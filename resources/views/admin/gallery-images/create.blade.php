@extends('layouts.admin')

@section('title', 'Add Images')

@section('main')
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10 col-sm-12">
            <div class="card shadow-lg mt-4">
                <div class="card-header bg-primary text-white">
                    <h3 class="card-title mb-0"><i class="fas fa-images mr-2"></i>Add Images to Gallery</h3>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="mb-3 text-center">
                        <strong>Allowed file types:</strong> JPG, PNG, GIF &nbsp; | &nbsp; <strong>Max size:</strong> 5MB per image
                    </div>
                    <form action="{{ route('admin.galleries.images.store', $gallery->id) }}" method="POST" class="dropzone dz-clickable" id="gallery-dropzone" enctype="multipart/form-data" style="min-height: 250px; border: 2px dashed #007bff; background: #f8f9fa;">
                        @csrf
                        <div class="dz-message" data-dz-message>
                            <div class="text-center">
                                <i class="fas fa-cloud-upload-alt fa-3x text-primary mb-2"></i>
                                <div class="h5">Drag and drop images here or click to select files</div>
                                <small class="text-muted">You can upload multiple images at once.</small>
                            </div>
                        </div>
                        <div class="fallback">
                            <input name="images[]" type="file" multiple />
                        </div>
                    </form>
                    <div class="form-group mt-4 text-center">
                        <a href="{{ route('admin.galleries.images.index', $gallery->id) }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left mr-1"></i> Back to Images
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.css" />
@endpush

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.js"></script>
    <script>
        Dropzone.options.galleryDropzone = {
            paramName: 'images',
            maxFilesize: 5, // MB
            uploadMultiple: true,
            parallelUploads: 10,
            addRemoveLinks: true,
            dictDefaultMessage: 'Drag and drop images here or click to upload',
            acceptedFiles: 'image/*',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            successmultiple: function(files, response) {
                window.location.href = "{{ route('admin.galleries.images.index', $gallery->id) }}";
            },
            error: function(file, response) {
                toastr.error(response.message || response);
            }
        };
    </script>
@endpush 