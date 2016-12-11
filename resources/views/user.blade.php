@extends('template')

@section('container')
	
	<div class = "row"><center>
		<h3> {{$user->profile_name}} <h3>
		<h4>{{$user->name}}</h4>

		<p>{{$user->bio}}</p>

		<br>
		<h4>Posts</h4>
		</center>

		<?php 
			$posts = $user->posts;
			use Carbon\Carbon; 
		?>
		<div class = "col-md-4"></div>
		<div class = "col-md-8">
			<!-- i should figure out the best way to do this without duplicating code -->
			@foreach ($posts as $post)
				<div class = "post">
					<!-- down/up vote on left, post content on right -->
					<div class = "left" style = "display: inline-block; width: 3rem">
						<div class = "voting">
							<a href = "" onclick = "vote({{ $post->id }}, 1);">
								<img width = "70%" src = "{{{ asset('/img/upvote.png') }}}" />
							</a><br>
							<a href = "" onclick = "vote({{ $post->id }}, 0);">
								<img width = "70%" src = "{{{ asset('/img/downvote.png') }}}" />
							</a>
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