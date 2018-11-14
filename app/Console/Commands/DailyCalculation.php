<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Repositories\GameHistoryRepository;
use App\Repositories\GameDailyRepository;


use Log;

class DailyCalculation extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'calculate:daily';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '每日結算';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(GameDailyRepository $daily, GameHistoryRepository $history)
    {
        parent::__construct();

        $this->daily = $daily;
        $this->history = $history;

    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->calculate();
    }

    protected function calculate()
    {
        $this->info($this->description);

        
        
        
    }

    
}