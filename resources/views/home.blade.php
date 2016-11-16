@extends('template')



@section('container')
    <div class="row">
        <div class="col-md-10 col-md-offset-2">
            <p>
                Welcome to the discussion/activism network at ISU. This website will be used to facilitate organized discussion and planning. It is still in development and lacking some features. <a href = "/register">Create an account</a> to join the discussion. 
            </p>
          
        </div>
    </div>

    <div class = "row">
    	<div class = "col-md-3">
    		{!! Form::open(['url' => 'home', 'method' => 'get']); !!}

    			<h3>Search for Posts</h3>
    			<h5>By tag, user, and radius</h5>
				<div class="form-group">

	                <label for="radius" class="col-md-2 control-label">Radius</label>


	                    <input type = "text" value = "50" id="radius" class="form-control" name="radius" value="{{ old('radius') }}" autofocus />
	                    <select id = "radiusUnits">
	                    	<option value = "mi">Miles</option>
	                    	<option value = "km">Kilometers</option>
	                    </select>

	            </div>
				
				<div class = "form-group">
					<label for = "tags" class = "col-md-2 control-label">Tags </label>

					<input type = "text" id = "tags" class = "form-control" name = "tags" autofocus />
					
					<label>
						{!! Form::checkbox('all_tags'); !!}
						Check here to include all tags
					</label>

				</div>

				

				<div class = "form-group">
					<label for = "users" class = "col-md-2 control-label">Users</label>


					<input type = "text" id = "users" class = "form-control" name = "users" autofocus />


				</div>



				{!! Form::submit('Search for Posts') !!}
			{!! Form::close(); !!}
    	</div>
    	<div class = "col-md-9">
    		@foreach ($posts as $post)
				<div class = "row">
					<a href = "/{{$post->id}}" ><h4>{{ $post->title }}</h4></a>
					{{ $post->text }}


				</div>
			@endforeach
    	</div>
    </div>
@endsection
