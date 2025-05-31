<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="full_name">{{ __('Full Name*') }}</label>
            <input type="text" name="full_name" class="form-control @error('full_name') is-invalid @enderror" 
                   id="full_name" placeholder="Enter full name" value="{{ old('full_name', $team->full_name ?? '') }}">
            @error('full_name')
                <small class="error invalid-feedback" role="alert">{{ $message }}</small>
            @enderror
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="position">{{ __('Position*') }}</label>
            <input type="text" name="position" class="form-control @error('position') is-invalid @enderror" 
                   id="position" placeholder="Enter position" value="{{ old('position', $team->position ?? '') }}">
            @error('position')
                <small class="error invalid-feedback" role="alert">{{ $message }}</small>
            @enderror
        </div>
    </div>
</div>

<div class="row mt-3">
    <div class="col-md-6">
        <div class="form-group">
            <label for="image">{{ __('Profile Image') }}</label>
            <div class="custom-file">
                <input type="file" class="custom-file-input @error('image') is-invalid @enderror" 
                       id="image" name="image" onchange="previewImage(this)">
                <label class="custom-file-label" for="image">
                    {{ isset($team->image) ? basename($team->image) : 'Choose file' }}
                </label>
                @error('image')
                    <small class="error invalid-feedback" role="alert">{{ $message }}</small>
                @enderror
            </div>
            <div class="mt-2">
                @php
                    $imageUrl = isset($team->image_url) ? $team->image_url : asset('images/default-team.png');
                @endphp
                <img id="image-preview" src="{{ $imageUrl }}" 
                     alt="Preview" class="img-fluid rounded-circle" 
                     style="width: 150px; height: 150px; object-fit: cover; margin-top: 10px;">
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    function previewImage(input) {
        const preview = document.getElementById('image-preview');
        const file = input.files[0];
        const reader = new FileReader();

        reader.onloadend = function() {
            preview.src = reader.result;
        }

        if (file) {
            reader.readAsDataURL(file);
        } else {
            preview.src = "{{ asset('images/default-team.png') }}";
        }

        // Update the file input label
        const fileName = input.files[0]?.name || 'Choose file';
        input.nextElementSibling.textContent = fileName;
    }

    // Show default image on page load
    document.addEventListener('DOMContentLoaded', function() {
        const preview = document.getElementById('image-preview');
        if (preview) {
            preview.style.display = 'block';
        }
    });
</script>
@endpush
