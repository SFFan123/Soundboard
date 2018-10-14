@extends('layouts.SoundboardApp')

@section('customJS')
<script type="text/javascript">
    var fileTooBigText = 'The Gif is too big. <img src="https://static-cdn.jtvnw.net/emoticons/v1/549893/1.0">';


    function checkFileInput(file)
    {
        const colorSuccess = "#00ff00";
        const colorFailed = "#ff0000";
        var file1 = file.files[0];
        var fileSize = file.files[0].size/ 1024;
        if(fileSize>1024)
        {
            fileSize = fileSize / 1024 + "";
            fileSize = fileSize.substring(0,fileSize.indexOf(".")+3);
            fileSize = fileSize + " MB";
        }
        else
        {
            fileSize = fileSize + "";
            fileSize = fileSize.substring(0,fileSize.indexOf(".")+3);
            fileSize += " KB";
        }
        document.getElementById("filename_info").innerHTML = file1.name;

        document.getElementById("filesize").innerHTML = fileSize;

        if(file.files[0].size < (10*1024*1024))
        {
            document.getElementById("fileSizeError").style.display = "none";
            document.getElementById("fileSizeCheck").style.display = "";
            document.getElementById("fileSizeCheck").style.color = colorSuccess;
            document.getElementById("bt_submit").disabled = false;
            hideAlert();
        }
        else
        {
            document.getElementById("fileSizeCheck").style.display = "none";
            document.getElementById("fileSizeError").style.display = "";
            document.getElementById("fileSizeError").style.color = colorFailed;
            document.getElementById("bt_submit").disabled = true;
            document.getElementById('alert').style.display = "";
            document.getElementById("alert-text").innerHTML = fileTooBigText;
        }       
    }

    function hideAlert()
    {
        document.getElementById("alert").style.display = "none";
    }

</script>

@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div id="alert" class="alert alert-warning alert-dismissible fade show" style="display: none;">
              <a id="alert-text"></a>
              <button type="button" class="close" aria-label="Close" onclick="hideAlert();">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form method="POST" action="/gifs" enctype="multipart/form-data">
                @csrf
                <h2>Upload a new Gif</h2>

                <div class="form-group">
                    <label for="gifFile">File input</label>
                        <input type="file" name="gifFile" id="gifFile" accept=".gif" oninput="checkFileInput(this)" required>
                    <p class="help-block">Only gif files can be uploaded here. If your file is not in the .gif format please convert it and try again.</p>
                </div>

                <div class="form-group">
                    <label for="gifName">Gif Name</label>
                    <input type="text" id="gifName" name="gifName" class="form-control" required>
                </div>

                <div class="form-check-inline">
                <input class="form-check-input" type="radio" name="gifPlacement" id="gifPlacementLeft" value="left" checked>
                <label class="form-check-label" for="gifPlacementLeft">
                    Place Gif on the Left side.
                </label>
                </div>
                <div class="form-check-inline" style="float: right;">
                    <input class="form-check-input" type="radio" name="gifPlacement" id="gifPlacementRight" value="right">
                    <label class="form-check-label" for="gifPlacementRight">
                        Place Gif on the Right side.
                    </label>
                </div>

                <div class="form-check form-check" style="margin-top: 1em;">
                    <input type="checkbox" type="checkbox" name="isEnabled" class="form-check-input" id="isEnabled" checked>
                    <label class="form-check-label" for="isEnabled">Enabeld</label>
                </div>


                <div class="card-body">
                    <label for="filename_info">Filename: </label>
                    <a id="filename_info"></a>

                    <br>

                    <label for="filesize">Filesize: </label>
                    <a id="filesize"></a>
                    <i id="fileSizeCheck" class="fas fa-check-square fa-2x" style="display: none;"></i>
                    <i id="fileSizeError" class="fas fa-times fa-2x" style="display: none;"></i>
                    <hr>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary" id="bt_submit">Submit</button>

                    <a class="btn btn-warning btn-close" href="{{ route('home') }}" style="float: right;">Cancel</a>
                </div>
            </form>

        @include('layouts.errors')
        </div>
    </div>
</div>
@endsection
