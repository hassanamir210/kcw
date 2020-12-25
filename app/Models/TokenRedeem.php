<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;

class TokenRedeem extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'token_redeems';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id','tokens','value','status'];

    /**
     * @return string
     */
    public function user()
    {
        return $this->hasOne(User::class,'id','user_id');
    }
}
