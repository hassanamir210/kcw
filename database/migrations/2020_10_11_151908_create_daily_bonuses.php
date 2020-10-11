<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDailyBonuses extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $sql = 'CREATE TABLE `bonus_values` (
                  `id` int(10) NOT NULL AUTO_INCREMENT,
                  `label` varchar(50) DEFAULT NULL,
                  `value` decimal(8,2) DEFAULT NULL,
                  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
                  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
                  PRIMARY KEY (`id`)
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4';

        DB::connection()->getPdo()->exec($sql);

        

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('daily_bonuses');
    }
}
