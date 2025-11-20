<?php

namespace Jobs\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Jobs\Models\CvTemplate;

class CvController extends Controller
{
    public function index(Request $request)
    {
        $candidateId = $request->user()?->id ?? $request->integer('candidate_id');
        $query = CvTemplate::query();

        if ($candidateId) {
            $query->where('candidate_id', $candidateId);
        }

        return response()->json($query->get());
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'candidate_id' => ['required', 'integer'],
            'title' => ['required', 'string', 'max:255'],
            'content' => ['required', 'array'],
            'is_default' => ['boolean'],
        ]);

        $cv = CvTemplate::create($data);

        return response()->json($cv, 201);
    }
}
