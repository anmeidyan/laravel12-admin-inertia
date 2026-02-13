@extends('layouts.admin-app')
@section('title')
    User Role Create | {{ config('app.name', 'Laravel') }}
@endsection

@section('content')

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>User Role Create</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.user.role.index') }}">User Role</a></li>
                        <li class="breadcrumb-item active">Create</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <form action="{{ route('admin.user.role.store') }}" method="POST" enctype="multipart/form-data" onsubmit="disableButton(event)">
                @csrf
                <div class="row">
                    <div class="col-md-4">
                        <div class="card card-primary">
                            <div class="card-header"></div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Status</label>
                                    <select class="form-control" name="is_active">
                                        <option value="1" selected>Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Role name</label>
                                    <input type="text" class="form-control" name="name" placeholder="Enter role name" value="{{ old('name') }}">
                                    @error('name')
                                        <span class="invalid-feedback d-block">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="card card-primary">
                            <div class="card-header"></div>
                            <div class="card-body">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Menu</th>
                                            <th>Permission</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($menus as $menu)
                                            <tr>
                                                <td>{{ $menu->name }}</td>
                                                <td>
                                                    @forelse($menu->permissions as $permission)
                                                        <div class="icheck-primary d-inline mr-3">
                                                            <input type="checkbox" name="permission_ids[]" value="{{ $permission->id }}" id="permission_{{ $permission->id }}">
                                                            <label for="permission_{{ $permission->id }}">{{ $permission->name }}</label>
                                                        </div>
                                                    @empty
                                                        There is no permission.
                                                    @endforelse
                                                </td>
                                            </tr>
                                            @forelse($menu->children as $key => $child)
                                                <tr>
                                                    <td>-- {{ $child->name }}</td>
                                                    <td>
                                                        @forelse($child->permissions as $permission)
                                                            <div class="icheck-primary d-inline mr-3">
                                                                <input type="checkbox" name="permission_ids[]" value="{{ $permission->id }}" id="permission_{{ $permission->id }}">
                                                                <label for="permission_{{ $permission->id }}">{{ $permission->name }}</label>
                                                            </div>
                                                        @empty
                                                            There is no permission.
                                                        @endforelse
                                                    </td>
                                                </tr>
                                            @empty
                                            @endforelse
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 a-center mb-3">
                        <a href="{{ route('admin.user.role.index') }}" class="btn btn-secondary btn-sm"><i class="fas fa-chevron-left mr-1"></i> Back</a>
                        <button type="submit" id="submit-button" class="btn btn-primary btn-sm"><i class="fas fa-save mr-1"></i> Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </section>

@endsection