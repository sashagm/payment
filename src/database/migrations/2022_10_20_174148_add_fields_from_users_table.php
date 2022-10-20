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

        if (Schema::hasTable('users')) {
            
            if (!Schema::hasColumn('users', 'bonus')) {
                Schema::table('users', function (Blueprint $table) {
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
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('bonus');
        });
    }
};
