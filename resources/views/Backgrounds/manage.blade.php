@extends('layouts.manageLayout')

@section ('titlesub')
    Backgrounds
@endsection

@section ('customJS')
<script language="javascript" type="text/javascript">

</script>
@endsection

@section('favicon')
    <link rel="icon" type="image/png" href="https://static-cdn.jtvnw.net/emoticons/v1/559312/1.0" sizes="32x32">
@endsection

@section('contentSub')
                @if(empty($backgrounds->all()))
                    <div class="card text-center">
                        <div class="card-body">
                            <h5 class="card-title">No backgrounds here <img src="https://static-cdn.jtvnw.net/emoticons/v1/549934/2.0" /></h5>
                            <a href="{{route('UploadBackground')}}" class="btn btn-success" style="margin-right: 20px;">Upload a Background</a>
                            <a href="{{route('home')}}" class="btn btn-info">Go Back</a>
                        </div>
                    </div>
                @endif
                @if(!empty($unusedBackgroundImages))
                    <div class="card text-center">
                        <div class="card-body bg-warning">
                            <h5 class="card-title">{{count($unusedBackgroundImages)}} unused Backgroundimage(s) in storage</h5>
                            <a href="#AssignUnused" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle list-group-item list-group-item-primary">Assign</a>
                            <div class="collapse list-unstyled" id="AssignUnused">
                                @foreach($unusedBackgroundImages as $unusedBackground)
                                    <div class="form-group border border-dark bg-white">
                                        <img style="width: 150px; height: auto; background-color: white; left:0" src="/storage/{{$unusedBackground}}"/>
                                        <a>{{substr($unusedBackground,27)}}</a>
                                        <div class="form-group">
                                            <form method="POST" action="{{route('ManageUnusedBackgrounds')}}">
                                                @csrf
                                                @method('POST')
                                                <input type="hidden" name="id" value="{{Crypt::encrypt($unusedBackground)}}" >
                                                <input type="submit" value="Add" class="btn btn-primary">
                                            </form>
                                            <div>
                                                <form method="POST" action="{{route('ManageUnusedBackgrounds')}}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <input type="hidden" name="id" value="{{Crypt::encrypt($unusedBackground)}}" >
                                                    <input type="submit" value="Delete" class="btn btn-danger" onclick="return confirm('Are you sure you want to Delete this Background (Filename: {{substr($unusedBackground,27)}}) ?')">
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif
                <div class="card-deck">
                    @foreach ($backgrounds as $background)
                        <div class="card" style="width: 18rem;">
                            <img class="card-img-top" src=" {{asset('/storage/backgrounds/'.$background->filename)}}" alt="Card image cap">
                            <div class="card-body">
                                <h5 class="card-title">{{$background->name}}</h5>
                                <p class="card-text">ID: {{$background->id}} </p>
                            </div>
                            <ul class="list-group list-group-flush">
                                @if($background->id == $activeBackground)
                                    <li class="list-group-item bg-success">Active Background</li>
                                @else
                                    <li class="list-group-item">
                                        <form method="POST" action="{{route('UpdateBackground')}}">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="id" value="{{Crypt::encrypt($background->id)}}" >
                                            <input type="submit" value="Make Active" class="btn btn-primary" >
                                        </form>
                                    </li>
                                @endif
                                <li class="list-group-item"><small class="text-muted">Last updated: {{$background->updated_at->diffforhumans()}}</small></li>
                            </ul>
                            <div class="card-body">
                                <a href="/background/edit/{{$background->id}}" class="btn btn-primary">Edit</a>

                                <form method="POST" action="{{route('DeleteBackground')}}" style="float:right;">
                                    @csrf
                                    @method('DELETE')
                                    <input type="hidden" name="id" value="{{Crypt::encrypt($background->id)}}" >
                                    <input type="submit" value="Delete" class="btn btn-danger" onclick="return confirm('Are you sure you want to Delete this Background (ID: {{$background->id}}) ?')">
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
@endsection