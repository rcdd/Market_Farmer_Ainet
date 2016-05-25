@extends('layouts.backend')

@section('title', 'Adicionar novo utilizador')

@section('content')
<div class="container">
    <div class="content">            
        
        <form action="/users/create" method="post" class="form-group">
             @include('partials.errors')
             @include('users.partials.add-edit')
            <div class="form-group">
                <label for="inputPassword">Password</label>
                <input
                    type="password" class="form-control"
                    name="password" id="inputPassword"
                    value=""/>
            </div>
            <div class="form-group">
                <label for="inputPasswordConfirmation">Password confirmation</label>
                <input
                    type="password" class="form-control"
                    name="password_confirmation" id="inputPasswordConfirmation"/>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary" name="ok">Add</button>
                <button type="submit" class="btn btn-default" name="cancel">Cancel</button>
            </div>
        </form>
    </div>
</div>
@endsection
