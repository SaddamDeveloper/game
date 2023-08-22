<?php

namespace App\Console\Commands;

use App\Services\GameFifteenService;
use Illuminate\Console\Command;

class EveryFifteen extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fifteen:execute';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This is the artisan command for game executoin every Fifteen minutes';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        // 15 Minutes Game
        $game_fifteen_service = new GameFifteenService();
        $game_fifteen_service->gameValue();    
    }
}
