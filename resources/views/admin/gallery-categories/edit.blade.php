@extends('layouts.admin')

@section('title', 'Edit Gallery Category')

@section('main')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Edit Gallery Category</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.gallery-categories.update', $galleryCategory->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        @include('admin.gallery-categories._form')
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save mr-1"></i> Update
                            </button>
                            <a href="{{ route('admin.gallery-categories.index') }}" class="btn btn-default">
                                <i class="fas fa-arrow-left mr-1"></i> Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection 