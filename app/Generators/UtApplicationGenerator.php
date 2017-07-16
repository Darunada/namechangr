<?php

namespace App\Generators;

use App\Concerns\Generators\ConvertsWordTemplates;
use App\Concerns\Generators\GeneratesApplications;
use App\Concerns\Generators\GeneratesDocx;
use App\Concerns\Generators\GeneratesHtml;
use App\Concerns\Generators\GeneratesPdf;
use App\Concerns\Generators\LoadsWordTemplates;
use App\Concerns\Generators\StoresGeneratedFiles;
use App\Contracts\Generators\ApplicationDocxGenerator;
use App\Contracts\Generators\ApplicationGenerator;
use App\Contracts\Generators\ApplicationHtmlGenerator;
use App\Contracts\Generators\ApplicationPdfGenerator;

class UtApplicationGenerator implements ApplicationGenerator, ApplicationDocxGenerator, ApplicationHtmlGenerator, ApplicationPdfGenerator
{
    use GeneratesApplications, GeneratesDocx, GeneratesPdf, GeneratesHtml;
    use LoadsWordTemplates, ConvertsWordTemplates, StoresGeneratedFiles;

    protected $templates = [
        'name_and_gender_change'=>'ut/name-and-gender-change.docx',
        'name_change'=>'ut/name-change.docx',
        'gender_change'=>'ut/gender-change.docx'
    ];

}
