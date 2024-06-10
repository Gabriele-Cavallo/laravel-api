@extends('layouts.admin')

@section('content')
    @include('partials.flash-messages')

    <h1>LISTA PROGETTI APERTI</h1>
    <table class="table table-bordered border-primary align-middle">
        <thead>
            <th class="text-center">ID</th>
            <th class="text-center">Project Name</th>
            <th class="text-center">Slug</th>
            <th class="text-center">Type</th>
            <th class="text-center">Technologies</th>
            <th class="text-center">Client Name</th>
            <th class="text-center">Summary</th>
            <th class="text-center">Actions</th>
        </thead>
        <tbody>
            @foreach ($projects as $project)
                <tr>
                    <td><strong>{{ $project->id }}</strong></td>
                    <td>{{ $project->name }}</td>
                    <td>{{ $project->slug }}</td>
                    <td class="no-wrap">{{ $project->type ? $project->type->name : 'No type' }}</td>
                    <td>
                        <div class="my-2"> 
                            @if (count($project->technologies) > 0)
                                @foreach ($project->technologies as $technology)
                                    {{ $technology->name }}@if (!$loop->last),@endif
                                @endforeach
                            @else
                                <span class="no-wrap">No technologies selected</span>
                            @endif
                        </div>
                    </td>
                    <td>{{ $project->client_name }}</td>
                    <td>{{ $project->summary }}</td>
                    <td class="text-center">
                        <button class="btn btn-dark my-2">
                            <a href="{{ route('admin.projects.show', $project->slug) }}">View Project</a>
                        </button>
                        <button class="btn btn-dark my-2">
                            <a href="{{ route('admin.projects.edit', $project->slug) }}">Edit Project</a>
                        </button>
                        <form action="{{ route('admin.projects.destroy', $project->slug) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger my-2 js-delete-btn" data-project-name="{{ $project->name }}">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

     <!-- Modale eliminazione progetto -->
     <div class="modal fade" id="deleteConfirmModal" tabindex="-1" aria-labelledby="deleteConfirmModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h1 class="modal-title fs-5" id="deleteConfirmModalLabel">Confirm deletion</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary btn-danger" id="modal-confirm">Delete</button>
            </div>
        </div>
        </div>
    </div>
@endsection