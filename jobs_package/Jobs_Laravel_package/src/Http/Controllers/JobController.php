<?php

namespace Jobs\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Jobs\Events\JobPublished;
use Jobs\Http\Requests\JobRequest;
use Jobs\Models\Job;

class JobController extends Controller
{
    public function index(Request $request)
    {
        $query = Job::with('company')->published();

        if ($request->filled('location')) {
            $query->where('location', 'like', '%' . (string) $request->string('location') . '%');
        }

        if ($request->filled('keyword')) {
            $query->where('title', 'like', '%' . (string) $request->string('keyword') . '%');
        }

        if ($request->filled('search')) {
            $term = (string) $request->string('search');
            $query->where(function ($q) use ($term) {
                $q->where('title', 'like', '%' . $term . '%')
                    ->orWhere('description', 'like', '%' . $term . '%');
            });
        }

        if ($request->boolean('featured')) {
            $query->where('is_featured', true);
        }

        if ($request->filled('sort') && $request->string('sort') === 'recent') {
            $query->latest('published_at');
        }

        return response()->json($query->paginate($request->integer('per_page', 15)));
    }

    public function show(Job $job)
    {
        return response()->json($job->load(['company', 'applications']));
    }

    public function store(JobRequest $request)
    {
        $job = Job::create($request->validated());

        $this->dispatchPublishedEvent($job);

        return response()->json($job, 201);
    }

    public function update(JobRequest $request, Job $job)
    {
        $job->update($request->validated());

        $this->dispatchPublishedEvent($job);

        return response()->json($job);
    }

    public function destroy(Job $job)
    {
        $job->delete();

        return response()->json(['message' => 'Job removed']);
    }

    protected function dispatchPublishedEvent(Job $job): void
    {
        if ($job->status === 'published') {
            JobPublished::dispatch($job);
        }
    }
}
