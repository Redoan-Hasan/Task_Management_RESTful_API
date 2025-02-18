<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return auth()->user()->tasks;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'body' => 'required|string',
        ]);

        // $task = auth()->user()->tasks()->create($request->only('body'));
        $task = auth()->user()->tasks()->create([
            'body'=>$request->body,
            'is_finished'=>true,
            'finished_at'=>now(),
        ]);

        if(!$task){
            return response()->json([
                'error'=>'Give the details properly',
            ], Response::HTTP_BAD_REQUEST);
        }

        return response()->json([
            'message' => 'Task created successfully',
            'task' => $task,
        ], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        if($task->user_id !== auth()->id()){
            return response()->json([
                'error' => 'You are not authorized to view this task',
            ], Response::HTTP_FORBIDDEN);
        }

        return $task;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        if($task->user_id !== auth()->id()){
            return response()->json([
                'error' => 'You are not authorized to update this task',
            ], Response::HTTP_FORBIDDEN);
        }

        $request->validate([
            'body' => 'required|string',
        ]);

        $task->update($request->only('body'));

        return response()->json([
            'message' => 'Task updated successfully',
            'task' => $task,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        if($task->user_id !== auth()->id()){
            return response()->json([
                'error' => 'You are not authorized to delete this task',
            ], Response::HTTP_FORBIDDEN);
        }

        $task->delete();

        return response()->json([
            'message' => 'Task deleted successfully',
        ], Response::HTTP_OK);
    }
}
