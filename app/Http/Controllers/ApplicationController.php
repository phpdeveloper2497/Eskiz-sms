<?php

namespace App\Http\Controllers;

use App\Http\Requests\ApplicationStatusUpdateRequest;
use App\Http\Resources\ApplicationResource;
use App\Models\Application;
use App\Services\EskizSmsService;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $applications = Application::all()->sortByDesc('created_at');
        return ApplicationResource::collection($applications);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Application $application)
    {
        //
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Application $application)
    {

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Application $application)
    {
        //
    }

    public function updateStatus(ApplicationStatusUpdateRequest $request, Application $application)
    {
        $application->update([
            'status_id' => $request->status_id
        ]);
        if ($request->status_id) {
//            dispatch(new NotifyApplicationStatusChange($application));

            $eskiz = new EskizSmsService();
            $phone = $application->user->phone;

            $eskiz->sendSms($phone);
        }
     else{
        throw new AuthorizationException('You are not authorized to update this application status', 400);
    }

    return new ApplicationResource($application);
    }
}
