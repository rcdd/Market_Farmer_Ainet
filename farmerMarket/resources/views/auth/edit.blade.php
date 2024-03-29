@extends('layouts.app')
@section('title', 'Edit Profile')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
                <div class="panel-body">
            		<form class="form-horizontal" role="form" method="POST" action="{{ url('/users/update/'.$id) }}"  enctype="multipart/form-data">
                  		@include('auth.partials.form')
                  		<div class="form-group" >
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-success">
                                    <i class="fa fa-btn fa-check "></i>Update
                                </button>
                            </div>
                        </div>
                  	</form>
                </div>
        </div>
    </div>
</div>
@endsection
