@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Manage Users</h1>
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>
                    <form action="{{ route('admin.update.user', $user) }}" method="POST">
                        @csrf
                        <select name="role" class="form-select" onchange="this.form.submit()">
                            <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                            <option value="client" {{ $user->role === 'client' ? 'selected' : '' }}>Client</option>
                            <option value="agent" {{ $user->role === 'agent' ? 'selected' : '' }}>Agent</option>
                            <option value="user" {{ $user->role === 'user' ? 'selected' : '' }}>User</option>
                        </select>
                    </form>
                </td>
                <td>
                    <!-- Add other actions if needed -->
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
