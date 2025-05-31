@extends('layouts.admin')

@section('title', 'Contact Message Details')

@section('main')
    <div class="row">
        <div class="col-6">
            <h1 class="h3 mb-0">Contact Message Details</h1>
        </div>
        <div class="col-6">
            <div class="float-right">
                <a href="{{ route('admin.contacts.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left mr-1"></i>
                    Back to Messages
                </a>
                @permission('contacts.update')
                    <form action="{{ route('admin.contacts.toggle-read', $contact) }}" method="POST" style="display: inline;">
                        @csrf
                        @if($contact->is_read)
                            <button type="submit" class="btn btn-warning">
                                <i class="fas fa-eye-slash mr-1"></i>
                                Mark as Unread
                            </button>
                        @else
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-eye mr-1"></i>
                                Mark as Read
                            </button>
                        @endif
                    </form>
                @endpermission
                @permission('contacts.delete')
                    <button type="button" class="btn btn-danger delete-btn" data-destroy="{{ route('admin.contacts.destroy', $contact) }}">
                        <i class="fas fa-trash mr-1"></i>
                        Delete
                    </button>
                @endpermission
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-12 mt-2">
            @include('layouts.shared.alert')
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <!-- Message Content -->
            <div class="card mt-3">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-envelope mr-2"></i>
                        {{ $contact->subject }}
                    </h3>
                    <div class="card-tools">
                        @if($contact->is_read)
                            <span class="badge badge-success">Read</span>
                        @else
                            <span class="badge badge-warning">Unread</span>
                        @endif
                    </div>
                </div>
                <div class="card-body">
                    <div class="message-content">
                        <div class="mb-4 p-3 bg-light rounded">
                            <h5 class="mb-3">Message:</h5>
                            <p class="mb-0" style="white-space: pre-wrap; line-height: 1.6;">{{ $contact->message }}</p>
                        </div>
                        
                        @if($contact->phone)
                            <div class="row mb-3">
                                <div class="col-sm-3"><strong>Phone:</strong></div>
                                <div class="col-sm-9">
                                    <a href="tel:{{ $contact->phone }}" class="text-primary">
                                        <i class="fas fa-phone mr-1"></i>
                                        {{ $contact->phone }}
                                    </a>
                                </div>
                            </div>
                        @endif
                        
                        <div class="row mb-3">
                            <div class="col-sm-3"><strong>Email:</strong></div>
                            <div class="col-sm-9">
                                <a href="mailto:{{ $contact->email }}" class="text-primary">
                                    <i class="fas fa-envelope mr-1"></i>
                                    {{ $contact->email }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="card mt-3">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-reply mr-2"></i>
                        Quick Actions
                    </h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <a href="mailto:{{ $contact->email }}?subject=Re: {{ $contact->subject }}" 
                               class="btn btn-primary btn-block">
                                <i class="fas fa-reply mr-2"></i>
                                Reply via Email
                            </a>
                        </div>
                        @if($contact->phone)
                            <div class="col-md-4">
                                <a href="tel:{{ $contact->phone }}" class="btn btn-success btn-block">
                                    <i class="fas fa-phone mr-2"></i>
                                    Call Customer
                                </a>
                            </div>
                            <div class="col-md-4">
                                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $contact->phone) }}" 
                                   target="_blank" class="btn btn-info btn-block">
                                    <i class="fab fa-whatsapp mr-2"></i>
                                    WhatsApp
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <!-- Contact Information -->
            <div class="card mt-3">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-user mr-2"></i>
                        Contact Information
                    </h3>
                </div>
                <div class="card-body">
                    <div class="contact-info">
                        <div class="mb-3">
                            <strong>Name:</strong><br>
                            <span class="text-lg">{{ $contact->name }}</span>
                        </div>
                        
                        <div class="mb-3">
                            <strong>Email:</strong><br>
                            <a href="mailto:{{ $contact->email }}" class="text-primary">{{ $contact->email }}</a>
                        </div>
                        
                        @if($contact->phone)
                            <div class="mb-3">
                                <strong>Phone:</strong><br>
                                <a href="tel:{{ $contact->phone }}" class="text-primary">{{ $contact->phone }}</a>
                            </div>
                        @endif
                        
                        <div class="mb-3">
                            <strong>Inquiry Type:</strong><br>
                            @php
                                $types = [
                                    'general' => 'General Inquiry',
                                    'sales' => 'Vehicle Sales',
                                    'service' => 'Service & Maintenance',
                                    'parts' => 'Parts & Accessories'
                                ];
                                $typeClass = [
                                    'general' => 'info',
                                    'sales' => 'success',
                                    'service' => 'warning',
                                    'parts' => 'primary'
                                ];
                            @endphp
                            <span class="badge badge-{{ $typeClass[$contact->inquiry_type] ?? 'secondary' }}">
                                {{ $types[$contact->inquiry_type] ?? ucfirst($contact->inquiry_type) }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Message Details -->
            <div class="card mt-3">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-info-circle mr-2"></i>
                        Message Details
                    </h3>
                </div>
                <div class="card-body">
                    <div class="message-details">
                        <div class="mb-3">
                            <strong>Received:</strong><br>
                            <span title="{{ $contact->created_at->format('Y-m-d H:i:s') }}">
                                {{ $contact->created_at->format('M d, Y \a\t H:i') }}
                            </span>
                            <small class="text-muted d-block">
                                ({{ $contact->created_at->diffForHumans() }})
                            </small>
                        </div>
                        
                        @if($contact->is_read && $contact->read_at)
                            <div class="mb-3">
                                <strong>Read:</strong><br>
                                <span title="{{ $contact->read_at->format('Y-m-d H:i:s') }}">
                                    {{ $contact->read_at->format('M d, Y \a\t H:i') }}
                                </span>
                                <small class="text-muted d-block">
                                    ({{ $contact->read_at->diffForHumans() }})
                                </small>
                            </div>
                        @endif
                        
                        <div class="mb-3">
                            <strong>Status:</strong><br>
                            @if($contact->is_read)
                                <span class="badge badge-success">
                                    <i class="fas fa-check mr-1"></i>
                                    Read
                                </span>
                            @else
                                <span class="badge badge-warning">
                                    <i class="fas fa-exclamation mr-1"></i>
                                    Unread
                                </span>
                            @endif
                        </div>
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
                    <p>Are you sure you want to delete this contact message from <strong>{{ $contact->name }}</strong>?</p>
                    <p class="text-danger"><small>This action cannot be undone.</small></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <form id="deleteForm" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete Message</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(function() {
            // Delete button click handler
            $(document).on('click', '.delete-btn', function(e) {
                e.preventDefault();
                const url = $(this).data('destroy');
                $('#deleteForm').attr('action', url);
                $('#delete-modal').modal('show');
            });
        });
    </script>
@endpush
