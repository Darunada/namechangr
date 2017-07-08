<?php

namespace App\Generators;

use App\Concerns\Generators\ConvertsWordTemplates;
use App\Concerns\Generators\GeneratesApplications;
use App\Concerns\Generators\GeneratesDocx;
use App\Concerns\Generators\GeneratesHtml;
use App\Concerns\Generators\GeneratesPdf;
use App\Contracts\Generators\ApplicationDocxGenerator;
use App\Contracts\Generators\ApplicationGenerator;
use App\Contracts\Generators\ApplicationHtmlGenerator;
use App\Contracts\Generators\ApplicationPdfGenerator;

class UtApplicationGenerator implements ApplicationGenerator, ApplicationDocxGenerator, ApplicationHtmlGenerator, ApplicationPdfGenerator
{
    use ConvertsWordTemplates, GeneratesApplications, GeneratesDocx, GeneratesPdf, GeneratesHtml;

    protected $templates = [
        'name_and_gender_change'=>'ut/name_and_gender_change.docx',
        'name_change'=>'ut/name_change.docx',
        'gender_change'=>'ut/gender_change.docx'
    ];
}
