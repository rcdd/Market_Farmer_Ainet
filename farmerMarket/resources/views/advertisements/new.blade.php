@extends('layouts.app')
@section('title', 'Home')
@section('content')

<div class="container">
        <div class="panel-body row col-md-10" >
            <form method="POST" action="/advertisement/save" class="form-horizontal" enctype="multipart/form-data" role="form">
                @include('advertisements.partials.form')
                
                <div class="form-group">
                    <label class="col-md-3 control-label" for="submit"></label>
                    <div class="col-md-9">
                        <button id="submit" name="submit" class="btn btn-primary">Insert</button>
                    </div>
                </div>
            </form>
        </div>
</div>

@endsection