<?php

namespace JobsLaravelPackage\Http\Controllers\Api;

use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;
use JobsLaravelPackage\Http\Requests\StoreOpeningRequest;
use JobsLaravelPackage\Http\Requests\UpdateOpeningRequest;
use JobsLaravelPackage\Models\Opening;

class OpeningController extends Controller
{
    public function index(): JsonResponse
    {
        $openings = Opening::with(['categories', 'locations', 'primaryCategory'])
            ->latest()
            ->paginate(config('jobs.pagination'));

        return response()->json($openings);
    }

    public function store(StoreOpeningRequest $request): JsonResponse
    {
        Gate::authorize('create', Opening::class);

        $opening = Opening::create([
            ...$request->validated(),
            'slug' => Str::slug($request->string('title')) . '-' . Str::random(6),
            'user_id' => $request->user()->getAuthIdentifier(),
        ]);

        $this->syncRelations($opening, $request->input('categories', []), $request->input('locations', []));

        return response()->json($opening->load(['categories', 'locations']), 201);
    }

    public function show(Opening $opening): JsonResponse
    {
        return response()->json($opening->load(['categories', 'locations', 'applicants']));
    }

    public function update(UpdateOpeningRequest $request, Opening $opening): JsonResponse
    {
        Gate::authorize('update', $opening);

        $opening->update($request->validated());
        $this->syncRelations($opening, $request->input('categories', []), $request->input('locations', []));

        return response()->json($opening->load(['categories', 'locations']));
    }

    public function destroy(Opening $opening): JsonResponse
    {
        Gate::authorize('delete', $opening);

        $opening->delete();

        return response()->json([], 204);
    }

    protected function syncRelations(Opening $opening, array $categories, array $locations): void
    {
        if (!empty($categories)) {
            $opening->categories()->sync($categories);
        }

        if (!empty($locations)) {
            $opening->locations()->sync($locations);
        }
    }
}
