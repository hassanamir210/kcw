<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableUserAddImageColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $sql = 'ALTER TABLE `users` ADD `id_front_image` VARCHAR(20) NULL DEFAULT NULL AFTER `total_points`, ADD `id_back_image` VARCHAR(20) NULL DEFAULT NULL AFTER `id_front_image`, ADD `passport_front_image` VARCHAR(20) NULL DEFAULT NULL AFTER `id_back_image`, ADD `passport_back_image` VARCHAR(20) NULL DEFAULT NULL AFTER `passport_front_image`;';

        DB::connection()->getPdo()->exec($sql);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
