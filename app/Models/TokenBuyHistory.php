<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TokenBuyHistory extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'token_buy_histories';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['amount'];
}
