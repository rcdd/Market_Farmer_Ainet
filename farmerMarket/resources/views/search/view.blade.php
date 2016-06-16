@extends('layouts.app')

@section('content')

<div class="container">
        <div class="row col-md-12">
            @if($search != "")

            	@foreach ($search as $key=> $advertisement)
					<div>
						<a href="{{ URL::route('search.show', ['id' => $student->id]) }}">{{$student->name}}</a>
					</div>         
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
                Nothing found, try another keyword!!
           @endif
        </div>
</div>
@endsection
