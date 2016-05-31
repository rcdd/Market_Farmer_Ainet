@extends('layouts.app')

@section('content')
<div class="container">
        <div class="row">
            <div class="col-md-6">
                <a href="/advertisement/new"><button class="btn btn-success">New advertisement</button></a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <table class="table table-striped">
                    <thead>
                    <td>Owner</td>
                    <td>Name</td>
                    <td>Price</td>
                    <td></td>
                    </thead>
                    <tbody>
                    @foreach ($advertisements as $advertisement)
                        <tr>
                            <td>{{$advertisement->owner_id}}</td>
                            <td>{{$advertisement->name}}</td>
                            <td>{{$advertisement->price_cents}}€</td>
                            <td><a href="/advertisement/destroy/{{$advertisement->id}}"><button class="btn btn-danger">Del</button></a> </td>
                        </tr>
                   @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
