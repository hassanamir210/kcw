<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableUsersAddBankColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $sql = 'ALTER TABLE `users` ADD `bank_account_no` VARCHAR(255) NULL DEFAULT NULL AFTER `block_chain_address`, ADD `bank_name` VARCHAR(255) NULL DEFAULT NULL AFTER `bank_account_no`, ADD `bank_user_title` VARCHAR(255) NULL DEFAULT NULL AFTER `bank_name`, ADD `bank_branch_code` VARCHAR(255) NULL DEFAULT NULL AFTER `bank_user_title`;';

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
