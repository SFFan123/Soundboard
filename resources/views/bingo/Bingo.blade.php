@extends('layouts.layout')

@section('title')BINGO
@endsection
@section('favicon')
    <link rel="icon" type="image/png" href="https://static-cdn.jtvnw.net/emoticons/v1/1615451/1.0" sizes="32x32">
@endsection
@section('sideJS')
<script type="text/javascript">
    var Area;
    function clickOnCell(id)
    {
        var i1 = id.substr(0,1);
        var i2 = id.substr(1,1);
        console.log(Area);
        if(Area[i1][i2] === false)
        {
            document.getElementById(id).className = "bg-success";
            Area[i1][i2] = true;
            if(checkForRow() || checkForCollum() || checkForCross())
            {
                alert("Winner Winner chicken dinner!");
            }
        }
        else
        {
            document.getElementById(id).classList.remove('bg-success');
            Area[i1][i2] = false;
        }
    }

    function checkForRow()
    {
        for(var i1 = 0; i1 < 5; i1++)
        {
            var rowScore = 0;
            for(var i2 = 0; i2 < 5; i2++)
            {
                if(Area[i1][i2])
                {
                    rowScore++;
                    if(rowScore === 5)
                    {
                        return true;
                    }
                }
            }
        }
        return false;
    }
    function checkForCollum()
    {
        for(var i1 = 0; i1 < 5; i1++)
        {
            var CollomScore = 0;
            for(var i2 = 0; i2 < 5; i2++)
            {
                if(Area[i2][i1])
                {
                    CollomScore++;
                    if(CollomScore === 5)
                    {
                        return true;
                    }
                }
            }
        }
        return false;
    }
    function checkForCross()
    {
        var cross1 =
            Area[0][0] &&
            Area[1][1] &&
            Area[2][2] &&
            Area[3][3] &&
            Area[4][4];
        if(cross1)
        {
            return true;
        }
        var cross2 =
            Area[0][4] &&
            Area[1][3] &&
            Area[2][2] &&
            Area[3][1] &&
            Area[4][0];
        if(cross2)
        {
            return true;
        }
        return false;
    }
    window.onload = function () {
        var id;
        Area = new Array(5);
        for (var i = 0; i < 5; i++) {
            Area[i] = new Array(5);
        }
        for (var i1 = 0; i1 < 5; i1++) {
            for (var i2 = 0; i2 < 5; i2++) {
                Area[i1][i2] = false;
            }
        }
    };
</script>
@endsection

@section('sideCSS')
    <style type="text/css">
        tr{

        }
        td, th{
            text-align: center;
            vertical-align: middle !important;
            height: 130px !important;
            width: 130px !important;
        }
        th{
            font-size: large;
            border-bottom-width: 4px !important;
        }
        td:hover
        {
            background-color: #0088fb78;
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
        #bottom-div img
        {
            height: 56px;
            width: auto;
            max-width: 56px;
        }
    </style>
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
