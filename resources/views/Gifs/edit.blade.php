@extends('layouts.SoundboardApp')


@section('customCSS')

@endsection


@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <a type="button" href="{{route('ManageGifs')}}" class="btn btn-light" style="position: relative; float: left; height: fit-content;" title="Go back to Meme Management"><i class="fas fa-angle-left"></i></a>
            <div class="col-md-8">
                @if(Session::has('message') && Session::has('alert-class'))
                    <div class="alert {{ Session::get('alert-class', 'alert-info') }} alert-dismissible fade show" role="alert">
                        {{ Session::get('message', 'Error loading Data from Session') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                <form method="POST" action="{{route('EditGif', $gif->id)}}" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <h2>Edit a Gif</h2>
                    <div class="form-group">
                        <img src="/storage/gifs/{{$gif->filename}}" class="img-thumbnail">
                        <label for="gifFile">Gif Filename:</label>
                        <label id="gifFile">{{$gif->filename}}</label>

                    </div>

                    <div class="form-group">
                        <label for="GifName">Gif Name</label>
                        <input type="text" id="GifName" name="GifName" class="form-control" value="{{$gif->GifName}}" required>
                    </div>

                    <div class="form-check-inline">
                        <input class="form-check-input" type="radio" name="gifPlacement" id="gifPlacementLeft" value="left" @if($gif->placement == 'left')
                        checked
                                @endif >
                        <label class="form-check-label" for="gifPlacementLeft">
                            Place Gif on the Left side.
                        </label>
                    </div>
                    <div class="form-check-inline" style="float: right;">
                        <input class="form-check-input" type="radio" name="gifPlacement" id="gifPlacementRight" value="right" @if($gif->placement == 'right')
                        checked
                                @endif>
                        <label class="form-check-label" for="gifPlacementRight">
                            Place Gif on the Right side.
                        </label>
                    </div>

                    <div class="form-check form-check" style="margin-top: 1em;">
                        <input type="checkbox" type="checkbox" name="isEnabled" class="form-check-input" id="isEnabled" @if($gif->enabled == 1)
                        checked
                                @endif>
                        <label class="form-check-label" for="isEnabled">Enabeld</label>
                    </div>


                    <div class="card-body">
                        <label for="createdAtInfo">Created at: </label>
                        <a id="createdAtInfo" title="{{$gif->created_at}}">{{$gif->created_at->diffForHumans()}}</a>

                        <br>

                        <label for="updatedAtInfo">Last updated at: </label>
                        <a id="updatedAtInfo" title="{{$gif->updated_at}}">{{$gif->updated_at->diffForHumans()}}</a>

                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary" id="bt_submit">Submit</button>

                        <a class="btn btn-warning btn-close" href="{{route('ManageGifs')}}" style="float: right;">Cancel</a>
                    </div>
                </form>

                @include('layouts.errors')
            </div>
        </div>
    </div>
@endsection