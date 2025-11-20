<?php

namespace Jobs\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Jobs\Models\AtsStage;
use Jobs\Models\AtsStageAssignment;
use Jobs\Models\JobApplication;

class AtsController extends Controller
{
    public function stages()
    {
        return response()->json(AtsStage::orderBy('position')->get());
    }

    public function move(Request $request, JobApplication $jobApplication)
    {
        $data = $request->validate([
            'ats_stage_id' => ['required', 'integer', 'exists:ats_stages,id'],
            'notes' => ['nullable', 'string'],
        ]);

        $assignment = AtsStageAssignment::create([
            'job_application_id' => $jobApplication->id,
            'ats_stage_id' => $data['ats_stage_id'],
            'notes' => $data['notes'] ?? null,
            'moved_by' => $request->user()?->id,
            'moved_at' => now(),
        ]);

        $jobApplication->update(['status' => 'in-pipeline']);

        return response()->json($assignment->load('stage'));
    }
}
