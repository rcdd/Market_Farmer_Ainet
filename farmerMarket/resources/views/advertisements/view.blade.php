@extends('layouts.app')

@section('content')
@if ($ads->blocked)
    <div class="alert alert-danger">This advertisement is blocked!</div>
@endif
@if ($ads->available_until == '0000-00-00 00:00:00')
    <div class="alert alert-danger">This advertisement is closed or out-of-date!</div>
@endif
<div class="container">


        <div class="row col-md-12">
            <div class="row col-md-8">
                <div class="col-sm-6">
                    <img src="{{ url('images/ads/' .$ads->id) }}" alt="Image Product" width="300" height="200" class="img"> </img> 
                </div>
                <div class="col-sm-6">
                    <p><label class="control-label" for="owner">Owner: </label> {{ $ads->user->name }} </p>

                    <p><label class="control-label" for="name">Name: </label> {{$ads->name}}</p>

                    <p><label class="control-label" for="name">Description: </label> {{$ads->description}}</p>

                    <p><label class="control-label" for="name">Quantity: </label> {{$ads->quantity}}</p>

                    <p><label class="control-label" for="name">Trade Prefs: </label> {{$ads->trade_prefs}}</p>

                    <p><label class="control-label" for="price">Open Price: </label> {{$ads->price_cents}}€ </p>

                    <p><label class="control-label" for="price">Last Price: </label> 
                    {{ $ads->lastBid() ? $ads->lastBid() : $ads->price_cents }}
                    € 
                    </p>
                    @if($ads->available_until)
                    <p><label class="control-label" for="name">Available Until: </label> {{$ads->available_until}}</p>
                    @endif
                    @if(!$ads->blocked && $ads->available_until != '0000-00-00 00:00:00')
                    <button  data-toggle="modal" data-target="#newBid" data-id="{{$ads->id}}" data-price="{{$ads->price_cents}}" class="bid btn btn-info">Bid</button></a>
                    @endif

                    @if(Auth::user()->id == $ads->user->id)
                    <a href="/advertisement/edit/{{$ads->id}}"><button class="btn btn-primary">Edit</button></a> 
                    <a href="/advertisement/view/{{$ads->id}}/viewBids"><button class="btn btn-success">View Bids</button></a> 
                    @endif

                    @if(Auth::user()->admin)
                            @if($ads->blocked)
                                    <a href="/advertisement/status/{{$ads->id}}"><button class="btn btn-warning">UnBlock</button></a>
                            @else
                                    <a href="/advertisement/status/{{$ads->id}}" onclick="return confirm('Are you sure?')"><button class="btn btn-warning">Block</button></a>
                            @endif 
                    @endif
                    
                    @if(Auth::user()->id == $ads->user->id || Auth::user()->admin)
                    <a href="/advertisement/destroy/{{$ads->id}}" onclick="return confirm('Are you sure?')"><button class="btn btn-danger">Del</button></a> 
                    @endif
                    

                </div>
            </div>
        </div>

            @if ($errors->has('comment'))
                <br />
                <span class="help-block">
                    <strong>{{ $errors->first('comment') }}</strong>
                </span>
            @endif
        <div class="row col-md-12">
            <div class="row col-md-8">
                <h2>Comments</h2><hr>
            </div><br>
            <div class="row col-md-4">
                <button data-toggle="modal" data-target="#newComment" class="btn btn-info">
                        <i class="fa fa-commenting"></i> New comment
                </button>
            </div>
            <div class="row col-md-12">
                @include('comments.comments_view')
            </div>
        </div>


</div>
<script type="text/javascript">
    $("button.replay").click(function(){
        $id = $(this).data('id');
        $("#parent_id").val($id);
    });
</script>

@endsection


<div id="newComment" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">   
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">New Comment</h4>
          </div>
            <div class="modal-body">
            <form class="form-horizontal" role="form" method="POST" action="{{ url('/comment/new') }}">
                @include('comments.comment_form')

            </div>
        </div>
    </div>
</div>

<div id="replayComment" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Replay Comment</h4>
          </div>
            <div class="modal-body">
            <form class="form-horizontal" role="form" method="POST" action="{{ url('/comment/new') }}">
            <input type="hidden" class="form-control" id="parent_id" name="parent_id" value="" />
                @include('comments.comment_form')

            </div>
        </div>
    </div>
</div>

<div id="newBid" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Place a Bid</h4>
          </div>
          <div class="modal-body">  
            <div class="container">

                <div class="col-sm-5 col-md-6" align="left">

                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/advertisement/view/' . $ads->id . '/bid') }}">
                     {{ csrf_field() }}

                        <div class="form-group">
                            <p><label class="control-label col-md-3" for="lastBid">Last Bid:  {{
                            $ads->lastBid() ? $ads->lastBid() : $ads->price_cents}}€ </label> </p>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3" for="price_cents">Value to bid: </label> 
                                <div class="col-md-7">
                                    <input type="text" name="price_cents" id="price_cents" class="form-control" placeholder="Enter a value">
                            </div>        
                        </div> 

                        <div class="form-group">
                            <label class="control-label col-md-3" for="trade_prefs">Trade Prefs: </label> 
                                <div class="col-md-7">
                                     <input type="text" name="trade_prefs" id="trade_prefs" class="form-control" placeholder="Trade Prefs">
                             </div>        
                        </div> 

                        <div class="form-group">
                            <label class="control-label col-md-3" for="quantity">Quantity: </label> 
                                <div class="col-md-7">
                                    <input type="text" name="quantity" id="quantity" class="form-control" placeholder="Quantity">
                                </div>        
                        </div> 

                        <div class="form-group">
                            <label class="control-label col-md-3" for="trade_location">Trade Location: </label> 
                                <div class="col-md-7">
                                    <input type="text" name="trade_location" id="trade_location" class="form-control" placeholder="Location">
                                </div>        
                        </div> 

                        <div class="form-group">
                            <label class="control-label col-md-3" for="comment">Comments: </label> 
                                <div class="col-md-7">
                                    <textarea name="comment" id="comment" class="form-control" placeholder="Enter a comment"></textarea>
                                </div>        
                        </div> 


                    <br/><br/>
                    <button type="submit" class="btn btn-success">
                        <i class="fa fa-gavel"></i>Place a Bid
                    </button>
                    </form>

                </div>
            </div>
        </div>
    </div>
    </div>
</div>