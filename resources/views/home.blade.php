@extends('layouts.SoundboardApp')

@section('favicon')
<link rel="shortcut icon" href="https://static-cdn.jtvnw.net/emoticons/v1/1034795/1.0" type="image/png" />
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
                <div class="card">
                <div class="card-header">Katie Soundboard moves to Laravel 5.7 <img src="https://static-cdn.jtvnw.net/emoticons/v1/549887/1.0" alt="katieAww"> </div>
                <div class="card-body">
                    <a class="list-group-item list-group-item-action list-group-item-success">Basic structure created</a>
                    <a class="list-group-item list-group-item-action list-group-item-success">Basic database created</a>
                    <a class="list-group-item list-group-item-action list-group-item-success">Authentication created</a>
                    <a class="list-group-item list-group-item-action list-group-item-success">Sample Management</a>
                    <a class="list-group-item list-group-item-action list-group-item-success">Gif Management <img src="https://cdn.betterttv.net/emote/59b594fe0d64e35b941728ec/1x"></a>
                    <a class="list-group-item list-group-item-action list-group-item-success">Soundboard page completely changed to dynamic <img src="https://cdn.discordapp.com/emojis/393591416166809613.png?" style="width: 26px; height: 26px;"></a>
                    <a class="list-group-item list-group-item-action list-group-item-success">Background Image Management <img src="https://cdn.discordapp.com/emojis/467095069959389184.png" style="height: 26px; width: 26px;"></a>
                    <div class="list-group-item list-group-item-action list-group-item-info">status on development visit <a href="https://github.com/SFFan123/Soundboard/issues">github.com/SFFan123/Soundboard/issues</a></div>

                </div>
                </div>
                <div class="card">
                    <div class="card-header">Sample Management</div>
                    <div class="card-body">
                        <a>Currently {{ $samples->count() }} Sample(s) online.</a>
                        <div class="btn-group" role="group" aria-label="Control Buttons" style="float:right">
                            <a href="/samples/manage" class="btn btn-primary">Manage</a>
                            <a href="/samples/create" class="btn btn-success">Upload New</a>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">Meme Management</div>

                    <div class="card-body">
                        <a>Currently {{ $memes->count() }} Meme(s) online.</a>
                        <div class="btn-group" role="group" aria-label="Control Buttons" style="float:right">
                            <a href="{{Route('ManageMemes')}}" class="btn btn-primary">Manage</a>
                            <button type="button" class="btn btn-success">Upload New</button>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">Gif Management</div>

                    <div class="card-body">
                        <a>Currently {{ $gifs->count() }} Gif(s) online.</a>
                        <div class="btn-group" role="group" aria-label="Control Buttons" style="float:right">
                            <a href="{{Route('ManageGifs')}}" class="btn btn-primary">Manage</a>
                            <a href="{{Route('UploadGif')}}" class="btn btn-success">Upload New</a>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">Background Management</div>
                    <div class="card-body">

                        <a>Currently {{ $Backgrounds->count() }} Background(s) online.</a>
                        <div class="btn-group" role="group" aria-label="Control Buttons" style="float:right">
                            <a href="{{Route('ManageBackground')}}" class="btn btn-primary">Manage</a>
                            <a href="{{Route('UploadBackground')}}" class="btn btn-success">Upload New</a>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">User Management TODO</div>
                    <div class="card-body">
                        <a>Soon <sup>TM</sup> </a>
                        <div class="btn-group" role="group" aria-label="Control Buttons" style="float:right">
                            <button type="button" class="btn btn-primary disabled">Manage</button>
                            <button type="button" class="btn btn-success disabled">Add New</button>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">Katie Bingo Management TODO</div>

                    <div class="card-body">
                        <a>Soon <sup>TM</sup> </a>
                        <div class="btn-group" role="group" aria-label="Control Buttons" style="float:right">
                            <button type="button" class="btn btn-primary disabled">Manage</button>
                            <button type="button" class="btn btn-success disabled">Add New</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
