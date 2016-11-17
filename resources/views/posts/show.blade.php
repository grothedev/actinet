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
					$timestamp = $time->diffForHumans();
					$timestamp .= ' ' . $time->format('h:i A');
				?>

				{{ $timestamp }}
				
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
				@foreach($comments as $comment)

					@if($comment->depth == null) 
						<script charset="UTF-8" type = "text/javascript">

							renderCommentTree('{{ $comment->getDescendantsAndSelf()->toHierarchy()->toJson() }}');

						</script>
					@endif
				@endforeach
			</div>
		</div>
		

			

			<form class="form-horizontal" role="form" method="POST" action="{{ url('/make-comment/p' . $post->id) }}">
				{{ csrf_field() }}

				<h4>Add to the discussion</h4>

				<div class="form-group{{ $errors->has('text') ? ' has-error' : '' }}">

	                <label for="text" class="col-md-2 control-label">Add to the discusssion</label>

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