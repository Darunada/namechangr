<?php

namespace App\Http\Controllers\Api;

use App\Generators\UtApplicationGenerator;
use App\Http\Controllers\Controller;
use App\Jobs\DeleteApplicationFile;
use App\Jobs\GenerateApplication;
use App\Models\Application\Application;
use App\Models\Application\File as ApplicationFile;
use Auth;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ApplicationController extends Controller
{

    public function __construct()
    {
        // view application is already applied in the route
        $this->middleware('can:update,application')->only(['update', 'delete_file']);
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        return Application::with('files')->where('user_id', Auth::user()->id)->get();
    }

    /**
     * Display the specified resource.
     *
     * @param Application $application
     * @return JsonResponse
     */
    public function show(Application $application)
    {
        $toReturn = [
            'success' => true,
            'application' => $application,
            'html' => view('states.UT.partials.generated-files', compact('application'))->render()
        ];

        return response()->json($toReturn);
    }

    /**
     * @param Request $request
     * @param Application $application
     * @return JsonResponse
     */
    public function update(Request $request, Application $application)
    {
        $application->fill($request->input());
        $application->save();

        return response()->json(['success' => true, 'application' => $application]);
    }

    /**
     * @param Request $request
     * @param Application $application
     * @param $type
     * @return JsonResponse
     */
    public function generate(Request $request, Application $application, $type = 'docx')
    {
        // TODO: instantiate the right generator
        // start generating...
        $job = new GenerateApplication($application, new UtApplicationGenerator(), $type);
        dispatch($job);

        return response()->json(['success' => true, 'type' => $type, 'application' => $application]);
    }

    /**
     * @param Request $request
     * @param Application $application
     * @param ApplicationFile $applicationFile
     * @return JsonResponse
     */
    public function delete_file(Request $request, Application $application, ApplicationFile $applicationFile)
    {
        $job = new DeleteApplicationFile($applicationFile);
        dispatch($job);

        return response()->json(['success' => true, 'queued' => true]);
    }
}
