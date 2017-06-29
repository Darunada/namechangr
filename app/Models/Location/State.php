<?php

namespace App\Models\Location;

use App\Scopes\ActiveScope;
use Illuminate\Database\Eloquent\Model;

class State extends Model
{

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'active' => 'boolean',
    ];

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        // add an active scope to prevent inactive states from being returned
        static::addGlobalScope(new ActiveScope());
    }

    /**
     * States have 1..n counties
     */
    public function counties()
    {
        return $this->hasMany('App\Models\Location\County');
    }

    /**
     * States have 1..n districts
     */
    public function districts()
    {
        return $this->hasMany('App\Models\Court\District');
    }

    /**
     * States have 1..n locations through counties
     */
    public function locations() {
        return $this->hasManyThrough('App\Models\Court\Location', 'App\Models\Location\County');
    }

    /**
     *
     * @return string
     */
    public function code() {
        return $this->iso_3166_2;
    }
}
