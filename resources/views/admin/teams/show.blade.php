@extends('admin.layouts.app')

@section('title', 'View Team Member')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Team Member Details</h3>
            <div class="card-tools">
                <a href="{{ route('admin.teams.edit', $team) }}" class="btn btn-primary btn-sm">
                    <i class="fas fa-edit"></i> Edit
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4 text-center">
                    <img src="{{ $team->image_url }}" alt="{{ $team->full_name }}" 
                         class="img-fluid rounded-circle mb-3" 
                         style="width: 200px; height: 200px; object-fit: cover;">
                </div>
                <div class="col-md-8">
                    <table class="table table-bordered">
                        <tr>
                            <th style="width: 150px;">Full Name</th>
                            <td>{{ $team->full_name }}</td>
                        </tr>
                        <tr>
                            <th>Position</th>
                            <td>{{ $team->position }}</td>
                        </tr>
                        <tr>
                            <th>Created At</th>
                            <td>{{ $team->created_at->format('M d, Y h:i A') }}</td>
                        </tr>
                        <tr>
                            <th>Updated At</th>
                            <td>{{ $team->updated_at->format('M d, Y h:i A') }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <a href="{{ route('admin.teams.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Back to List
            </a>
        </div>
    </div>
@endsection
