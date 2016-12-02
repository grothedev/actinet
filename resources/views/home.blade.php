@extends('template')

<?php use Carbon\Carbon; ?>

@section('container')
	@if (Auth::guest()) 
	    <div class="row">
	        <div class="col-md-10 col-md-offset-2">
	            <p>
	                Welcome to the discussion/activism network at ISU. This website will be used to facilitate organized discussion and planning. It is still in development and lacking some features. <a href = "/register">Create an account</a> to join the discussion. 
	            </p>
	          
	        </div>
	    </div>
	@endif

    <div class = "row">
    	<div class = "col-md-3">
    		{!! Form::open(['url' => '/', 'method' => 'get']); !!}

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
				<div class = "post">
					
					<!-- down/up vote on left, post content on right -->
					<div class = "left" style = "display: inline-block;">
						<div class = "voting">
							<a href = "" onclick = "vote({{ $post->id }}, 1);">up</a><br>
							<a href = "" onclick = "vote({{ $post->id }}, 0);">dn</a>
						</div>
					</div>
					<div class = "right" style="display: inline-block;">
						<a href = "{{ $post->id }}""><div class = "post-title">{{ $post->title }}</div></a>
						<div class = "post-stamp">
							<?php 
								$user = $post->user()->first();
								$time =  Carbon::parse($post->created_at->timezone('America/Chicago')); //TODO update this to be dynamic
								$timestamp = $time->diffForHumans();
								$timestamp .= ' ' . $time->format('h:i A');
							?>
							{{ $timestamp }} - <a href = "u/{{ $user->id }}">{{ $user->name }}</a>
						</div>
						<div class = "post-text">
							{{ $post->text }}
						</div>
						
						<div class = "post-extra">
							<div class = "post-tags">
								@foreach($post->tags as $tag)
									<div class = "tag">{{ $tag->tag }}</div>
								@endforeach
							</div>
							<div class = "post-files"></div>
							
						</div>
					</div>
				</div>
			@endforeach
    	</div>
    </div>
@endsection
