<?php

namespace JobsLaravelPackage\Http\Controllers\Api;

use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use JobsLaravelPackage\Models\Category;
use JobsLaravelPackage\Models\ExpertLevel;
use JobsLaravelPackage\Models\Location;
use JobsLaravelPackage\Models\Qualification;
use JobsLaravelPackage\Models\SkillTag;

class TaxonomyController extends Controller
{
    public function categories(): JsonResponse
    {
        return response()->json(
            Category::query()->where('type', 'job_category')->with('children')->get()
        );
    }

    public function tags(): JsonResponse
    {
        return response()->json(
            Category::query()->where('type', 'job_tag')->get()
        );
    }

    public function locations(): JsonResponse
    {
        return response()->json(
            Location::with('children')->get()
        );
    }

    public function skills(): JsonResponse
    {
        return response()->json(
            SkillTag::orderBy('name')->get()
        );
    }

    public function expertLevels(): JsonResponse
    {
        return response()->json(ExpertLevel::all());
    }

    public function qualifications(): JsonResponse
    {
        return response()->json(Qualification::all());
    }
}
