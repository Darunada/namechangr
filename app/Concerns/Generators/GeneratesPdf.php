<?php

namespace App\Concerns\Generators;

use App\Models\Application\File;

trait GeneratesPdf
{
    use ConvertsWordTemplates, StoresGeneratedFiles;

    /**
     * @param Application $application
     * @return File;
     */
    public function pdf(Application $application)
    {
        $template = $this->getParsedTemplateAs($application, 'HTML');
        return $this->createFileFromTemplate($template, 'pdf', $application);
    }

}