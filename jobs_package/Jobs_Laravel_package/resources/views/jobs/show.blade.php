@extends('jobs::layouts.base')

@section('content')
    <article class="job-card">
        <h1>{{ $job->title }}</h1>
        <p class="job-meta">{{ $job->type }} • {{ $job->currency }} {{ $job->salary_range }}</p>
        <p>{{ $job->short_description }}</p>
        <div>{!! nl2br(e($job->description)) !!}</div>

        <div class="job-tags">
            @foreach($job->categories as $category)
                <span class="tag">{{ $category->title }}</span>
            @endforeach
        </div>

        <div style="margin-top: 1rem;">
            <a class="button" href="{{ route('jobs.apply', $job) }}">{{ __('jobs::jobs.apply') }}</a>
            <form action="{{ route('jobs.bookmark', $job) }}" method="post" style="display: inline-block;">
                @csrf
                <button type="submit" class="button" style="background:#111827;">Bookmark</button>
            </form>
        </div>
    </article>

    @if($related->isNotEmpty())
        <h2 style="margin-top: 2rem;">Related roles</h2>
        <div class="jobs-grid">
            @foreach($related as $similar)
                <article class="job-card">
                    <h3><a href="{{ route('jobs.show', $similar) }}">{{ $similar->title }}</a></h3>
                    <p class="job-meta">{{ $similar->type }} • {{ $similar->currency }} {{ $similar->salary_range }}</p>
                </article>
            @endforeach
        </div>
    @endif
@endsection
