@extends('layouts.app')

@section('content')
    <div class="main-content p-20">
        <div class="top">
            <div class="text-left d-inline-flex">
                <h2>Projects</h2>
            </div>
            <div class="pull-right">
                <a href="{{route('projects.create')}}" class="btn btn-simple"><i class="fa fa-plus"></i> Add project</a>
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
                        <th>Title</th>
                        <th>Tag</th>
                        <th>Project lead</th>
                        <th>Contributors</th>
                        <th>Tasks</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($projects as $project) 
                        <tr>
                            <td>
                                <a href="{{route('projects.show', $project->id)}}">{{$project->title}}<a>
                            </td>
                            <td><span class="badge badge-simple text-uppercase">{{$project->tag}}</span></td>
                            <td>{{$project->lead()->name}}</td>
                            <td>
                                @foreach($project->members() as $member)
                                    <a href="{{route('users.show', $member->id)}}"><small>{{$member->name}}</small></a><br>
                                @endforeach
                            </td>
                            <td>{{$project->numberOfTasks()}}</td>
                            <td class="d-flex">
                                <a class="btn btn-sm btn-simple mr-1" href="{{route('projects.edit', $project->id)}}">Edit</a>
                                <form action="{{route('projects.destroy', $project->id)}}" method="POST">
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
