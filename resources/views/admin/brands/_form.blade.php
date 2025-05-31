<div class="row">
    <div class="col-md-8">
        <div class="form-group">
            <label for="name">Brand Name <span class="text-danger">*</span></label>
            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror"
                value="{{ old('name', $brand->name ?? '') }}" required>
            @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group">
            <label for="link">Website URL</label>
            <input type="url" name="link" id="link" class="form-control @error('link') is-invalid @enderror"
                value="{{ old('link', $brand->link ?? '') }}" placeholder="https://example.com">
            @error('link')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" id="description" rows="3"
                class="form-control @error('description') is-invalid @enderror">{{ old('description', $brand->description ?? '') }}</textarea>
            @error('description')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            <label for="logo">Logo @if(!isset($brand) || !$brand->logo) <span class="text-danger">*</span> @endif</label>
            <div class="custom-file">
                <input type="file" name="logo" id="logo"
                    class="custom-file-input @error('logo') is-invalid @enderror"
                    {{ !isset($brand) || !$brand->logo ? 'required' : '' }}>
                <label class="custom-file-label" for="logo">Choose file</label>
                @error('logo')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <small class="form-text text-muted">Recommended size: 200x100px. Max size: 2MB. Allowed types: jpg, jpeg, png, gif</small>
            
            @if(isset($brand) && $brand->logo)
                <div class="mt-3" id="logo-preview">
                    <img src="{{ $brand->logo_url }}" alt="{{ $brand->name }}" class="img-fluid" style="max-height: 100px;">
                    <div class="mt-2">
                        <button type="button" class="btn btn-sm btn-danger" id="remove-logo">
                            <i class="fas fa-trash-alt mr-1"></i> Remove Logo
                        </button>
                    </div>
                </div>
            @else
                <div id="logo-preview" class="mt-3 d-none">
                    <img src="" alt="Logo Preview" class="img-fluid" style="max-height: 100px;" id="logo-preview-image">
                </div>
            @endif
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const logoInput = document.getElementById('logo');
        const logoPreview = document.getElementById('logo-preview');
        const logoPreviewImage = document.getElementById('logo-preview-image');
        const customFileLabel = document.querySelector('.custom-file-label');
        
        if (logoInput) {
            // Show file name when file is selected
            logoInput.addEventListener('change', function() {
                const fileName = this.value.split('\\').pop();
                if (customFileLabel) {
                    customFileLabel.textContent = fileName;
                    customFileLabel.classList.add('selected');
                }
                
                // Show preview if it's an image
                if (this.files && this.files[0]) {
                    const reader = new FileReader();
                    
                    reader.onload = function(e) {
                        if (logoPreview) {
                            logoPreview.classList.remove('d-none');
                        }
                        if (logoPreviewImage) {
                            logoPreviewImage.src = e.target.result;
                        }
                    };
                    
                    reader.readAsDataURL(this.files[0]);
                } else {
                    if (logoPreview) {
                        logoPreview.classList.add('d-none');
                    }
                }
            });
        }

        // Handle remove logo button
        document.addEventListener('click', function(e) {
            if (e.target && e.target.matches('#remove-logo, #remove-logo *')) {
                e.preventDefault();
                if (confirm('Are you sure you want to remove the logo?')) {
                    // Remove any existing remove_logo hidden input
                    const existingRemoveInput = document.querySelector('input[name="remove_logo"]');
                    if (existingRemoveInput) {
                        existingRemoveInput.remove();
                    }
                    
                    // Add new remove_logo hidden input
                    const removeInput = document.createElement('input');
                    removeInput.type = 'hidden';
                    removeInput.name = 'remove_logo';
                    removeInput.value = '1';
                    document.querySelector('form').appendChild(removeInput);
                    
                    // Update UI
                    if (logoPreview) {
                        logoPreview.classList.add('d-none');
                    }
                    if (logoInput) {
                        logoInput.value = '';
                    }
                    if (customFileLabel) {
                        customFileLabel.textContent = 'Choose file';
                    }
                    
                    // Remove the remove button if it exists
                    const removeButton = document.getElementById('remove-logo');
                    if (removeButton) {
                        removeButton.closest('div').remove();
                    }
                }
                return false;
            }
        });
    });
</script>
@endpush
