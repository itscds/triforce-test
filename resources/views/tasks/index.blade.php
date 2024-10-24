@extends('layout') <!-- Ensure you extend the main layout -->

@section('content')
    <div class="container mt-4">
        <h1 class="mb-4">To-Do List</h1>

        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Tasks</h5>
                <a href="{{ route('tasks.create') }}" class="btn btn-primary">Add New Task</a>
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Task Name</th>
                            <th>Due Date</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tasks as $task)
                            <tr class="{{ $task->due_date <= now()->addDay() && !$task->is_completed ? 'table-danger' : '' }}">
                                <td>{{ $task->task_name }}</td>
                                <td>{{ $task->due_date->format('F j, Y, g:i A') }}</td>
                                <td>{{ $task->is_completed ? 'Completed' : 'Pending' }}</td>
                                <td>
                                    <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" style="display:inline;" onsubmit="return confirmDelete();">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    </form>                                   
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script>
    function confirmDelete() {
        return confirm('Are you sure you want to delete this task?');
    }
</script>
@endsection
