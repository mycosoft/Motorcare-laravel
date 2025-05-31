<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Our Offices - Motorcare Uganda</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'motorcare-orange': '#FF6B35',
                        'motorcare-brown': '#555555',
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-gray-50">
    @include('partials.header')
    <!-- Hero Section -->
    <section class="relative bg-gradient-to-r from-motorcare-brown to-gray-700 text-white py-20">
        <div class="absolute inset-0 bg-black/30"></div>
        <div class="relative max-w-6xl mx-auto px-4 text-center">
            <h1 class="text-5xl font-bold mb-6">Our Offices</h1>
            <p class="text-xl text-gray-200 max-w-3xl mx-auto">Find Motorcare Uganda locations across the country</p>
        </div>
    </section>

<!-- Offices Section -->
<section class="py-5">
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-lg-4 col-xl-3">
                <div class="office-sidebar bg-white shadow-sm rounded p-4">
                    <!-- Search -->
                    <div class="search-box mb-4">
                        <div class="input-group">
                            <input type="text" id="officeSearch" class="form-control" placeholder="Search offices...">
                            <button class="btn btn-danger" type="button">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Use My Location -->
                    <div class="mb-4">
                        <button class="btn btn-outline-secondary w-100" id="useLocationBtn">
                            <i class="fas fa-location-arrow me-2"></i>
                            Use my location
                        </button>
                    </div>

                    <!-- Office List -->
                    <div class="office-list">
                        @foreach($offices as $index => $office)
                        @php
                            $markerColors = ['danger', 'success', 'primary', 'warning', 'secondary', 'info', 'dark', 'purple'];
                            $markerColor = $markerColors[$index % count($markerColors)];
                            $markerLetters = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I'];
                            $markerLetter = $markerLetters[$index % count($markerLetters)];
                        @endphp
                        <div class="office-card border rounded mb-2" data-office-id="{{ $office->id }}" data-lat="{{ $office->latitude }}" data-lng="{{ $office->longitude }}" data-city="{{ $office->city }}">
                            <div class="d-flex align-items-center p-3 cursor-pointer" onclick="toggleOfficeDetails('{{ $office->id }}')">
                                <!-- Marker Icon -->
                                <div class="me-3">
                                    <div class="text-white rounded-circle d-flex align-items-center justify-center" style="width: 32px; height: 32px; font-weight: bold; font-size: 14px; background: #FF6B35;">
                                        {{ $markerLetter }}
                                    </div>
                                </div>

                                <!-- Office Name -->
                                <div class="flex-grow-1">
                                    <h6 class="office-name mb-0 fw-bold text-uppercase" style="font-size: 11px;">{{ $office->name }}</h6>
                                </div>

                                <!-- Dropdown Arrow -->
                                <div class="office-toggle">
                                    <i class="fas fa-chevron-down" style="transition: transform 0.3s; font-size: 14px; color: #FF6B35;"></i>
                                </div>
                            </div>

                            <!-- Expandable Details -->
                            <div class="office-expanded-details" style="display: none;">
                                <div class="px-3 pb-3">
                                    <div class="border-top pt-3">
                                        <!-- Phone -->
                                        @if($office->phone)
                                        <div class="d-flex align-items-center mb-2">
                                            <i class="fas fa-phone text-{{ $markerColor }} me-2" style="width: 16px;"></i>
                                            <span class="text-muted small">{{ $office->phone }}</span>
                                        </div>
                                        @endif

                                        <!-- Address -->
                                        <div class="mb-3">
                                            <strong class="text-dark small">Address:</strong>
                                            <div class="text-muted small">{{ $office->address }}, {{ $office->city }}</div>
                                        </div>

                                        <!-- Working Hours -->
                                        <div class="mb-3">
                                            <strong class="text-dark small">Working Hours</strong>
                                            <div class="text-muted small">
                                                <div><strong>Mon - Fri:</strong> {{ $office->working_hours_formatted ?? '8:00 AM - 5:00 PM' }}</div>
                                                <div><strong>Sat-Sun:</strong> CLOSED</div>
                                            </div>
                                        </div>

                                        <!-- Dealer Type -->
                                        <div class="mb-3">
                                            <strong class="text-dark small">Dealer Type</strong>
                                            <div class="text-muted small">
                                                @if($office->services)
                                                    @foreach(explode(',', $office->services_list) as $service)
                                                        <div>{{ trim($service) }}</div>
                                                    @endforeach
                                                @else
                                                    <div>Vehicle Sales</div>
                                                    <div>Service/Repairs</div>
                                                    <div>Parts</div>
                                                    <div>Showroom</div>
                                                @endif
                                            </div>
                                        </div>

                                        <!-- Get Directions Button -->
                                        <div class="mt-3">
                                            <a href="https://www.google.com/maps/dir/?api=1&destination={{ $office->latitude }},{{ $office->longitude }}"
                                               target="_blank"
                                               class="btn btn-outline-{{ $markerColor }} btn-sm text-decoration-none">
                                                <i class="fas fa-directions me-1"></i>Get Directions
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Map -->
            <div class="col-lg-8 col-xl-9">
                <div class="map-container">
                    <!-- Interactive Google Map with Markers -->
                    <div id="map" style="height: 600px; width: 100%; border-radius: 8px;"></div>

                    <script>
                    let map;
                    let markers = [];
                    let currentInfoWindow = null; // Track currently open info window

                    function initMap() {
                        // Center map on Uganda with better coverage
                        const ugandaCenter = { lat: 1.373333, lng: 32.290275 };

                        // Initialize map to match your reference screenshot - focused Uganda view
                        map = new google.maps.Map(document.getElementById("map"), {
                            zoom: 6.8, // Correct zoom to show full Uganda like in your screenshot
                            center: ugandaCenter,
                            mapTypeId: 'roadmap', // Roadmap to show cities, roads, and features clearly
                            restriction: {
                                latLngBounds: {
                                    north: 4.5,   // Show a bit more north like your screenshot
                                    south: -2.0,  // Show a bit more south like your screenshot
                                    east: 35.5,   // Show a bit more east like your screenshot
                                    west: 29.0,   // Show a bit more west like your screenshot
                                },
                                strictBounds: false, // Allow slight panning like your screenshot
                            },
                            // Clean styling to match your reference image - no yellow roads
                            styles: [
                                {
                                    featureType: "water",
                                    elementType: "geometry",
                                    stylers: [{ color: "#4fc3f7" }] // Blue for Lake Victoria
                                },
                                {
                                    featureType: "landscape",
                                    elementType: "geometry",
                                    stylers: [{ color: "#e8f5e8" }] // Light green terrain
                                },
                                {
                                    featureType: "road.highway",
                                    elementType: "geometry",
                                    stylers: [{ visibility: "off" }] // Hide yellow/orange highways
                                },
                                {
                                    featureType: "road.arterial",
                                    elementType: "geometry",
                                    stylers: [{ visibility: "off" }] // Hide arterial roads
                                },
                                {
                                    featureType: "road.local",
                                    elementType: "geometry",
                                    stylers: [{ visibility: "off" }] // Hide local roads
                                },
                                {
                                    featureType: "administrative.locality",
                                    elementType: "labels.text",
                                    stylers: [
                                        { visibility: "on" },
                                        { color: "#000000" }, // Darker color for better visibility
                                        { weight: "bold" }    // Bold text for better readability
                                    ]
                                },
                                {
                                    featureType: "administrative.locality",
                                    elementType: "labels.text.stroke",
                                    stylers: [
                                        { color: "#ffffff" }, // White outline for contrast
                                        { weight: 2 }
                                    ]
                                },
                                {
                                    featureType: "administrative.country",
                                    elementType: "geometry.stroke",
                                    stylers: [{ color: "#999999" }, { weight: 1 }] // Country borders
                                }
                            ]
                        });

                        // Office locations from database
                        const offices = [
                            @foreach($offices as $index => $office)
                            {
                                position: { lat: {{ $office->latitude }}, lng: {{ $office->longitude }} },
                                title: "{{ $office->name }}",
                                city: "{{ $office->city }}",
                                address: "{{ $office->address }}",
                                phone: "{{ $office->phone }}",
                                email: "{{ $office->email }}",
                                label: "{{ chr(65 + $index) }}",
                                id: {{ $office->id }}
                            }@if(!$loop->last),@endif
                            @endforeach
                        ];

                        // Create markers for each office
                        offices.forEach((office, index) => {
                            // Create custom marker with orange background and white letter
                            const marker = new google.maps.Marker({
                                position: office.position,
                                map: map,
                                title: office.title,
                                label: {
                                    text: office.label,
                                    color: 'white',
                                    fontWeight: 'bold',
                                    fontSize: '14px' // Perfect size for focused Uganda view
                                },
                                icon: {
                                    path: google.maps.SymbolPath.CIRCLE,
                                    fillColor: '#FF6B35', // Orange color matching your screenshot
                                    fillOpacity: 1,
                                    strokeColor: '#ffffff',
                                    strokeWeight: 2, // Clean border
                                    scale: 20 // Perfect size for focused Uganda view
                                }
                            });

                            // Create interactive info window with close functionality
                            const infoWindow = new google.maps.InfoWindow({
                                content: `
                                    <div style="padding: 15px; max-width: 320px; font-family: Arial, sans-serif;">
                                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 12px;">
                                            <h6 style="color: #FF6B35; margin: 0; font-weight: bold; font-size: 16px;">${office.title}</h6>
                                        </div>
                                        <div style="border-left: 3px solid #FF6B35; padding-left: 12px;">
                                            <p style="margin: 0 0 8px 0; font-size: 14px; color: #333;">
                                                <i class="fas fa-map-marker-alt" style="color: #FF6B35; margin-right: 8px; width: 16px;"></i>
                                                <strong>City:</strong> ${office.city}
                                            </p>
                                            <p style="margin: 0 0 8px 0; font-size: 14px; color: #333;">
                                                <i class="fas fa-home" style="color: #FF6B35; margin-right: 8px; width: 16px;"></i>
                                                <strong>Address:</strong> ${office.address}
                                            </p>
                                            <p style="margin: 0 0 8px 0; font-size: 14px; color: #333;">
                                                <i class="fas fa-phone" style="color: #FF6B35; margin-right: 8px; width: 16px;"></i>
                                                <strong>Phone:</strong> <a href="tel:${office.phone}" style="color: #FF6B35; text-decoration: none;">${office.phone}</a>
                                            </p>
                                            <p style="margin: 0; font-size: 14px; color: #333;">
                                                <i class="fas fa-envelope" style="color: #FF6B35; margin-right: 8px; width: 16px;"></i>
                                                <strong>Email:</strong> <a href="mailto:${office.email}" style="color: #FF6B35; text-decoration: none;">${office.email}</a>
                                            </p>
                                        </div>
                                    </div>
                                `,
                                pixelOffset: new google.maps.Size(0, -10) // Position above marker
                            });

                            // Add click listener to marker for interactive functionality
                            marker.addListener('click', () => {
                                // Close currently open info window if any
                                if (currentInfoWindow) {
                                    currentInfoWindow.close();
                                }

                                // Open this info window
                                infoWindow.open(map, marker);
                                currentInfoWindow = infoWindow;

                                // Highlight corresponding office card
                                highlightOfficeCard(office.id);
                            });

                            // Close info window when clicking elsewhere on map
                            map.addListener('click', () => {
                                if (currentInfoWindow) {
                                    currentInfoWindow.close();
                                    currentInfoWindow = null;
                                }
                            });

                            // Store marker and info window
                            markers.push({
                                marker: marker,
                                infoWindow: infoWindow,
                                office: office
                            });
                        });
                    }

                    // Function to highlight office card when marker is clicked
                    function highlightOfficeCard(officeId) {
                        // Remove active class from all cards
                        document.querySelectorAll('.office-card').forEach(card => {
                            card.classList.remove('active');
                        });

                        // Add active class to selected card
                        const selectedCard = document.querySelector(`[data-office-id="${officeId}"]`);
                        if (selectedCard) {
                            selectedCard.classList.add('active');
                            selectedCard.scrollIntoView({ behavior: 'smooth', block: 'center' });
                        }
                    }

                    // Load Google Maps API
                    window.initMap = initMap;
                    </script>



                    <!-- Load Google Maps API with your API key -->
                    <script async defer
                        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCQTomBWk-ck2BqhTO8MNZWXvK9m_AJUZw&callback=initMap">
                    </script>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Office Details Modal -->
