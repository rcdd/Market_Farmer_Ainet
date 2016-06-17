@if (count($comments) > 0)
    @foreach($comments as $comment)
	    <!--<div class="row col-md-12">
	    	<div class="row">
		        <div class="col-md-2">
		            <label class="control-label" for="user">User: </label>
		            <img src="{{ url('/images/profile/'. Auth::user()->id ) }}" alt="Profile Picture" width="40" height="40">
		            {{$comment->user->name}}
		        </div>

		        <div class="col-md-4">
		            <label class="control-label" for="date">Date: </label>
		            {{$comment->created_at}}
		        </div>
		    </div>
	     <div class="row">
	        <div class="col-md-6">
	            <label class="control-label" for="user"></label>
	            {{$comment->comment}}
	        </div>-->
<table style="width:100%">
	        <tr>
	        	<td>
				  <div class="row col-md-12">
				    <div class="row">
				        <div class="col-sm-8">
				            <div class="panel panel-white post panel-shadow">
				                <div class="post-heading">
				                    <div class="pull-left image">
				                        <img src="{{ url('/images/profile/'. Auth::user()->id ) }}" class="img-circle avatar" alt="Profile Picture" width="70" height="70">
				                    </div>
				                    <div class="pull-left meta">
				                        <div class="title h5">
				                            <a href="#"><b>{{$comment->user->name}}</b></a>
				                            made a comment.
				                        </div>
				                        <h6 class="text-muted time">{{$comment->created_at}}</h6>
				                    </div>
				                </div> 
				              </div> 
				           </div>
			           </div>
			       </div>

				   <div class="post-description" > 
				   		<div>
				   			<p>{{$comment->comment}}</p>
				   		</div>
				        
				               
				   </div>
				        
        		</td>
        	     <td>
			        <div class="col-md-6">
			            <button data-toggle="modal" data-target="#replayComment" data-id="{{$comment->id}}" class="replay btn btn-primary">
			                    <i class="fa fa-mail-reply"></i>
			            </button>
			            @if(Auth::user()->admin)
			            	@if($comment->blocked)
					            <a href="{{url('/comment/unblock/' . $comment->id) }}"><button class="replay btn btn-warning" >
					                    <i class="fa fa-ban"></i> 
					            </button></a>
					        @else
					        	<a href="{{url('/comment/block/' . $comment->id) }}"><button class="replay btn btn-warning">
					                    <i class="fa fa-ban"></i> 
					            </button></a>
					        @endif

				            <a href="{{url('/comment/delete/' . $comment->id) }}"><button class="replay btn btn-danger">
				                    <i class="fa fa-close"></i> 
				            </button></a>
				            
			            @endif
			        </div>
			      </div>
	      	   </td>
	      </tr>
</table>
	      <hr width=80% align=left>
	    </div>
	    @if(count($comment->hasReplay) > 0)
	        @foreach($comment->hasReplay as $com)

				<div class="row col-md-offset-1">
			    	<div class="row ">
				        <div class="col-md-2">
				            <label class="control-label" for="user"> </label>
				            <a href="#"><b>{{$com->user->name}}</b></a>
				        </div>
				        <div class="col-md-4">
				            <label class="control-label" for="date"> </label>
				            <h6 class="text-muted time">{{$com->created_at}}</h6>
				        </div>
				    </div>
				     <div class="row">
				        <div class="col-md-6">
				            <label class="control-label" for="user"> </label>
				            {{$com->comment}}
				        </div>



				        @if(Auth::user()->admin)
					        
					        <div class="col-md-4">
					        @if($com->blocked)
					            <a href="{{url('/comment/unblock/' . $com->id) }}"><button class="replay btn btn-warning">
					                    <i class="fa fa-ban"></i> 
					            </button></a>
				        	@else
					        	<a href="{{url('/comment/block/' . $com->id) }}"><button class="replay btn btn-warning">
					                    <i class="fa fa-ban"></i> 
					            </button></a>
				        	@endif
								<a href="{{url('/comment/delete/' . $com->id) }}"><button class="replay btn btn-danger">
		                    	<i class="fa fa-close"></i> 
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