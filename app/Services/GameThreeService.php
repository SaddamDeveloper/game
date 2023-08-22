<?php

namespace App\Services;

use App\Models\GameDetails;
use App\Models\GamePlay;
use App\Models\GameResult;
use App\Models\UserPlayGame;
use App\Models\Wallet;
use App\Models\WalletHistory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class GameThreeService
{
    public function gameValue()
    {
        $total_winning_amount = 0;
        // 3 Minute Color Game
        $color_value = $this->gameInitiate(1, 1);
        $win_id_color = array_search(min($color_value), $color_value);
        $winning_amount_color = $color_value[$win_id_color];
        $total_winning_amount += $winning_amount_color;

        // 3 Minute Number Game
        $number_value = $this->gameInitiate(1, 2);
        $win_id_number = array_search(min($number_value), $number_value);
        $winning_amount_number = $number_value[$win_id_number];
        $total_winning_amount += $winning_amount_number;

        //Distribution of Amount Color GAme
        if ($winning_amount_color > 0) {
            $play_game_winner = $this->playGameWinner($win_id_color, 1);
        }
        //Distribution of Amount Number game
        if ($winning_amount_number > 0) {
            $play_game_winner = $this->playGameWinner($win_id_number, 2);
        }

        $game_play = GamePlay::whereGame_id(1)->whereStatus(1)->first();
        // Result Share to Latest Game
        $result = $this->result($win_id_number, $win_id_color, $game_play->id);
        // End user Play game in user Game Play table
        $end_user_game_play = UserPlayGame::where('game_play_id', $game_play->id)->update(['status' => 2]);
        //End Prevoius Game and Start a new Game   
        $this->gameReboot($game_play, $total_winning_amount);
        Log::info('ILOVEYOU');
    }

    public function countGameValue($game_details_id, $type)
    {
        $game_play = GamePlay::whereGame_id(1)->whereStatus(1)->first();
        $playing_amount = UserPlayGame::where('game_details_id', $game_details_id)->where('game_play_id', $game_play->id)->where('status', 1)->sum('amount');
        if ($type == 1) {
            $playing_amount = $playing_amount * 3;
        } else {
            $playing_amount = $playing_amount * 7;
        }
        return $playing_amount;
    }

    private function wallet($user_id, $winning_amount)
    {
        $wallet = Wallet::where('user_id', $user_id)->first();
        $wallet->amount = ($wallet->amount + $winning_amount);
        $wallet->save();
        $this->walletHistory($wallet->id, $winning_amount, $wallet->amount, $user_id);
    }

    private function walletHistory($wallet_id, $winning_amount, $wallet_amount)
    {
        $wallet_history = new WalletHistory;
        $wallet_history->wallet_id = $wallet_id;
        $wallet_history->comment = $winning_amount . " Winning Amount credited to wallet.";
        $wallet_history->amount = $winning_amount;
        $wallet_history->total = $wallet_amount;
        $wallet_history->save();
    }

    private function result($win_id_number, $win_id_color, $game_play_id)
    {
        $result = new GameResult();
        $result->game_play_id = $game_play_id;
        $result->number_game_details_id = $win_id_number;
        $result->color_game_details_id = $win_id_color;
        $result->save();
        return true;
    }

    private function playGameWinner($win_id, $type)
    {

        $game_play = Gameplay::whereGame_id(1)->whereStatus(1)->first();
        $user_play_game = UserPlayGame::where('game_play_id', $game_play->id)->where('game_details_id', $win_id)->get();
        // Update User Wallet 
        if (isset($user_play_game) && !empty($user_play_game) && (count($user_play_game) > 0)) {
            foreach ($user_play_game as $upg) {
                $upg->is_win = 2;
                $upg->save();
                if ($type == 1) {
                    $user_wining_amount = $upg->amount * 3;
                } else {
                    $user_wining_amount = $upg->amount * 7;
                }
                $user_id = $upg->user_id;
                try {
                    DB::transaction(function () use ($user_id, $user_wining_amount) {
                        $this->wallet($user_id, $user_wining_amount);
                    });
                } catch (\Exception $e) {
                    return redirect()->back();
                }
            }
            $user_play_game = UserPlayGame::where('game_play_id', $game_play->id)->update(['status' => 2]);
        } else {
            return false;
        }
    }

    private function gameReboot($game_play, $wining_amt)
    {
        $game_play->status = 2;
        $game_play->winning_amt = $wining_amt;
        $game_play->save();
        $new_game_play = new GamePlay();
        $new_game_play->game_id = 1;
        $new_game_play->save();
        return true;
    }

    private function checkUserGamePlay()
    {
        $game_play = Gameplay::whereGame_id(1)->whereStatus(1)->first();
        $user_play_game = UserPlayGame::where('game_play_id', $game_play->id)->count();
        if ($user_play_game > 0) {
            return false;
        } else {
            return true;
        }
    }

    private function gameInitiate($gameId, $gameType)
    {
        $three_minutes = GameDetails::where('game_id', $gameId)->whereType($gameType)->get();
        $ids = collect($three_minutes)->map(function ($row) {
            return $row->id;
        });
        
        foreach ($ids as $id) {
            $value[$id] = $this->countGameValue($id, $gameType);
        }
        return $value;
    }
}
