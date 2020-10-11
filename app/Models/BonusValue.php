<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BonusValue extends Model
{
   	/**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'bonus_values';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['label','value'];
}
