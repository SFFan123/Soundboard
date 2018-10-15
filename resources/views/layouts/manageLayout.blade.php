@extends('layouts.soundboardApp')

@section ('title')
    Manage @yield('titlesub')
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h2>Manage @yield('titlesub')</h2>
                @if(Session::has('message') && Session::has('alert-class'))
                    <div class="alert {{ Session::get('alert-class', 'alert-info') }} alert-dismissible fade show" role="alert">
                        {{ Session::get('message', 'Error loading Data from Session') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                @yield('contentSub')
            </div>
        </div>
    </div>
@endsection