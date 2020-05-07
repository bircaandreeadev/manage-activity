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
            <form method="post" action="{{route('tasks.store')}}">
                @csrf
                <input type="hidden" value="1" name="task">
                <div class="form-group row">
                    <label for="project_id" class="col-sm-3 col-form-label">Projects</label>
                    <div class="col-sm-9">
                        <select class="form-control @error('project_id') is-invalid @enderror" id="project_id" name="project_id"value="{{ old('project_id') }}">
                            <option disabled selected value="">Select an option</option>
                            @foreach($projects as $project)
                                @if($project->members()->containsStrict('id', Auth::user()->id) || $project->lead()->id == Auth::user()->id)
                                    <option value="{{$project->id}}">{{$project->title}}</option>
                                @endif
                            @endforeach
                        </select>
                        @error('project_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
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
                        <select class="form-control @error('board_id') is-invalid @enderror" id="board_id" name="board_id"value="{{ old('board_id') }}">
                            <option disabled selected value="">Select an option</option>
                            
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

