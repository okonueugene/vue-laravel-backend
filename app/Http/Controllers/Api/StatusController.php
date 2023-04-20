<?php

namespace App\Http\Controllers\Api;

use App\Models\Status;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;

class StatusController extends Controller
{
    public function allStatus()
    {
        $statuses = Status::all();
        return response()->json(['data' => $statuses], Response::HTTP_OK);
    }

    public function addStatus(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:statuses',
        ]);

        $status = Status::create($validatedData);

        return response()->json(['data' => $status], Response::HTTP_CREATED);
    }

    public function getSingleStatus($status_id)
    {
        $status = Status::find($status_id);
        return response()->json(['data' => $status], Response::HTTP_OK);
    }

    public function updateStatus($status_id, Request $request)
    {
        $status = Status::find($status_id);
        $status->update($request->all());
        return response()->json(['data' => $status], Response::HTTP_OK);
    }

    public function destroyStatus($status_id)
    {
        $status = Status::find($status_id);
        $status->delete();
        return response()->json(['data' => $status], Response::HTTP_OK);
    }
}
