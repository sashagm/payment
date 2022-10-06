<?php

namespace Sashagm\Payment\Console\Commands;

use Illuminate\Console\Command;

class PaymentCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'payment:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $ask = $this->ask('Начать установку?');
        dd($ask);
    }
}
