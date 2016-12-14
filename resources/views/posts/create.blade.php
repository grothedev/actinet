@extends('template')
@section('container')
	<div class = "row">
		@if (Auth::guest())
			<h3>You must be <a href = "login">logged in</a> to make a post.</h3>
		@else
			<form class="form-horizontal" role="form" method="POST" action="{{ url('/make-post') }}">
				{{ csrf_field() }}
				<h3>Make a post</h3>

				<div class="form-group{{ $errors->has('text') ? ' has-error' : '' }}">

	                <label for="text" class="col-md-2 control-label">Write something</label>

	                <div class="col-md-8">

	                    <textarea id="text" class="form-control" name="text" value="{{ old('text') }}" required autofocus></textarea>

	                    @if ($errors->has('text'))
	                        <span class="help-block">
	                            <strong>{{ $errors->first('text') }}</strong>
	                        </span>
	                    @endif
	                </div>
	            </div>
	            
	            <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">

	                <label for="tags" class="col-md-2 control-label">Add a title</label>

	                <div class="col-md-8">

	                    <input type = "text" id="title" class="form-control" name="title" value="{{ old('title') }}" required autofocus />

	                    @if ($errors->has('title'))
	                        <span class="help-block">
	                            <strong>{{ $errors->first('title') }}</strong>
	                        </span>
	                    @endif
	                </div>
	            </div>

	            <div class="form-group{{ $errors->has('tags') ? ' has-error' : '' }}">

	                <label for="tags" class="col-md-2 control-label">Add some tags (separate by spaces)</label>

	                <div class="col-md-8">

	                    <!--<input type = "text" id="tags" class="form-control" name="tags" value="{{ old('tags') }}" required autofocus /> -->

	                    {!! Form::select('tags[]', [], null, ['class' => 'form-control', 'multiple' => 'true', 'id' => 'tags']) !!}

	                    @if ($errors->has('tags'))
	                        <span class="help-block">
	                            <strong>{{ $errors->first('tags') }}</strong>
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


			</form>
		@endif
	</div>
@endsection

<body onload = "init({{ $tags->toJSON() }})" />
<script type = "text/javascript">
	function init(tags_json){
		//fancy dropdown UI
		$(document).ready( function(){

			//json to string, removing everything other than tag and id
			tags_json = JSON.stringify(tags_json, ['id', 'tag']); 
			
			//string to json, renaming key 'tag' to 'text' to work with the select element
			//also setting id to tag string so i don't have to  change post controller a lot
			tags_json = JSON.parse(tags_json, function(key, value){
				if (key === 'tag'){
					this.text = value;
					this.id = value;
				} else {
					return value;
				}
			});

			$('#tags').select2({
				placeholder: 'Choose some tags, or create new ones',
				tags: true,
				data: tags_json
			});


		});
		
	}
	
</script>