<?php

namespace App\Models\Application;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class File extends Model
{
    use SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'application_files';

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'modified_at',
        'deleted_at',
        'expired_at'
    ];

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('expired', function (Builder $builder) {
            $builder->whereDate('expired_at', '>', Carbon::now());
        });
    }

    /**
     * All files belong to a user
     */
    function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * all files belong to an application
     */
    function application()
    {
        return $this->belongsTo('App\Models\Application\Application');
    }
}
