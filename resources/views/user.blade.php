@extends('template')

@section('container')
	
	<div class = "row">
		
		<h2>{{$user->name}}</h2>
		<h4>{{$user->bio}}</h4>

	</div>
@endsection