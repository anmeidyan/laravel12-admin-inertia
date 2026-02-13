@extends('layouts.admin-app')
@section('title')
    User List | {{ config('app.name', 'Laravel') }}
@endsection

@section('content')

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>User List</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">User List</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            @include('admin.components.alert')
            <div class="row">
                <div class="col-12">

                    <div class="card">
                        <div class="card-header">
                            @can('admin.user.list.create')
                                <a href="{{ route('admin.user.list.create') }}" class="btn btn-primary btn-sm"><i class="fas fa-plus mr-1"></i> Add User</a>
                            @endcan
                        </div>
                        <div class="card-body">
                            <table id="datatable-simple" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Status</th>
                                        <th>Role</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Created at</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($users as $user)
                                        <tr>
                                            <td>{{ $user->id }}</td>
                                            <td>{!! $user->is_active ? '<span class="badge bg-success">Active</span>' : '<span class="badge bg-danger">Inactive</span>' !!}</td>
                                            <td>{{ $user->role->name ?? 'N/A' }}</td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->created_at }}</td>
                                            <td>
                                                @can('admin.user.list.edit')
                                                    <a href="{{ route('admin.user.list.edit', $user->id) }}" class="btn btn-xs btn-info"><i class="fas fa-pencil-alt"></i></a>
                                                @endcan
                                                @can('admin.user.list.delete')
                                                    <form action="{{ route('admin.user.list.destroy', $user->id) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-xs btn-danger" onclick="return confirm('Are you sure?')"><i class="fas fa-trash"></i></button>
                                                    </form>
                                                @endcan
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center">Data not found.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection