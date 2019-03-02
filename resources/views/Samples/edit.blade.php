@extends('layouts.SoundboardApp')


@section('customCSS')
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
@endsection

@section('customJS')
    <script>
        function updatePreview() {
            document.getElementById('preview').innerHTML = document.getElementById('sampleHTML').value;
        }
    </script>
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <a type="button" href="{{route('manageSample')}}" class="btn btn-light" style="position: relative; float: left; height: fit-content;" title="Go back to Sample Management"><i class="fas fa-angle-left"></i></a>
            <div class="col-md-8">
                @if(Session::has('message') && Session::has('alert-class'))
                    <div class="alert {{ Session::get('alert-class', 'alert-info') }} alert-dismissible fade show" role="alert">
                        {{ Session::get('message', 'Error loading Data from Session') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                <form method="POST" action="{{route('editSample', $sample->id)}}" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <h2>Edit a Sample</h2>
                    <div class="form-group">
                        <label for="sampleFile">Sample Filename:</label>
                        <label id="sampleFile">{{$sample->filename}}</label>
                        <audio id="{{ $sample->id }}" style="float: right" class="border border-dark" controls>
                            <source id="soundSource" src="{{Storage::url('samples/' . $sample->filename)}}" type="audio/mp3" />
                            Your browser doesn't support the HTML5 Audio/Video element.
                        </audio>
                    </div>

                    <div class="form-group">
                        <label for="sampleName">Sample Name</label>
                        <input type="text" id="sampleName" name="sampleName" class="form-control" value="{{$sample->name}}" required>
                    </div>

                    <div class="form-group">
                        <label for="sampleHTML">Display (HTML)</label>
                        <input type="text" id="sampleHTML" name="sampleHTML" class="form-control" value="{{ html_entity_decode($sample->display) }}" required>
                    </div>

                    <div class="form-check form-check-inline">
                        <input type="checkbox" type="checkbox" name="subCheck" class="form-check-input" id="subCheck" @if($sample->subsound == 1)
                        checked
                                @endif >
                        <label class="form-check-label" for="subCheck">Subsound</label>
                    </div>
                    <div class="form-check form-check-inline" style="margin-left: 3em;">
                        <input type="checkbox" type="checkbox" name="isEnabled" class="form-check-input" id="isEnabled" @if($sample->enabled == 1)
                        checked
                                @endif >
                        <label class="form-check-label" for="isEnabled">Enabeld</label>
                    </div>


                    <div class="card-body">
                        <label for="createdAtInfo">Created at: </label>
                        <a id="createdAtInfo">{{$sample->created_at}}</a>

                        <br>

                        <label for="updatedAtInfo">Last updated at: </label>
                        <a id="updatedAtInfo">{{$sample->updated_at}}</a>

                    </div>

                    <div class="form-group" style="text-align: center">
                        <button type="submit" class="btn btn-primary" id="bt_submit" style="float: left">Submit</button>
                        <a class="btn btn-info" id="btnUpdatePreview" onclick="updatePreview();"><i class="fas fa-sync-alt"></i> Update Preview</a>
                        <a class="btn btn-warning btn-close" href="/samples/manage" style="float: right;">Cancel</a>
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
                            {!! html_entity_decode($sample->display) !!}
                        </div>
                    </div>
            </div>
        </div>
    </div>
@endsection