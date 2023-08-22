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

class GameFifteenService
{
    public function gameValue()
    {
        $total_winning_amount = 0;

        // $fifteen_minutes_game_play =     GamePlay::where('game_id', 2)->where('status',1)->first();
        // $fifteen_minutes_result_check = GameResult::where('game_play_id',$fifteen_minutes_game_play->id)->first();
        // if ($fifteen_minutes_result_check) {
        //     $total_winning_amount += $this->countGameValue($fifteen_minutes_result_check->color_game_details_id,1);
        //     $total_winning_amount += $this->countGameValue($fifteen_minutes_result_check->color_game_details_id,1);
        // }else{

        // }
        // 15 Minute Color Game
        $color_value = $this->gameInitiate(2, 1);
        $win_id_color = array_search(min($color_value), $color_value);
        $winning_amount_color = $color_value[$win_id_color];
        $total_winning_amount += $winning_amount_color;
        // 15 Minute Number Game amount in array of user played
        $number_value = $this->gameInitiate(2, 2);
        
        // Number Ending  Game amount in array of user played
        $number_ending_data = $this->gameInitiate(2, 3);
        // Number Ending  Game amount in array of user played With ending Value
        $number_ending_value = [];
        foreach ($number_ending_data as $key => $value) {
            $game_details = GameDetails::find($key);
            $number_ending_value[$game_details->game_value] = $value;
        }
        // Number Ending  Game amount Added With Number game amount for finding win game id
        foreach ($number_value as $key => $item) {
            $game_details = GameDetails::find($key);
            if (substr($game_details->game_value, -1) == 0) {
                $number_value[$key] = $item + $number_ending_value['0E'];
            }elseif (substr($game_details->game_value, -1) == 1) {
                $number_value[$key] = $item + $number_ending_value['1E'];
            }elseif (substr($game_details->game_value, -1) == 2) {
                $number_value[$key] = $item + $number_ending_value['2E'];
            }elseif (substr($game_details->game_value, -1) == 3) {
                $number_value[$key] = $item + $number_ending_value['3E'];
            }elseif (substr($game_details->game_value, -1) == 4) {
                $number_value[$key] = $item + $number_ending_value['4E'];
            }elseif (substr($game_details->game_value, -1) == 5) {
                $number_value[$key] = $item + $number_ending_value['5E'];
            }elseif (substr($game_details->game_value, -1) == 6) {
                $number_value[$key] = $item + $number_ending_value['6E'];
            }elseif (substr($game_details->game_value, -1) == 7) {
                $number_value[$key] = $item + $number_ending_value['7E'];
            }elseif (substr($game_details->game_value, -1) == 8) {
                $number_value[$key] = $item + $number_ending_value['8E'];
            }elseif (substr($game_details->game_value, -1) == 9) {
                $number_value[$key] = $item + $number_ending_value['9E'];
            }
        }

        // Find which number is win after calculation
        $win_id_number = array_search(min($number_value), $number_value);
        $winning_amount_number = $number_value[$win_id_number];
        $total_winning_amount += $winning_amount_number;

        Log::debug("number Value");
        Log::debug($number_value);
        Log::debug("Win id");
        Log::debug($win_id_number);
        Log::debug("Win Number");
        Log::debug($winning_amount_number);
        Log::debug("Win Amount");
        Log::debug($total_winning_amount);
        //Distribution of Amount Color GAme
        if ($winning_amount_color > 0) {
            $play_game_winner = $this->playGameWinner($win_id_color, 1);
        }
        //Distribution of Amount Number game
        if ($winning_amount_number > 0) {
            $play_game_winner = $this->playGameWinner($win_id_number, 2);
        }
        //Distribution of Amount Number Ending Game
        $ending_win_id = $this->getEndingGameId($win_id_number);
        if ($winning_amount_number > 0) {
            if ($ending_win_id) {
                $play_game_winner = $this->playGameWinner($ending_win_id->id, 3);
            }
        }
        Log::debug("Ending Win Id");
        Log::debug($ending_win_id);
        $game_play = GamePlay::whereGame_id(2)->whereStatus(1)->first();
        // Result Share to Latest Game
        $result = $this->result($win_id_number, $win_id_color, $game_play->id, $ending_win_id->id ?? null);
        // End user Play game in user Game Play table
        $end_user_game_play = UserPlayGame::where('game_play_id', $game_play->id)->update(['status' => 2]);
        //End Prevoius Game and Start a new Game   
        $this->gameReboot($game_play, $total_winning_amount);
        Log::info('15mGAME');
    }

