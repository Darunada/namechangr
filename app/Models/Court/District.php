<?php

namespace App\Models\Court;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class District extends Model
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
     * Districts are associated with 1 state
     */
    public function state()
    {
        $this->belongsTo('App\Models\Location\State');
    }

    /**
     * Districts are associated with 1..n counties
     */
    public function counties()
    {
        $this->belongsToMany('App\Models\Location\County', 'district_counties');
    }

}
