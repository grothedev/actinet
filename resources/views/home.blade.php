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
    			<h5>By tags and users</h5>
    			<!-- hide radius input for now
				<div class="form-group">

	                <label for="radius" class="col-md-2 control-label">Radius</label>


	                    <input type = "text" value = "50" id="radius" class="form-control" name="radius" value="{{ old('radius') }}" autofocus />
	                    <select id = "radiusUnits">
	                    	<option value = "mi">Miles</option>
	                    	<option value = "km">Kilometers</option>
	                    </select>

	            </div>
				-->

				<div class = "form-group">
					<label for = "tags" class = "col-md-2 control-label">Tags </label>

					<!-- 
						drop down list of popular tags as well as better UI with select2 js -->
					{!! Form::select('tagIds[]', [], null, ['class' => 'form-control', 'multiple' => 'true', 'id' => 'tagIds']) !!}

					<label>
						{!! Form::checkbox('all_tags'); !!}
						Check here to include all tags
					</label>

				</div>

				

				<div class = "form-group">
					<label for = "users" class = "col-md-2 control-label">Users</label>

					{!! Form::select('userIds[]', [], null, ['class' => 'form-control', 'multiple' => 'true', 'id' => 'userIds']) !!}

					<!--
					<input type = "text" id = "users"  value = "Choose some users" class = "form-control" name = "users" autofocus />
					-->

				</div>



				{!! Form::submit('Search for Posts') !!}
			{!! Form::close(); !!}

			If you have ideas for how the user interface should work/look,<a href = "/feedback" > let it be known. </a>

    	</div>
    	<div class = "col-md-9">

    		@if ($posts !== null)


	    		@foreach ($posts as $post)
					<div class = "post">
						
						<!-- down/up vote on left, post content on right -->
						<div class = "left" style = "display: inline-block; width: 5%">
							<div class = "voting">
								<a href = "" onclick = "vote({{ $post->id }}, 1);">
									<img width = "70%" src = "{{{ asset('/img/upvote.png') }}}" />
								</a><br>
								<a href = "" onclick = "vote({{ $post->id }}, 0);">
									<img width = "70%" src = "{{{ asset('/img/downvote.png') }}}" />
								</a>
							</div>
						</div>
						<div class = "right" style="display: inline-block; width: 95%; float: right">
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
			@endif
    	</div>
    </div>
@endsection
<body onload = "init({{ $tags->toJSON() }}, {{ $users->toJSON() }})" />
<script type = "text/javascript">
	function init(tags_json, users_json){
		//fancy dropdown UI
		$(document).ready( function(){

			//json to string, removing everything other than tag and id
			tags_json = JSON.stringify(tags_json, ['id', 'tag']); 
			users_json = JSON.stringify(users_json, ['id', 'name']);

			//string to json, renaming key 'tag' to 'text' to work with the select element
			tags_json = JSON.parse(tags_json, function(key, value){
				if (key === 'tag'){
					this.text = value;
				} else {
					return value;
				}
			});

			users_json = JSON.parse(users_json, function(key, value){
				if (key === 'name'){
					this.text = value;
				} else {
					return value;
				}
			});

			$('#tagIds').select2({
				placeholder: 'Choose some tags',
				//tags: true
				data: tags_json
			});

			$('#userIds').select2({
				placeholder: 'Choose some users',
				data: users_json
			});

		});
		
	}
	
</script>