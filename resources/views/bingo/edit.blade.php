@extends('layouts.soundboardApp')


@section('customCSS')
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
@endsection

@section('favicon')
    <link rel="icon" type="image/png" href="https://static-cdn.jtvnw.net/emoticons/v1/549953/1.0" sizes="32x32">
@endsection

@section('customJS')
<script>
    function updatePreview() {
        document.getElementById('preview').innerHTML = document.getElementById('memeHTML').value;
    }
</script>
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <a type="button" href="/memes/manage" class="btn btn-light" style="position: relative; float: left; height: fit-content;" title="Go back to Phrase Management"><i class="fas fa-angle-left"></i></a>
            <div class="col-md-8">
                @if(Session::has('message') && Session::has('alert-class'))
                    <div class="alert {{ Session::get('alert-class', 'alert-info') }} alert-dismissible fade show" role="alert">
                        {{ Session::get('message', 'Error loading Data from Session') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                <form method="POST" action="/bingo/edit/{{$meme->id}}" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <h2>Edit a meme</h2>
                    <div class="form-group">
                        <label for="phraseName">Phrase Name</label>
                        <input type="text" id="phraseName" name="phraseName" class="form-control" value="{{$meme->memeName}}" required>
                    </div>

                    <div class="form-group">
                        <label for="phraseHTML">Display (HTML)</label>
                        <input type="text" id="phraseHTML" name="phraseHTML" class="form-control" value="{{ html_entity_decode($meme->memeText) }}" required>
                    </div>

                    <div class="form-group">
                        <label for="memeClipboard">Clipboard Text</label>
                        <textarea placeholder="The Text to paste into Twitch chat or Discord." type="text" id="memeClipboard" name="memeClipboard" class="form-control" required>{{$meme->clipboardText}}</textarea>
                    </div>


                    <div class="form-check form-check-inline">
                        <input type="checkbox" type="checkbox" name="isEnabled" class="form-check-input" id="isEnabled" @if($meme->enabled == 1)
                        checked
                                @endif >
                        <label class="form-check-label" for="isEnabled">Enabeld</label>
                    </div>


                    <div class="card-body">
                        <label for="createdAtInfo">Created at: </label>
                        <a id="createdAtInfo">{{$meme->created_at}}</a>

                        <br>

                        <label for="updatedAtInfo">Last updated at: </label>
                        <a id="updatedAtInfo">{{$meme->updated_at}}</a>

                    </div>

                    <div class="form-group" style="text-align: center">
                        <button type="submit" class="btn btn-primary" id="bt_submit" style="float: left">Submit</button>
                        <a class="btn btn-info" id="btnUpdatePreview" onclick="updatePreview();"><i class="fas fa-sync-alt"></i> Update Preview</a>
                        <a class="btn btn-warning btn-close" href="/memes/manage" style="float: right;">Cancel</a>
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
                <div id="preview_container" style="text-align: center">
                    <a>Preview: </a>
                    <div id="preview"  class="border border-info" style="display: inline-block;">
                        {!! html_entity_decode($meme->memeText) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection