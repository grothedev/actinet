@extends('template')
@section('container')

<div class = "row">
	<h4>Give suggestions, ask questions, etc. I am always looking for feedback to improve this website.</h4>

	<form class="form-horizontal" role="form" method="POST" action="{{ url('/feedback') }}">
				{{ csrf_field() }}

				<div class="form-group{{ $errors->has('text') ? ' has-error' : '' }}">

	                <label for="text" class="col-md-2 control-label">Feedback</label>

	                <div class="col-md-8">

	                    <textarea id="text" class="form-control" name="text" value="{{ old('text') }}" required autofocus></textarea>

	                    @if ($errors->has('text'))
	                        <span class="help-block">
	                            <strong>{{ $errors->first('text') }}</strong>
	                        </span>
	                    @endif
	                </div>
	            </div>

	            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">

	                <label for="email" class="col-md-2 control-label">Email (optional)</label>

	                <div class="col-md-8">

	                    <input type = "text" id="email" class="form-control" name="email" value="{{ old('email') }}" autofocus />

	                    @if ($errors->has('email'))
	                        <span class="help-block">
	                            <strong>{{ $errors->first('email') }}</strong>
	                        </span>
	                    @endif
	                </div>
	            </div>

	            <div class="form-group">
	                <div class="col-md-8 col-md-offset-2">
	                    <button type="submit">
	                        Submit
	                    </button>
	                </div>
	            </div>

</div>

<div class = "row">
	<h4><a href = "https://github.com/grothedev/actinet">Source Code on GitHub</a></h4>
</div>

@endsection