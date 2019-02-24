@extends('layouts.manageLayout')

@section ('titlesub')
Users
@endsection

@section ('linkedJS')

@endsection

@section('favicon')
    <link rel="icon" type="image/png" href="https://static-cdn.jtvnw.net/emoticons/v1/559312/1.0" sizes="32x32">
@endsection

@section('contentSub')

                @if(empty($users->all()))
                    <div class="card text-center">
                        <div class="card-body">
                            <h5 class="card-title">No Users here <img src="https://static-cdn.jtvnw.net/emoticons/v1/549934/2.0" /></h5>
                            <a href="" class="btn btn-success disabled" style="margin-right: 20px;">Add user</a>
                            <a href="{{Route('home')}}" class="btn btn-info">Go Back</a>
                        </div>
                    </div>
                @endif
                <div class="card-columns">
                    @foreach ($users as $user)
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">{{$user->name}}</h5>
                                <p class="card-text">ID: {{$user->id}} </p>
                                <p class="card-text"><small class="text-muted">Last updated: {{$user->updated_at->diffForHumans()}}</small></p>

                                <a href="{{route('EditUser', $user->id)}}" class="btn btn-primary">Edit</a>
                                @if(count($users)>1)
                                <form method="POST" action="{{route('DeleteUser', $user->id)}}" style="float:right;">
                                    @csrf
                                    @method('DELETE')
                                    <input type="hidden" name="id" value="{{Crypt::encrypt($user->id)}}" >
                                    <input type="submit" value="Delete" class="btn btn-danger" onclick="return confirm('Are you sure you want to Delete this User, (ID: {{$user->id}}) ?')">
                                </form>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
@endsection