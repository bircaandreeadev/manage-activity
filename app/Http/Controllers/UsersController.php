<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Project;
use App\Task;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Validator;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::orderBy('name', 'asc')->get();
        
        return view('users.index', [
            'users' => $users
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = Permission::all();
        $projects = Project::all();
        return view('users.create', [
            'permissions' => $permissions,
            'projects' => $projects,
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
        $validator = User::validate($request->toArray());
        
        if ($validator->fails()) {
            return redirect("users/create")
                        ->withErrors($validator)
                        ->withInput();
        }

        // create user
        $user = User::create($request->toArray());

        $user->projects()->attach($request->get('projects'), ['lead' => 0]);

        $user->syncPermissions($request->get('permissions'));

        return redirect("users")->with('status', 'User created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        $permissions = $user->getAllPermissions();
        $tasks = Task::where('user_id', $id)
            ->join('labels', 'labels.id', '=', 'tasks.label_id')
            ->orderBy('completed', 'asc')
            ->orderBy('due_date', 'asc')
            ->orderBy('labels.priority', 'asc')
            ->select('tasks.*') //see PS:
            ->get();
        return view('users.show', [
            'user' => $user,
            'permissions' => $permissions,
            'tasks' => $tasks,
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
        $user = User::findOrFail($id);
        $permissions = Permission::all();
        $projects = Project::all();

        return view('users.edit', [
            'user' => $user,
            'permissions' => $permissions,
            'projects' => $projects,
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
        $user = User::findOrFail($id);

        $validator = Validator::make($request->toArray(), [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$user->id,
            'password' => 'required',
        ]);
        
        if ($validator->fails()) {
            return redirect("users/$id/edit")
                        ->withErrors($validator)
                        ->withInput();
        }

        // update user
        $user->update($request->toArray());

        $user->projects()->detach();

        // attach member
        $user->projects()->wherePivot('lead', 0)->sync($request->get('projects'));

        $user->syncPermissions($request->get('permissions'));

        return redirect('users')->with('status', 'User updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        $user->delete();

        return redirect('users')->with('status', 'User deleted!');
    }
}
