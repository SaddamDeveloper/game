<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\GameResultResource;
use Illuminate\Http\Request;
use App\Models\GamePlay;
use App\Models\UserPlayGame;
use App\Models\GameResult;
use App\Models\GameDetails;
use App\Models\Wallet;
use App\Models\WalletHistory;
use App\Services\GameThreeService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class GameController extends Controller
{
  public function gamePlayThree()
  {
    $game_play = Gameplay::where('status', 1)->where('game_id', 1)->first();
    $db_time = $game_play->created_at;
    $db_time = $db_time->toDateTimeString();
    $current_time = Carbon::now()->toDateTimeString();
    $startTime = Carbon::parse($db_time);
    $finishTime = Carbon::parse($current_time);
    $diff_in_sec = $startTime->diffInSeconds($finishTime);
    $game_status = true;
    if ($diff_in_sec >= 180) {
      $game_status = false;
    } else {
      $diff_in_sec = 180 - $diff_in_sec;
      $game_play->setAttribute('timer', $diff_in_sec);
    }
    if ($game_play) {
      $response = [
        'status' => 'true',
        'message' => 'game_play',
        'game_status' => $game_status,
        'data' => $game_play
      ];
    }
    return response()->json($response, 200);
  }

 
  public function gameFullThreeResult()
  {
    // 10 results
    $game_play = GamePlay::select(
      'game_play.id as game_play_id',
      'game_result.number_game_details_id',
      'game_result.color_game_details_id',
      'game_result.created_at'
    )
      ->addSelect(['number_value' => function ($query) {
        $query->select('game_value')
          ->from('game_details')
          ->whereColumn('id', 'game_result.number_game_details_id')
          ->limit(1);
      }])
      ->addSelect(['color_value' => function ($query) {
        $query->select('color')
          ->from('game_details')
          ->whereColumn('id', 'game_result.color_game_details_id')
          ->limit(1);
      }])
      ->join('game_result', 'game_result.game_play_id', '=', 'game_play.id')
      ->where('game_play.status', 2)

      ->orderBy('game_play.id', 'desc')
      ->paginate(10);
    return $game_play;
  }
  
  public function userPlayGame(Request $request)
  {
    $this->validate($request, [
      'type' => 'required|numeric',
      'amount' => 'required|numeric',
      'contractMoney' => 'required|numeric',
      'qty' => 'required|numeric'
    ]);
    $user = Auth::guard('sanctum')->user();
    $wallet = Wallet::where('user_id', $user->id)->first();
    $wallet_balance = $wallet->amount;
    $total_amount = $request->input('amount') * $request->input('qty');
    if ($wallet_balance <= 10 || $wallet_balance < $total_amount) {
      return response()->json(['msg' => 'Wallet balance is low!', 'status' => 'LOW_BAL']);
    }
    if (($wallet_balance - $total_amount) < 10) {
      return response()->json(['msg' => 'Maintain minimum 10 rupees balance!', 'status' => 'MAINTAIN_BAL']);
    }
    try {
      $walletAmount = 0;
      DB::transaction(function () use ($request, $user, $wallet_balance, $total_amount, $wallet, &$walletAmount) {
        $game_play = Gameplay::whereStatus(1)->latest()->first();
        $user_play = new UserPlayGame;
        $user_play->game_play_id = $game_play->id;
        $user_play->user_id = $user->id;
        $user_play->game_details_id = $request->input('type');
        $user_play->amount = $total_amount;
        $user_play->save();
        // Deduct from wallet
        $wallet->amount = ($wallet_balance - $total_amount);
        $walletAmount = $wallet->amount;
        $wallet->save();
        // Insert in Wallet History
        $wallet_history = new WalletHistory();
        $wallet_history->wallet_id = $wallet->id;
        $wallet_history->comment = 'Rs. ' . $total_amount . ' has been deducated from your account!';
        $wallet_history->amount  = $total_amount;
        $wallet_history->total = $wallet->amount;
        $wallet_history->status = 2;
        $wallet_history->save();
      });
      $response = [
        'status' => true,
        'data' => $user
      ];
      return response()->json($response, 200);
    } catch (\Exception $e) {
      return response()->json($e, 200);
    }
  }

  public function gameResult($game_id, $user_id)
  {
    $game_result = GameResult::where('game_play_id', $game_id)
      ->addSelect(['number_value' => function ($query) {
        $query->select('game_value')
          ->from('game_details')
          ->whereColumn('id', 'game_result.number_game_details_id')
          ->limit(1);
      }])
      ->addSelect(['color_value' => function ($query) {
        $query->select('color')
          ->from('game_details')
          ->whereColumn('id', 'game_result.color_game_details_id')
          ->limit(1);
      }])
      ->first();
    // $user_id = Auth::guard('sanctum')->user()->id;
    //User is win Or Not
    $user_game_plays = UserPlayGame::where('user_id', $user_id)
      ->where('game_play_id', $game_id)
      ->where('status', 2)
      ->where('is_win', 2)
      ->get();

    $winingAmount = 0;
    foreach ($user_game_plays as $key => $item) {
      if ($game_result->number_game_details_id == $item->game_details_id) {
        $winingAmount += $item->amount * 60;
      } elseif ($game_result->ending_game_details_id == $item->game_details_id) {
        $winingAmount += $item->amount * 7;
      }elseif ($game_result->color_game_details_id == $item->game_details_id) {
        $winingAmount += $item->amount * 7;
      }
    }
    $response = [
      'status' => 'true',
      'message' => 'game_result',
      'data' => [
        'game_id' => $game_id,
        'result' => $game_result,
        'winning_amount' => $winingAmount
      ]
    ];
    return response()->json($response, 200);

    // return $user_game_plays;
    // $winning_amount = 0;
    // if ($user_game_plays) {
    //   // Fetch win amount
    //   foreach ($user_game_plays as $item) {
    //   }
    // }
    // return $winning_amount;
    // $winning_amount = 0;
    // $number = null;
    // $colors = [];
    // $number_data = GameResult::where('game_play_id', $game_id)->where('game_details_id', '<', 11)->first();
    // $color_data = GameResult::where('game_play_id', $game_id)->where('game_details_id', '>', 10)->get();
    // foreach ($color_data as $value) {
    //   $colors[] = [
    //     'name' => isset($value->gameDetails->game_value) ? $value->gameDetails->game_value : '',
    //     'color' => isset($value->gameDetails->color) ? $value->gameDetails->color : '',
    //   ];
    // }
    // $number = isset($number_data->gameDetails->game_value) ? $number_data->gameDetails->game_value : '';

    // // If user play game
    // $user_play_game = UserPlayGame::where('game_play_id', $game_id)->whereUser_id($user_id)->whereIs_win(2)->whereStatus(2)->get();
    // if ($user_play_game) {
    //   // Fetch win amount
    //   foreach ($user_play_game as $item) {
    //     $game_three_service = new GameThreeService();
    //     $winning_amount += $game_three_service->userWinAmount($item, $number);
    //   }
    // }
  }

  public function gameValue()
  {

    $odd_number_count = $this->countGameValue(11);
    $even_number_count = $this->countGameValue(12);
    $copper_number_count = $this->countGameValue(13);

    $count_zero_amount = $this->countGameValue(1);
    $count_one_amount = $this->countGameValue(2);
    $count_two_amount = $this->countGameValue(3);
    $count_three_amount = $this->countGameValue(4);
    $count_four_amount = $this->countGameValue(5);
    $count_five_amount = $this->countGameValue(6);
    $count_six_amount = $this->countGameValue(7);
    $count_seven_amount = $this->countGameValue(8);
    $count_eight_amount = $this->countGameValue(9);
    $count_nine_amount = $this->countGameValue(10);

    $zero_total = ($count_zero_amount * 9) + ($even_number_count * 1.5) + ($copper_number_count * 4);
    $one_total = ($count_one_amount * 9) + ($count_one_amount * 2);
    $two_total = ($count_two_amount * 9) + ($count_two_amount * 2);
    $three_total = ($count_three_amount * 9) + ($count_three_amount * 2);
    $four_total = ($count_four_amount * 9) + ($count_four_amount * 2);
    $five_total = ($count_five_amount * 9) + ($copper_number_count * 4) + ($odd_number_count * 1.5);
    $six_total = ($count_six_amount * 9) + ($count_six_amount * 2);
    $seven_total = ($count_seven_amount * 9) + ($count_seven_amount * 2);
    $eight_total = ($count_eight_amount * 9) + ($count_eight_amount * 2);
    $nine_total = ($count_nine_amount * 9) + ($count_nine_amount * 2);

    $total_arr = [
      '1' => $zero_total,
      '2' => $one_total,
      '3' => $two_total,
      '4' => $three_total,
      '5' => $four_total,
      '6' => $five_total,
      '7' => $six_total,
      '8' => $seven_total,
      '9' => $eight_total,
      '10' => $nine_total
    ];
    $min_total_id = array_search(min($total_arr), $total_arr);
    $winning_amount = $total_arr[$min_total_id];
    $min_total = $this->winningGame($min_total_id);
    $user_wallet = $this->wallet($min_total_id, $winning_amount);
    if ($user_wallet == true) {
      $wallet_history = $this->walletHistory($min_total_id, $winning_amount);
    }
  }

  private function countGameValue($game_details_id)
  {
    $playnig_count = UserPlayGame::where('game_details_id', $game_details_id)->where('status', 1)->sum('amount');
    return $playnig_count;
  }

  private function winningGame($min_total_id)
  {
    $game_play = new GamePlay();
    $game_play->game_id = 1;
    $game_play->winning_game_detail_id = $min_total_id;
    $game_play->save();
  }

  private function wallet($game_details_id, $winning_amount)
  {
    $user_play_game = userPlayGame::where('game_details_id', $game_details_id)->get();
    if (!empty($user_play_game)) {
      foreach ($user_play_game as $user_play_game) {
        $wallet = new wallet;
        $wallet->user_id = $user_play_game->user_id;
        $wallet->amount = $winning_amount;
        $wallet->save();
        return true;
      }
    } else {
      return false;
    }
  }

  private function walletHistory($game_details_id, $winning_amount)
  {
    $user_play_game = userPlayGame::where('game_details_id', $game_details_id)->get();

    if (!empty($user_play_game)) {
      foreach ($user_play_game as $user_play_game) {
        $prev_wallet_tot = walletHistory::where('user_id', $user_play_game->user_id)->sum('total');
        $wallet_history = new WalletHistory;
        $wallet_history->user_id = $user_play_game->user_id;
        $wallet_history->comment = "Winning Amount";
        $wallet_history->amount = $winning_amount;
        $wallet_history->total = $prev_wallet_tot + $winning_amount;
        $wallet_history->save();
      }
    }
  }



  //////////////////////Fifteen Minutes/////////////////////

  public function gamePlayFifteen()
  {
    $game_play = Gameplay::where('status', 1)->where('game_id', 2)->first();
    $db_time = $game_play->created_at;
    $db_time = $db_time->toDateTimeString();
    $current_time = Carbon::now()->toDateTimeString();
    $startTime = Carbon::parse($db_time);
    $finishTime = Carbon::parse($current_time);
    $diff_in_sec = $startTime->diffInSeconds($finishTime);
    $game_status = true;
    if ($diff_in_sec >= 70) {
      $game_status = false;
    } else {
      $diff_in_sec = 70 - $diff_in_sec;
      $game_play->setAttribute('timer', $diff_in_sec);
    }
    if ($game_play) {
      $response = [
        'status' => 'true',
        'message' => 'game_play',
        'game_status' => $game_status,
        'data' => $game_play
      ];
    }
    return response()->json($response, 200);
  }
  public function gameFullFifteenResult()
  {
    // 10 results
    $game_play = GamePlay::select(
      'game_play.id as game_play_id',
      'game_result.number_game_details_id',
      'game_result.color_game_details_id',
      'game_result.ending_game_details_id',
      'game_result.created_at'
    )
      ->addSelect(['number_value' => function ($query) {
        $query->select('game_value')
          ->from('game_details')
          ->whereColumn('id', 'game_result.number_game_details_id')
          ->limit(1);
      }])
      ->addSelect(['ending_number_value' => function ($query) {
        $query->select('game_value')
          ->from('game_details')
          ->whereColumn('id', 'game_result.ending_game_details_id')
          ->limit(1);
      }])
      ->addSelect(['color_value' => function ($query) {
        $query->select('color')
          ->from('game_details')
          ->whereColumn('id', 'game_result.color_game_details_id')
          ->limit(1);
      }])
      ->join('game_result', 'game_result.game_play_id', '=', 'game_play.id')
      ->where('game_play.status', 2)

      ->orderBy('game_play.id', 'desc')
      ->paginate(10);
    return $game_play;
  }

  ///unused
  public function gameResultFifteen($game_id, $user_id)
  {
    $game_result = GameResult::where('game_play_id', $game_id)
      ->addSelect(['number_value' => function ($query) {
        $query->select('game_value')
          ->from('game_details')
          ->whereColumn('id', 'game_result.number_game_details_id')
          ->limit(1);
      }])
      ->addSelect(['ending_number_value' => function ($query) {
        $query->select('game_value')
          ->from('game_details')
          ->whereColumn('id', 'game_result.ending_game_details_id')
          ->limit(1);
      }])
      ->addSelect(['color_value' => function ($query) {
        $query->select('color')
          ->from('game_details')
          ->whereColumn('id', 'game_result.color_game_details_id')
          ->limit(1);
      }])
      ->first();
    // $user_id = Auth::guard('sanctum')->user()->id;
    $user_game_plays = UserPlayGame::where('user_id', $user_id)
      ->where('game_play_id', $game_id)
      ->where('status', 2)
      ->where('is_win', 2)
      ->get();
    $winingAmount = 0;
    foreach ($user_game_plays as $key => $item) {
      if ($game_result->number_game_details_id == $item->game_details_id) {
        $winingAmount += $item->amount * 60;
      } elseif ($game_result->ending_game_details_id == $item->game_details_id) {
        $winingAmount += $item->amount * 7;
      }
      elseif ($game_result->color_game_details_id == $item->game_details_id) {
        $winingAmount += $item->amount * 7;
      }
    }
    $response = [
      'status' => 'true',
      'message' => 'game_result',
      'data' => [
        'game_id' => $game_id,
        'result' => $game_result,
        'winning_amount' => $winingAmount
      ]
    ];
    return response()->json($response, 200);
  }
}
