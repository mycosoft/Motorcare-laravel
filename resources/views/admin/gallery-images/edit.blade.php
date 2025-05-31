@extends('layouts.admin')

@section('title', 'Edit Image')

@section('main')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Edit Image</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.galleries.images.update', [$gallery->id, $image->id]) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label>Current Image</label>
                            <div class="mb-2">
                                <img src="{{ asset($image->image_path) }}" alt="{{ $image->alt_text }}"
                                    class="img-thumbnail" style="max-height: 200px;">
                            </div>
                            <label for="image">New Image (optional)</label>
                            <input type="file" class="form-control-file @error('image') is-invalid @enderror" id="image"
                                name="image">
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="alt_text">Alt Text</label>
                            <input type="text" class="form-control @error('alt_text') is-invalid @enderror" id="alt_text"
                                name="alt_text" value="{{ old('alt_text', $image->alt_text) }}">
                            @error('alt_text')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="is_featured" name="is_featured"
                                    value="1" {{ old('is_featured', $image->is_featured) ? 'checked' : '' }}>
                                <label class="custom-control-label" for="is_featured">Featured</label>
                            </div>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Update</button>
                            <a href="{{ route('admin.galleries.images.index', $gallery->id) }}"
                                class="btn btn-default">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection 