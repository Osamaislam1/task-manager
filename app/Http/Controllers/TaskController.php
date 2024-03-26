<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::all();
        return response()->json($tasks, 200);
    }

    public function show($id)
    {
        $task = Task::findOrFail($id);
        return response()->json($task, 200);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'description' => 'nullable',
            'due_date' => 'nullable|date',
            'status' => 'nullable|boolean',
        ]);

        $task = Task::create($validatedData);
        return response()->json(['message' => 'Task created successfully', 'task' => $task], 201);
    }

    public function update(Request $request, $id)
    {
        $task = Task::findOrFail($id);
        $validatedData = $request->validate([
            'title' => 'required',
            'description' => 'nullable',
            'due_date' => 'nullable|date',
            'status' => 'nullable|boolean',
        ]);

        $task->update($validatedData);
        return response()->json(['message' => 'Task updated successfully', 'task' => $task], 200);
    }

    public function updatestatus(Request $request, Task $task)
    {
        $request->validate([
            'status' => 'required|boolean',
        ]);

        $task->status = $request->status;
        $task->save();

        return response()->json(['message' => 'Task status updated successfully', 'task' => $task], 200);
    }

    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        $task->delete();

        return response()->json(['message' => 'Task deleted successfully'], 200);
    }
}
