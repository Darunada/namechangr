<?php

namespace App\Models;

use App\Models\Location\State;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'name_change' => 'boolean',
        'gender_change' => 'boolean',
        'data' => 'array'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['state_id', 'name_change', 'gender_change', 'data'];

    /**
     * All applications belong to a user
     */
    function user() {
        return $this->belongsTo('App\User');
    }

    /**
     * An application occurs within a state
     */
    function state() {
        return $this->belongsTo('App\Models\Location\State');
    }

}
