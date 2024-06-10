@extends('layouts.admin')

@section('content')
    @include('partials.flash-messages')

    <h2>{{ $project->name }}</h2>

    <div class="project-wrapper">
        @if ($project->cover_image)
            <img src="{{ asset('storage/' . $project->cover_image) }}" alt="{{ $project->name }}">
        @endif
        <div class="my-2"><strong>ID</strong>: {{ $project->id }}</div>
        <div class="my-2"><strong>Slug</strong>: {{ $project->slug }}</div>
        <div class="my-2"><strong>Type</strong>: {{ $project->type ? $project->type->name : 'No type' }}</div>
        <div class="my-2"><strong>Technologies</strong>: 
            @if (count($project->technologies) > 0)
                @foreach ($project->technologies as $technology)
                    {{ $technology->name }}@if (!$loop->last),@endif
                @endforeach
            @else
                <span>No technologies selected</span>
            @endif
        </div>
        <div class="my-2"><strong>Client name</strong>: {{ $project->client_name }}</div>
        <div class="my-2"><strong>Created at</strong>: {{ $project->created_at }}</div>
        <div class="my-2"><strong>Updated at</strong>: {{ $project->updated_at }}</div>
        <div class="my-2"><strong>Summary</strong>: {{ $project->summary ? $project->summary : 'Summary empty' }}</div>
        <button class="btn btn-dark mt-4">
            <a class="nav-link text-white" href="{{ route('admin.projects.index') }}">
                <i class="fa-solid fa-newspaper fa-lg fa-fw"></i> Projects
            </a>
        </button>
        <button class="btn btn-dark mt-4">
            <a href="{{ route('admin.projects.edit', $project->slug) }}">Edit Project</a>
        </button>
    </div>
@endsection