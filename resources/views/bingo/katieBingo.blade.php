@extends('layouts.layout')

@section('title')BINGO
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
            height: 120px;
        }
        td, th{
            text-align: center;
            vertical-align: middle !important;
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
    <table class="table table-bordered table-dark td-hover">
        <tr>
            <th scope="col">B</th>
            <th scope="col">I</th>
            <th scope="col">N</th>
            <th scope="col">G</th>
            <th scope="col">O</th>
        </tr>
        <tr>
            <td id="00" onclick="clickOnCell(this.id)">Test1</td>
            <td id="01" onclick="clickOnCell(this.id)">Test2</td>
            <td id="02" onclick="clickOnCell(this.id)">Test3</td>
            <td id="03" onclick="clickOnCell(this.id)">Test4</td>
            <td id="04" onclick="clickOnCell(this.id)">Test5</td>
        </tr>
        <tr>
            <td id="10" onclick="clickOnCell(this.id)">Test6</td>
            <td id="11" onclick="clickOnCell(this.id)">Test7</td>
            <td id="12" onclick="clickOnCell(this.id)">Test8</td>
            <td id="13" onclick="clickOnCell(this.id)">Test9</td>
            <td id="14" onclick="clickOnCell(this.id)">Test10</td>
        </tr>
        <tr>
            <td id="20" onclick="clickOnCell(this.id)">Test11</td>
            <td id="21" onclick="clickOnCell(this.id)">Test12</td>
            <td id="22" onclick="clickOnCell(this.id)">Test13</td>
            <td id="23" onclick="clickOnCell(this.id)">Test14</td>
            <td id="24" onclick="clickOnCell(this.id)">Test15</td>
        </tr>
        <tr>
            <td id="30" onclick="clickOnCell(this.id)">Test16</td>
            <td id="31" onclick="clickOnCell(this.id)">Test17</td>
            <td id="32" onclick="clickOnCell(this.id)">Test18</td>
            <td id="33" onclick="clickOnCell(this.id)">Test19</td>
            <td id="34" onclick="clickOnCell(this.id)">Test20</td>
        </tr>
        <tr>
            <td id="40" onclick="clickOnCell(this.id)">Test21</td>
            <td id="41" onclick="clickOnCell(this.id)">Test22</td>
            <td id="42" onclick="clickOnCell(this.id)">Test23</td>
            <td id="43" onclick="clickOnCell(this.id)">Test24</td>
            <td id="44" onclick="clickOnCell(this.id)">Test25</td>
        </tr>
    </table>
    <div id="bottom-div" style="text-align: center">
        <p>
            <img src="{{asset('storage/img/katieGive.png')}}" alt="katieTake" style="transform: scaleX(-1);"> Submit your suggestion for further options  <a target="_blank" href="https://docs.google.com/forms/d/e/1FAIpQLScJkRQq5-RkfCLgtiTUp_Fm65-KsIv39hQ8dcOhFie3bcYgvw/viewform">here</a> <img src="{{asset('storage/img/katieGive.png')}}" alt="katieGive">
        </p>
    </div>


@endsection