<div class="modal fade" id="officeModal" tabindex="-1" aria-labelledby="officeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="officeModalLabel">Office Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="officeModalBody">
                <!-- Office details will be loaded here -->
            </div>
        </div>
    </div>
</div>

@include('partials.footer')

<style>
.page-banner {
    padding: 100px 0 60px;
}

.office-sidebar {
    max-height: 600px;
    overflow-y: auto;
}

.office-card {
    transition: all 0.3s ease;
    border: 1px solid #e0e0e0 !important;
}

.office-card:hover {
    border-color: #dc3545 !important;
    box-shadow: 0 4px 8px rgba(220, 53, 69, 0.1);
}

.office-card.active {
    border-color: #dc3545 !important;
    background-color: #fff5f5;
}

.office-toggle {
    position: absolute;
    right: 15px;
    top: 15px;
    transition: transform 0.3s ease;
}

.office-card.expanded .office-toggle {
    transform: rotate(180deg);
}

.cursor-pointer {
    cursor: pointer;
}

.office-card {
    transition: all 0.3s ease;
}

.office-card:hover {
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}

.office-card.expanded {
    background-color: #f8f9fa;
    border-color: #dc3545;
}

.office-marker {
    min-width: 30px;
}

.breadcrumb {
    background: none;
    padding: 0;
    margin: 0;
}

