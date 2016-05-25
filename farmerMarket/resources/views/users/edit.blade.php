@extends('layouts.backend')

@section('title', 'Editar utilizadores')

@section('content')
        <div class="container">
            <div class="content">            
                
                <form action="users-edit.php" method="post" class="form-group">
                    <input type="hidden" name="user_id" value="{{ $id }}" />
                    <div class="form-group">
                        @include('users.partials.add-edit')
                        <button type="submit" class="btn btn-primary" name="ok">Save</button>
                        <button type="submit" class="btn btn-default" name="cancel">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
@endsection
