@extends('layouts.app')

@section('content')

<script>
    $(document).ready(function() {
        $("#order").change(function() {
             alert($('#order option:selected').val());
            $.ajax({
                type: 'POST',
                url: 'http://market.project/advertisement/index',
                data: {'dataString': $('#order option:selected').val()},
                cache: false,
                success: function(data)
                {
                    alert(data);
                }
            });
        });
    });

</script>

<div class="container">
        <div class="row col-md-12">
            <div class="col-md-2">
                <a href="/advertisement/new"><button class="btn btn-success">New advertisement</button></a>
            </div>
            <div class="col-md-2">
                <select name="order" id="order" class="form-control" onchange="(this.value)">
                    <option value="0">Filter By</option>
                    <option value="1" selected>Product Name (Asc)</option>
                    <option value="2">Product Name (Desc)</option>
                    <option value="3">Price (Asc)</option>
                    <option value="4">Price (Desc)</option>
                    <option value="5">Date Offering (Asc)</option>
                    <option value="6">Date Offering (Desc)</option>
                    <option value="7">Seller's Name (Asc)</option>
                    <option value="8">Seller's Name (Desc)</option>
                    <option value="9">Seller's Score (Asc)</option>
                    <option value="10">Seller's Score (Desc)</option>
                </select>

                

            </div>
            <div class="col-md-5">
                <div class="input-group" id="adv-search">
                    <input type="text" class="form-control" readonly placeholder="Search by" />
                    <div class="input-group-btn">
                        <div class="btn-group" role="group">
                            <div class="dropdown dropdown-lg">
                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><span class="caret"></span></button>
                                <div class="dropdown-menu dropdown-menu-right" role="menu">
                                    <form class="form-horizontal" role="form" action="/advertisement/index" enctype="multipart/form-data" method="POST">
                                      <div class="form-group">
                                        <label for="contain">Seller Name</label>
                                        <input class="form-control" type="text" />
                                      </div>
                                      <label for="filter">Scores</label> 
                                      <div class="form-group checkbox">
                                        <label>
                                            <input type="checkbox" name="score_group[]" value="1" /> 1 | 
                                        </label>
                                        <label>
                                            <input type="checkbox" name="score_group[]" value="2" /> 2 | 
                                        </label>
                                        <label>
                                            <input type="checkbox" name="score_group[]" value="3" /> 3 | 
                                        </label>
                                        <label>
                                            <input type="checkbox" name="score_group[]" value="4" /> 4 | 
                                        </label>
                                        <label>
                                            <input type="checkbox" name="score_group[]" value="5" /> 5 
                                        </label>
                                      </div>
                                      <div class="form-group">
                                        <label for="contain">Location</label>
                                        <input class="form-control" type="text" />
                                      </div>
                                      <div class="form-group">
                                        <label for="contain">Tags</label>
                                        <input class="form-control" type="text" />
                                      </div>
                                      <button type="submit" name="advertisementSearch" id="advertisementSearch" class="btn btn-primary"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="row col-md-12">
            <br/>
            @if($advertisements != "")
                @foreach ($advertisements as $advertisement)
                    <a href="/advertisement/view/{{$advertisement->id}}">
                    <div class="row col-md-6">
                        <div class="col-sm-6">
                            <img src="{{ url('images/ads/' .$advertisement->id) }}" alt="Image Product" width="240" height="140" class="img-rounded">
                        </div>

                        <div class="col-sm-6">

                            <p><label class="control-label" for="owner">Owner: </label> {{$advertisement->user->name}} </p>

                            <p><label class="control-label" for="name">Name: </label> {{$advertisement->name}}</p>

                            <p><label class="control-label" for="price">Open Price: </label> {{$advertisement->price_cents}}€ </p>

                            <p><label class="control-label" for="price">Minimal Price: </label> {{$advertisement->price_cents}}€ </p>
                        <hr width=100% align=left>
                        </div>

                    </div>
                    </a> 
               @endforeach
           @else
                No Ads!
           @endif
        </div>
</div>
@endsection
