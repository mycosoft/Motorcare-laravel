@extends('layouts.admin')

@section('title', 'Dashboard')

@push('styles')
<style>
    .content-wrapper {
        background-color: #f4f6f9 !important;
    }

    .content {
        background-color: #f4f6f9 !important;
    }

    .stat-card {
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }

    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
    }

    .stat-card .card-body {
        position: relative;
    }

    .stat-card .card-body::before {
        content: '';
        position: absolute;
        top: 0;
        right: 0;
        width: 100px;
        height: 100px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
        transform: translate(30px, -30px);
    }

    .card {
        background-color: #ffffff;
        border: none;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .alert {
        background-color: #ffffff;
        border: 1px solid #dee2e6;
    }

    body {
        background-color: #f4f6f9 !important;
    }
</style>
@endpush

@section('main')


    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Welcome Section -->
            <div class="row mb-4 mt-4">
                <div class="col-12">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="mb-0 font-weight-bold">Welcome Back, {{ auth()->user()->name }}</h4>
                        <small class="text-muted">Last updated: {{ now()->format('d M Y, H:i') }}</small>
                    </div>
                </div>
            </div>

            <!-- Unread Contacts Alert -->
            @if($stats['unread_contacts'] > 0)
                <div class="alert alert-warning alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5><i class="icon fas fa-exclamation-triangle"></i> Alert!</h5>
                    You have {{ $stats['unread_contacts'] }} unread contact{{ $stats['unread_contacts'] > 1 ? 's' : '' }} that need your attention.
                    <a href="{{ route('admin.contacts.index') }}" class="btn btn-sm btn-warning ml-2">
                        <i class="fas fa-eye mr-1"></i> View Now
                    </a>
                </div>
            @endif

            <!-- Statistics Cards -->
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6 col-12 mb-4">
                    <div class="card stat-card" style="background: linear-gradient(135deg, #007bff 0%, #0056b3 100%); border-radius: 15px; border: none; color: white; position: relative; overflow: hidden;">
                        <div class="card-body p-4">
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <div>
                                    <h2 class="mb-1 font-weight-bold">{{ number_format($stats['contacts']) }}</h2>
                                    <p class="mb-0" style="opacity: 0.9;">Total Contacts</p>
                                </div>
                                <div style="opacity: 0.3; font-size: 3rem;">
                                    <i class="fas fa-envelope"></i>
                                </div>
                            </div>
                            <a href="{{ route('admin.contacts.index') }}" class="text-white" style="text-decoration: none; opacity: 0.9;">
                                <small>View Details <i class="fas fa-arrow-right ml-1"></i></small>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 col-sm-6 col-12 mb-4">
                    <div class="card stat-card" style="background: linear-gradient(135deg, #28a745 0%, #1e7e34 100%); border-radius: 15px; border: none; color: white; position: relative; overflow: hidden;">
                        <div class="card-body p-4">
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <div>
                                    <h2 class="mb-1 font-weight-bold">{{ number_format($stats['galleries']) }}</h2>
                                    <p class="mb-0" style="opacity: 0.9;">Image Galleries</p>
                                </div>
                                <div style="opacity: 0.3; font-size: 3rem;">
                                    <i class="fas fa-images"></i>
                                </div>
                            </div>
                            <a href="{{ route('admin.galleries.index') }}" class="text-white" style="text-decoration: none; opacity: 0.9;">
                                <small>View Details <i class="fas fa-arrow-right ml-1"></i></small>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 col-sm-6 col-12 mb-4">
                    <div class="card stat-card" style="background: linear-gradient(135deg, #ffc107 0%, #e0a800 100%); border-radius: 15px; border: none; color: white; position: relative; overflow: hidden;">
                        <div class="card-body p-4">
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <div>
                                    <h2 class="mb-1 font-weight-bold">{{ number_format($stats['offices']) }}</h2>
                                    <p class="mb-0" style="opacity: 0.9;">Office Locations</p>
                                </div>
                                <div style="opacity: 0.3; font-size: 3rem;">
                                    <i class="fas fa-building"></i>
                                </div>
                            </div>
                            <a href="{{ route('admin.offices.index') }}" class="text-white" style="text-decoration: none; opacity: 0.9;">
                                <small>View Details <i class="fas fa-arrow-right ml-1"></i></small>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 col-sm-6 col-12 mb-4">
                    <div class="card stat-card" style="background: linear-gradient(135deg, #dc3545 0%, #bd2130 100%); border-radius: 15px; border: none; color: white; position: relative; overflow: hidden;">
                        <div class="card-body p-4">
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <div>
                                    <h2 class="mb-1 font-weight-bold">{{ number_format($stats['brands']) }}</h2>
                                    <p class="mb-0" style="opacity: 0.9;">Partner Brands</p>
                                </div>
                                <div style="opacity: 0.3; font-size: 3rem;">
                                    <i class="fas fa-tags"></i>
                                </div>
                            </div>
                            <a href="{{ route('admin.brands.index') }}" class="text-white" style="text-decoration: none; opacity: 0.9;">
                                <small>View Details <i class="fas fa-arrow-right ml-1"></i></small>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main row -->
            <div class="row">
                <!-- Left col -->
                <section class="col-lg-8 connectedSortable">
                    <!-- Recent Contacts -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-envelope mr-1"></i>
                                Recent Contact Inquiries
                            </h3>
                            <div class="card-tools">
                                @permission('contacts.read')
                                    <a href="{{ route('admin.contacts.index') }}" class="btn btn-primary btn-sm">
                                        <i class="fas fa-list mr-1"></i> View All
                                    </a>
                                @endpermission
                            </div>
                        </div>
                        <div class="card-body p-0">
                            @forelse($recentContacts as $contact)
                                <div class="d-flex align-items-center p-3 border-bottom">
                                    <div class="mr-3">
                                        <span class="badge badge-{{ $contact->is_read ? 'secondary' : 'danger' }} p-2">
                                            <i class="fas fa-envelope"></i>
                                        </span>
                                    </div>
                                    <div class="flex-grow-1">
                                        <h6 class="mb-1">{{ $contact->name }}</h6>
                                        <p class="mb-1 text-sm">{{ $contact->subject }}</p>
                                        <small class="text-muted">
                                            {{ $contact->inquiry_type }} • {{ $contact->created_at->diffForHumans() }}
                                            @if(!$contact->is_read)
                                                <span class="badge badge-danger ml-1">New</span>
                                            @endif
                                        </small>
                                    </div>
                                    <div>
                                        <a href="{{ route('admin.contacts.show', $contact) }}" class="btn btn-sm btn-outline-primary">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </div>
                                </div>
                            @empty
                                <div class="text-center py-4">
                                    <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                                    <p class="text-muted">No contact inquiries yet.</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </section>

                <!-- Right col -->
                <section class="col-lg-4 connectedSortable">
                    <!-- Quick Actions -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-bolt mr-1"></i>
                                Quick Actions
                            </h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                @permission('brands.create')
                                    <div class="col-6 mb-2">
                                        <a href="{{ route('admin.brands.create') }}" class="btn btn-success btn-block btn-sm">
                                            <i class="fas fa-plus mb-1"></i><br>
                                            <small>Add Brand</small>
                                        </a>
                                    </div>
                                @endpermission
                                @permission('teams.create')
                                    <div class="col-6 mb-2">
                                        <a href="{{ route('admin.teams.create') }}" class="btn btn-info btn-block btn-sm">
                                            <i class="fas fa-user-friends mb-1"></i><br>
                                            <small>Add Team</small>
                                        </a>
                                    </div>
                                @endpermission
                                @permission('galleries.create')
                                    <div class="col-6 mb-2">
                                        <a href="{{ route('admin.galleries.create') }}" class="btn btn-warning btn-block btn-sm">
                                            <i class="fas fa-images mb-1"></i><br>
                                            <small>Add Gallery</small>
                                        </a>
                                    </div>
                                @endpermission
                                @permission('offices.create')
                                    <div class="col-6 mb-2">
                                        <a href="{{ route('admin.offices.create') }}" class="btn btn-danger btn-block btn-sm">
                                            <i class="fas fa-building mb-1"></i><br>
                                            <small>Add Office</small>
                                        </a>
                                    </div>
                                @endpermission
                                @permission('roles.create')
                                    <div class="col-6 mb-2">
                                        <a href="{{ route('admin.roles.create') }}" class="btn btn-secondary btn-block btn-sm">
                                            <i class="fas fa-user-shield mb-1"></i><br>
                                            <small>Add Role</small>
                                        </a>
                                    </div>
                                @endpermission
                                @permission('contacts.read')
                                    <div class="col-6 mb-2">
                                        <a href="{{ route('admin.contacts.index') }}" class="btn btn-primary btn-block btn-sm">
                                            <i class="fas fa-envelope mb-1"></i><br>
                                            <small>View Contacts</small>
                                        </a>
                                    </div>
                                @endpermission
                            </div>
                        </div>
                    </div>
                </section>
            </div>

            <!-- Featured Galleries Section -->
            @if($featuredGalleries->count() > 0)
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">
                                    <i class="fas fa-star mr-1"></i>
                                    Featured Galleries
                                </h3>
                                <div class="card-tools">
                                    <a href="{{ route('admin.galleries.index') }}" class="btn btn-primary btn-sm">
                                        <i class="fas fa-images mr-1"></i> View All
                                    </a>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    @foreach($featuredGalleries as $gallery)
                                        <div class="col-lg-4 col-md-6 mb-3">
                                            <div class="card card-outline card-primary">
                                                <div class="card-body p-0">
                                                    <div style="height: 200px; overflow: hidden;">
                                                        @if($gallery->images->count() > 0)
                                                            <img src="{{ $gallery->images->first()->image_url }}"
                                                                 alt="{{ $gallery->title }}"
                                                                 class="img-fluid w-100 h-100"
                                                                 style="object-fit: cover;"
                                                                 onerror="this.src='{{ asset('img/default-gallery.jpg') }}'">
                                                        @else
                                                            <div class="d-flex align-items-center justify-content-center h-100 bg-light">
                                                                <i class="fas fa-image fa-3x text-muted"></i>
                                                            </div>
                                                        @endif
                                                    </div>
                                                    <div class="p-3">
                                                        <h6 class="mb-1">{{ $gallery->title }}</h6>
                                                        <small class="text-muted">{{ $gallery->category->name ?? 'Uncategorized' }}</small>
                                                        <div class="mt-2">
                                                            <span class="badge badge-warning">Featured</span>
                                                            <span class="badge badge-info">{{ $gallery->images->count() }} images</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </section>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        // Initialize tooltips
        $('[data-toggle="tooltip"]').tooltip();

        // Auto-refresh dashboard every 5 minutes
        setInterval(function() {
            location.reload();
        }, 300000);

        // Add notification for unread contacts
        @if($stats['unread_contacts'] > 0)
            // Show a subtle notification after 3 seconds
            setTimeout(function() {
                if (Notification.permission === 'granted') {
                    new Notification('Motorcare Admin', {
                        body: 'You have {{ $stats["unread_contacts"] }} unread contact{{ $stats["unread_contacts"] > 1 ? "s" : "" }}',
                        icon: '{{ asset("favicon.ico") }}'
                    });
                }
            }, 3000);
        @endif

        // Request notification permission
        if ('Notification' in window && Notification.permission === 'default') {
            Notification.requestPermission();
        }
    });
</script>
@endpush
