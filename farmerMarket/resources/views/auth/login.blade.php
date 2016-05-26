@extends('layouts.app')
@section('title', 'Login')
@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">@yield('title')</div>
                <div class="panel-body">
                    @include('auth.partials.login_form')
                </div>
            </div>
        </div>
    </div>
</div>

@stop
