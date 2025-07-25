<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    return view('tasks.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    $task = Auth::user()->tasks()->create([
    'title' => $request->title,
    'description' => $request->description, // Optional
    'is_done' => false,
]);

    return response()->json($task);
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        //
    $task->update($request->all());
    return response()->json($task);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        //
    $task->delete();
    return response()->json(['status' => 'deleted']);
    }

    /**
     * Toggle the completion status of the specified task.
     */
public function toggle(Task $task)
{
    if ($task->user_id !== auth()->id()) {
        abort(403); // block if not owned by user
    }

    $task->is_done = !$task->is_done;
    $task->save();

    return response()->json($task);
}

    /**
     * Fetch tasks for the authenticated user.
     */
public function fetch()
{
    $tasks = Auth::user()->tasks()->latest()->get();
    return response()->json($tasks);
}

}
