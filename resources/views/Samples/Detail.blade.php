@extends ('layouts.layout')

@section ('title')Katie quote {{$sample->id}}@endsection

@section ('linkedCSS')
    <link rel="stylesheet" type="text/css" href="{{ url('/css/detail.css') }}" />
@endsection

@section ('bodyContent')
    <div class="board-wrapper bg-white">
        <div>
            <div class="board-header">
                <div>
                    <div class="header-sound-def">
                        <a>
                            Audios with
                            <img src="https://static-cdn.jtvnw.net/badges/v1/a5687e93-8d0f-455f-921f-2d86961b1c98/1" alt="katie Subbage" class="emote">
                            in it are the Subsounds
                            <img src="https://kabie.namic.co/resources/image/random_gif/katieVA.gif" class="emote" alt="katieV Animated">
                        </a>
                    </div>
                    <div class="empty-div"></div>
                </div>
            </div>
            <h1>Information to Sample ID: {{$sample->id}}</h1>
                <ul>
                    <li>Sample-Name: {{$sample->name}}</li>
                    <li>Sample-File: {{$sample->filename}}</li>
                    <audio id="{{ $sample->id }}" controls>
                        <source src="{{ \Storage::url('/samples/' . $sample->filename) }}" type="audio/mp3" />
                            Your browser doesn't support the HTML5 Audio/Video element.
                    </audio>
                </ul>
                <a>Report this Sample</a>
        </div>
    </div>
@endsection
