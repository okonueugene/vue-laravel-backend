<?php

namespace App\Http\Controllers\Api;

use App\Models\UserTask;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserTasksController extends Controller
{
    public function index()
    {
        $userTasks = UserTask::with(['user', 'task', 'status'])->get();
        return response()->json(['data' => $userTasks], 200);
    }

    public function addUserTask(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => 'required',
            'task_id' => 'required',
            'status_id' => 'required',
            'remarks' => 'nullable|string',
            'due_date' => 'required|date',
            'start_time' => 'nullable|date_format:H:i',
            'end_time' => 'nullable|date_format:H:i',
        ]);

        $userTask = UserTask::create($validatedData);

        return response()->json(['data' => $userTask], 201);
    }

    public function showSingleUserTask($userTaskId)
    {
        $userTask = UserTask::with(['user', 'task', 'status'])->findOrFail($userTaskId);
        return response()->json(['data' => $userTask], 200);
    }

    public function updateUserTask(Request $request, $userTaskId)
    {
        $validatedData = $request->validate([
            'user_id' => 'sometimes|required',
            'task_id' => 'sometimes|required',
            'status_id' => 'sometimes|required',
            'remarks' => 'nullable|string',
            'due_date' => 'sometimes|required|date',
            'start_time' => 'nullable|date_format:H:i',
            'end_time' => 'nullable|date_format:H:i',
        ]);

        $userTask = UserTask::with(['user', 'task', 'status'])->findOrFail($userTaskId);
        $userTask->update($validatedData);

        return response()->json(['data' => $userTask], 200);
    }

    public function destroyUserTask($userTaskId)
    {
        $userTask = UserTask::with(['user', 'task', 'status'])->findOrFail($userTaskId);
        $userTask->delete();

        return response()->json(null, 204);
    }

    public function getUserTasksByUserId($userId)
    {
        $userTasks = UserTask::where('user_id', $userId)
                    ->join('users', 'users.id', '=', 'user_tasks.user_id')
                    ->join('tasks', 'tasks.id', '=', 'user_tasks.task_id')
                    ->join('statuses', 'statuses.id', '=', 'user_tasks.status_id')
                    ->select('users.name as user_name', 'tasks.name as task_name', 'statuses.name as status_name')
                    ->get();
        return response()->json(['data' => $userTasks], 200);
    }

    public function changeStatus(Request $request, $userTaskId)
    {
        $validatedData = $request->validate([
            'status_id' => 'required',
        ]);

        $userTask = UserTask::with(['user', 'task', 'status'])->findOrFail($userTaskId);
        $userTask->update($validatedData);

        return response()->json(['data' => $userTask], 200);
    }

    public function getCurrentUserTasks()
    {
        $userId = Auth::id();
        $userTasks = UserTask::where('user_id', $userId)
                    ->join('users', 'users.id', '=', 'user_tasks.user_id')
                    ->join('tasks', 'tasks.id', '=', 'user_tasks.task_id')
                    ->join('statuses', 'statuses.id', '=', 'user_tasks.status_id')
                    ->select('users.name as user_name', 'tasks.name as task_name', 'statuses.name as status_name', 'user_tasks.*')
                    ->get();
        return response()->json(['data' => $userTasks], 200);
    }

}
