<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TokenValueHistory extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'token_value_histories';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['value'];

}
