<?php

namespace Jobs\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Jobs\Models\CoverLetter;

class CoverLetterController extends Controller
{
    public function index(Request $request)
    {
        $candidateId = $request->user()?->id ?? $request->integer('candidate_id');
        $query = CoverLetter::query();

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
            'body' => ['required', 'string'],
        ]);

        $letter = CoverLetter::create($data);

        return response()->json($letter, 201);
    }
}
