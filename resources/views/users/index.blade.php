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
                <th>Roles</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        @foreach ($user->roles as $role)
                            <span class="badge bg-primary">{{ $role->name }}</span>
                        @endforeach
                    </td>
                    <td>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editRolesModal{{ $user->id }}">
                            Edit Roles
                        </button>
                    </td>
                </tr>

                <!-- Edit Roles Modal -->
                <div class="modal fade" id="editRolesModal{{ $user->id }}" tabindex="-1" aria-labelledby="editRolesModalLabel{{ $user->id }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editRolesModalLabel{{ $user->id }}">Edit Roles for {{ $user->name }}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('users.update', $user) }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label for="roles">Roles</label>
                                        <select multiple class="form-control" id="roles" name="roles[]">
                                            @foreach ($roles as $role)
                                                <option value="{{ $role->name }}" {{ in_array($role->name, $user->roles->pluck('name')->toArray()) ? 'selected' : '' }}>
                                                    {{ $role->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-primary mt-3">Update Roles</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            @endforeach
        </tbody>
    </table>
</div>
@endsection
