@extends('layouts.backend')

@section('title', 'Listagem de utilizadores')

@section('content')
<a class="btn btn-primary" href="/users/create">Add user</a>

<a class="btn btn-warning" href="logout.php">Logout</a></div>
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
        <tr>
            <td>{{ $user->email      }}</td>
            <td>{{ $user->name       }}</td>
            <td>{{ $user->created_at }}</td>
            <td>{{ $user->type       }}</td>
            <td>
                    <a class="btn btn-xs btn-primary" href="/users/edit/{{ $user->id }}">Edit</a> 
                
                <form action="users-delete.php" method="post" class="inline">
                    <input type="hidden" name="user_id" value="{{ $user->user_id }}">
                    <div class="form-group">
                        <button type="submit" class="btn btn-xs btn-danger" onclick="return confirm('Are you sure in delete this user?');">Delete</button>
                    </div>
                </form>
            </td>
        </tr>
    @endforeach
    </table>
@else
    <h2>No users found</h2>
@endif

@endsection