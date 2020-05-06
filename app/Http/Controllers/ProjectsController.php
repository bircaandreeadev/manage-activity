<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;
use App\User;
use App\Label;
use Auth;

class ProjectsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::all();
        return view('projects.index', [
            'projects' => $projects,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all();
        $leads = User::permission('manage projects')->get();

        return view('projects.create', [
            'users' => $users,
            'leads' => $leads,
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
        $validator = Project::validate($request->toArray());
        
        if ($validator->fails()) {
            return redirect('projects/create')
                        ->withErrors($validator)
                        ->withInput();
        }

        // create project
        $project = Project::create($request->toArray());

        // attach  members
        $project->users()->attach($request->get('members'));

        // attach the lead project marked with 1
        $project->users()->attach($request->get('lead'), ['lead' => 1]);

        return redirect('projects')->with('status', 'Project created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        $project = Project::findOrFail($id);

        if(!($project->members()->containsStrict('id', Auth::user()->id) || $project->lead()->id == Auth::user()->id)) {
            abort(403, 'Unauthorized action.');
        }
        
        $users = User::all();
        $labels = Label::all();
        return view('projects.show', [
            'project' => $project,
            'users' => $users,
            'labels' => $labels,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $project = Project::findOrFail($id);
        $users = User::all();
        $leads = User::permission('manage projects')->get();
        return view('projects.edit', [
            'project' => $project,
            'users' => $users,
            'leads' => $leads,
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
        $validator = Project::validate($request->toArray());
        
        if ($validator->fails()) {
            return redirect("projects/$id/edit")
                        ->withErrors($validator)
                        ->withInput();
        }

        // update project
        $project = Project::findOrFail($id);
        $project->update($request->toArray());

        $project->users()->detach();
        // attach members
        $project->users()->attach($request->get('members'));

        // attach the lead project marked with 1
        $project->users()->attach($request->get('lead'), ['lead' => 1]);

        return redirect('projects')->with('status', 'Project updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $project = Project::findOrFail($id);

        $project->delete();

        return redirect('projects')->with('status', 'Project deleted!');
    }
}
