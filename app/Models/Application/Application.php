<?php

namespace App\Models\Application;

use App\Scopes\ActiveScope;
use Carbon\Carbon;
use Crypt;
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
        'data' => 'array',
        'is_generating_documents' => 'boolean'
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

    /**
     * An application can have many files
     */
    function files() {
        return $this->hasMany('App\Models\Application\File');
    }

    function getParsedData() {
        $data = $this->data; // array right?
        $data = $this->adjustGenders($data);
        return $this->parseData($data);
    }

    /**
     * Set data
     *
     * @param  string  $value
     * @return void
     */
    public function setDataAttribute($value)
    {
        $this->attributes['data'] = Crypt::encrypt($value);
    }

    /**
     * Get data
     *
     * @param  string  $value
     * @return string
     */
    public function getDataAttribute($value) {
        try {
            $value = Crypt::decrypt($value);
        } catch (\Exception $e) {
            // do nothing
            // perhaps the stored value is still plain text
        }

        return $value;
    }

    private function parseData(array &$arr) {

        foreach($arr as $key=>&$value) {
            if(is_array($value)) {
                $arr[$key] = $this->parseData($value);
            } else if(is_null($value)) {
                $arr[$key] = '';
            } elseif($value instanceof Carbon) {
                $arr[$key] = $value->format('m/d/Y');
            } else if(substr_compare($key, '_id', strlen($key)-3, 3) === 0) {
                // ends in _id
                $classShortName = substr($key, 0, -3);
                switch($classShortName) {
                    case 'county':
                    case 'state':
                        $namespace = 'App\\Models\\Location\\';
                        break;
                    case 'district':
                    case 'location':
                        $namespace = "App\\Models\\Court\\";
                        break;
                }

                $class = $namespace.ucfirst($classShortName);

                if(class_exists($class)) {
                    $model = $class::withoutGlobalScope(ActiveScope::class)->where('id', $value)->first();
                    switch($classShortName) {
                        case 'county':
                        case 'district':
                            $arr[$classShortName] = $model->name;
                            break;
                        case 'state':
                            $arr[$classShortName] = $model->iso_3166_2;
                            break;
                        case 'location':
                            $arr[$classShortName] = str_replace("\n", ' ', $model->address);
                            break;
                    }
                }
            }
        }

        return $arr;
    }

    /**
     * @param array $arr
     * @return array
     */
    protected function adjustGenders(array $arr) {
        $genders = [
            'current_gender'=>'current_gender_other',
            'requested_gender'=>'requested_gender_other',
        ];

        foreach($genders AS $gender=>$other) {
            if (array_key_exists($gender, $arr) && array_key_exists($other, $arr)) {
                if ($arr[$gender] == 'other') {
                    $arr[$gender] = $arr[$other];
                }
            }
        }

        return $arr;
    }
}