    private function getEndingGameId($game_id)
    {
        $game_details = GameDetails::find($game_id);
        $win_id = substr($game_details->game_value, -1);
        if ($win_id == 0) {
            return GameDetails::select('id')->where('type', 3)->where('game_value', '0E')->first();
        } elseif ($win_id == 1) {
            return GameDetails::select('id')->where('type', 3)->where('game_value', '1E')->first();
        }
        elseif ($win_id == 2) {
            return GameDetails::select('id')->where('type', 3)->where('game_value', '2E')->first();
        }
        elseif ($win_id == 3) {
            return GameDetails::select('id')->where('type', 3)->where('game_value', '3E')->first();
        }
        elseif ($win_id == 4) {
            return GameDetails::select('id')->where('type', 3)->where('game_value', '4E')->first();
        }
        elseif ($win_id == 5) {
            return GameDetails::select('id')->where('type', 3)->where('game_value', '5E')->first();
        }
        elseif ($win_id == 6) {
            return GameDetails::select('id')->where('type', 3)->where('game_value', '6E')->first();
        }
        elseif ($win_id == 7) {
            return GameDetails::select('id')->where('type', 3)->where('game_value', '7E')->first();
        }
        elseif ($win_id == 8) {
            return GameDetails::select('id')->where('type', 3)->where('game_value', '8E')->first();
        }
        elseif ($win_id == 9) {
            return GameDetails::select('id')->where('type', 3)->where('game_value', '9E')->first();
        }
    }

    private function countGameValue($game_details_id, $type)
    {
        $game_play = GamePlay::whereGame_id(2)->whereStatus(1)->first();
        $playing_amount = UserPlayGame::where('game_details_id', $game_details_id)->where('game_play_id', $game_play->id)->where('status', 1)->sum('amount');
        if ($type == 1) {
            $playing_amount = $playing_amount * 7;
        } else if ($type == 2) {
            $playing_amount = $playing_amount * 60;
        }
        else if ($type == 3) {
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

    private function result($win_id_number, $win_id_color, $game_play_id, $ending_win_id = null)
    {
        $result = new GameResult();
        $result->game_play_id = $game_play_id;
        $result->number_game_details_id = $win_id_number;
        $result->color_game_details_id = $win_id_color;
        $result->ending_game_details_id = $ending_win_id;
        $result->save();
        return true;
    }


    private function playGameWinner($win_id, $type)
    {
        $game_play = Gameplay::whereGame_id(2)->whereStatus(1)->first();
        $game_winners = UserPlayGame::where('game_play_id', $game_play->id)->where('game_details_id', $win_id)->get();
        // Update User Wallet 
        if (isset($game_winners) && !empty($game_winners) && (count($game_winners) > 0)) {
            foreach ($game_winners as $winner) {
                $winner->is_win = 2;
                $winner->save();
                if ($type == 1) {
                    $user_wining_amount = $winner->amount * 7;
                } elseif ($type == 2) {
                    $user_wining_amount = $winner->amount * 60;
                }
                elseif ($type == 3) {
                    $user_wining_amount = $winner->amount * 7;
                }
                $user_id = $winner->user_id;
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
        $new_game_play->game_id = 2;
        $new_game_play->save();
        return true;
    }

    private function checkUserGamePlay($gameId, $gameType)
    {
        $game_play = Gameplay::whereGame_id($gameId)->whereType($gameType)->whereStatus(1)->first();
        $user_play_game = UserPlayGame::where('game_play_id', $game_play->id)->count();
        if ($user_play_game > 0) {
            return false;
        } else {
            return true;
        }
    }

    private function gameInitiate($gameId, $gameType)
    {
        $fifteen_minutes = GameDetails::where('game_id', $gameId)->whereType($gameType)->get();
        $ids = collect($fifteen_minutes)->map(function ($row) {
            return $row->id;
        });
        foreach ($ids as $id) {
            $value[$id] = $this->countGameValue($id, $gameType);
        }
        return $value;
    }
}
