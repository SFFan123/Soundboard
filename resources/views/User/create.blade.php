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

                <div class="card">
                    <div class="card-header">{{ __('Register') }}</div>

                    <div class="card-body">
                        <form method="POST" action="">
                            @csrf

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Username') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" placeholder="Username" autocomplete="on" required autofocus>

                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" placeholder="e-mail@example.com" autocomplete="on" required>

                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" autocomplete="off" placeholder="Password" required>

                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password" autocomplete="off" required>
                                </div>
                            </div>


                            <div class="form-group border border-info rounded mx-auto">
                                <div class="card-header bg-info">
                                    Available Roles:
                                </div>
                                <div class="list-group list-group-flush">
                                    @foreach($roles as $role)
                                        <div class="form-group form-check" style="padding-left: 2em; padding-top: 1em;">
                                            <input type="checkbox" class="form-check-input" id="role_{{$role->id}}" @if($role->name == 'user') checked disabled="true" title="Default Role" @endif>
                                            <label class="form-check-label" for="role_{{$role->id}}">{{ ucfirst ($role->name) }} @if($role->name == 'user')(Default Role)@endif</label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                                <button type="submit" class="btn btn-primary">
                                    {{ __('Add new User') }}
                                </button>
                            <button type="reset" class="btn btn-warning" style="float: right" tabindex="-1">{{__('Reset')}}</button>

                        </form>
                    </div>
                </div>
        </div>
    </div>
</div>
@endsection
