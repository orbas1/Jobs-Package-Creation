<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Jobs') }}</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 2rem; background: #f7f8fb; }
        h1, h2 { margin: 0 0 0.5rem; }
        .jobs-header { display: flex; justify-content: space-between; align-items: center; gap: 1rem; flex-wrap: wrap; }
        .jobs-filters input, .jobs-filters select { padding: 0.5rem; margin-right: 0.5rem; }
        .jobs-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)); gap: 1rem; margin-top: 1rem; }
        .job-card { background: #fff; border-radius: 8px; padding: 1rem; box-shadow: 0 1px 3px rgba(0,0,0,0.08); }
        .job-meta { color: #6b7280; font-size: 0.9rem; }
        .job-tags .tag { display: inline-block; background: #eef2ff; color: #4338ca; padding: 0.2rem 0.5rem; border-radius: 4px; margin-right: 0.25rem; }
        .button { display: inline-block; margin-top: 0.5rem; padding: 0.5rem 0.75rem; background: #2563eb; color: #fff; border-radius: 6px; text-decoration: none; }
        .jobs-apply { background: #fff; padding: 1.5rem; border-radius: 8px; box-shadow: 0 1px 3px rgba(0,0,0,0.08); }
    </style>
</head>
<body>
    @if(session('status'))
        <div class="alert">{{ session('status') }}</div>
    @endif

    @yield('content')
</body>
</html>
