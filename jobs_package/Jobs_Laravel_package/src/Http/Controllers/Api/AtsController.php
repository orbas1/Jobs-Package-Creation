<?php

namespace JobsLaravelPackage\Http\Controllers\Api;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Gate;
use JobsLaravelPackage\Models\AtsStage;
use JobsLaravelPackage\Models\Opening;
use JobsLaravelPackage\Models\UserJob;

class AtsController extends Controller
{
    public function stages(Opening $opening): JsonResponse
    {
        $stages = AtsStage::forOpening($opening)->get();

        return response()->json($stages);
    }

    public function updateStage(Request $request, UserJob $application): JsonResponse
    {
        Gate::authorize('updateStage', $application);

        $validated = $request->validate([
            'stage_id' => ['required', 'integer', 'exists:ats_stages,id'],
            'status' => ['nullable', 'string', 'max:50'],
        ]);

        $stage = AtsStage::findOrFail($validated['stage_id']);

        if ($stage->opening_id && $stage->opening_id !== $application->opening_id) {
            abort(422, 'Stage does not belong to this opening.');
        }

        $application->update([
            'stage_id' => $validated['stage_id'],
            'status' => $validated['status'] ?? $stage->slug,
        ]);

        return response()->json($application->load(['stage', 'opening']));
    }
}
