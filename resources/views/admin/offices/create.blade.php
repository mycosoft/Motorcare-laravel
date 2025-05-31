@extends('layouts.admin')

@section('title', 'Create New Office')

@section('main')
    <div class="row">
        <div class="col-12">
            @include('layouts.shared.alert')
        </div>
    </div>
    
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-plus mr-2"></i>
                        Create New Office
                    </h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.offices.index') }}" class="btn btn-secondary btn-sm">
                            <i class="fas fa-arrow-left mr-1"></i>
                            Back to Offices
                        </a>
                    </div>
                </div>
                
                <form action="{{ route('admin.offices.store') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <!-- Basic Information -->
                            <div class="col-md-6">
                                <h5 class="mb-3">
                                    <i class="fas fa-info-circle mr-2"></i>
                                    Basic Information
                                </h5>
                                
                                <div class="form-group">
                                    <label for="name">Office Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                           id="name" name="name" value="{{ old('name') }}" required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="type">Office Type <span class="text-danger">*</span></label>
                                    <select class="form-control @error('type') is-invalid @enderror" id="type" name="type" required>
                                        <option value="">Select Office Type</option>
                                        <option value="branch" {{ old('type') == 'branch' ? 'selected' : '' }}>Branch</option>
                                        <option value="service_center" {{ old('type') == 'service_center' ? 'selected' : '' }}>Service Center</option>
                                        <option value="parts_center" {{ old('type') == 'parts_center' ? 'selected' : '' }}>Parts Center</option>
                                    </select>
                                    @error('type')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="address">Address <span class="text-danger">*</span></label>
                                    <textarea class="form-control @error('address') is-invalid @enderror" 
                                              id="address" name="address" rows="3" required>{{ old('address') }}</textarea>
                                    @error('address')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="city">City <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control @error('city') is-invalid @enderror" 
                                                   id="city" name="city" value="{{ old('city') }}" required>
                                            @error('city')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="region">Region</label>
                                            <select class="form-control @error('region') is-invalid @enderror" id="region" name="region">
                                                <option value="">Select Region</option>
                                                <option value="Central" {{ old('region') == 'Central' ? 'selected' : '' }}>Central</option>
                                                <option value="Eastern" {{ old('region') == 'Eastern' ? 'selected' : '' }}>Eastern</option>
                                                <option value="Northern" {{ old('region') == 'Northern' ? 'selected' : '' }}>Northern</option>
                                                <option value="Western" {{ old('region') == 'Western' ? 'selected' : '' }}>Western</option>
                                                <option value="Karamoja" {{ old('region') == 'Karamoja' ? 'selected' : '' }}>Karamoja</option>
                                            </select>
                                            @error('region')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Contact & Location -->
                            <div class="col-md-6">
                                <h5 class="mb-3">
                                    <i class="fas fa-map-marker-alt mr-2"></i>
                                    Contact & Location
                                </h5>
                                
                                <div class="form-group">
                                    <label for="phone">Phone Number</label>
                                    <input type="text" class="form-control @error('phone') is-invalid @enderror" 
                                           id="phone" name="phone" value="{{ old('phone') }}">
                                    @error('phone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="email">Email Address</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                           id="email" name="email" value="{{ old('email') }}">
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="latitude">Latitude</label>
                                            <input type="number" step="any" class="form-control @error('latitude') is-invalid @enderror"
                                                   id="latitude" name="latitude" value="{{ old('latitude') }}"
                                                   placeholder="e.g., 0.3476 (Uganda: -1.5 to 4.2)" onchange="validateCoordinates()">
                                            @error('latitude')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                            <small class="form-text text-muted">Uganda latitude range: -1.5 to 4.2</small>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="longitude">Longitude</label>
                                            <input type="number" step="any" class="form-control @error('longitude') is-invalid @enderror"
                                                   id="longitude" name="longitude" value="{{ old('longitude') }}"
                                                   placeholder="e.g., 32.5825 (Uganda: 29.5 to 35.0)" onchange="validateCoordinates()">
                                            @error('longitude')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                            <small class="form-text text-muted">Uganda longitude range: 29.5 to 35.0</small>
                                        </div>
                                    </div>
                                </div>

                                <!-- Coordinate Validation Alert -->
                                <div id="coordinateAlert" class="alert alert-warning" style="display: none;">
                                    <i class="fas fa-exclamation-triangle mr-2"></i>
                                    <span id="coordinateMessage"></span>
                                </div>

                                <!-- Map Preview -->
                                <div class="form-group">
                                    <label>Location Preview</label>
                                    <div id="mapPreview" style="height: 200px; border: 1px solid #ddd; border-radius: 4px; display: none;">
                                        <iframe id="previewFrame" width="100%" height="200" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                                    </div>
                                    <button type="button" class="btn btn-info btn-sm mt-2" onclick="showMapPreview()">
                                        <i class="fas fa-map-marker-alt mr-1"></i>Preview Location on Map
                                    </button>
                                </div>

                                <div class="form-group">
                                    <label for="manager_name">Manager Name</label>
                                    <input type="text" class="form-control @error('manager_name') is-invalid @enderror" 
                                           id="manager_name" name="manager_name" value="{{ old('manager_name') }}">
                                    @error('manager_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="manager_phone">Manager Phone</label>
                                    <input type="text" class="form-control @error('manager_phone') is-invalid @enderror" 
                                           id="manager_phone" name="manager_phone" value="{{ old('manager_phone') }}">
                                    @error('manager_phone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <hr>

                        <div class="row">
                            <!-- Services -->
                            <div class="col-md-6">
                                <h5 class="mb-3">
                                    <i class="fas fa-cogs mr-2"></i>
                                    Services Offered
                                </h5>
                                
                                <div class="form-group">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="services[]" value="Sales" id="service_sales">
                                        <label class="form-check-label" for="service_sales">Vehicle Sales</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="services[]" value="Service" id="service_service">
                                        <label class="form-check-label" for="service_service">Service & Repairs</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="services[]" value="Parts" id="service_parts">
                                        <label class="form-check-label" for="service_parts">Parts & Accessories</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="services[]" value="Finance" id="service_finance">
                                        <label class="form-check-label" for="service_finance">Finance & Insurance</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="services[]" value="Warehousing" id="service_warehousing">
                                        <label class="form-check-label" for="service_warehousing">Warehousing</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="services[]" value="Distribution" id="service_distribution">
                                        <label class="form-check-label" for="service_distribution">Distribution</label>
                                    </div>
                                </div>
                            </div>

                            <!-- Working Hours -->
                            <div class="col-md-6">
                                <h5 class="mb-3">
                                    <i class="fas fa-clock mr-2"></i>
                                    Working Hours
                                </h5>
                                
                                <div class="form-group">
                                    <label for="monday_friday">Monday - Friday</label>
                                    <input type="text" class="form-control @error('monday_friday') is-invalid @enderror" 
                                           id="monday_friday" name="monday_friday" value="{{ old('monday_friday', '8:00 AM - 6:00 PM') }}">
                                    @error('monday_friday')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="saturday">Saturday</label>
                                    <input type="text" class="form-control @error('saturday') is-invalid @enderror" 
                                           id="saturday" name="saturday" value="{{ old('saturday', '8:00 AM - 4:00 PM') }}">
                                    @error('saturday')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="sunday">Sunday</label>
                                    <input type="text" class="form-control @error('sunday') is-invalid @enderror" 
                                           id="sunday" name="sunday" value="{{ old('sunday', 'Closed') }}">
                                    @error('sunday')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea class="form-control @error('description') is-invalid @enderror" 
                                              id="description" name="description" rows="3">{{ old('description') }}</textarea>
                                    @error('description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="is_active" value="1" id="is_active" checked>
                                        <label class="form-check-label" for="is_active">
                                            Office is Active
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save mr-1"></i>
                            Create Office
                        </button>
                        <a href="{{ route('admin.offices.index') }}" class="btn btn-secondary ml-2">
                            <i class="fas fa-times mr-1"></i>
                            Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
function validateCoordinates() {
    const lat = parseFloat(document.getElementById('latitude').value);
    const lng = parseFloat(document.getElementById('longitude').value);
    const alert = document.getElementById('coordinateAlert');
    const message = document.getElementById('coordinateMessage');

    // Uganda bounds
    const ugandaLatMin = -1.5, ugandaLatMax = 4.2;
    const ugandaLngMin = 29.5, ugandaLngMax = 35.0;

    if (lat && lng) {
        if (lat < ugandaLatMin || lat > ugandaLatMax || lng < ugandaLngMin || lng > ugandaLngMax) {
            alert.style.display = 'block';
            alert.className = 'alert alert-danger';
            message.textContent = `Coordinates (${lat}, ${lng}) are outside Uganda. Please verify the location.`;
        } else {
            alert.style.display = 'block';
            alert.className = 'alert alert-success';
            message.textContent = `Coordinates (${lat}, ${lng}) are valid for Uganda.`;
        }
    } else {
        alert.style.display = 'none';
    }
}

function showMapPreview() {
    const lat = document.getElementById('latitude').value;
    const lng = document.getElementById('longitude').value;
    const address = document.getElementById('address').value;
    const city = document.getElementById('city').value;

    if (lat && lng) {
        // Use coordinates for map
        const mapUrl = `https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3989.7!2d${lng}!3d${lat}!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zM!5e0!3m2!1sen!2sus!4v1234567890123!5m2!1sen!2sus&z=15`;
        document.getElementById('previewFrame').src = mapUrl;
        document.getElementById('mapPreview').style.display = 'block';
    } else if (address && city) {
        // Use address for map
        const searchQuery = encodeURIComponent(`${address}, ${city}, Uganda`);
        const mapUrl = `https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3989.7!2d32.5825!3d0.3476!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zM!5e0!3m2!1sen!2sus!4v1234567890123!5m2!1sen!2sus&q=${searchQuery}`;
        document.getElementById('previewFrame').src = mapUrl;
        document.getElementById('mapPreview').style.display = 'block';
    } else {
        alert('Please enter either coordinates (latitude & longitude) or address information to preview the location.');
    }
}

// Common Uganda city coordinates for quick reference
function setCommonLocation(city) {
    const locations = {
        'kampala': {lat: 0.3476, lng: 32.5825},
        'gulu': {lat: 2.7796, lng: 32.2990},
        'mbarara': {lat: -0.6413, lng: 30.6563},
        'jinja': {lat: 0.4314, lng: 33.2042},
        'lira': {lat: 2.2499, lng: 32.8998},
        'arua': {lat: 3.0197, lng: 30.9107},
        'kitgum': {lat: 3.2781, lng: 32.8872},
        'masaka': {lat: -0.3540, lng: 31.7340},
        'fort_portal': {lat: 0.6710, lng: 30.2748}
    };

    const location = locations[city.toLowerCase()];
    if (location) {
        document.getElementById('latitude').value = location.lat;
        document.getElementById('longitude').value = location.lng;
        validateCoordinates();
    }
}

// Add quick location buttons
document.addEventListener('DOMContentLoaded', function() {
    const cityField = document.getElementById('city');
    if (cityField) {
        cityField.addEventListener('blur', function() {
            const city = this.value.toLowerCase();
            if (city && !document.getElementById('latitude').value && !document.getElementById('longitude').value) {
                setCommonLocation(city);
            }
        });
    }
});
</script>
@endpush
