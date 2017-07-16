<?php

namespace App\Http\Controllers\States;


use App\Concerns\GuardsApplicationRequests;
use App\Generators\UtApplicationGenerator;
use App\Http\Controllers\Controller;
use App\Jobs\DeleteApplicationFile;
use App\Jobs\GenerateApplication;
use App\Models\Application\Application;
use App\Models\Application\File AS ApplicationFile;
use App\Models\Location\State;
use App\Scopes\ActiveScope;
use Auth;
use Cache;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use mikehaertl\pdftk\Pdf;
use Storage;
use Symfony\Component\Finder\Exception\AccessDeniedException;

class UtController extends Controller
{

    use GuardsApplicationRequests;

    protected $state;

    public function __construct()
    {
        $this->middleware('auth');

        $this->state = Cache::remember('state-ut', 60*24, function() {
            return State::where('name', 'Utah')->first();
        });
    }

    public function index(Request $request, Application $application)
    {
        $states = State::withoutGlobalScope(ActiveScope::class)->pluck('name', 'id');
        $counties = $application->state->counties->pluck('name', 'id');
        $locations = $application->state->locations->all();

        return view('states.UT.index', compact('locations', 'counties', 'states', 'application'));
    }

    public function download_file(Request $request, Application $application, ApplicationFile $applicationFile) {
        $fileContents = Storage::get($applicationFile->path);

        return response()->stream(function () use ($fileContents) {
            // grab the raw file and echo it out
            echo $fileContents;
        }, 200, [
            // other headers could be added
            'Cache-Control' => 'no-cache',
            'Content-Description' => 'File Download of document-package.docx',
            'Content-Disposition' => 'attachment; filename="document-package.docx"',
            'Expires' => '0',
            'Pragma' => 'no-cache'
        ]);
    }


}
