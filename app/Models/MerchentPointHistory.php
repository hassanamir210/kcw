<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MerchentPointHistory extends Model
{
     /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'merchent_point_histories';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id','point'];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
