@extends('layouts.app')
@section('content')
    <form action="{{ route('tasks.update', $task->id) }}" method="post">
        {{ method_field('PUT') }}
        @csrf
        <div class="card-body">

            <div class="mb-3">
                <div class="col-md-4 position-relative">
                    <label class="form-label" for="validationTooltip03">Project <span class="text-danger">*</span></label>
                    <select class="form-control" aria-label="Default select example" name="project_id">
                        @foreach ($projects as $project)
                            <option value="{{ $project->id }}" @if($task->project->id == $project->id) selected @endif>{{ $project->title }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="mb-3">
                <div class="col-md-4 position-relative">
                    <label class="form-label" for="validationTooltip03">Title <span class="text-danger">*</span></label>
                    <input name="title" value="{{ $task->title}}" class="form-control" id="validationTooltip03"
                        type="text" required="">
                </div>
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-primary mb-3">Update</button>
            </div>
        </div>
    </form>
@endsection
