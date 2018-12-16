@extends ('layouts.layout')

@section ('title')
Katie QUOTES
@endsection

@section('favicon')
<link rel="icon" type="image/png" href="https://static-cdn.jtvnw.net/emoticons/v1/496660/1.0" sizes="32x32">
@endsection

@section('sideCSS')
    <style type="text/css">
        table
        {
            border: none;
            text-align: center;
            vertical-align: middle;
        }
        tr
        {
            border-collapse: collapse;
        }
        td
        {
            min-height: 40px;
            vertical-align: middle;
        }
        #Bottom_explnation_stuff
        {
            text-align: center;
            font-size: 13px;
            display: block;
        }
        #Bottom_explnation_stuff img
        {
            height:17px;
            width: 17px;
        }
        .container {
            background: white;
            margin: auto;
            width: 52%;
        }
    </style>
@endsection

@section ('linkedJS')
<script src="/js/soundboard.js"></script>
@endsection
@section ('linkedCSS')
<link rel="stylesheet" type="text/css" href="{{ url('/css/soundboard.css') }}" />
@endsection
@section ('bodyContent')
        <div id="left-side-container" class="left-side-container">
            <div id="left-top-fixed-div">
                @if(!empty ( $randomMeme ))
                <div id="random-meme-div" class="random-meme-div" onclick="copyMeme()" title="Click left to copy meme to clipboard">
                        {!! html_entity_decode($randomMeme->memeText) !!}
                    </div>
                    <textarea style="display: none" id="meme_Clipboard_Text">{{$randomMeme->clipboardText}}</textarea>
                @endif
                <div id="currentMediaDisplayDiv"><ul id="currentMediaDisplay"></ul></div>
            </div>
        </div>
        <div id="hint_right_side" onClick="stopAllSounds();">Hitting Esc will Stop all sounds <img src="https://static-cdn.jtvnw.net/emoticons/v1/549914/1.0" alt="katieLurk"><br>And also clicking on this <i class="fas fa-stop"></i></div>
        <div id="info_right_side">Due to a Chrome update the Volume Control got changed to just mute and unmute. To gain the old controls back you need to go to <u>chrome://flags/#enable-modern-media-controls</u> and change the "New Media Controls" to "disabled".</div>
        <div id="queue_info_right_side">Queue running, stop with Esc! or with the stop button above this.</div>
    <table id="wrapperTable" bgcolor="#FFFFFF">
        <tr>
            <td>
                <div>
                    <div id="Sample-Counter">
                        <label for="sampCount">Sample count: {{$samples->count()}}</label>
                        <output id="sampCount" name="sampCount"></output>
                    </div>
                    <div>
                        <a style="margin-bottom:5px;">
                            Audios with 
                            <img src="https://static-cdn.jtvnw.net/badges/v1/a5687e93-8d0f-455f-921f-2d86961b1c98/1" alt="katie Subbage"> 
                            in it are the Subsounds 
                            <img src="https://kabie.namic.co/resources/image/random_gif/katieVA.gif" style="width:28px;height:28px;" alt="katieV Animated">
                        </a>
                        <br>
                        <button class="control_button" id="playQueue" onclick="queueAll();">
                            Queue all, and play.
                        </button>
                        <button class="control_button" id="play" onclick="toggleAllSounds();" title="Warning this will play ALL sounds at once!">
                            PLAY <b>ALL</b> AT ONCE
                        </button>
                        <button class="control_button" onclick="rewindAudio();">
                            Rewind all
                        </button>
                        <button class="control_button" onclick="playRandomAudio();">
                            Random play
                        </button>
                        <label for="allowMultiplaycheckbox">Allow multi(on random):
                            <input id="allowMultiplaycheckbox" name="allowMultiplaycheckbox" type="checkbox" checked="checked" />
                        </label>
                        |
                        <label for="playLimitation"><i>Limit to filtered samples</i>
                            <input type="checkbox" id="playLimitation"/>
                        </label>
                        <br>
                    <div class="search-wrapper"> 
                        <form>
                            <input type="text" id="myInput" onkeyup="searchBarKeyUp();" placeholder="Search for Samples.." title="Type in a Sample name" style="margin-top:5px;"/>
                            <button id="btnClearSearchbar" class="close-icon" type="reset" onclick="clearSearchBar();" style="visibility: hidden;"></button>
                        </form>
                    </div>
                    </div>
                    <div id="soundTable">
                        @foreach ($samples as $sample)
                        <div class="subGridContainer">
                            <div id="cell_{{ $sample->id }}" class="gird-item">
                                <a class="Sample-Name">{!! html_entity_decode($sample->display) !!}</a>
                                <a class="serach_Tag">{{$sample->name}}</a>
                                <i class="fas fa-bars fa-border Meta-Data" title="ID: {{$sample->id}}"></i>
                            </div>
                            <div class="gird-item">
                                <audio name="sound"  id="{{ $sample->id }}" onplay="startsPlaying(id);" onpause="stopsPlaying(id);" controls>
                                <source id="soundSource" src="/storage/samples/{{$sample->filename}}" type="audio/mp3" />
                                Your browser doesn't support the HTML5 Audio/Video element.
                                </audio>
                            </div>
                        </div>
                        <!-- New Element -->
                        @endforeach
                    </div>
                </div>
            </td>
        </tr>
    <!-- End wrapper tabel -->
    </table>
        @if(!empty ( $bottomGif ))
    <div id="bottom-div" style="{{$bottomGif->placement}}: 0px;">
        <img id="bottomGif" src="/storage/gifs/{{$bottomGif->filename}}" alt="{{$bottomGif->GifName}}">
    </div>
    @endif
@endsection