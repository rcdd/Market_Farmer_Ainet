@extends('layouts.app')

@section('content')

@if (count($bids))
<div class="table-responsive">
    <table class="table table-condensed table-striped ">
        <thead>
            <tr>
                <th>Advertisement</th>
                <th>Description</th>                
                <th>Bid placed</th>                
                <th>Bid Actual</th>             
                <th>Bid Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>

            @foreach($bids as $bid)
                <tr class=" @if($bid['bid']->status ==  2) danger @elseif($bid['bid']->status ==  3) success @endif" >
                    <td>{{ $bid['advertisement']->name }}</td>
                    <td>{{ $bid['advertisement']->description }}</td>
                    <td>{{ $bid['bid']->price_cents }}</td>
                    <td>{{ $bid['advertisement']->lastBid() }} </td>
                    <td>{{ $bid['bid']->bidStatusToString() }}</td>
                    <td>
                        @if($bid['bid']->status ==  1 && !$bid['advertisement']->blocked && $bid['advertisement']->available_until !='0000-00-00 00:00:00')
                            <button data-toggle="modal" data-target="#changeBid" data-idbid="{{ $bid['bid']->id }}" data-lastbid="{{ $bid['advertisement']->lastBid() }}" data-idads="{{ $bid['advertisement']->id }}" class="change btn btn-xs btn-warning">Change</button>
                            <a href="{{ url('/bids/delete/' . $bid['bid']->id) }}">
                                <button class="btn btn-xs btn-danger" onclick="return confirm('Are you sure in cancel this bid?');">Cancel</button>
                            </a>
                        @else
                        Not alowed
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@else
    <h2>No bids found</h2>
@endif
<script type="text/javascript">
    $("button.change").click(function(){
        console.log("teste");
        $id_ads = $(this).data('idads');
        console.log("id ads"+$id_ads);
        $("#id_ads").val($id_ads);

        $id_bid = $(this).data('idbid');
        console.log("id bid"+$id_bid);
        $("#id_bid").val($id_bid);

        $lastBid = $(this).data('lastbid');
        $("#last_bid").text($lastBid +" "); 

        console.log($lastBid);

    });
</script>
@endsection


<div id="changeBid" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Change a Bid</h4>
          </div>
          <div class="modal-body">  
            <div class="container">
                <div class="col-sm-5 col-md-6" align="left">
                
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/bids/change/') }}">
                       
                                     {{ csrf_field() }}
                           
                                <input type="hidden" name="id_ads" id="id_ads" value="" />
                                <input type="hidden" name="id_bid" id="id_bid" value="" />

                            <div class="form-group">
                                <p><label class="control-label col-md-4" for="lastBid" >Last Bid:  <span id="last_bid"></span>€ </label></p>
                            </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3" for="price_cents" >Value to bid: </label> 
                                        <div class="col-md-7">
                                            <input type="text" min="0" step="0.01" class="form-control" name="price_cents" id="price_cents" placeholder="Enter bid value">
                                        </div>
                                </div>

                                 <div class="form-group">
                                    <label class="control-label col-md-3" for="trade_prefs">Trade Prefs: </label> 
                                        <div class="col-md-7">
                                            <input type="text" name="trade_prefs" class="form-control" placeholder="Trade Prefs" id="trade_prefs  ">
                                        </div>
                                </div>
                                
                                <div class="form-group">
                                 <label class="control-label col-md-3" for="quantity">Quantity: </label>
                                    <div class="col-md-7">
                                        <input type="text" min="0" name="quantity" class="form-control" placeholder="Quantity" id="quantity">
                                    </div>
                                </div>
                                
                                 <div class="form-group">
                                    <label class="control-label col-md-3" for="trade_location">Trade Location: </label> 
                                     <div class="col-md-7">
                                        <input type="text" name="trade_location" class="form-control" placeholder="Location" id="trade_location">
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="control-label col-md-3" for="comment">Comments: </label> 
                                    <div class="col-md-7">
                                        <textarea name="comment" class="form-control" placeholder="Enter a Comment" id="comment"></textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-offset-2 col-sm-10">
                                        <button type="submit" class="btn btn-success">
                                            <i class="fa fa-gavel"></i>Change a Bid
                                        </button>
                                    </div>
                                </div>

                    </form>

                </div>
            </div>
           </div>
        </div>
    </div>
</div>