<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Repositories\GameHistoryRepository;
use App\Repositories\GameDailyRepository;
use App\Repositories\TempRepository;

class DailyCalculation extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'calculate:daily {date?}';

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
    public function __construct(GameDailyRepository $daily, GameHistoryRepository $history, TempRepository $temp)
    {
        parent::__construct();

        $this->daily = $daily;
        $this->history = $history;
        $this->temp = $temp;

    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $date = $this->hasArgument('date') ? $this->argument('date') : null;
        $date = is_null($date) ? date("Y-m-d") : date("Y-m-d", strtotime($date));

        $this->calculate($date);
    }

    protected function calculate($date)
    {
        $this->info($this->description);

        $getLimit = $this->temp->getData();
        $offset = $getLimit->offset;
        $limit = $getLimit->limit;

        $getHistory = $this->history->getData($offset, $limit);

        if($getHistory->isNotEmpty()){
            $group = $getHistory->groupBy('user_id');

            $max = $getHistory->max()->id;

            $group->each(function($item, $userID) use ($max) {
                $amount = $item->reduce(function($carry, $item){
                    return $carry + $item->amount;
                }, 0);

                $result = $item->reduce(function($carry, $item){
                    return $carry + $item->result;
                }, 0); 

                $limiData = array(
                    'offset' => $max,
                );
                $this->temp->update(1, $limiData);
                $betTime = date('Y-m-d', strtotime($item[0]->bet_time));

                $exists = $this->daily->exists($userID, $betTime);

                if(empty($exists)){
                    $data = array(
                        'user_id' => $userID,
                        'amount' => $amount,
                        'result' => $result,
                        'bet_time' => $betTime
                    );
                    $this->daily->create($data);
                }else{
                    $data = array(
                        'amount' => bcadd($amount, $exists->amount, 2),
                        'result' => bcadd($result, $exists->result, 2),
                    );

                    $this->daily->update($userID, $data);
                }

            });
        }        
    }

    
}