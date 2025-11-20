<?php

namespace Jobs\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Jobs\Models\InterviewSchedule;
use Jobs\Models\JobApplication;

class InterviewController extends Controller
{
    public function index(JobApplication $jobApplication)
    {
        return response()->json($jobApplication->load('candidate')->interviews ?? []);
    }

    public function store(Request $request, JobApplication $jobApplication)
    {
        $data = $request->validate([
            'scheduled_at' => ['required', 'date'],
            'location' => ['nullable', 'string'],
            'instructions' => ['nullable', 'string'],
            'meeting_link' => ['nullable', 'string'],
            'status' => ['nullable', 'string'],
        ]);

        $interview = InterviewSchedule::create(array_merge($data, [
            'job_application_id' => $jobApplication->id,
        ]));

        return response()->json($interview, 201);
    }
}
