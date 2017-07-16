<?php

namespace App\Concerns\Generators;

use App\Models\Application\Application;
use App\Models\Application\File;

trait GeneratesPdf
{

    /**
     * @param Application $application
     * @return File
     */
    public function pdf(Application $application)
    {
        $template = $this->getParsedTemplateAs($application, 'HTML');
        return $this->createFileFromTemplate($template, 'pdf', $application);
    }

}