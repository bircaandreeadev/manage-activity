@extends('layouts.app')

@section('content')
    <div class="main-content p-20">
        <div class="top">
            <div class="text-left">
                <h2>Add user</h2>
            </div>
        </div>
        <div class="mt-3 d-flex">
            <form class="w-50" autocomplete="off">
                <div class="form-group row">
                    <label for="name" class="col-sm-3 col-form-label">Name</label>
                    <div class="col-sm-9">
                        <input autocomplete="off" placeholder="Enter name" id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required>

                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="email" class="col-sm-3 col-form-label">Email</label>
                    <div class="col-sm-9">
                        <input autocomplete="off" placeholder="Enter email" id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required>

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="password" class="col-sm-3 col-form-label">Password</label>
                    <div class="col-sm-9">
                        <input autocomplete="off" type="password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="Password" name="password" value="{{ old('password') }}" required>
                       
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="permissions" class="col-sm-3 col-form-label">Permissions</label>
                    <div class="col-sm-9">
                        <select class="form-control js-example-basic-multiple" multiple="multiple" id="permissions" name="permissions[]" @error('permissions') is-invalid @enderror value="{{ old('permissions[]') }}" required>
                            @foreach($permissions as $permission)
                                <option value="{{$permission->id}}">{{$permission->name}}</option>
                            @endforeach
                        </select>
                        @error('permissions')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="projects" class="col-sm-3 col-form-label">Projects</label>
                    <div class="col-sm-9">
                        <select class="form-control js-example-basic-multiple" multiple="multiple" id="projects" name="projects[]" @error('projects') is-invalid @enderror value="{{ old('projects[]') }}" required>
                            @foreach($projects as $project)
                                <option value="{{$project->id}}">{{$project->title}}</option>
                            @endforeach
                        </select>
                        @error('projects')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row mb-0">
                    <div class="col-md-2 offset-md-10 text-right">
                        <button type="submit" class="btn btn-simple">
                            Create
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
