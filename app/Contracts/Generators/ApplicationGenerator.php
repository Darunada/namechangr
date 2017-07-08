<?php

namespace App\Contracts\Generators;

use App\Models\Application\Application;
use App\Models\Application\File;

interface ApplicationGenerator
{
    /**
     * @param Application $application
     * @param $type
     * @return File
     */
    public function generate(Application $application, $type);
}