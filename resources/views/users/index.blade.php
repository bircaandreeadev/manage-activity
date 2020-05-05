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
                            <td></td>
                            <td>
                                <a class="btn btn-sm btn-simple" href="{{route('users.edit', $user->id)}}">Edit</a>
                                <a class="btn btn-sm btn-simple" href="{{route('users.destroy', $user->id)}}">Delete</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
