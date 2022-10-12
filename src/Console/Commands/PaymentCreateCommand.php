<?php

namespace Sashagm\Payment\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Sashagm\Payment\Models\Payment;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

class PaymentCreateCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'payment:create {user} {sum} ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Создать тестовый платёж';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(Faker $faker)
    {
        $login = $this->argument('user');
        $order_id = Str::random(10);
        $sum = $this->argument('sum');
        $user = User::where('name', $login)->first();
        if($user) {
        $payment = Payment::create([
            'user_id'   =>  $user->id,
            'desc'      =>  $order_id,
            'sum'       =>  $sum,
            'provider'  =>  0,
            'status'    =>  0
        ]);
        $payment->save();
        $this->info("Платёж $order_id на сумму $sum успешно создан для пользователя $login !"); } else 
        {
            $this->info("Логин $login не найден!"); 
        }
    }
}
