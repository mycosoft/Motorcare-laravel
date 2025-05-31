@extends('layouts.admin')

@section('title', 'Create Gallery Category')

@section('main')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Create Gallery Category</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.gallery-categories.store') }}" method="POST">
                        @csrf
                        @include('admin.gallery-categories._form')
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save mr-1"></i> Create
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