@extends('layouts.app')

@section('content')
<div class="container">
        <div class="row col-md-12">
            <div class="row col-md-8">
                <div class="col-sm-6">
                    <img src="{{ url('images/ads/' .$ads->id) }}" alt="Image Product" width="140" height="140" class="img-rounded"> </img> 
                </div>
                <div class="col-sm-6">
                    <p><label class="control-label" for="owner">Owner: </label> {{$ads->owner_id}} </p>

                    <p><label class="control-label" for="name">Name: </label> {{$ads->name}}</p>

                    <p><label class="control-label" for="price">Open Price: </label> {{$ads->price_cents}}€ </p>

                    <p><label class="control-label" for="price">Minimal Price: </label> {{$ads->price_cents}}€ </p>
                   
                    <a href="/advertisement/bid/{{$ads->id}}"><button class="btn btn-primary">Bid</button></a> 
                    <a href="/advertisement/edit/{{$ads->id}}"><button class="btn btn-warning">Edit</button></a> 
                    <a href="/advertisement/destroy/{{$ads->id}}"><button class="btn btn-danger">Del</button></a> 

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
        </div>

            <div class="row col-md-12">
                    @if (count($comments) > 0)
                        @foreach($comments as $comment)
                        <div class="row">
                            <div class="col-md-2">
                                <label class="control-label" for="user">User: </label>
                                {{$comment->author}}
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
                                <button data-toggle="modal" data-target="#replayComment" class="btn btn-warning">
                                        <i class="fa fa-mail-reply"></i> Replay
                                </button>
                            </div>
                                <br /><hr>
                        </div>
                        @endforeach
                    @else
                        No comments.. Be the First :)
                    @endif

                
            </div>
</div>

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
            <form class="form-horizontal" role="form" method="POST" action="{{ url('/comment/reply') }}">
                @include('comments.comment_form')

            </div>
        </div>
    </div>
</div>
@endsection