.breadcrumb-item + .breadcrumb-item::before {
    color: rgba(255, 255, 255, 0.7);
}

.search-box .form-control {
    border-right: none;
}

.search-box .btn {
    border-left: none;
}

#officeMap {
    border-radius: 8px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.gm-style-iw {
    max-width: 300px !important;
}

.office-info-window {
    padding: 10px;
}

.office-info-window h6 {
    color: #dc3545;
    margin-bottom: 10px;
}

.office-info-window p {
    margin-bottom: 5px;
    font-size: 14px;
}


</style>

<script>


let offices = @json($offices);

function highlightOfficeCard(officeId) {
    // Remove active class from all cards
    document.querySelectorAll('.office-card').forEach(card => {
        card.classList.remove('active');
    });

    // Add active class to selected card
    const selectedCard = document.querySelector(`[data-office-id="${officeId}"]`);
    if (selectedCard) {
        selectedCard.classList.add('active');
        selectedCard.scrollIntoView({ behavior: 'smooth', block: 'center' });
    }
}

function updateMapLocation(office) {
    if (office.latitude && office.longitude) {
        // Create a new Google Maps embed URL for the specific office location
        const mapUrl = `https://www.google.com/maps/embed/v1/place?key=YOUR_API_KEY&q=${office.latitude},${office.longitude}&zoom=15`;

        // For now, we'll use a simple search-based embed
        const searchUrl = `https://www.google.com/maps/embed/v1/search?key=YOUR_API_KEY&q=${encodeURIComponent(office.address + ', ' + office.city + ', Uganda')}`;

        // Update the iframe src (you can implement this when you have an API key)
        // document.querySelector('#officeMap iframe').src = searchUrl;

        // For now, just show an alert with office details
        showOfficeModal(office);
    }
}

