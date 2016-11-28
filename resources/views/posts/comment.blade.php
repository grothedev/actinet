	<script type="text/javascript">
		function expandComments(id){
			$("#commentBox-" + id).toggle(200);
		}

	</script>
	<div class = "commentClickBox" onclick = "expandComments({{ $comment->id }})">
		<div class = "commentText">
			{{ $comment->text }}
		</div>
		<div class = "commentStamp">
			{{ $comment->user()->get()[0]['name'] }}

			<?php
				use Carbon\Carbon;
				$time = Carbon::parse($comment->created_at->timezone('America/Chicago'));
				//$timestamp = $time->diffForHumans(); //this is off by 6 hours for some reason
				$timestamp = ' ' . $time->format('h:i A');
			?>

			{{ $timestamp }}
		</div>	
	</div>
	<div class = "commentBox" id = "commentBox-{{ $comment->id }}">
		<form class="form-horizontal" role="form" method="POST" action="{{ url('/make-comment/c' . $comment->id) }}">
			{{ csrf_field() }}
			<div class="form-group{{ $errors->has('text') ? ' has-error' : '' }}">
                <div class="col-md-6">

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
