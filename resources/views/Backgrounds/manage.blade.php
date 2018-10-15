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
                <div class="card-deck">
                    @foreach ($backgrounds as $background)
                        <div class="card" style="width: 18rem;">
                            <img class="card-img-top" src="{{'/storage/backgrounds/'.$background->filename}}" alt="Card image cap">
                            <div class="card-body">
                                <h5 class="card-title">{{$background->name}}</h5>
                                <p class="card-text">ID: {{$background->id}} </p>
                            </div>
                            <ul class="list-group list-group-flush">
                                @if($background->id == $activeBackground)
                                    <li class="list-group-item bg-success">Active Background</li>
                                @else
                                    <li class="list-group-item">
                                        <form method="POST" action="/background/edit/">
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

                                <form method="POST" action="/backgrounds/delete/" style="float:right;">
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