function showOfficeModal(office) {
    const modalBody = document.getElementById('officeModalBody');
    modalBody.innerHTML = `
        <div class="row">
            <div class="col-md-6">
                <h6 class="text-danger mb-3">${office.name}</h6>
                <p><i class="fas fa-map-marker-alt text-muted me-2"></i><strong>Address:</strong><br>${office.address}, ${office.city}</p>
                ${office.phone ? `<p><i class="fas fa-phone text-muted me-2"></i><strong>Phone:</strong> ${office.phone}</p>` : ''}
                ${office.email ? `<p><i class="fas fa-envelope text-muted me-2"></i><strong>Email:</strong> ${office.email}</p>` : ''}
                <p><i class="fas fa-clock text-muted me-2"></i><strong>Working Hours:</strong><br>${office.working_hours_formatted || 'Contact for hours'}</p>
                ${office.services ? `<p><i class="fas fa-cogs text-muted me-2"></i><strong>Services:</strong><br>${office.services.join(', ')}</p>` : ''}
                ${office.manager_name ? `<p><i class="fas fa-user text-muted me-2"></i><strong>Manager:</strong> ${office.manager_name}</p>` : ''}
            </div>
            <div class="col-md-6">
                <div class="map-embed" style="height: 300px; border-radius: 8px; overflow: hidden;">
                    <iframe
                        src="https://www.google.com/maps/embed/v1/search?key=YOUR_API_KEY&q=${encodeURIComponent(office.address + ', ' + office.city + ', Uganda')}"
                        width="100%"
                        height="300"
                        style="border:0;"
                        allowfullscreen=""
                        loading="lazy">
                    </iframe>
                </div>
            </div>
        </div>
    `;

    // Show the modal
    const modal = new bootstrap.Modal(document.getElementById('officeModal'));
    modal.show();
}

