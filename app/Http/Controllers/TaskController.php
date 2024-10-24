<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;


class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::all();
        return view('tasks.index', compact('tasks'));
    }

    public function create()
    {
        return view('tasks.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'task_name' => 'required|max:255',
            'due_date' => 'required|date',
        ]);

        Task::create([
            'task_name' => $request->task_name,
            'is_completed' => false,
            'due_date' => $request->due_date,
        ]);

        return redirect()->route('tasks.index');
    }

    public function edit(Task $task)
    {
        return view('tasks.edit', compact('task'));
    }

    public function update(Request $request, Task $task)
    {
        $request->validate([
            'task_name' => 'required|max:255',
            'due_date' => 'required|date',
        ]);

        $task->update([
            'task_name' => $request->task_name,
            'is_completed' => $request->has('is_completed'),
            'due_date' => $request->due_date,
        ]);

        return redirect()->route('tasks.index');
    }
}
