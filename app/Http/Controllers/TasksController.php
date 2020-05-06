<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;
use Auth;

class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();

        if($user->hasPermissionTo('manage tasks')) {
            $tasks = Task::join('labels', 'labels.id', '=', 'tasks.label_id')
            ->orderBy('due_date', 'desc')
            ->orderBy('labels.priority', 'desc')
            ->select('tasks.*') //see PS:
            ->get();
        } else {
            $tasks = Task::join('labels', 'labels.id', '=', 'tasks.label_id')
            ->where('tasks.user_id', $user->id)
            ->orderBy('tasks.due_date', 'desc')
            ->orderBy('labels.priority', 'desc')
            ->select('tasks.*') //see PS:
            ->get();
        }
       
        return view('tasks.index', [
            'tasks' => $tasks,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Task::validate($request->toArray());
        $project_id = $request->get('project_id');
        if ($validator->fails()) {
            return redirect("projects/$project_id")
                        ->with('fail', 1)
                        ->withErrors($validator);
        }

        // create task
        $task = Task::create($request->toArray());

        return redirect("projects/$project_id")->with('status', 'Task created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $task = Task::findOrFail($id);
        $task->setAttribute('url', route('tasks.update', $id));
        return $task;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Task::validate($request->toArray());
        $project_id = $request->get('project_id');
        if ($validator->fails()) {
            return redirect("projects/$project_id")
                        ->with('fail', 1)
                        ->withErrors($validator);
        }

        // update task
        $task = Task::findOrFail($id);
        $task->update($request->toArray());

        return redirect("projects/$project_id")->with('status', 'Task updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
