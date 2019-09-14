@extends ('basic')

@section('favicon')
@yield('favicon')
@endsection
@section('title')
@yield('title')
@endsection
@section('CSS')
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
@yield('linkedCSS')
<style type="text/css">
    body{
        background: url({{ (empty($background->filename) ) ?  'https://kabie.namic.co/resources/image/background_image/default.png' : 'storage/backgrounds/'.$background->filename }}), linear-gradient(to bottom, rgba(30, 75, 115, 1), rgba(115, 115, 115, 0.5)) repeat;
        background-size: auto, contain;
        }
</style>
@yield('sideCSS')
@endsection

@section('JS')
    <script src="{{asset('js/app.js')}}"></script>
@yield('sideJS')
@yield('linkedJS')
@endsection

@section('body')
<div class="container" id="app">
	@yield('bodyContent')
	@include('footer')
</div>
@endsection
