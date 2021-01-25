<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableMerchentPointHistories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         $sql = 'CREATE TABLE `merchent_point_histories` (
                      `id` int(10) NOT NULL AUTO_INCREMENT,
                      `user_id` int(10) NOT NULL,
                      `point` decimal(8,2) NOT NULL,
                      `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
                      `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
                      PRIMARY KEY (`id`)
                    ) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4';

        DB::connection()->getPdo()->exec($sql);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('table_merchent_point_histories');
    }
}
