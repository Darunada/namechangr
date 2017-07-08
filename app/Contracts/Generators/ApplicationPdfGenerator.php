<?php

namespace App\Contracts\Generators;

use App\Models\Application\Application;
use App\Models\Application\File;

interface ApplicationPdfGenerator
{
    /**
     * @param Application $application
     * @return File
     */
    public function pdf(Application $application);
}