@extends('template')

@section('container')
	
	<div class = "row">
		
		<h4><b>About {{$user->name}}:</b> <p style = "margin-left: 4rem; margin-top: .6rem;">{{$user->bio}}</p></h4>

		

	</div>
@endsection