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
            <form method="post" class="form-update" action="{{route('tasks.update', $task->id)}}">
                @csrf
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" value="{{$project->id}}" name="project_id">
                <input type="hidden" value="1" name="task">

                <div class="form-group row">
                    <label for="title" class="col-sm-3 col-form-label">Title</label>
                    <div class="col-sm-9">
                        <input autocomplete="off" placeholder="Enter title" id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ $task->title }}">

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
                        <select class="form-control @error('label_id') is-invalid @enderror" id="label_id" name="label_id">
                            <option disabled selected value="">Select an option</option>
                            @foreach($labels as $label)
                                <option value="{{$label->id}}" @if($task->label_id == $label->id) selected="selected" @endif>{{$label->title}}</option>
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
                        <input autocomplete="off" placeholder="Enter date" id="due_date" type="date" class="form-control @error('due_date') is-invalid @enderror" name="due_date" value="{{ $task->due_date }}">

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
                            <select class="form-control @error('user_id') is-invalid @enderror" id="user_id" name="user_id">
                                <option disabled selected value="">Select an option</option>
                                @foreach($users as $user)
                                    <option value="{{$user->id}}" @if($task->user_id == $user->id) selected="selected" @endif>{{$user->name}}</option>
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
                                <option value="{{$board->id}}" @if($task->board_id == $board->id) selected="selected" @endif>{{$board->title}}</option>
                            @endforeach
                        </select>
                        @error('board_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="completed" class="col-sm-3 col-form-label">Completed</label>
                    <div class="col-sm-9">
                        <input autocomplete="off" placeholder="Enter date" id="completed" type="date" class="form-control @error('completed') is-invalid @enderror" name="completed" value="{{ $task->completed }}">

                        @error('completed')
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

    
<script>

    $(document).ready(function(){
        $('#project_id').change(function(){
    
            // projct  id
            var id = $(this).val();
    
            // Empty the dropdown
            $('#board_id').find('option').not(':first').remove();
    
            // AJAX request 
            $.ajax({
                url: '../projects/'+id,
                type: 'get',
                dataType: 'json',
                success: function(response){
                    var len = 0;
                    if(response != null){
                        len = response.length;
                    }
                    if(len > 0){
                        // Read data and create <option >
                        for(var i=0; i<len; i++){
    
                            var id = response[i].id;
                            var title = response[i].title;
                            var option = "<option value='"+id+"'>"+title+"</option>"; 
    
                            $("#board_id").append(option); 
                        }
                    }
                }
            });
        });
    });
    
    </script>
@endsection

