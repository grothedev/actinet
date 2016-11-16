<div class = "comment">
	<div class = "commentText">
		{{ $comment->text }}
	</div>
	<div class = "commentStamp">
		{{ $comment->created_at }}
		{{ $comment->user()->get() }}
	</div>

	<div class = "commentBox">
		<form class="form-horizontal" role="form" method="POST" action="{{ url('/make-comment/c' . $comment->id) }}">
			{{ csrf_field() }}
			<div class="form-group{{ $errors->has('text') ? ' has-error' : '' }}">

                <label for="text" class="col-md-2 control-label">Comment</label>

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

	<div class = "comments">
		@foreach($comment->comments as $comment)
			include('comment.php');
		@endforeach
	</div>
</div>