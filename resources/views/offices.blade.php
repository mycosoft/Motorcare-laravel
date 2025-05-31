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
                    <!-- Google Maps Embed -->
                    <div id="googleMapContainer" style="height: 600px; width: 100%; border-radius: 8px; overflow: hidden; position: relative;">
                        <!-- Google Maps Embed - Zoomed out view of Uganda with markers -->
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4073303.1384897232!2d29.5!3d1.0!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x177dbb0d3f0b5555%3A0x7b5b5b5b5b5b5b5b!2sUganda!5e0!3m2!1sen!2sus!4v1234567890123!5m2!1sen!2sus&z=5"
                            width="100%"
                            height="600"
                            style="border:0;"
                            allowfullscreen=""
                            loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade">
                        </iframe>

                        <!-- Custom Markers Overlay -->
                        <div class="position-absolute top-0 start-0 w-100 h-100" style="pointer-events: none;">
                            @foreach($offices as $index => $office)
                                @if($office->latitude && $office->longitude)
                                    @php
                                        // Convert lat/lng to approximate pixel positions for Uganda map
                                        $latRange = 4.2 - (-1.5); // 5.7
                                        $lngRange = 35.0 - 29.5; // 5.5

                                        $normalizedLat = (4.2 - $office->latitude) / $latRange;
                                        $normalizedLng = ($office->longitude - 29.5) / $lngRange;

                                        $topPercent = $normalizedLat * 100;
                                        $leftPercent = $normalizedLng * 100;

                                        // Ensure markers stay within bounds
                                        $topPercent = max(5, min(95, $topPercent));
                                        $leftPercent = max(5, min(95, $leftPercent));

                                        // Use letters for markers
                                        $markerLetters = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I'];
                                        $markerLetter = $markerLetters[$index % count($markerLetters)];
                                    @endphp

                                    <div class="position-absolute office-map-marker"
                                         style="top: {{ $topPercent }}%; left: {{ $leftPercent }}%; transform: translate(-50%, -100%); pointer-events: auto; cursor: pointer; z-index: 10;"
                                         data-office-id="{{ $office->id }}"
                                         onclick="highlightOfficeCard('{{ $office->id }}')">
                                        <!-- Marker with Letter -->
                                        <div class="position-relative">
                                            <!-- Orange circular marker with letter -->
                                            <div class="d-flex align-items-center justify-center text-white fw-bold"
                                                 style="width: 32px; height: 32px; background: #FF6B35; border-radius: 50%; border: 3px solid white; box-shadow: 0 3px 8px rgba(0,0,0,0.3); font-size: 14px;">
                                                {{ $markerLetter }}
                                            </div>
                                            <!-- Office Label -->
                                            <div class="position-absolute bg-white px-2 py-1 rounded shadow-sm" style="top: 38px; left: 50%; transform: translateX(-50%); font-size: 11px; font-weight: bold; color: #FF6B35; white-space: nowrap; opacity: 0; transition: opacity 0.3s;">
                                                {{ $office->city }}
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
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

<!-- Floating Buttons -->
<!-- Contact Us Button (Bottom Left) -->
<div class="fixed bottom-6 left-6 z-50">
    <!-- Contact Menu -->
    <div id="contactMenu" class="absolute bottom-16 left-0 bg-white rounded-2xl shadow-2xl p-3 w-56 opacity-0 transform translate-y-4 pointer-events-none transition-all duration-300">
        <div class="space-y-0">
            <a href="https://wa.me/256312238100" target="_blank" class="flex items-center p-2 rounded-xl hover:bg-green-50 transition-colors duration-200">
                <div class="w-12 h-12 bg-green-500 rounded-full flex items-center justify-center mr-3">
                    <i class="fab fa-whatsapp text-white text-lg"></i>
                </div>
                <span class="text-gray-700 font-medium">WhatsApp</span>
            </a>

            <a href="mailto:info@motorcareuganda.com" class="flex items-center p-2 rounded-xl hover:bg-red-50 transition-colors duration-200">
                <div class="w-12 h-12 bg-red-500 rounded-full flex items-center justify-center mr-3">
                    <i class="fas fa-envelope text-white text-lg"></i>
                </div>
                <span class="text-gray-700 font-medium">Email us</span>
            </a>

            <a href="tel:+256312238100" class="flex items-center p-2 rounded-xl hover:bg-green-50 transition-colors duration-200">
                <div class="w-12 h-12 bg-green-600 rounded-full flex items-center justify-center mr-3">
                    <i class="fas fa-phone text-white text-lg"></i>
                </div>
                <span class="text-gray-700 font-medium">Direct call</span>
            </a>
        </div>
    </div>

    <!-- Main Contact Button -->
    <button id="contactButton" class="bg-green-600 hover:bg-green-700 text-white p-4 rounded-full shadow-2xl hover:shadow-3xl transition-all duration-300 transform hover:scale-110 flex items-center justify-center" onclick="toggleContactMenu()">
        <i class="fas fa-comment text-xl"></i>
    </button>
</div>

<!-- Back to Top Button (Bottom Right) -->
<div class="fixed bottom-6 right-6 z-50">
    <button id="backToTop" class="bg-motorcare-orange hover:bg-orange-500 text-white p-4 rounded-full shadow-2xl hover:shadow-3xl transition-all duration-300 transform hover:scale-110 opacity-0 translate-y-4" onclick="scrollToTop()">
        <i class="fas fa-chevron-up text-xl"></i>
    </button>
</div>

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

// Back to Top Button Functionality
const backToTopButton = document.getElementById('backToTop');

// Show/hide button based on scroll position
window.addEventListener('scroll', function() {
    if (window.pageYOffset > 300) {
        backToTopButton.classList.remove('opacity-0', 'translate-y-4');
        backToTopButton.classList.add('opacity-100', 'translate-y-0');
    } else {
        backToTopButton.classList.add('opacity-0', 'translate-y-4');
        backToTopButton.classList.remove('opacity-100', 'translate-y-0');
    }
});

// Smooth scroll to top function
function scrollToTop() {
    window.scrollTo({
        top: 0,
        behavior: 'smooth'
    });
}

// Contact Menu Toggle Functionality
let contactMenuOpen = false;
const contactMenu = document.getElementById('contactMenu');
const contactButton = document.getElementById('contactButton');

function toggleContactMenu() {
    contactMenuOpen = !contactMenuOpen;

    if (contactMenuOpen) {
        contactMenu.classList.remove('opacity-0', 'translate-y-4', 'pointer-events-none');
        contactMenu.classList.add('opacity-100', 'translate-y-0', 'pointer-events-auto');
    } else {
        contactMenu.classList.add('opacity-0', 'translate-y-4', 'pointer-events-none');
        contactMenu.classList.remove('opacity-100', 'translate-y-0', 'pointer-events-auto');
    }
}

// Close contact menu when clicking outside
document.addEventListener('click', function(event) {
    if (!contactButton.contains(event.target) && !contactMenu.contains(event.target)) {
        if (contactMenuOpen) {
            toggleContactMenu();
        }
    }
});
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