// Office card click handlers
document.addEventListener('DOMContentLoaded', function() {
    // Make map markers interactive
    document.querySelectorAll('.office-map-marker').forEach(marker => {
        const label = marker.querySelector('.position-absolute.bg-white');

        // Show label on hover
        marker.addEventListener('mouseenter', function() {
            if (label) label.style.opacity = '1';
        });

        marker.addEventListener('mouseleave', function() {
            if (label) label.style.opacity = '0';
        });
    });
    // Add toggle function for office details
    window.toggleOfficeDetails = function(officeId) {
        const card = document.querySelector(`[data-office-id="${officeId}"]`);
        const details = card.querySelector('.office-expanded-details');
        const toggle = card.querySelector('.office-toggle i');
        const isExpanded = details.style.display === 'block';

        // Close all other expanded cards
        document.querySelectorAll('.office-card').forEach(otherCard => {
            if (otherCard !== card) {
                const otherDetails = otherCard.querySelector('.office-expanded-details');
                const otherToggle = otherCard.querySelector('.office-toggle i');
                otherDetails.style.display = 'none';
                otherToggle.style.transform = 'rotate(0deg)';
                otherCard.classList.remove('expanded');
            }
        });

        // Toggle current card
        if (isExpanded) {
            details.style.display = 'none';
            toggle.style.transform = 'rotate(0deg)';
            card.classList.remove('expanded');
        } else {
            details.style.display = 'block';
            toggle.style.transform = 'rotate(180deg)';
            card.classList.add('expanded');
        }

        highlightOfficeCard(officeId);
    };

    // Search functionality
    document.getElementById('officeSearch').addEventListener('input', function() {
        const searchTerm = this.value.toLowerCase();

        document.querySelectorAll('.office-card').forEach(card => {
            const officeName = card.querySelector('.office-name').textContent.toLowerCase();
            const officeDetails = card.querySelector('.office-expanded-details');
            let officeAddress = '';

            if (officeDetails) {
                const addressElement = officeDetails.querySelector('p');
                if (addressElement) {
                    officeAddress = addressElement.textContent.toLowerCase();
                }
            }

            if (officeName.includes(searchTerm) || officeAddress.includes(searchTerm)) {
                card.style.display = 'block';
            } else {
                card.style.display = 'none';
            }
        });
    });

    // Use location button
    document.getElementById('useLocationBtn').addEventListener('click', function() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                const userLat = position.coords.latitude;
                const userLng = position.coords.longitude;

                // Update the main map to show user location
                const mapFrame = document.querySelector('#officeMap iframe');
                if (mapFrame) {
                    const newSrc = `https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3989.7!2d${userLng}!3d${userLat}!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zM!5e0!3m2!1sen!2sus!4v1234567890123!5m2!1sen!2sus`;
                    mapFrame.src = newSrc;
                }

                alert('Map updated to show your location!');
            }, function(error) {
                alert('Unable to get your location. Please check your browser settings.');
            });
        } else {
            alert('Geolocation is not supported by this browser.');
        }
    });
});


</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
