<?php

namespace Jobs\Http\Controllers;

use Illuminate\Routing\Controller;
use Jobs\Events\ApplicationSubmitted;
use Jobs\Http\Requests\ApplicationRequest;
use Jobs\Models\Job;
use Jobs\Models\JobApplication;

class ApplicationController extends Controller
{
    public function index()
    {
        $query = JobApplication::with(['job', 'candidate']);

        if (request()->filled('company_id')) {
            $query->whereHas('job', function ($q) {
                $q->where('company_id', request()->integer('company_id'));
            });
        }

        if (request()->filled('candidate_id')) {
            $query->where('candidate_id', request()->integer('candidate_id'));
        }

        if (request()->filled('status')) {
            $query->where('status', request()->string('status'));
        }

        return response()->json($query->paginate(request()->integer('per_page', 15)));
    }

    public function store(ApplicationRequest $request)
    {
        $job = Job::findOrFail($request->integer('job_id'));

        $data = $request->validated();
        $data['status'] = $data['status'] ?? 'applied';
        $data['applied_at'] = now();

        $application = $job->applications()->create($data);

        ApplicationSubmitted::dispatch($application);

        return response()->json($application->load(['job', 'candidate']), 201);
    }

    public function update(ApplicationRequest $request, JobApplication $jobApplication)
    {
        $jobApplication->update($request->validated());

        return response()->json($jobApplication);
    }

    public function storeForJob(Job $job, ApplicationRequest $request)
    {
        $payload = $request->validated();
        $payload['job_id'] = $job->id;

        $request->merge($payload);

        return $this->store($request);
    }
}
