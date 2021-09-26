<?php

namespace App\Concerns\Generators;

use App\Generators\Exceptions\TypeNotSupportedException;
use App\Models\Application\Application;

trait GeneratesApplications
{
    /**
     * @param Application $application
     * @param $type
     */
    public function generate(Application $application, $type)
    {
        if (method_exists($this, $type)) {
            $this->$type($application);
        }

        throw new TypeNotSupportedException("Type '$type' is not supported by " . get_class($this));
    }


}
