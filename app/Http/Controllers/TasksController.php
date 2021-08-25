<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Inertia\Inertia;
use App\Models\TaskCategory;
use Illuminate\Http\Request;
use App\Http\Resources\TaskResource;
use App\Http\Requests\StoreTaskRequest;
use Illuminate\Support\Facades\Redirect;
use App\Http\Resources\TaskCategoryResource;

class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $taskCategories = TaskCategory::where('user_id', $request->user()->id)->where('status', 1)->get();

        $query = $request->user()->tasks();

        if (isset($request->id)) {
            $query->where('category_id', $request->id);
        }

        $tasks = $query->get();

        TaskResource::withoutWrapping();
        TaskCategoryResource::withoutWrapping();

        return Inertia::render('Task/Index', [
           'tasks' => TaskResource::collection($tasks),
           'taskCategories' => new TaskCategoryResource($taskCategories)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $taskCategories = TaskCategory::where('user_id', $request->user()->id)->where('status', 1)->get();
        TaskCategoryResource::withoutWrapping();
        return Inertia::render('Task/Create', [
            'taskCategories' => new TaskCategoryResource($taskCategories)
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTaskRequest $request)
    {
        $task = new Task;
        $task->user_id = $request->user()->id;
        $task->category_id = $request->categoryId;
        $task->name = $request->name;
        $task->is_complete = 0;
        $task->save();

        $redirect = Redirect::route('task.index');
        return $redirect->with('success', 'Task added successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Task $task)
    {
        TaskResource::withoutWrapping();
        TaskCategoryResource::withoutWrapping();

        $taskCategories = TaskCategory::where('user_id', $request->user()->id)->where('status', 1)->get();

        return Inertia::render('Task/Edit', [
            'task' => new TaskCategoryResource($task),
            'taskCategories' => new TaskCategoryResource($taskCategories)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreTaskRequest $request, Task $task)
    {
        $task->category_id = $request->categoryId;
        $task->name = $request->name;
        $task->is_complete = $request->isComplete;
        $task->save();

        $redirect = Redirect::route('task.index');
        return $redirect->with('success', 'Task updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        $task->delete();

        return Redirect::back()->with('success', 'Task deleted successfully.');
    }

    /**
     * Toggle the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function toggleComplete(Task $task)
    {
        $task->is_complete = ! $task->is_complete;
        $task->save();

        $redirect = Redirect::route('task.index');
        return $redirect->with('success', 'Status updated successfully.');
    }
}
