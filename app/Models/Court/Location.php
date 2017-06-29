<?php

namespace App\Models\Court;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Location
 *
 */
class Location extends Model
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

    /*
     * Belongs to
     */
    public function district()
    {
        return $this->belongsTo('App\Models\Court\District');
    }

    public function county()
    {
        return $this->belongsTo('App\Models\Location\County');
    }
}
