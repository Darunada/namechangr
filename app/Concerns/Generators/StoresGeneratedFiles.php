<?php
/**
 * Created by PhpStorm.
 * User: Lea
 * Date: 7/7/2017
 * Time: 8:44 PM
 */

namespace App\Concerns\Generators;

use App\Models\Application\Application;
use App\Models\Application\File;
use Carbon\Carbon;
use Illuminate\Http\File as SystemFile;
use Storage;

trait StoresGeneratedFiles
{
    /**
     * @param $template
     * @param $type
     * @param Application $application
     * @return File
     */
    protected function createFileFromTemplate($template, $type, Application $application)
    {
        $path = Storage::putFile('applications', new SystemFile($template), 'private');

        $file =  new File();
        $file->user_id = $application->user_id;
        $file->application_id = $application->id;
        $file->path = $path;
        $file->type = $type;
        $file->expired_at = Carbon::now()->addDays(30);
        $file->save();

        return $file;
    }
}