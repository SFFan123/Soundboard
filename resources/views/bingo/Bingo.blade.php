@extends('layouts.layout')

@section('title')BINGO
@endsection
@section('favicon')
    <link rel="icon" type="image/png" href="https://static-cdn.jtvnw.net/emoticons/v1/1615451/1.0" sizes="32x32">
@endsection
@section('sideJS')
    <link rel="script" href="{{asset('js/bingo.js')}}">
@endsection

@section('sideCSS')
    <link rel="stylesheet" href="{{asset('css/bingo.css')}}">
@endsection

@section('bodyContent')
    <table class="table table-bordered table-dark td-hover" style="word-wrap:break-word;">
        <tr>
            <th scope="col">B</th>
            <th scope="col">I</th>
            <th scope="col">N</th>
            <th scope="col">G</th>
            <th scope="col">O</th>
        </tr>
        @if(isset($tiles))
            @for($i=0;$i<5;$i++)
                <tr>
                    @for($j=0;$j<5;$j++)
                        <td id="{{$i . $j}}" onclick="clickOnCell(this.id)">@php
                                    echo html_entity_decode($tiles[0]);
                                    array_splice($tiles,0,1);
                                    @endphp</td>
                    @endfor
                </tr>
            @endfor
        @else
            <tr>
                <td colspan="5" style="color:red">ERROR LOADING DATA <img src="https://cdn.betterttv.net/emote/56e9f494fff3cc5c35e5287e/1x" alt="monkaS"> </td>
            </tr>
        @endif
    </table>
    <div id="bottom-div" style="text-align: center">
        <p>
            <img src="{{asset('storage/img/katieGive.png')}}" alt="katieTake" style="transform: scaleX(-1);"> Submit your suggestion for further options  <a target="_blank" href="https://docs.google.com/forms/d/e/1FAIpQLScJkRQq5-RkfCLgtiTUp_Fm65-KsIv39hQ8dcOhFie3bcYgvw/viewform">here</a> <img src="{{asset('storage/img/katieGive.png')}}" alt="katieGive">
        </p>
    </div>
@endsection
