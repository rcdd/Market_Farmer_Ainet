@extends('layouts.app')

@section('content')
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

                    <p><label class="control-label" for="price">Minimal Price: </label> {{$ads->price_cents}}€ </p>

                    <p><label class="control-label" for="name">Available Until: </label> {{$ads->available_until}}</p>
                   

                    <a href="/advertisement/bid/{{$ads->id}}"><button class="btn btn-primary">Bid</button></a>
                    @if(Auth::user()->id == $ads->user->id)
                    <a href="/advertisement/edit/{{$ads->id}}"><button class="btn btn-warning">Edit</button></a> 
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

<script type="text/javascript">
$('#replayComment').on('show', function(e) {
    alert("sdfsdf");
    //get data-id attribute of the clicked element
    var parent_id = $(e.relatedTarget).data('id');

    //populate the textbox
    $(e.currentTarget).find('input[name="parent_id"]').val(parent_id);
});
</script>
