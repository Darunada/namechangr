<?php

namespace App\Concerns\Generators;

use App\Models\Application\Application;
use PhpOffice\PhpWord\IOFactory;

trait ConvertsWordTemplates
{


    /**
     * @param Application $application
     * @param string $type
     * @return string
     */
    protected function getParsedTemplateAs($application, $type) {
        $template = $this->getParsedTemplate($application);

        $phpWord = IOFactory::load($template);
        $phpWord->save($template, $type);

        return $template;
    }

}