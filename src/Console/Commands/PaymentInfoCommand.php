<?php

namespace Sashagm\Payment\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Sashagm\Payment\Models\Payment;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

class PaymentInfoCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'payment:info {desc} ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Получить информацию по платежу';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $order_id = $this->argument('desc');
        $payment = Payment::where('desc', $order_id)->first();
        $user = User::where('id', $payment->user_id)->first();
        if($payment) {
            dd($payment);



        } else {  $this->info("Платёж $order_id не найден!"); }

    }
}
