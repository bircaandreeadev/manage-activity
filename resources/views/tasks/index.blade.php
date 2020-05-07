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
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        <div class="mt-3">
            <table class="table-striped">
                <thead>
                    <tr>
                        <th>Priority</th>
                        <th>Due date</th>
                        <th>Completed</th>
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
                                @if(is_null($task->completed)) 
                                    <i class="fa fa-times text-danger font-20 vertical-bottom"></i> 
                                @else
                                    <i class="fa fa-check-square text-success font-20 vertical-bottom"></i> 
                                @endif
                                <i class="vertical-bottom font-weight-bolder font-20 {{$task->label->icon}}" style="color: {{$task->label->color}}"></i> {{$task->label->title}}
                            </td>
                            <td>{{$task->due_date}}</td>
                            <td>{{$task->completed}}</td>
                            <td><span class="badge badge-simple text-uppercase">{{$task->board->project->tag}}-{{$task->id}}</span></td>
                            <td>{{$task->title}}</td>
                            <td>{{$task->user->name}}</td>
                            <td>{{$task->board->project->title}}</td>
                            @can('manage own tasks')
                                <td class="d-flex">
                                    <a class="btn btn-sm btn-simple mr-1" href="{{route('tasks.edit', $task->id)}}">Edit</a>
                                    @if($task->created_by_user_id == Auth::id() || Auth::user()->hasRole('admin'))
                                        <form action="{{route('tasks.destroy', $task->id)}}" method="POST">
                                            @csrf
                                            <input name="_method" type="hidden" value="DELETE">
                                            <button type="submit" class="btn btn-sm btn-simple" onclick="return confirm('Are you sure you want to delete the task?')">Delete</a>
                                        </form>
                                    @endif
                                </td>
                            @endcan
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
