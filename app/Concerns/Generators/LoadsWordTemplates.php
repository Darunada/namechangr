<?php
/**
 * Created by PhpStorm.
 * User: Lea
 * Date: 7/7/2017
 * Time: 7:06 PM
 */

namespace App\Concerns\Generators;

use App\Generators\Exceptions\GeneratorException;
use App\Models\Application\Application;
use Illuminate\Support\Arr;
use PhpOffice\PhpWord\TemplateProcessor;

trait LoadsWordTemplates
{

//    protected $templates = [
//        'name_and_gender_change'=>'',
//        'name_change'=>'',
//        'gender_change'=>''
//    ];

    /**
     * @param Application $application
     * @return array
     */
    protected function getTemplateVars(Application &$application) {
        return Arr::dot($application->getParsedData());
    }

    /**
     * @param TemplateProcessor $processor
     * @param Application $application
     */
    private function setProcessorVars(TemplateProcessor &$processor, Application &$application)
    {
        $vars = $this->getTemplateVars($application);

        foreach($vars AS $name=>$value) {
            $processor->setValue($name, $value);
        }
    }

    /**
     * @param Application $application
     * @return string
     */
    protected function getTemplateFilename(Application &$application)
    {
        // logic to decide what template to get
        if($application->name_change && $application->gender_change) {
            $filename = resource_path('/templates/'.$this->templates['name_and_gender_change']);
        } else if($application->name_change) {
            $filename = resource_path('/templates/'.$this->templates['name_change']);
        } else if($application->gender_change) {
            $filename = resource_path('/templates/'.$this->templates['gender_change']);
        }

        if(empty($filename) || !file_exists($filename)) {
            throw new GeneratorException("Unable to load template for application.  No template found for file '$filename'.");
        }

        return $filename;
    }

    /**
     * @param TemplateProcessor $processor
     * @param Application $application
     * @return string
     */
    private function storeParsedTemplate(TemplateProcessor &$processor, Application &$application)
    {
        $tempFile = $processor->save(); // saves back into the same tempfile it was loaded from

        // TODO Do I want to store this to disk for some reason?

        return $tempFile;
    }

    /**
     * @param Application $application
     * @return string
     */
    private function parseTemplate(Application &$application)
    {
        $processor = new TemplateProcessor($this->getTemplateFilename($application));
        $this->setProcessorVars($processor, $application);
        return $this->storeParsedTemplate($processor, $application);
    }

    /**
     * @param Application $application
     * @return string
     */
    protected function getParsedTemplate(Application $application)
    {
        return $this->parseTemplate($application);
    }
}