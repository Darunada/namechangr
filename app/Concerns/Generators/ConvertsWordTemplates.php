<?php

namespace App\Concerns\Generators;

trait ConvertsWordTemplates
{
    use LoadsWordTemplates;

    protected function getParsedTemplateAs($application, $type) {
        $template = $this->getParsedTemplate($application);

        $phpWord = IOFactory::load($template);
        $phpWord->save($template, $type);

        return $template;
    }

}