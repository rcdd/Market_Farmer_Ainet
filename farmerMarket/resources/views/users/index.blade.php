@extends('layouts.app')

@section('title', 'Listagem de utilizadores')

@section('content')

@if (count($users))
    <table class="table table-striped">
    <thead>
        <tr>
            <th>Email</th>
            <th>Fullname</th>
            <th>Created At</th>
            <th>Type</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
    @foreach ($users as $user)
        @if(Auth::user()->id != $user->id)
            <tr>
                <td>{{ $user->email      }}</td>
                <td>{{ $user->name       }}</td>
                <td>{{ $user->created_at }}</td>
                <td>{{ $user->admin ? "Admin" : "Regular"       }}</td>
                <td>                    
                    @if($user->admin)
                        <a class="btn btn-xs btn-warning" href="{{ url('/users/revokeAdmin/' . $user->id) }}">Revoke Admin</a> 
                    @else
                        <a class="btn btn-xs btn-warning" href="{{ url('/users/becomeAdmin/' . $user->id) }}">Become Admin</a> 
                    @endif
                        @if($user->blocked)
                            <a class="btn btn-xs btn-warning" href="{{ url('/users/unblocked/' . $user->id) }}">Unblock</a> 
                        @else
                           <a class="btn btn-xs btn-warning" href="{{ url('/users/blocked/' . $user->id) }}">Block</a> 
                        @endif
                    <a href="{{ url('/users/delete/' . $user->id) }}">
                        <button class="btn btn-xs btn-danger" onclick="return confirm('Are you sure in delete this user?');">Delete</button>
                    </a>
                </td>
            </tr>
        @endif
    @endforeach
    </table>
@else
    <h2>No users found</h2>
@endif

@endsection