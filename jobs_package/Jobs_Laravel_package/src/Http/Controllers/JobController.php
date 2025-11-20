<?php

namespace Jobs\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Jobs\Http\Requests\JobRequest;
use Jobs\Models\Job;

class JobController extends Controller
{
    public function index(Request $request)
    {
        $query = Job::with('company')->published();

        if ($request->filled('location')) {
            $query->where('location', 'like', '%' . $request->string('location') . '%');
        }

        if ($request->filled('keyword')) {
            $query->where('title', 'like', '%' . $request->string('keyword') . '%');
        }

        return response()->json($query->paginate());
    }

    public function show(Job $job)
    {
        return response()->json($job->load(['company', 'applications']));
    }

    public function store(JobRequest $request)
    {
        $job = Job::create($request->validated());

        return response()->json($job, 201);
    }

    public function update(JobRequest $request, Job $job)
    {
        $job->update($request->validated());

        return response()->json($job);
    }

    public function destroy(Job $job)
    {
        $job->delete();

        return response()->json(['message' => 'Job removed']);
    }
}
