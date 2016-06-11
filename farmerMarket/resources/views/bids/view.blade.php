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
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($bids as $bid)
                <tr>
                    <td>{{ $bid['advertisement']->name }}</td>
                    <td>{{ $bid['advertisement']->description }}</td>
                    <td>{{ $bid['bid']->price_cents }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@else
    <h2>No bids found</h2>
@endif
@endsection