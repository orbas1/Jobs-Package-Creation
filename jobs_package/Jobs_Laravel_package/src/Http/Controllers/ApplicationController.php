<?php

namespace Jobs\Http\Controllers;

use Illuminate\Routing\Controller;
use Jobs\Http\Requests\ApplicationRequest;
use Jobs\Models\Job;
use Jobs\Models\JobApplication;

class ApplicationController extends Controller
{
    public function index()
    {
        return response()->json(JobApplication::with(['job', 'candidate'])->paginate());
    }

    public function store(ApplicationRequest $request)
    {
        $job = Job::findOrFail($request->integer('job_id'));

        $data = $request->validated();
        $data['status'] = $data['status'] ?? 'applied';
        $data['applied_at'] = now();

        $application = $job->applications()->create($data);

        return response()->json($application->load(['job', 'candidate']), 201);
    }

    public function update(ApplicationRequest $request, JobApplication $jobApplication)
    {
        $jobApplication->update($request->validated());

        return response()->json($jobApplication);
    }
}
