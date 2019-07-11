@extends('errors.illustrated-layout')

@section('code', '500')
@section('title', __('Error'))
@section('favicon', __('https://static-cdn.jtvnw.net/emoticons/v1/960463/1.0'))

@section('image')
    <div style="background-image: url('{{asset('svg/500.svg')}}');" class="absolute pin bg-cover bg-no-repeat md:bg-left lg:bg-center">
    </div>
@endsection

@section('message', __('Whoops, something went wrong on our servers.'))

@section('detail')
    @if(isset($exception))
        @if(strlen($exception->getMessage()) > 0)
        {{$exception->getMessage()}}
        @else
            {{ 'No details provided' }}
        @endif
    @endif
    @if(isset($message))
        @if(strlen($message) > 0)
        {{$message}}
        @else
            {{ 'No details provided' }}
        @endif
    @endif
@endsection