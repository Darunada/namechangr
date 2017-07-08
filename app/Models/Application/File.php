<?php

namespace App\Models\Application;

use Illuminate\Database\Eloquent\Model;

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
     * All files belong to a user
     */
    function user() {
        return $this->belongsTo('App\User');
    }

    /**
     * all files belong to an application
     */
    function application() {
        return $this->belongsTo('App\Models\Application\Application');
    }
}
