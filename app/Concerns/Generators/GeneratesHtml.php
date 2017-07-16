<?php

namespace App\Concerns\Generators;

use App\Models\Application\Application;
use App\Models\Application\File;

trait GeneratesHtml
{

    /**
     * @param Application $application
     * @return File
     */
    public function html(Application $application)
    {
        $template = $this->getParsedTemplateAs($application, 'HTML');
        return $this->createFileFromTemplate($template, 'html', $application);
    }
}