@extends('layouts.admin-app')
@section('title')
    User List Create | {{ config('app.name', 'Laravel') }}
@endsection

@section('content')

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>User List Create</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.user.list.index') }}">User List</a></li>
                        <li class="breadcrumb-item active">Create</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <form action="{{ route('admin.user.list.store') }}" method="POST" enctype="multipart/form-data" onsubmit="disableButton(event)">
                @csrf
                <div class="row">
                    <div class="col-md-6">
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
                                    <label>Role</label>
                                    <select class="form-control" name="role_id">
                                        <option value="">- Select -</option>
                                        @foreach($roles as $role)
                                            <option value="{{ $role->id }}" {{ old('role_id') == $role->id ? 'selected' : '' }}>{{ $role->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('role_id')
                                        <span class="invalid-feedback d-block">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" class="form-control" name="name" placeholder="Enter name" value="{{ old('name') }}">
                                    @error('name')
                                        <span class="invalid-feedback d-block">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" class="form-control" name="email" placeholder="Enter email" value="{{ old('email') }}">
                                    @error('email')
                                        <span class="invalid-feedback d-block">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card card-primary">
                            <div class="card-header"></div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" class="form-control" name="password" placeholder="Enter password">
                                    @error('password')
                                        <span class="invalid-feedback d-block">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Confirm Password</label>
                                    <input type="password" class="form-control" name="password_confirmation" placeholder="Confirm password">
                                    @error('password_confirmation')
                                        <span class="invalid-feedback d-block">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 a-center mb-3">
                        <a href="{{ route('admin.user.list.index') }}" class="btn btn-secondary btn-sm"><i class="fas fa-chevron-left mr-1"></i> Back</a>
                        <button type="submit" id="submit-button" class="btn btn-primary btn-sm"><i class="fas fa-save mr-1"></i> Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </section>

@endsection