@extends('errors.illustrated-layout')

@section('code', '404')
@section('title', __('Page Not Found'))
@section('favicon', __('https://static-cdn.jtvnw.net/emoticons/v1/960463/1.0'))

@section('image')
    <div style="background-image: url('/svg/404.svg');" class="absolute pin bg-cover bg-no-repeat md:bg-left lg:bg-center">
    </div>
@endsection

@section('message', __('Sorry, the page you are looking for could not be found.'))

@section('detail')
    @if(strlen($exception->getMessage()) > 0))
    {{$exception->getMessage()}}
    @else
    {{ 'No details provided' }}
    @endif
@endsection