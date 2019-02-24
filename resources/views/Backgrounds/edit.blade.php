@extends('layouts.SoundboardApp')

@section('favicon')
    <link rel="icon" type="image/png" href="https://static-cdn.jtvnw.net/emoticons/v1/549953/1.0" sizes="32x32">
@endsection

@section('customJS')

@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <a type="button" href="{{route('ManageBackground')}}" class="btn btn-light" style="position: relative; float: left; height: fit-content;" title="Go back to background Management"><i class="fas fa-angle-left"></i></a>
            <div class="col-md-8">
                @if(Session::has('message') && Session::has('alert-class'))
                    <div class="alert {{ Session::get('alert-class', 'alert-info') }} alert-dismissible fade show" role="alert">
                        {{ Session::get('message', 'Error loading Data from Session') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                <form method="POST" action="{{route('EditBackground', [$background->id])}}" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <h2>Edit a background</h2>

                    <div class="form-group">
                        <img src="/storage/backgrounds/{{$background->filename}}" class="img-thumbnail card-img" style="height: auto; width: 60%;">
                        <br>
                        <label for="backgroundFile">Background Filename:</label>
                        <label id="backgroundFile">{{$background->filename}}</label>

                    </div>

                    <div class="form-group">
                        <label for="backgroundName">Background Name</label>
                        <input type="text" id="backgroundName" name="backgroundName" class="form-control" value="{{$background->name}}" required>
                    </div>

                    <div class="form-check form-check-inline">
                        <input type="checkbox" type="checkbox" name="isEnabled" class="form-check-input" id="isEnabled" @if($background->enabled == 1)
                        checked
                                @endif >
                        <label class="form-check-label" for="isEnabled">Enabled</label>
                    </div>


                    <div class="card-body">
                        <label for="createdAtInfo">Created at: </label>
                        <a id="createdAtInfo">{{$background->created_at}}</a>

                        <br>

                        <label for="updatedAtInfo">Last updated at: </label>
                        <a id="updatedAtInfo">{{$background->updated_at}}</a>

                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary" id="bt_submit">Submit</button>

                        <a class="btn btn-warning btn-close" href="{{route('ManageBackground')}}" style="float: right;">Cancel</a>
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