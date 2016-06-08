@extends('layouts.app')

@section('content')
<div class="container">
        <div class="row">
                <a href="/advertisement/new"><button class="btn btn-success">New advertisement</button></a>
        </div>
        <br/>
        <div class="row col-md-12">
                @foreach ($advertisements as $advertisement)
                    <div class="row col-md-6">
                        <div class="col-sm-6">
                            <img src="{{ url('images/ads/' .$advertisement->id) }}" alt="Image Product" width="140" height="140" class="img-rounded"> </img> 
                        </div>

                        <div class="col-sm-6">

                            <p><label class="control-label" for="owner">Owner: </label> {{$advertisement->owner_id}} </p>


                            <p><label class="control-label" for="name">Name: </label> {{$advertisement->name}}</p>

                            <p><label class="control-label" for="price">Open Price: </label> {{$advertisement->price_cents}}€ </p>

                            <p><label class="control-label" for="price">Minimal Price: </label> {{$advertisement->price_cents}}€ </p>
                           
                            <a href="/advertisement/view/{{$advertisement->id}}"><button class="btn btn-success">View</button></a> 
                            <a href="/advertisement/bid/{{$advertisement->id}}"><button class="btn btn-primary">Bid</button></a> 
                            <a href="/advertisement/edit/{{$advertisement->id}}"><button class="btn btn-warning">Edit</button></a> 
                            <a href="/advertisement/destroy/{{$advertisement->id}}"><button class="btn btn-danger">Del</button></a> 

                        </div>
                    </div>
               @endforeach
        </div>
    </div>
@endsection
