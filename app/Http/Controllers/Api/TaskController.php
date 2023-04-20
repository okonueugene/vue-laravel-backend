<?php

namespace App\Http\Controllers\Api;

use App\Models\Task;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get all tasks with associated status
        $tasks = Task::with('status')->get();

        // Return response with tasks data
        return response()->json(['data' => $tasks], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function addTask(Request $request)
    {
        // Validate user input
        $validatedData = $request->validate([
            'status_id' => 'required',
            'name' => 'required',
            'description' => 'nullable|string',
            'due_date' => 'required|date',
        ]);

        // Create new task with input data
        $task = Task::create($validatedData);

        // Return response with created task data
        return response()->json(['data' => $task], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showTask($id)
    {
        // Get task with associated status by id
        $task = Task::with('status')->findOrFail($id);

        // Return response with task data
        return response()->json(['data' => $task], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateTask(Request $request, $id)
    {
        // Validate user input
        $validatedData = $request->validate([
            'status_id' => 'sometimes|required',
            'name' => 'sometimes|required',
            'description' => 'nullable|string',
            'due_date' => 'sometimes|required|date',
        ]);

        // Get task with associated status by id
        $task = Task::with('status')->findOrFail($id);

        // Update task with validated data
        $task->update($validatedData);

        // Return response with updated task data
        return response()->json(['data' => $task], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyTask($id)
    {
        // Get task with associated status by id
        $task = Task::with('status')->findOrFail($id);

        // Delete task from database
        $task->delete();

        // Return response with success message
        return response()->json(['message' => 'Task deleted successfully'], 200);
    }
}
