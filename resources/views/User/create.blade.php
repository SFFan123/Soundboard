@extends('layouts.SoundboardApp')

@section('customJS')

@endsection

@section('favicon')
    <link rel="shortcut icon" href="https://static-cdn.jtvnw.net/emoticons/v1/1336435/1.0" type="image/png" />
@endsection

@section('customCSS')
    <style>
        input:invalid:not(:focus):not(:placeholder-shown) {
            outline: 1px solid #f00;
        }</style>

@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif


            <form method="POST" action="">
                @csrf
                <h2>Add a new User</h2>

                <div class="form-group">
                    <label for="Username">User Name</label>
                    <input placeholder="Username" type="text" id="Username" name="Username" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="UserHTML">e-mail</label>
                    <input placeholder="e-mail" type="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" id="email" name="email" class="form-control" required>
                </div>



                <div class="card" style="width: 18rem;">
                    <div class="card-header">
                        Available Roles:
                    </div>
                    <ul class="list-group list-group-flush">
                        @foreach($roles as $role)
                            <li class="list-group-item">
                                <input type="checkbox" type="checkbox" name="{{$role->id}}" class="form-check-input" id="{{$role->id}}" style="margin-left: 0.5em">
                                <label class="form-check-label" style="margin-left: 2em">{{ ucfirst ($role->name) }}</label>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <hr>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary" id="bt_submit">Submit</button>

                    <a class="btn btn-warning btn-close" href="{{ route('home') }}" style="float: right;">Cancel</a>
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
