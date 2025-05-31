@extends('layouts.admin')

@section('title', 'Contact Messages')

@section('main')
    <div class="row">
        <div class="col-6">
            <h1 class="h3 mb-0">Contact Messages</h1>
        </div>
        <div class="col-6">
            <!-- No create button for contacts as they come from frontend -->
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
                    <h3 class="card-title">
                        <i class="fas fa-envelope mr-2"></i>
                        Contact Messages
                    </h3>
                    <div class="card-tools">
                        <div class="btn-group">
                            <button type="button" class="btn btn-sm btn-outline-primary" onclick="filterByStatus('all')">
                                All
                            </button>
                            <button type="button" class="btn btn-sm btn-outline-warning" onclick="filterByStatus('unread')">
                                Unread
                            </button>
                            <button type="button" class="btn btn-sm btn-outline-success" onclick="filterByStatus('read')">
                                Read
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="datatables" data-route="{{ route('admin.contacts.index') }}"
                            data-configs="{{ json_encode($tableConfigs) }}" class="table table-bordered table-sm">
                            <thead>
                                <tr>
                                    @foreach ($tableConfigs as $config)
                                        <th>{{ $config['name'] }}</th>
                                    @endforeach
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Modal -->
    <div class="modal fade" id="delete-modal" tabindex="-1" role="dialog" aria-labelledby="delete-modal-label"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="delete-modal-label">Confirm Delete</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this contact message? This action cannot be undone.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <form id="deleteForm" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
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
                columns: JSON.parse($('#datatables').data('configs')),
                order: [[5, 'desc']], // Order by created_at desc
                pageLength: 25,
                responsive: true,
                language: {
                    processing: '<i class="fas fa-spinner fa-spin"></i> Loading...'
                }
            });

            // Delete button click handler
            $(document).on('click', '.delete-btn', function(e) {
                e.preventDefault();
                const url = $(this).data('destroy');
                $('#deleteForm').attr('action', url);
                $('#delete-modal').modal('show');
            });

            // Filter functions
            window.filterByStatus = function(status) {
                if (status === 'all') {
                    table.column(4).search('').draw(); // Clear status filter
                } else if (status === 'unread') {
                    table.column(4).search('Unread').draw();
                } else if (status === 'read') {
                    table.column(4).search('Read').draw();
                }
                
                // Update button states
                $('.btn-group .btn').removeClass('btn-primary btn-warning btn-success')
                    .addClass('btn-outline-primary btn-outline-warning btn-outline-success');
                
                if (status === 'all') {
                    $('button[onclick="filterByStatus(\'all\')"]').removeClass('btn-outline-primary').addClass('btn-primary');
                } else if (status === 'unread') {
                    $('button[onclick="filterByStatus(\'unread\')"]').removeClass('btn-outline-warning').addClass('btn-warning');
                } else if (status === 'read') {
                    $('button[onclick="filterByStatus(\'read\')"]').removeClass('btn-outline-success').addClass('btn-success');
                }
            };

            // Auto-refresh every 30 seconds for new messages
            setInterval(function() {
                table.ajax.reload(null, false);
            }, 30000);
        });
    </script>
@endpush
