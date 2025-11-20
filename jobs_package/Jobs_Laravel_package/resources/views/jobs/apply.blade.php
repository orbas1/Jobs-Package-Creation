@extends('jobs::layouts.base')

@section('content')
    <div class="jobs-apply">
        <h1>{{ $job->title }}</h1>
        <p class="job-meta">{{ $job->type }} • {{ $job->currency }} {{ $job->salary_range }}</p>

        <form action="{{ route('jobs.apply.store', $job) }}" method="post">
            @csrf
            <div>
                <label for="cover_letter">Cover letter</label>
                <textarea name="cover_letter" id="cover_letter" rows="6" style="width:100%;">{{ old('cover_letter') }}</textarea>
            </div>
            <div>
                <label for="resume_url">Resume URL</label>
                <input type="url" name="resume_url" id="resume_url" value="{{ old('resume_url') }}" style="width:100%;">
            </div>
            <button type="submit" class="button" style="margin-top:1rem;">Submit application</button>
        </form>
    </div>
@endsection
