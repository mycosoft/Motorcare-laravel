@extends('layouts.admin')

@section('title', 'Offices Management')

@section('main')
    <div class="row">
        <div class="col-6"></div>
        <div class="col-6">
            @permission('offices.create')
                <a href="{{ route('admin.offices.create') }}" class="mt-3 btn btn-primary float-right">
                    <i class="fas fa-plus mr-1"></i>
                    {{ __('New Office') }}
                </a>
            @endpermission
        </div>
    </div>
    <div class="row">
        <div class="col-12 mt-2">
            @include('layouts.shared.alert')
        </div>
    </div>
    {{ csrf_field() }}
    {{ method_field('DELETE') }}
    <div class="row">
        <div class="col-12">
            <div class="card mt-3">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-building mr-2"></i>
                        Offices Management
                    </h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="datatables" data-route="{{ route('admin.offices.index') }}"
                            data-configs="{{ json_encode($tableConfigs) }}" class="table table-bordered table-sm">
                            <thead>
                                <tr>
                                    <th>Office Name</th>
                                    <th>Type</th>
                                    <th>City</th>
                                    <th>Region</th>
                                    <th>Phone</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        function deleteRecord(id) {
            if (confirm('Are you sure you want to delete this office?')) {
                $.ajax({
                    url: '{{ route("admin.offices.index") }}/' + id,
                    type: 'DELETE',
                    data: {
                        _token: $('input[name="_token"]').val()
                    },
                    success: function(response) {
                        location.reload();
                    },
                    error: function(xhr) {
                        alert('Error deleting office. Please try again.');
                    }
                });
            }
        }
    </script>
@endpush
