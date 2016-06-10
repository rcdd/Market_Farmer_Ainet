@extends('layouts.app')

@section('content')

<div class="container">
        <div class="row">
                <a href="/advertisement/new"><button class="btn btn-success">New advertisement</button></a>
        </div>
        <br/>
        <div class="row col-md-12">
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
