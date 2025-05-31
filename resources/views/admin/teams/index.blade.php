@extends('layouts.admin')

@section('title', 'Team Members')

@section('main')
    <div class="row">
        <div class="col-6"></div>
        <div class="col-6">
            @permission('teams.create')
                <a href="{{ route('admin.teams.create') }}" class="mt-3 btn btn-primary float-right">
                    <i class="fas fa-plus mr-1"></i>
                    {{ __('New Team Member') }}
                </a>
            @endpermission
        </div>
    </div>
    <div class="row">
        <div class="col-12 mt-2">
            @include('layouts.shared.alert')
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card mt-3">
                <div class="card-header">
                    <h3 class="card-title">Team Members</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="datatables" data-route="{{ route('admin.teams.index') }}"
                            data-configs="{{ json_encode($tableConfigs) }}" class="table table-bordered table-sm">
                            <thead>
                                <tr>
                                    @for ($i = 0; $i < count($tableConfigs); $i++)
                                        <th>{{ $tableConfigs[$i]['name'] }}</th>
                                    @endfor
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal" tabindex="-1" id="delete-modal">
        <div class="modal-dialog">
            <div class="modal-content" id="delete-form">
                <div class="modal-header">
                    <h5 class="modal-title">Delete Confirmation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this team member?</p>
                </div>
                <div class="modal-footer">
                    <form action="" method="POST" id="deleteForm">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(function() {
            // Initialize DataTable
            const table = $('#datatables').DataTable({
                processing: true,
                serverSide: true,
                ajax: $('#datatables').data('route'),
                columns: JSON.parse($('#datatables').data('configs'))
            });

            // Delete button click handler
            $(document).on('click', '.delete-btn', function(e) {
                e.preventDefault();
                const url = $(this).data('destroy');
                $('#deleteForm').attr('action', url);
                $('#delete-modal').modal('show');
            });

            // Handle delete form submission
            $('#deleteForm').on('submit', function(e) {
                e.preventDefault();
                const form = $(this);
                
                $.ajax({
                    url: form.attr('action'),
                    type: 'POST',
                    data: form.serialize(),
                    success: function(response) {
                        $('#delete-modal').modal('hide');
                        table.ajax.reload();
                        toastr.success('Team member deleted successfully');
                    },
                    error: function(xhr) {
                        console.error(xhr);
                        toastr.error('An error occurred while deleting the team member');
                    }
                });
            });
        });
    </script>
@endpush
