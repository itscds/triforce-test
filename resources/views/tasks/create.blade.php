@extends('layout')

@section('content')
<h1>{{ isset($task) ? 'Edit' : 'Create' }} Task</h1>

<form action="{{ isset($task) ? route('tasks.update', $task->id) : route('tasks.store') }}" method="POST">
    @csrf
    @if(isset($task))
        @method('PUT')
    @endif

    <div class="mb-3">
        <label for="task_name" class="form-label">Task Name</label>
        <input type="text" name="task_name" class="form-control" value="{{ $task->task_name ?? '' }}" required>
    </div>

    <div class="mb-3">
        <label for="due_date" class="form-label">Due Date</label>
        <input type="datetime-local" name="due_date" class="form-control" value="{{ isset($task) ? $task->due_date->format('Y-m-d\TH:i') : '' }}" required>
    </div>

    <div class="mb-3">
        <label for="is_completed">
            <input type="checkbox" name="is_completed" {{ isset($task) && $task->is_completed ? 'checked' : '' }}> Completed
        </label>
    </div>

    <button type="submit" class="btn btn-success">{{ isset($task) ? 'Update' : 'Create' }}</button>
</form>
@endsection
