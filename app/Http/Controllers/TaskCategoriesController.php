<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\TaskCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use App\Http\Resources\TaskCategoryResource;
use App\Http\Requests\StoreTaskCategoryRequest;

class TaskCategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $categories = $request->user()->taskCategories;

        TaskCategoryResource::withoutWrapping();

        return Inertia::render('TaskCategory/Index', [
           'categories' => TaskCategoryResource::collection($categories)
        ]);
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create()
    {
        return Inertia::render('TaskCategory/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTaskCategoryRequest $request)
    {
        $taskCategory = new TaskCategory;
        $taskCategory->user_id = $request->user()->id;
        $taskCategory->name = $request->name;
        $taskCategory->status = 1;
        $taskCategory->save();

        $redirect = Redirect::route('taskCategory.index');
        return $redirect->with('success', 'Category added successfully.');
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
    public function edit(TaskCategory $taskCategory)
    {
        TaskCategoryResource::withoutWrapping();

        return Inertia::render('TaskCategory/Edit', [
            'categoryDetails' => new TaskCategoryResource($taskCategory)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreTaskCategoryRequest $request, TaskCategory $taskCategory)
    {
        $taskCategory->name = $request->name;
        $taskCategory->status = $request->status;
        $taskCategory->save();

        $redirect = Redirect::route('taskCategory.index');
        return $redirect->with('success', 'Category updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(TaskCategory $taskCategory)
    {
        $taskCategory->delete();

        return Redirect::back()->with('success', 'Category deleted successfully.');
    }
}
