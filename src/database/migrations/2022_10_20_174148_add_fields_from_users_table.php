<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        if (Schema::hasTable(config('payment.general.userTable'))) {
            
            if (!Schema::hasColumn(config('payment.general.userTable'), 'bonus')) {
                Schema::table(config('payment.general.userTable'), function (Blueprint $table) {
                    $table->decimal('bonus', $precision = 10, $scale = 2)->default(0.00);
                });
            }            


        }
 
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table(config('payment.general.userTable'), function (Blueprint $table) {
            $table->dropColumn('bonus');
        });
    }
};
