@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Admin Dashboard</h1>
    <a href="{{ route('admin.manage.users') }}" class="btn btn-primary">Manage Users</a>
    <!-- Add more admin functionalities here -->
</div>
@endsection
