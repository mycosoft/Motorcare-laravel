@extends('layouts.admin')

@section('title', 'Edit Role')

@push('styles')
<style>
    .permission-group {
        border: 1px solid #e3e6f0;
        border-radius: 8px;
        margin-bottom: 20px;
        background: #f8f9fc;
    }

    .permission-group-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 12px 20px;
        border-radius: 8px 8px 0 0;
        font-weight: 600;
        text-transform: capitalize;
    }

    .permission-items {
        padding: 20px;
    }

    .permission-checkbox {
        margin-bottom: 12px;
    }

    .permission-checkbox .form-check-input {
        transform: scale(1.2);
        margin-right: 10px;
    }

    .permission-checkbox .form-check-label {
        font-weight: 500;
        color: #5a5c69;
        cursor: pointer;
        padding-left: 5px;
    }

    .permission-checkbox .form-check-label:hover {
        color: #3a3b45;
    }

    .select-all-btn {
        background: #1cc88a;
        border: none;
        color: white;
        padding: 6px 12px;
        border-radius: 4px;
        font-size: 12px;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .select-all-btn:hover {
        background: #17a673;
        transform: translateY(-1px);
    }

    .deselect-all-btn {
        background: #e74a3b;
        border: none;
        color: white;
        padding: 6px 12px;
        border-radius: 4px;
        font-size: 12px;
        cursor: pointer;
        margin-left: 8px;
        transition: all 0.3s ease;
    }

    .deselect-all-btn:hover {
        background: #c0392b;
        transform: translateY(-1px);
    }

    .role-card {
        box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
        border: none;
        border-radius: 12px;
    }

    .role-card-header {
        background: linear-gradient(135deg, #4e73df 0%, #224abe 100%);
        color: white;
        border-radius: 12px 12px 0 0;
        padding: 20px;
    }

    .role-card-header h3 {
        margin: 0;
        font-weight: 600;
        font-size: 1.5rem;
    }

    .role-card-body {
        padding: 30px;
    }

    .form-group label {
        font-weight: 600;
        color: #5a5c69;
        margin-bottom: 8px;
    }

    .form-control {
        border-radius: 8px;
        border: 1px solid #d1d3e2;
        padding: 12px 15px;
        font-size: 14px;
    }

    .form-control:focus {
        border-color: #4e73df;
        box-shadow: 0 0 0 0.2rem rgba(78, 115, 223, 0.25);
    }

    .btn-primary {
        background: linear-gradient(135deg, #4e73df 0%, #224abe 100%);
        border: none;
        padding: 12px 30px;
        border-radius: 8px;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(78, 115, 223, 0.4);
    }

    .btn-secondary {
        background: #6c757d;
        border: none;
        padding: 12px 30px;
        border-radius: 8px;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .btn-secondary:hover {
        background: #5a6268;
        transform: translateY(-2px);
    }

    .permissions-summary {
        background: #e7f3ff;
        border: 1px solid #b8daff;
        border-radius: 8px;
        padding: 15px;
        margin-bottom: 20px;
    }

    .permissions-count {
        font-weight: 600;
        color: #004085;
    }
</style>
@endpush

@section('main')
    <div class="row justify-content-center">
        <div class="col-lg-10 col-md-12">
            <div class="card role-card mt-3">
                <div class="card-header role-card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3 class="card-title mb-0">
                            <i class="fas fa-user-shield mr-2"></i>
                            Edit Role: {{ $role->name }}
                        </h3>
                        <a href="{{ route('admin.roles.index') }}" class="btn btn-light btn-sm">
                            <i class="fas fa-arrow-left mr-1"></i> Back to Roles
                        </a>
                    </div>
                </div>
                <div class="card-body role-card-body">
                    <form action="{{ route('admin.roles.update', $role) }}" method="POST" id="roleForm">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-6">
                                @include('admin.roles._form')
                            </div>
                            <div class="col-md-6">
                                <div class="permissions-summary">
                                    <h6><i class="fas fa-info-circle mr-2"></i>Permissions Summary</h6>
                                    <p class="mb-1">Total Available: <span class="permissions-count">{{ $permissions->count() }}</span></p>
                                    <p class="mb-0">Currently Assigned: <span class="permissions-count" id="selectedCount">{{ count($rolePermissions) }}</span></p>
                                </div>
                            </div>
                        </div>

                        <hr class="my-4">

                        <div class="form-group">
                            <label class="mb-3">
                                <i class="fas fa-key mr-2"></i>{{ __('Role Permissions') }}
                            </label>

                            <div class="mb-3">
                                <button type="button" class="btn btn-success btn-sm" id="selectAllPermissions">
                                    <i class="fas fa-check-double mr-1"></i> Select All
                                </button>
                                <button type="button" class="btn btn-danger btn-sm ml-2" id="deselectAllPermissions">
                                    <i class="fas fa-times mr-1"></i> Deselect All
                                </button>
                            </div>

                            @php
                                $groupedPermissions = $permissions->groupBy(function($permission) {
                                    return explode('.', $permission->name)[0];
                                });
                            @endphp

                            @foreach($groupedPermissions as $group => $groupPermissions)
                                <div class="permission-group">
                                    <div class="permission-group-header">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <span>
                                                <i class="fas fa-folder mr-2"></i>
                                                {{ ucfirst($group) }} Permissions
                                            </span>
                                            <div>
                                                <button type="button" class="select-all-btn" onclick="selectGroupPermissions('{{ $group }}')">
                                                    Select All
                                                </button>
                                                <button type="button" class="deselect-all-btn" onclick="deselectGroupPermissions('{{ $group }}')">
                                                    Deselect All
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="permission-items">
                                        <div class="row">
                                            @foreach($groupPermissions as $permission)
                                                <div class="col-md-6 col-lg-4">
                                                    <div class="permission-checkbox">
                                                        <div class="form-check">
                                                            <input class="form-check-input permission-input"
                                                                   type="checkbox"
                                                                   name="permissions[]"
                                                                   value="{{ $permission->id }}"
                                                                   id="permission_{{ $permission->id }}"
                                                                   data-group="{{ $group }}"
                                                                   {{ in_array($permission->id, $rolePermissions) ? 'checked' : '' }}>
                                                            <label class="form-check-label" for="permission_{{ $permission->id }}">
                                                                {{ ucfirst(str_replace('.', ' ', $permission->name)) }}
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                            @error('permissions')
                                <div class="alert alert-danger mt-2">
                                    <i class="fas fa-exclamation-triangle mr-2"></i>{{ $message }}
                                </div>
                            @enderror
                        </div>

                        <hr class="my-4">

                        <div class="form-group text-center">
                            @permission('roles.update')
                                <button type="submit" class="btn btn-primary mr-3">
                                    <i class="fas fa-save mr-2"></i>{{ __('Update Role') }}
                                </button>
                            @endpermission
                            <a href="{{ route('admin.roles.index') }}" class="btn btn-secondary">
                                <i class="fas fa-times mr-2"></i>{{ __('Cancel') }}
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        // Update selected count when checkboxes change
        function updateSelectedCount() {
            const selectedCount = $('.permission-input:checked').length;
            $('#selectedCount').text(selectedCount);
        }

        // Select all permissions
        $('#selectAllPermissions').click(function() {
            $('.permission-input').prop('checked', true);
            updateSelectedCount();
        });

        // Deselect all permissions
        $('#deselectAllPermissions').click(function() {
            $('.permission-input').prop('checked', false);
            updateSelectedCount();
        });

        // Update count when individual checkboxes change
        $('.permission-input').change(function() {
            updateSelectedCount();
        });

        // Group selection functions
        window.selectGroupPermissions = function(group) {
            $(`input[data-group="${group}"]`).prop('checked', true);
            updateSelectedCount();
        };

        window.deselectGroupPermissions = function(group) {
            $(`input[data-group="${group}"]`).prop('checked', false);
            updateSelectedCount();
        };

        // Form validation
        $('#roleForm').submit(function(e) {
            const selectedPermissions = $('.permission-input:checked').length;
            if (selectedPermissions === 0) {
                e.preventDefault();
                Swal.fire({
                    icon: 'warning',
                    title: 'No Permissions Selected',
                    text: 'Please select at least one permission for this role.',
                    confirmButtonColor: '#4e73df'
                });
                return false;
            }
        });

        // Add smooth animations
        $('.permission-group').hide().fadeIn(500);

        // Stagger the animation for each group
        $('.permission-group').each(function(index) {
            $(this).delay(index * 100).fadeIn(300);
        });
    });
</script>
@endpush
