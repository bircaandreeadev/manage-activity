@extends('layouts.app')

@section('content')
    <div class="main-content p-20">
        <div class="top">
            <div class="text-left d-inline-flex">
                <h2>{{$project->title}}</h2>
                <small>{{$project->decription}}</small>
            </div>
            @can('manage boards')
                <div class="pull-right add-board">
                    <button class="btn btn-simple"><i class="fa fa-plus"></i> Add board</a>
                </div>
            @endcan

            @canany(['add own task', 'manage tasks'])
                <div class="pull-right add-task">
                    <button class="btn btn-simple"><i class="fa fa-plus"></i> Add task</a>
                </div>
            @endcan
        </div>
        <div class="mt-3 d-flex">
            @foreach($project->boards as $board)
                <div class="card p-20 col-md-3 mx-1">
                    <ul class="text-center card-header green-gradient-bg text-white">{{$board->title}}</ul>

                    <div class="card-body">
                        @foreach($board->tasks as $task)
                            @can('manage tasks')
                                <a class="update-task" id="{{$task->id}}">
                            @endcan
                            <div class="card card-task p-1 mb-1">
                                <p>
                                    @if(is_null($task->completed)) 
                                        <i class="fa fa-times text-danger font-20 vertical-bottom"></i> 
                                    @else
                                        <i class="fa fa-check-square text-success font-20 vertical-bottom"></i> 
                                    @endif
                                    <span class="badge badge-simple text-uppercase">{{$project->tag}}-{{$task->id}}</span>

                                    <i class="fa fa-pencil pull-right edit-task"></i>
                                </p>
                                <span><i data-toggle="tooltip" data-placement="top" title="{{$task->label->title}}" class="vertical-bottom font-weight-bolder font-20 {{$task->label->icon}}" style="color: {{$task->label->color}}"></i>
                                {{$task->title}}</span>

                                @if(is_null($task->completed)) 
                                    <small class="text-right">Due date: {{$task->due_date}}</small>
                                @else
                                    <small class="text-right">Completed at: {{$task->completed}}</small>
                                @endif
                                <small class="text-right">Assigned to: {{$task->user->name}}</small>
                            </div>
                            @can('manage tasks')
                                </a>
                            @endcan
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    </div>
      
    <div id="create-task" class="modal bd-example-modal-lg @if (session('fail')) d-block @endif" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add task</h5>
                    <button type="button" class="close close-modal" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{route('tasks.store')}}">
                        @csrf
                        <input type="hidden" value="{{$project->id}}" name="project_id">
                        <div class="form-group row">
                            <label for="title" class="col-sm-3 col-form-label">Title</label>
                            <div class="col-sm-9">
                                <input autocomplete="off" placeholder="Enter title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}">
        
                                @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="label_id" class="col-sm-3 col-form-label">Priority</label>
                            <div class="col-sm-9">
                                <select class="form-control @error('label_id') is-invalid @enderror" name="label_id"value="{{ old('label_id') }}">
                                    <option disabled selected value="">Select an option</option>
                                    @foreach($labels as $label)
                                        <option value="{{$label->id}}">{{$label->title}}</option>
                                    @endforeach
                                </select>
                                @error('label_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="due_date" class="col-sm-3 col-form-label">Due date</label>
                            <div class="col-sm-9">
                                <input autocomplete="off" placeholder="Enter date" type="date" class="form-control @error('due_date') is-invalid @enderror" name="due_date" value="{{ old('due_date') }}">
        
                                @error('due_date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        @can('manage tasks')
                            <div class="form-group row">
                                <label for="user_id" class="col-sm-3 col-form-label">Users</label>
                                <div class="col-sm-9">
                                    <select class="form-control @error('user_id') is-invalid @enderror" name="user_id"value="{{ old('user_id') }}">
                                        <option disabled selected value="">Select an option</option>
                                        @foreach($users as $user)
                                            <option value="{{$user->id}}">{{$user->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('user_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        @else
                            <input type="hidden" value="{{Auth::id()}}" name="user_id">
                        @endcan

                        <div class="form-group row">
                            <label for="board_id" class="col-sm-3 col-form-label">Board</label>
                            <div class="col-sm-9">
                                <select class="form-control @error('board_id') is-invalid @enderror"  name="board_id"value="{{ old('board_id') }}">
                                    <option disabled selected value="">Select an option</option>
                                    @foreach($project->boards as $board)
                                        <option value="{{$board->id}}">{{$board->title}}</option>
                                    @endforeach
                                </select>
                                @error('board_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group mb-0">
                            <div class="pull-right">
                                <button type="submit" class="btn btn-simple">
                                    Create
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div id="update-task" class="modal bd-example-modal-lg @if (session('fail')) d-block @endif" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Update task</h5>
                    <button type="button" class="close close-modal-edit" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" class="form-update" action="">
                        @csrf
                        <input type="hidden" name="_method" value="PUT">
                        <input type="hidden" value="{{$project->id}}" name="project_id">
                        <div class="form-group row">
                            <label for="title" class="col-sm-3 col-form-label">Title</label>
                            <div class="col-sm-9">
                                <input autocomplete="off" placeholder="Enter title" id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}">
        
                                @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="label_id" class="col-sm-3 col-form-label">Priority</label>
                            <div class="col-sm-9">
                                <select class="form-control @error('label_id') is-invalid @enderror" id="label_id" name="label_id"value="{{ old('label_id') }}">
                                    <option disabled selected value="">Select an option</option>
                                    @foreach($labels as $label)
                                        <option value="{{$label->id}}">{{$label->title}}</option>
                                    @endforeach
                                </select>
                                @error('label_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="due_date" class="col-sm-3 col-form-label">Due date</label>
                            <div class="col-sm-9">
                                <input autocomplete="off" placeholder="Enter date" id="due_date" type="date" class="form-control @error('due_date') is-invalid @enderror" name="due_date" value="{{ old('due_date') }}">
        
                                @error('due_date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        @can('manage tasks')
                            <div class="form-group row">
                                <label for="user_id" class="col-sm-3 col-form-label">Users</label>
                                <div class="col-sm-9">
                                    <select class="form-control @error('user_id') is-invalid @enderror" id="user_id" name="user_id"value="{{ old('user_id') }}">
                                        <option disabled selected value="">Select an option</option>
                                        @foreach($users as $user)
                                            <option value="{{$user->id}}">{{$user->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('user_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        @else
                            <input type="hidden" value="{{Auth::id()}}" name="user_id">
                        @endcan

                        <div class="form-group row">
                            <label for="board_id" class="col-sm-3 col-form-label">Board</label>
                            <div class="col-sm-9">
                                <select class="form-control @error('board_id') is-invalid @enderror" id="board_id" name="board_id"value="{{ old('board_id') }}">
                                    <option disabled selected value="">Select an option</option>
                                    @foreach($project->boards as $board)
                                        <option value="{{$board->id}}">{{$board->title}}</option>
                                    @endforeach
                                </select>
                                @error('board_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group mb-0">
                            <div class="pull-right">
                                <button type="submit" class="btn btn-simple">
                                    Update
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
