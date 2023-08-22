<?php

namespace App\Http\Controllers\Admin\Game;

use App\Http\Controllers\Controller;
use App\Models\GameDetails;
use App\Models\GamePlay;
use App\Models\GameResult;
use App\Models\UserPlayGame;
use Carbon\Carbon;
use Illuminate\Http\Request;

class GameResultController extends Controller
{
    public function index()
    {
        return view('admin.game.index');
    }

    public function game()
    {
        $game_play = Gameplay::where('status', 1)->where('game_id', 2)->first();
        $color = $game_play->gameResult->colorGameDetails ?? null;
        $number = $game_play->gameResult->numberGameDetails ?? null;
        $ending = $game_play->gameResult->endingGameDetails ?? null;
        $db_time = $game_play->created_at;
        $db_time = $db_time->toDateTimeString();
        $current_time = Carbon::now()->toDateTimeString();
        $startTime = Carbon::parse($db_time);
        $finishTime = Carbon::parse($current_time);
        $diff_in_sec = $startTime->diffInSeconds($finishTime);
        $game_status = true;
        if ($diff_in_sec >= 900) {
            $game_status = false;
          } else {
            $diff_in_sec = 900 - $diff_in_sec;
            $game_play->setAttribute('timer', $diff_in_sec);
          }
        if (!empty($color)) {
            $game_play->setAttribute('color', '<span class="wi-badge-result" style="background-color:'.$color->color.'"></span>');
        }
        if(!empty($number)){
            $game_play->setAttribute('number', $number->game_value);
        }
        if(!empty($ending)){
            $game_play->setAttribute('ending', $ending->game_value);
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

    public function gameWinAmountFetch($type,$data)
    {
        // 1 = color, 2 = number, 3 = ending
        $game_play = 0;
        $playing_game = GamePlay::where('status',1)->where('game_id',2)->first();
        if ($type == 1) {
            $game_play = UserPlayGame::where('game_play_id',$playing_game->id)->where('game_details_id',$data)->sum('amount');
        }elseif ($type == 2) {
            
            $game_detail = GameDetails::where('game_id',2)->where('game_value',$data)->first();
            if ($game_detail) {
                $game_play = UserPlayGame::where('game_play_id',$playing_game->id)->where('game_details_id',$game_detail->id)->sum('amount');
            }
        }elseif($type == 3){
            $col_val = $data."E";
            $game_detail = GameDetails::where('game_id',2)->where('game_value',$col_val)->first();

            $game_play = UserPlayGame::where('game_play_id',$playing_game->id)->where('game_details_id',$game_detail->id)->sum('amount');
        }
        return $game_play;
    }

    public function resultInsert(Request $request)
    {
        $this->Validate($request,[
            'number' =>'required',
            'color' =>'required',
            'ending' => 'required',
        ]);

        $game_play = GamePlay::where('game_id',2)->where('status',1)->first();
        if ($game_play) {
            $game_result = new GameResult();
            $game_result->game_play_id = $game_play->id;
            $game_result->number_game_details_id = $request->input('number');
            $game_result->color_game_details_id = $request->input('color');
            $game_result->ending_game_details_id = $request->input('ending');
            $game_result->save();
            return 1;
        }else{
            return 2;
        }
    }
}
