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

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif


            <form method="POST" action="{{Route('StoreMeme')}}" enctype="multipart/form-data">
                @csrf
                <h2>Make a new Meme</h2>

                <div class="form-group">
                    <label for="memeName">Meme Name</label>
                    <input placeholder="The name of the meme, try to make it best descriptive" type="text" id="memeName" name="memeName" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="memeHTML">Display (HTML-Code)</label>
                    <textarea placeholder="The HTML Code to create the meme including <img> tags" type="text" id="memeHTML" name="memeHTML" class="form-control" required></textarea>
                </div>

                <div class="form-group">
                    <label for="memeClipboard">Clipboard Text</label>
                    <textarea placeholder="The Text to paste into Twitch chat or Discord." type="text" id="memeClipboard" name="memeClipboard" class="form-control" required></textarea>
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
