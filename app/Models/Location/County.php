<?php

namespace App\Models\Location;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * States
 *
 */
class County extends Model
{
    use SoftDeletes;

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'deleted_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'deleted_at'
    ];

    /**
     * Counties have 1 state
     */
    public function state()
    {
        return $this->belongsTo('App\Models\Location\State');
    }

    /**
     * Counties have 1..n districts
     */
    public function districts()
    {
        return $this->belongsToMany('App\Models\Court\District', 'district_counties');
    }
}
