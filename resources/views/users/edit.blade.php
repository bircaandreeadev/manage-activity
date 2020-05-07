@extends('layouts.app')

@section('content')
    <div class="main-content p-20">
        <div class="top">
            <div class="text-left">
                <h2>Add user</h2>
            </div>
        </div>
        <div class="mt-3 d-flex">
            <form class="w-50" autocomplete="off" action="{{route('users.update', $user->id)}}" method="POST">
                @csrf
                <input name="_method" type="hidden" value="PUT">
                <div class="form-group row">
                    <label for="name" class="col-sm-3 col-form-label">Name</label>
                    <div class="col-sm-9">
                        <input autocomplete="off" placeholder="Enter name" id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $user->name }}">

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
                        <input autocomplete="off" placeholder="Enter email" id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}">

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
                        <input autocomplete="off" type="password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="Password" name="password" value="{{ $user->password }}">
                       
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
                        <select class="form-control js-example-basic-multiple @error('permissions') is-invalid @enderror" multiple="multiple" id="permissions" name="permissions[]" value="{{ old('permissions[]') }}">
                            @foreach($permissions as $permission)
                                <option value="{{$permission->id}}" @if($user->getAllPermissions()->containsStrict('id', $permission->id)) selected="selected" @endif>{{$permission->name}}</option>
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
                        <select class="form-control js-example-basic-multiple @error('projects') is-invalid @enderror" multiple="multiple" id="projects" name="projects[]" value="{{ old('projects[]') }}">
                            @foreach($projects as $project)
                                <option value="{{$project->id}}" @if($project->users->containsStrict('id', $user->id)) selected="selected" @endif>{{$project->title}}</option>
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
                            Update
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
