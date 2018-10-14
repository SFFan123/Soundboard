@extends('layouts.SoundboardApp')

@section('customJS')

@endsection

@section('favicon')
    <link rel="shortcut icon" href="https://static-cdn.jtvnw.net/emoticons/v1/1336435/1.0" type="image/png" />
@endsection

@section('customJS')

@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <form method="POST" action="{{route('StoreBackground')}}" enctype="multipart/form-data">
                @csrf
                <h2>Upload a Background</h2>

                <div class="form-group">
                    <label for="backgroundFile">File input</label>
                    <input type="file" name="backgroundFile" id="backgroundFile" accept=".png" required>
                    <p class="help-block">Only png files can be uploaded here. If your file is not in the .png format please convert it and try again.</p>
                </div>

                <div class="form-group">
                    <label for="backgroundName">Background Name</label>
                    <input placeholder="The name of the Background, like: Christmas etc" type="text" id="backgroundName" name="backgroundName" class="form-control" required>
                </div>

                <div class="form-check form-check-inline">
                    <input type="checkbox" type="checkbox" name="isEnabled" class="form-check-input" id="isEnabled" checked>
                    <label class="form-check-label" for="isEnabled">Enabeld</label>
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
