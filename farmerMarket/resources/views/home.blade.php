@extends('layouts.app')
@section('title', 'Home')
@section('content')
<div class="container">
    <div class="row">
                    You are logged in!
    </div>
    <div class="row">
                <a href="/advertisement/new"><button class="btn btn-success">New advertisement</button></a>
    </div>
</div>
@endsection
