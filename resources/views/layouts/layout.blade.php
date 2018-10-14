@extends ('basic')

@section('favicon')
@yield('favicon')
@endsection
@section('title')
@yield('title')
@endsection

@section('CSS')
<style type="text/css">
    body{
        background: url({{ (empty($background->filename) ) ?  'https://kabie.namic.co/resources/image/background_image/default.png' : 'storage/backgrounds/'.$background->filename }}), linear-gradient(to bottom, rgba(30, 75, 115, 1), rgba(115, 115, 115, 0.5)) repeat;
        background-size: auto, contain;
    min-height: 1280px;
}
table 
{
    border: none;
    text-align: center;
    vertical-align: middle;
}
tr 
{
    border-collapse: collapse;
}
td 
{
    min-height: 40px;
    vertical-align: middle;
    display: block;
}
#Bottom_explnation_stuff
{
	text-align: center;
    font-size: 13px;
    display: block;
}
#Bottom_explnation_stuff img
{
    height:17px;
    width: 17px;
}
.container
{
	background: white;
	margin: auto;
    width: 52%;
}
@yield('sideCSS')
</style>
@yield('linkedCSS')
@endsection

@section('JS')
<script type="text/javascript"></script>
@yield('sideJS')
</script>
@yield('linkedJS')
@endsection

@section('body')
<div class="container">
	@yield('bodyContent')
	@include('footer')
</div>
@endsection