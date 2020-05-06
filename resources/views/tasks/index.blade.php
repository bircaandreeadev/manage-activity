@extends('layouts.app')

@section('content')
    <div class="main-content p-20">
        <div class="top">
            <div class="text-left d-inline-flex">
                <h2>Tasks</h2>
            </div>
            @canany(['manage tasks', 'add own task'])
                <div class="pull-right">
                    <a href="{{route('tasks.create')}}" class="btn btn-simple"><i class="fa fa-plus"></i> Add task</a>
                </div>
            @endcan
        </div>
        <div class="mt-3">
            <table class="table-striped">
                <thead>
                    <tr>
                        <th>Priority</th>
                        <th>Due date</th>
                        <th>Tag</th>
                        <th>Title</th>
                        <th>Assigned to</th>
                        <th>Project</th>
                        @can('manage own tasks')
                            <th>Actions</th>
                        @endcan
                    </tr>
                </thead>
                <tbody>
                    @foreach($tasks as $task) 
                        <tr>
                            <td>
                                <i class="vertical-bottom font-weight-bolder font-20 {{$task->label->icon}}" style="color: {{$task->label->color}}"></i> {{$task->title}}
                            </td>
                            <td>{{$task->due_date}}</td>
                            <td><span class="badge badge-simple text-uppercase">{{$task->board->project->tag}}-{{$task->id}}</span></td>
                            <td>{{$task->title}}</td>
                            <td>{{$task->user->name}}</td>
                            <td>{{$task->board->project->title}}</td>
                            @can('manage own tasks')
                                <td>
                                    <a class="btn btn-sm btn-simple" href="{{route('tasks.edit', $task->id)}}">Edit</a>
                                    <a class="btn btn-sm btn-simple" href="{{route('tasks.destroy', $task->id)}}">Delete</a>
                                </td>
                            @endcan
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
