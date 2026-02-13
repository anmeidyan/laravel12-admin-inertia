@extends('layouts.admin-app')
@section('title')
    Slideshow Edit | {{ config('app.name', 'Laravel') }}
@endsection

@section('content')

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Slideshow Edit</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.slideshow.index') }}">Slideshow</a></li>
                        <li class="breadcrumb-item active">Edit</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <form action="{{ route('admin.slideshow.update', $slideshow->id) }}" method="POST" enctype="multipart/form-data" onsubmit="disableButton(event)">
                @method('PUT')
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="card card-primary">
                            <div class="card-header"></div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Status</label>
                                    <select class="form-control" name="is_active">
                                        <option value="1" {{ $slideshow->is_active == 1 ? 'selected' : '' }}>Active</option>
                                        <option value="0" {{ $slideshow->is_active == 0 ? 'selected' : '' }}>Inactive</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Title</label>
                                    <input type="text" class="form-control" name="title" placeholder="Enter slideshow title" value="{{ old('title', $slideshow->title) }}">
                                    @error('title')
                                        <span class="invalid-feedback d-block">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea class="form-control" name="description" placeholder="Enter slideshow description">{{ old('description', $slideshow->description) }}</textarea>
                                    @error('description')
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
                                    <label class="d-block">Image</label>
                                    <a 
                                        href="javascript:;"
                                        data-src="{{ route('unisharp.lfm.show') }}?type=image"
                                        data-input="image_1"
                                        data-preview="preview_image_1" 
                                        class="btn btn-info lfm-image">
                                        <i class="fas fa-image"></i>
                                    </a>
                                    <input type="hidden" id="image_1" class="form-control" name="image_path" value="{{ config('app.url').$slideshow->image_path }}">
                                    <div id="preview_image_1" class="preview-image">
                                        @if($slideshow->image_path)
                                            <img src="{{ config('app.url').$slideshow->image_path }}" alt="Preview">
                                        @endif
                                    </div>
                                    @error('image_path')
                                        <span class="invalid-feedback d-block">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 a-center mb-3">
                        <a href="{{ route('admin.slideshow.index') }}" class="btn btn-secondary btn-sm"><i class="fas fa-chevron-left mr-1"></i> Back</a>
                        <button type="submit" id="submit-button" class="btn btn-primary btn-sm"><i class="fas fa-save mr-1"></i> Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </section>

@endsection