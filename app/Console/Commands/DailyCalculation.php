<?php

namespace App\Console\Commands;

use App\Repositories\GameDailyRepository;
use App\Repositories\GameHistoryRepository;
use App\Repositories\QueryLimitRepository;
use Illuminate\Console\Command;

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
    public function __construct(GameDailyRepository $daily, GameHistoryRepository $history, QueryLimitRepository $limit)
    {
        parent::__construct();

        $this->daily = $daily;
        $this->history = $history;
        $this->temp = $limit;

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
        $this->info($this->description . '開始');

        $getLimit = $this->temp->getData();
        $offset = $getLimit->offset;
        $limit = $getLimit->limit;

        $getHistory = $this->history->getData($offset, $limit);

        if ($getHistory->isNotEmpty()) {
            $group = $getHistory->groupBy('user_id');

            $maxID = $getHistory->max()->id;

            $group->each(function ($item, $userID) use ($maxID) {
                $amount = $item->reduce(function ($carry, $item) {
                    return $carry + $item->amount;
                }, 0);

                $result = $item->reduce(function ($carry, $item) {
                    return $carry + $item->result;
                }, 0);

                $limiData = array(
                    'offset' => $maxID,
                );
                $this->temp->update(1, $limiData);
                $betTime = date('Y-m-d', strtotime($item[0]->bet_time));

                $exists = $this->daily->exists($userID, $betTime);

                if (empty($exists)) {
                    $data = array(
                        'user_id' => $userID,
                        'amount' => $amount,
                        'result' => $result,
                        'bet_time' => $betTime,
                    );
                    $this->daily->create($data);
                } else {
                    $data = array(
                        'amount' => bcadd($amount, $exists->amount, 2),
                        'result' => bcadd($result, $exists->result, 2),
                        'updated_at' => date('Y-m-d H:i:s')
                    );

                    $this->daily->update($userID, $data);
                }

            });

            $this->info('統計結束');
        } else {
            $this->info('無新紀錄');
        }
    }

}
