@extends('layouts.admin')

@section('title', 'Gallery Images')

@section('main')
    <div class="row mb-3">
        <div class="col-12">
            <a href="{{ route('admin.galleries.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left mr-1"></i> Back to Galleries
            </a>
        </div>
    </div>
    <div class="row">
        <div class="col-6">
            <h3>{{ $gallery->title }} - Images</h3>
        </div>
        <div class="col-6">
            @permission('galleries.create')
                <a href="{{ route('admin.galleries.images.create', $gallery->id) }}" class="mt-3 btn btn-primary float-right">
                    <i class="fas fa-plus mr-1"></i>
                    {{ __('Add Image') }}
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
                <div class="card-body">
                    <div class="row" id="sortable-images">
                        @foreach ($images as $image)
                            <div class="col-md-3 mb-4" data-id="{{ $image->id }}">
                                <div class="card">
                                    <img src="{{ asset($image->image_path) }}" class="card-img-top" alt="{{ $image->alt_text }}">
                                    <div class="card-body">
                                        <p class="card-text">{{ $image->alt_text }}</p>
                                        <div class="btn-group">
                                            @permission('galleries.update')
                                                <a href="{{ route('admin.galleries.images.edit', [$gallery->id, $image->id]) }}"
                                                    class="btn btn-sm btn-default">Edit</a>
                                            @endpermission
                                            @permission('galleries.delete')
                                                <button type="button" class="btn btn-sm btn-danger delete-btn"
                                                    data-destroy="{{ route('admin.galleries.images.destroy', [$gallery->id, $image->id]) }}">
                                                    Delete
                                                </button>
                                            @endpermission
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

    <div class="modal" tabindex="-1" id="delete-modal">
        <div class="modal-dialog">
            <div class="modal-content" id="delete-form">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title"><i class="fas fa-exclamation-triangle mr-2"></i>Delete Image?</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <i class="fas fa-trash-alt fa-3x text-danger mb-3"></i>
                    <p class="h5">Are you sure you want to delete this image?</p>
                    <p class="text-muted mb-0">This action cannot be undone.</p>
                </div>
                <div class="modal-footer justify-content-center">
                    <form action="" method="POST" id="deleteForm">
                        @csrf
                        <input type="hidden" name="_method" value="DELETE">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger">
                            <i class="fas fa-trash-alt mr-1"></i> Yes, Delete Image
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <script>
        $(function() {
            // Initialize sortable
            $("#sortable-images").sortable({
                update: function(event, ui) {
                    const images = [];
                    $("#sortable-images .col-md-3").each(function(index) {
                        images.push({
                            id: $(this).data('id'),
                            order: index
                        });
                    });

                    // Save new order
                    $.ajax({
                        url: "{{ route('admin.galleries.images.reorder', $gallery->id) }}",
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            images: images
                        },
                        success: function(response) {
                            toastr.success('Images reordered successfully');
                        },
                        error: function(xhr) {
                            console.error(xhr);
                            toastr.error('An error occurred while reordering images');
                        }
                    });
                }
            });

            // Delete button click handler
            $(document).on('click', '.delete-btn', function(e) {
                e.preventDefault();
                const url = $(this).data('destroy');
                const imageCard = $(this).closest('.col-md-3');
                
                // Store the image card element for later removal
                $('#deleteForm').data('imageCard', imageCard);
                $('#deleteForm').attr('action', url);
                $('#delete-modal').modal('show');
            });

            // Handle delete form submission
            $('#deleteForm').on('submit', function(e) {
                e.preventDefault();
                const form = $(this);
                const url = form.attr('action');
                const imageCard = form.data('imageCard');

                $.ajax({
                    url: url,
                    type: 'POST',
                    data: form.serialize(),
                    success: function(response) {
                        $('#delete-modal').modal('hide');
                        if (imageCard) {
                            imageCard.fadeOut(400, function() {
                                $(this).remove();
                                // Show message if no images left
                                if ($("#sortable-images .col-md-3").length === 0) {
                                    $("#sortable-images").html('<div class="col-12 text-center"><p class="text-muted">No images found</p></div>');
                                }
                            });
                        }
                        toastr.success('Image deleted successfully');
                    },
                    error: function(xhr) {
                        $('#delete-modal').modal('hide');
                        let errorMessage = 'An error occurred while deleting the image';
                        if (xhr.responseJSON && xhr.responseJSON.message) {
                            errorMessage = xhr.responseJSON.message;
                        }
                        toastr.error(errorMessage);
                    }
                });
            });
        });
    </script>
@endpush 