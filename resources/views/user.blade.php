@extends('template')

@section('container')
	
	<div class = "row"><center>
		<h3> {{$user->profile_name}} <h3>
		<h4>{{$user->name}}</h4>

		<p>{{$user->bio}}</p>
	</center></div>
@endsection