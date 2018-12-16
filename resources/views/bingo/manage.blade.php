@extends('layouts.manageLayout')

@section ('titlesub')
Memes
@endsection

@section ('linkedJS')

@endsection

@section('favicon')
    <link rel="icon" type="image/png" href="https://static-cdn.jtvnw.net/emoticons/v1/559312/1.0" sizes="32x32">
@endsection

@section('contentSub')

                @if(empty($memes->all()))
                    <div class="card text-center">
                        <div class="card-body">
                            <h5 class="card-title">No Memes here <img src="https://static-cdn.jtvnw.net/emoticons/v1/549934/2.0" /></h5>
                            <a href="{{Route('MakeMeme')}}" class="btn btn-success" style="margin-right: 20px;">Make a Meme</a>
                            <a href="{{Route('home')}}" class="btn btn-info">Go Back</a>
                        </div>
                    </div>
                @endif
                <div class="card-deck">
                    @foreach ($memes as $meme)
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">{{$meme->memeName}}</h5>
                                <div class="card-body">{!! html_entity_decode($meme->memeText) !!} </div>
                                <p class="card-text"><small class="text-muted">Last updated: {{$meme->updated_at->diffForHumans()}}</small></p>

                                <a href="/memes/edit/{{$meme->id}}" class="btn btn-primary">Edit</a>

                                <form method="POST" action="/memes/delete/" style="float:right;">
                                    @csrf
                                    @method('DELETE')
                                    <input type="hidden" name="id" value="{{Crypt::encrypt($meme->id)}}" >
                                    <input type="submit" value="Delete" class="btn btn-danger" onclick="return confirm('Are you sure you want to Delete this Sample (ID: {{$meme->id}}) ?')">
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
@endsection