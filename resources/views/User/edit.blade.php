@extends('layouts.SoundboardApp')


@section('customCSS')
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
@endsection

@section('favicon')
    <link rel="icon" type="image/png" href="https://static-cdn.jtvnw.net/emoticons/v1/549953/1.0" sizes="32x32">
@endsection

@section('customJS')

@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <a type="button" href="/user/manage" class="btn btn-light" style="position: relative; float: left; height: fit-content;" title="Go back to User Management"><i class="fas fa-angle-left"></i></a>
            <div class="col-md-8">
                @if(Session::has('message') && Session::has('alert-class'))
                    <div class="alert {{ Session::get('alert-class', 'alert-info') }} alert-dismissible fade show" role="alert">
                        {{ Session::get('message', 'Error loading Data from Session') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                <form method="POST" action="/user/edit/{{$user->id}}">
                    @csrf
                    @method('PATCH')
                    <h2>Edit User " {{$user->name}} "</h2>
                    <div class="form-group">
                        <label for="userName">User Name</label>
                        <input type="text" id="name" name="name" class="form-control" value="{{$user->name}}" required>
                    </div>

                    <div class="form-group">
                        <label for="email">E-mail address</label>
                        <input type="email" id="email" name="email" class="form-control" value="{{ $user->email }}" required>
                    </div>

                    <div class="card border-danger mb-3" style="padding: 1em;">
                        <div class="form-group">
                            <label for="email">New Password</label>
                            <input type="password" id="password" name="password" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="email">Confirm new Password</label>
                            <input type="password" id="password_confirmation" name="password_confirmation" class="form-control">
                        </div>

                        <div class="card-body" style="padding: 0.5em;">
                        <img src="https://static-cdn.jtvnw.net/emoticons/v1/1034795/2.0">
                            <div class="card-text">
                                The password needs to meet these requirements.
                                <ul>
                                    <li>more than 6 characters long</li>
                                </ul>
                                To make your Password more secure.
                                <ul>
                                    <li>use Numbers</li>
                                    <li>No words</li>
                                    <li>Special Characters like !?=$%&()</li>
                                    <li>Not used on (many) other sites</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="form-group border border-info rounded mx-auto">
                        <div class="card-header bg-info">
                            Available Roles:
                        </div>
                        <div class="list-group list-group-flush">
                            @foreach($roles as $role)
                                <div class="form-group form-check" style="padding-left: 2em; padding-top: 1em;">
                                    <input type="checkbox" class="form-check-input" name="role_{{$role->id}}" @if($role->name == 'user')disabled title="Default Role" @endif {{ $user->hasRole($role->name) ? 'checked':'' }}>
                                    <label class="form-check-label" for="role_{{$role->id}}">{{ ucfirst ($role->name) }} @if($role->name == 'user')(Default Role)@endif</label>
                                </div>
                            @endforeach
                        </div>
                    </div>


                    <div class="card-body">
                        <label for="createdAtInfo">Created at: </label>
                        <a id="createdAtInfo">{{$user->created_at}}</a>

                        <br>

                        <label for="updatedAtInfo">Last updated at: </label>
                        <a id="updatedAtInfo">{{$user->updated_at}}</a>

                    </div>

                    <div class="form-group" style="text-align: center">
                        <button type="submit" class="btn btn-primary" id="bt_submit" style="float: left">Submit</button>
                        <a class="btn btn-warning btn-close" href="/user/manage" style="float: right;">Cancel</a>
                    </div>
                </form>

                @if ( count($errors) )
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)

                                <li> {{ $error }} </li>

                            @endforeach

                        </ul>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection