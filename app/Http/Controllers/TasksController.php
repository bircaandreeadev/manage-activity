<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;
use App\Project;
use App\Label;
use App\User;
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
            ->orderBy('completed', 'asc')
            ->orderBy('due_date', 'asc')
            ->orderBy('labels.priority', 'asc')
            ->select('tasks.*') //see PS:
            ->get();
        } else {
            $tasks = Task::join('labels', 'labels.id', '=', 'tasks.label_id')
            ->where('tasks.user_id', $user->id)
            ->orderBy('completed', 'asc')
            ->orderBy('due_date', 'asc')
            ->orderBy('labels.priority', 'asc')
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
        $projects = Project::all();
        $labels = Label::all();
        $users = User::all();
        return view('tasks.create', [
            'projects' => $projects,
            'labels' => $labels,
            'users' => $users,
        ]);
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
        if ($validator->fails() && $request->get('task')) {
            return redirect("tasks")
                        ->withErrors($validator);
        } elseif($validator->fails()) {
            return redirect("projects/$project_id")
                        ->with('fail_task', 1)
                        ->withErrors($validator);
        }
        $data = $request->toArray();
        $data['created_by_user_id'] = Auth::id();
        // create task
        $task = Task::create($data);

        if($request->get('task')) {
            return redirect("tasks")->with('status', 'Task created!');
        }
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
        $task->setAttribute('project_id', $task->board->project->id);
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
        $task = Task::findOrFail($id);
        $project = Project::findOrFail($task->board->project->id);
        $labels = Label::all();
        $users = User::all();
        return view('tasks.edit', [
            'project' => $project,
            'labels' => $labels,
            'users' => $users,
            'task' => $task,
        ]);
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

        if ($validator->fails() && $request->get('task')) {
            return redirect("tasks/$id/edit")
                        ->withErrors($validator);
        } elseif($validator->fails()) {
            return redirect("projects/$project_id")
                        ->with('fail_task', 1)
                        ->withErrors($validator);
        }

        // update task
        $task = Task::findOrFail($id);

        $data = $request->toArray();

        $task->update($data);

        if($request->get('task')) {
            return redirect("tasks")->with('status', 'Task updated!');
        }

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
        $task = Task::findOrFail($id);

        $task->delete();

        return redirect('tasks')->with('status', 'Task deleted!');
    }
}
