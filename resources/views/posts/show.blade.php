@extends('template')

<script charset="UTF-8" type = "text/javascript" src = "{{{ asset('/js/commentRenderer.js') }}}" ></script>

@section('container')
	<div class = "row">
		<div class = "post">
			<h3>{{ $post->title }}</h3>
			<div class = "post-text">
				{{ $post->text }}
			</div>
			<div class = "post-stamp">
				<?php
					use Carbon\Carbon;
					$time = Carbon::parse($post->created_at->timezone('America/Chicago'));
					//$timestamp = $time->diffForHumans();
					$timestamp = ' ' . $time->format('h:i A');
				?>

				{{ $timestamp }} - {{ $post->user['name'] }}
				
			</div>

			<div class = "post-extra">
				<div class = "post-tags">
					@foreach($post->tags as $tag)
						{{ $tag }}
					@endforeach
				</div>
				<div class = "post-files"></div>
				
			</div>

			<div class = "comments">
						<?php

							$traverse = function ($categories, $prefix = '-') use (&$traverse) {
							    foreach ($categories as $category) {
							        echo PHP_EOL. '<div class = "comment">' . outputComment($category);

								        echo '<div class = "comments">';
								        	$traverse($category->children, $prefix.'-');
								        echo '</div>';	
								    echo '</div>';

							    }
							};

							$traverse($comments);

							function outputComment($c){
								$comment = $c;
								return view('posts.comment', compact('comment'));
							}

						?>
						<script charset="UTF-8" type = "text/javascript">
							window.scrollTo(0, 0);
						</script>

			</div>
		</div>
		

			

			<form class="form-horizontal" role="form" method="POST" action="{{ url('/make-comment/p' . $post->id) }}">
				{{ csrf_field() }}

				<h4>Add to the discussion</h4>

				<div class="form-group{{ $errors->has('text') ? ' has-error' : '' }}">

	                <label for="text" class="col-md-2 control-label">Make a Comment</label>

	                <div class="col-md-8">

	                    <textarea id="text" class="form-control" name="text" value="{{ old('text') }}" required autofocus></textarea>

	                    @if ($errors->has('text'))
	                        <span class="help-block">
	                            <strong>{{ $errors->first('text') }}</strong>
	                        </span>
	                    @endif
	                </div>
	            </div>
	            
	            <div class="form-group">
	                <div class="col-md-8 col-md-offset-2">
	                    <button type="submit">
	                        Add Comment
	                    </button>
	                </div>
	            </div>

			</form>

	</div>
@endsection