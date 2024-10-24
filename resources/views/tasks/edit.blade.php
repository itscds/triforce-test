@extends('layout')

@section('content')
<div class="container mt-4">
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Edit Task</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('tasks.update', $task->id) }}" method="POST">
                @csrf
                @method('PUT') <!-- Add this line to specify that we're updating a resource -->
                
                <div class="mb-3">
                    <label for="task_name" class="form-label">Task Name</label>
                    <input type="text" name="task_name" id="task_name" class="form-control" value="{{ $task->task_name }}" required>
                </div>
                <div class="mb-3">
                    <label for="due_date" class="form-label">Due Date</label>
                    <input type="datetime-local" name="due_date" id="due_date" class="form-control" value="{{ $task->due_date->format('Y-m-d\TH:i') }}" required>
                </div>
                <div class="mb-3 form-check">
                    <input type="checkbox" name="is_completed" id="is_completed" class="form-check-input" {{ $task->is_completed ? 'checked' : '' }}>
                    <label for="is_completed" class="form-check-label">Mark as Completed</label>
                </div>
                <button type="submit" class="btn btn-primary">Update Task</button>
            </form>
        </div>
    </div>
</div>
@endsection
