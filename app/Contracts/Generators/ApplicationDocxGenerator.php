<?php

namespace App\Contracts\Generators;

use App\Models\Application\Application;
use App\Models\Application\File;

interface ApplicationDocxGenerator
{
    /**
     * @param Application $application
     * @return File;
     */
    public function docx(Application $application);
}