<?php

namespace App\Concerns\Generators;

use App\Models\Application\File;

trait GeneratesHtml
{
    use ConvertsWordTemplates, StoresGeneratedFiles;

    /**
     * @param Application $application
     * @return File;
     */
    public function html(Application $application)
    {
        $template = $this->getParsedTemplateAs($application, 'HTML');
        return $this->createFileFromTemplate($template, 'html', $application);
    }
}