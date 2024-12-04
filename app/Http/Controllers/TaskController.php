<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Http\Requests\TaskRequest;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Task::all());
    }

    /**
     * Store a newly created task.
     */
    public function store(TaskRequest $request)
    {
        $task = Task::create($request->validated());
        return response()->json($task, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $task = Task::findOrFail($id);
        return response()->json($task);
    }

    /**
     * Update the specified task.
     */
    public function update(TaskRequest $request, $id)
    {
        $task = Task::findOrFail($id);
        $task->update($request->validated());
        return response()->json($task);
    }

    /**
     * Display a listing employee's tasks.
     */
    public function getTasks($employeeId)
    {
        $tasks = Task::where('employee_id', $employeeId)->get();
        return response()->json($tasks);
    }

    /**
     * Mark task as completed.
     */
    public function markComplete($id)
    {
        $task = Task::findOrFail($id);
        $task->update(['status' => 'completed']);
        return response()->json($task);
    }

    /**
     * Remove the specified task.
     */
    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        $task->delete();
        return response()->json(['message' => 'Task deleted successfully']);
    }
}
