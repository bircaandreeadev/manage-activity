@extends('layouts.app')

@section('content')
    <div class="main-content p-20">
        <div class="top">
            <div class="text-left">
                <h2>Edit project</h2>
            </div>
        </div>
        <div class="mt-3 d-flex">
            <form class="w-50" autocomplete="off" action="{{route('projects.update', $project->id)}}" method="POST">
                @csrf
                <input name="_method" type="hidden" value="PUT">
                <div class="form-group row">
                    <label for="title" class="col-sm-3 col-form-label">Title</label>
                    <div class="col-sm-9">
                        <input autocomplete="off" placeholder="Enter title" id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ $project->title }}">

                        @error('title')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="description" class="col-sm-3 col-form-label">Description</label>
                    <div class="col-sm-9">
                        <textarea rows="13" autocomplete="off" placeholder="Enter description" id="description" type="text" class="form-control @error('description') is-invalid @enderror" name="description">{{ $project->description }}</textarea>

                        @error('description')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="tag" class="col-sm-3 col-form-label">Tag</label>
                    <div class="col-sm-9">
                        <input autocomplete="off" placeholder="Enter tag" id="tag" type="text" class="form-control @error('tag') is-invalid @enderror" name="tag" value="{{ $project->tag }}">

                        @error('tag')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="lead" class="col-sm-3 col-form-label">Project lead</label>
                    <div class="col-sm-9">
                        <select class="form-control @error('lead') is-invalid @enderror" id="lead" name="lead"value="{{ old('lead') }}">
                            <option diabled value="">Select an option</option>
                            @foreach($leads as $lead)
                                <option value="{{$lead->id}}" @if($lead->id == $project->lead()->id) selected="selected" @endif>{{$lead->name}}</option>
                            @endforeach
                        </select>
                        @error('lead')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="members" class="col-sm-3 col-form-label">Members</label>
                    <div class="col-sm-9">
                        <select class="form-control js-example-basic-multiple @error('members') is-invalid @enderror" multiple="multiple" id="members" name="members[]" value="{{ old('members[]') }}">
                            @foreach($users as $user)
                                <option value="{{$user->id}}" @if($project->members()->containsStrict('id', $user->id)) selected="selected" @endif>{{$user->name}}</option>
                            @endforeach
                        </select>
                        @error('members')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row mb-0">
                    <div class="col-md-2 offset-md-10 text-right">
                        <button type="submit" class="btn btn-simple">
                            Update
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
