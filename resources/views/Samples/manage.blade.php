@extends('layouts.SoundboardApp')

@section ('title')
Manage Samples
@endsection

@section ('linkedJS')
<script type="text/javascript">
    $(".delete").on("submit", function(){
        return confirm("Do you want to delete this item?");
    });
</script>
@endsection

@section('favicon')
    <link rel="icon" type="image/png" href="https://static-cdn.jtvnw.net/emoticons/v1/496660/1.0" sizes="32x32">
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @if(empty($samples->all()))
                    <div class="card text-center">
                        <div class="card-body">
                            <h5 class="card-title">No Samples here <img src="https://static-cdn.jtvnw.net/emoticons/v1/549934/2.0" /></h5>
                            <a href="{{Route('MakeSample')}}" class="btn btn-success" style="margin-right: 20px;">Upload a Sample</a>
                            <a href="{{Route('home')}}" class="btn btn-info">Go Back</a>
                        </div>
                    </div>
                @endif
                <div class="card-columns">
                {{-- dd($samples) --}}
                @foreach ($samples as $sample)

                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">{{$sample->name}}</h5>
                                <p class="card-text">ID: {{$sample->id}} </p>
                                <p class="card-text"><small class="text-muted">Last updated: {{$sample->updated_at->diffForHumans()}}</small></p>

                                <a href="/samples/edit/{{$sample->id}}" class="btn btn-primary">Edit</a>

                                <form method="POST" action="/samples/delete/" style="float:right;">
                                    @csrf
                                    @method('DELETE')
                                    <input type="hidden" name="id" value="{{Crypt::encrypt($sample->id)}}" >
                                    <input type="submit" value="Delete" class="btn btn-danger" onclick="return confirm('Are you sure you want to Delete this Sample (ID: {{$sample->id}}) ?')">
                                </form>
                            </div>
                        </div>
                @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection