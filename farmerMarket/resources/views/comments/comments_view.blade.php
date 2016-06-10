@if (count($comments) > 0)
    @foreach($comments as $comment)
	    <div class="row col-md-12">
	    	<div class="row">
		        <div class="col-md-2">
		            <label class="control-label" for="user">User: </label>
		            {{$comment->user->name}}
		        </div>
		        <div class="col-md-4">
		            <label class="control-label" for="date">Date: </label>
		            {{$comment->created_at}}
		        </div>
		    </div>
	     <div class="row">
	        <div class="col-md-6">
	            <label class="control-label" for="user">Mensage: </label>
	            {{$comment->comment}}
	        </div>
	        <div class="col-md-2">
	            <button data-toggle="modal" data-target="#replayComment" data-id="{{$comment->id}}" class="replay btn btn-warning">
	                    <i class="fa fa-mail-reply"></i> Replay
	            </button>
	            @if(Auth::user()->admin)
	            <a href="{{url('/comment/delete/' . $comment->id) }}"><button class="replay btn btn-danger">
	                    <i class="fa fa-close"></i> Delete
	            </button></a>
	            @endif
	        </div>
	      </div>
	      <hr width=80% align=left>
	    </div>
	    @if(count($comment->hasReplay) > 0)
	        @foreach($comment->hasReplay as $com)
				<div class="row col-md-offset-1">
			    	<div class="row ">
				        <div class="col-md-2">
				            <label class="control-label" for="user">User: </label>
				            {{$com->user->name}}
				        </div>
				        <div class="col-md-4">
				            <label class="control-label" for="date">Date: </label>
				            {{$com->created_at}}
				        </div>
				    </div>
				     <div class="row">
				        <div class="col-md-6">
				            <label class="control-label" for="user">Mensage: </label>
				            {{$com->comment}}
				        </div>
				        @if(Auth::user()->admin)
				        <div class="col-md-2">
							<a href="{{url('/comment/delete/' . $com->id) }}"><button class="replay btn btn-danger">
	                    	<i class="fa fa-close"></i> Delete
	            			</button></a>
				        </div>
				        @endif
				    </div>
				     
				    <br />
			      	<hr width=80% align=left>
			    </div>
	        @endforeach
	    @endif
    @endforeach
@else
    No comments.. Be the First :)
@endif