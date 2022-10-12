<?php

namespace Sashagm\Payment\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Sashagm\Payment\Models\Payment;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

class PaymentUpdateCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'payment:update {desc} ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Обновить тестовый платёж';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $order_id = $this->argument('desc');
        $payment = Payment::where('desc', $order_id)->first();
        if ($payment){
            if ($payment->status == 0) {
                $payment->sum_bonus = $payment->sum;
                $payment->status = 1;
                $payment->save();
                $user = User::where('id', $payment->user_id)->first();
                $user->bonus = $user->bonus + $payment->sum;
                $user->save();
                $this->info("Платёж $order_id успешно зачислен!");
            } else {
                $this->info("Платёж $order_id ранее уже был зачислен!");
            }

        } else {  $this->info("Платёж $order_id не найден!"); }

    }
}
