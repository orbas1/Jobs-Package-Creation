@extends('jobs::layouts.base')

@section('content')
    <div class="jobs-header">
        <h1>{{ __('jobs::jobs.listings') }}</h1>
        <form method="get" action="{{ route('jobs.index') }}" class="jobs-filters">
            <input type="text" name="search" value="{{ $filters['search'] ?? '' }}" placeholder="Search titles or keywords">
            <select name="category">
                <option value="">All categories</option>
                @foreach($categories as $category)
                    <option value="{{ $category->slug }}" @selected(($filters['category'] ?? null) === $category->slug)>{{ $category->title }}</option>
                @endforeach
            </select>
            <select name="type">
                <option value="">Any type</option>
                <option value="Full time" @selected(($filters['type'] ?? null) === 'Full time')>Full time</option>
                <option value="Part time" @selected(($filters['type'] ?? null) === 'Part time')>Part time</option>
                <option value="Contract" @selected(($filters['type'] ?? null) === 'Contract')>Contract</option>
            </select>
            <select name="skill">
                <option value="">Any skill</option>
                @foreach($skillTags as $skill)
                    <option value="{{ $skill->slug }}" @selected(($filters['skill'] ?? null) === $skill->slug)>{{ $skill->name }}</option>
                @endforeach
            </select>
            <label>
                <input type="checkbox" name="featured" value="1" @checked(!empty($filters['featured']))>
                Featured only
            </label>
            <button type="submit">Filter</button>
        </form>
    </div>

    <div class="jobs-grid">
        @forelse($openings as $job)
            <article class="job-card">
                <h2><a href="{{ route('jobs.show', $job) }}">{{ $job->title }}</a></h2>
                <p class="job-meta">{{ $job->type }} • {{ $job->currency }} {{ $job->salary_range }}</p>
                <p>{{ $job->short_description }}</p>
                <p class="job-tags">
                    @foreach($job->categories as $category)
                        <span class="tag">{{ $category->title }}</span>
                    @endforeach
                    @foreach($job->skillTags as $skill)
                        <span class="tag" style="background:#e0e7ff; color:#1f2937;">{{ $skill->name }}</span>
                    @endforeach
                </p>
                <a class="button" href="{{ route('jobs.show', $job) }}">View details</a>
            </article>
        @empty
            <p>No jobs found for the selected filters.</p>
        @endforelse
    </div>

    {{ $openings->links('jobs::partials.pagination') }}
@endsection
