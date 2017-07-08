<?php

namespace App\Contracts\Generators;

use App\Models\Application\Application;
use App\Models\Application\File;

interface ApplicationHtmlGenerator
{
    /**
     * @param Application $application
     * @return File
     */
    public function html(Application $application);
}