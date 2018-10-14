@extends ('layout')

@section ('title')Katie quote {{$sample->id}}@endsection

@section('sideCSS')
.container{
	padding-left: 10px;
	padding-right: 10px;
}
@endsection

@section ('bodyContent')
<h1>Information to Sample ID: {{$sample->id}}</h1>
	<ul>
		<li>Sample-Name: {{$sample->name}}</li>
		<li>Sample-File: {{$sample->filename}}</li>
		<audio id="{{ $sample->id }}" controls>
        	<source src="https://kabie.namic.co/resources/audio/{{$sample->filename}}" type="audio/mp3" />
            	Your browser doesn't support the HTML5 Audio/Video element.
        </audio>
	</ul>
	<a>Report this Sample</a> 
@endsection