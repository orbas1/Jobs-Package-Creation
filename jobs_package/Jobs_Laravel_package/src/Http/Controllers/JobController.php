<?php

namespace JobsLaravelPackage\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use JobsLaravelPackage\Models\Category;
use JobsLaravelPackage\Models\JobBookmark;
use JobsLaravelPackage\Models\Opening;
use JobsLaravelPackage\Models\UserJob;

class JobController extends Controller
{
    public function index(Request $request)
    {
        $openings = Opening::query()
            ->with(['categories', 'primaryCategory'])
            ->when($request->filled('search'), function ($query) use ($request) {
                $query->where('title', 'like', '%' . $request->string('search') . '%')
                    ->orWhere('short_description', 'like', '%' . $request->string('search') . '%');
            })
            ->when($request->filled('category'), function ($query) use ($request) {
                $query->whereHas('categories', function ($relation) use ($request) {
                    $relation->where('slug', $request->string('category'));
                });
            })
            ->when($request->filled('type'), fn ($query) => $query->where('type', $request->string('type')))
            ->when($request->boolean('featured'), fn ($query) => $query->whereNotNull('featured_expire_at'))
            ->paginate(config('jobs.pagination'));

        $openings->appends($request->all());

        return view('jobs::jobs.index', [
            'openings' => $openings,
            'categories' => Category::query()->where('type', 'job_category')->get(),
            'filters' => $request->only(['search', 'category', 'type', 'featured']),
        ]);
    }

    public function show(Opening $job)
    {
        $job->load(['categories', 'primaryCategory', 'locations']);
        $job->increment('total_visits');

        return view('jobs::jobs.show', [
            'job' => $job,
            'related' => Opening::query()
                ->where('id', '!=', $job->id)
                ->where('category_id', $job->category_id)
                ->latest()
                ->take(3)
                ->get(),
        ]);
    }

    public function apply(Opening $job)
    {
        return view('jobs::jobs.apply', [
            'job' => $job,
        ]);
    }

    public function applyStore(Request $request, Opening $job): RedirectResponse
    {
        $request->validate([
            'cover_letter' => ['nullable', 'string'],
            'resume_url' => ['nullable', 'url'],
        ]);

        $user = $request->user();

        if (!$user) {
            abort(403, 'Authentication required to apply.');
        }

        UserJob::updateOrCreate(
            [
                'user_id' => $user->getAuthIdentifier(),
                'opening_id' => $job->getKey(),
            ],
            [
                'meta' => [
                    'cover_letter' => $request->string('cover_letter')->toString(),
                    'resume_url' => $request->string('resume_url')->toString(),
                ],
            ]
        );

        return redirect()
            ->route('jobs.show', $job)
            ->with('status', __('jobs::jobs.applied_successfully'));
    }

    public function toggleBookmark(Opening $job): RedirectResponse
    {
        $user = Auth::user();

        if (!$user) {
            abort(403, 'Authentication required to bookmark.');
        }

        $bookmark = JobBookmark::where('user_id', $user->getAuthIdentifier())
            ->where('opening_id', $job->getKey())
            ->first();

        if ($bookmark) {
            $bookmark->delete();
            $message = __('jobs::jobs.bookmark_removed');
        } else {
            JobBookmark::create([
                'user_id' => $user->getAuthIdentifier(),
                'opening_id' => $job->getKey(),
            ]);
            $message = __('jobs::jobs.bookmark_added');
        }

        return redirect()->route('jobs.show', $job)->with('status', $message);
    }
}
