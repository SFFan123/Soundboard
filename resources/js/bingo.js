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