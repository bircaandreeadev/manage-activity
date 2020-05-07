@extends('layouts.app')

@section('content')
    <div class="main-content p-20">
        <div class="top">
            <div class="text-left d-inline-flex">
                <h2>Users</h2>
            </div>
            <div class="pull-right">
                <a href="{{route('users.create')}}" class="btn btn-simple"><i class="fa fa-plus"></i> Add user</a>
            </div>
        </div>
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        <div class="mt-3">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>E-mail</th>
                        <th>Projects</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user) 
                        <tr>
                            <td>
                                <a href="{{route('users.show', $user->id)}}">{{$user->name}}<a>
                            </td>
                            <td>{{$user->email}}</td>
                            <td>
                                @foreach($user->projects as $project)
                                    <a href="{{route('projects.show', $project->id)}}"><small>{{$project->title}}</small></a><br>
                                @endforeach
                            </td>
                            <td class="d-flex">
                                <a class="btn btn-sm btn-simple mr-1" href="{{route('users.edit', $user->id)}}">Edit</a>
                                <form action="{{route('users.destroy', $user->id)}}" method="POST">
                                    @csrf
                                    <input name="_method" type="hidden" value="DELETE">
                                    <button type="submit" class="btn btn-sm btn-simple" onclick="return confirm('Are you sure you want to delete the project?')">Delete</a>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
