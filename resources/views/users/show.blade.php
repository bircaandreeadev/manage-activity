@extends('layouts.app')

@section('content')
    <div class="main-content p-20">
        <div class="top">
            <div class="text-left">
                <h2>{{$user->name}}</h2>
                <small>{{$user->email}}</small>
            </div>
        </div>
        <div class="mt-3 d-flex">
            {{-- <div class="card p-20 col-md-3">
                <ul class="text-center card-header green-gradient-bg text-white">Projects</ul>

                <div class="card-body">
                    @foreach($user->getAllPermissions() as $permission)
                        <li>{{$permission->name}}</li>
                    @endforeach
                </div>
            </div>
            <div class="card p-20 col-md-3">
                <ul class="text-center card-header green-gradient-bg text-white">Tasks</ul>

                <div class="card-body">
                    @foreach($user->getAllPermissions() as $permission)
                        <li>{{$permission->name}}</li>
                    @endforeach
                </div>
            </div>
            <div class="card p-20 col-md-3">
                <ul class="text-center card-header green-gradient-bg text-white">Permissions</ul>

                <div class="card-body">
                    @foreach($user->getAllPermissions() as $permission)
                        <li>{{$permission->name}}</li>
                    @endforeach
                </div>
            </div> --}}
        </div>
    </div>
@endsection
