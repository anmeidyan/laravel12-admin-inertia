@extends('layouts.admin-app')
@section('title')
    Slideshow | {{ config('app.name', 'Laravel') }}
@endsection

@section('content')

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Slideshow</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Slideshow</li>
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
                            @can('admin.slideshow.create')
                                <a href="{{ route('admin.slideshow.create') }}" class="btn btn-primary btn-sm"><i class="fas fa-plus mr-1"></i> Add Slideshow</a>
                            @endcan
                        </div>
                        <div class="card-body">
                            <table id="datatable-simple" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Status</th>
                                        <th>Title</th>
                                        <th>Description</th>
                                        <th>Image</th>
                                        <th>Created at</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($slideshows as $slideshow)
                                        <tr>
                                            <td>{{ $slideshow->id }}</td>
                                            <td>{!! $slideshow->is_active ? '<span class="badge bg-success">Active</span>' : '<span class="badge bg-danger">Inactive</span>' !!}</td>
                                            <td>{{ $slideshow->title }}</td>
                                            <td>{{ $slideshow->description }}</td>
                                            <td>
                                                @if($slideshow->image_path)
                                                <a href="{{ config('app.url').$slideshow->image_path }}" target="_blank">
                                                    <img src="{{ config('app.url').$slideshow->image_path }}" alt="Image" class="img-fluid" width="100">
                                                </a>
                                                @endif
                                            </td>
                                            <td>{{ $slideshow->created_at }}</td>
                                            <td>
                                                @can('admin.slideshow.edit')
                                                    <a href="{{ route('admin.slideshow.edit', $slideshow->id) }}" class="btn btn-xs btn-info"><i class="fas fa-pencil-alt"></i></a>
                                                @endcan
                                                @can('admin.slideshow.delete')
                                                    <form action="{{ route('admin.slideshow.destroy', $slideshow->id) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-xs btn-danger" onclick="return confirm('Are you sure?')"><i class="fas fa-trash"></i></button>
                                                    </form>
                                                @endcan
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center">Data not found.</td>
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