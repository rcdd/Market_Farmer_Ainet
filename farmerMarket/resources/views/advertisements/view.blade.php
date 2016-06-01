@extends('layouts.app')

@section('content')
<div class="container">
        <div class="row">
                <a href="/advertisement/new"><button class="btn btn-success">New advertisement</button></a>
        </div>
        <br/>
        <div class="row col-md-12">
                @foreach ($advertisements as $advertisement)
                    <div class="row col-md-4">
                        <div class="col-sm-6">
                            <img src="/assets/images/market2.jpg" alt="..." width="140" height="140" class="img-rounded">
                        </div>

                        <div class="col-sm-6">

                            <label class="control-label" for="owner">Owner:</label>{{$advertisement->owner_id}}

                            <br/>

                            <label class="control-label" for="name">Name:</label>
                            {{$advertisement->name}}

                            <br/>

                            <label class="control-label" for="price">Price:</label>{{$advertisement->price_cents}}€

                            <br/>

                            <a href="/advertisement/destroy/{{$advertisement->id}}"><button class="btn btn-danger">Del</button></a> 
                            <a href="/advertisement/edit/{{$advertisement->id}}"><button class="btn btn-warning">Edit</button></a> 
                        </div>
                    </div>
               @endforeach
        </div>
    </div>
@endsection
