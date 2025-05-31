<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gallery - Motorcare Uganda</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Kalam:wght@300;400;700&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'motorcare-orange': '#FF6B35',
                        'motorcare-brown': '#4A4A4A',
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
            <h1 class="text-5xl font-bold mb-6">Our Gallery</h1>
            <p class="text-xl text-gray-200 max-w-3xl mx-auto">Explore our automotive journey through images</p>
        </div>
    </section>

    @if($featuredGalleries->count() > 0)
        <!-- Featured Galleries Section -->
        <section class="py-16 bg-white">
            <div class="max-w-7xl mx-auto px-4">
                <div class="text-center mb-12">
                    <h2 class="text-3xl font-bold text-motorcare-brown mb-4">Featured Collections</h2>
                    <div class="w-24 h-1 bg-motorcare-orange mx-auto"></div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($featuredGalleries as $gallery)
                        <div class="group relative bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 overflow-hidden transform hover:-translate-y-2">
                            @if($gallery->images->count() > 0)
                                <div class="relative h-64 overflow-hidden">
                                    <img src="{{ $gallery->images->first()->image_url }}"
                                         alt="{{ $gallery->title }}"
                                         class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent"></div>
                                    <div class="absolute bottom-4 left-4 text-white">
                                        <span class="bg-motorcare-orange px-3 py-1 rounded-full text-sm font-semibold">
                                            {{ $gallery->images->count() }} Photos
                                        </span>
                                    </div>
                                </div>
                            @else
                                <div class="h-64 bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center">
                                    <i class="fas fa-image text-gray-400 text-4xl"></i>
                                </div>
                            @endif

                            <div class="p-6">
                                <div class="flex items-center justify-between mb-3">
                                    <span class="text-sm text-motorcare-orange font-semibold">{{ $gallery->category->name }}</span>
                                    <i class="fas fa-star text-motorcare-orange"></i>
                                </div>
                                <h3 class="text-xl font-bold text-motorcare-brown mb-2 group-hover:text-motorcare-orange transition-colors duration-300">
                                    {{ $gallery->title }}
                                </h3>
                                @if($gallery->description)
                                    <p class="text-gray-600 text-sm leading-relaxed">
                                        {{ Str::limit($gallery->description, 100) }}
                                    </p>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <!-- Gallery Categories Section -->
    <section class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4">
            @if($categories->count() > 0)
                @foreach($categories as $category)
                    @if($category->galleries->count() > 0)
                        <div class="mb-16">
                            <div class="text-center mb-12">
                                <h2 class="text-3xl font-bold text-motorcare-brown mb-4">{{ $category->name }}</h2>
                                <div class="w-24 h-1 bg-motorcare-orange mx-auto mb-4"></div>
                                @if($category->description)
                                    <p class="text-gray-600 max-w-2xl mx-auto">{{ $category->description }}</p>
                                @endif
                            </div>

                            <!-- Masonry Grid for Gallery Images -->
                            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                                @foreach($category->galleries as $gallery)
                                    @foreach($gallery->images->take(8) as $image)
                                        <div class="group relative overflow-hidden rounded-xl shadow-md hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-1 cursor-pointer"
                                             onclick="openLightbox('{{ $image->image_url }}', '{{ $image->alt_text ?: $gallery->title }}')">
                                            <img src="{{ $image->image_url }}"
                                                 alt="{{ $image->alt_text ?: $gallery->title }}"
                                                 class="w-full h-48 object-cover group-hover:scale-110 transition-transform duration-700">
                                            <div class="absolute inset-0 bg-black/0 group-hover:bg-black/20 transition-colors duration-300"></div>
                                            <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                                <div class="bg-white/20 backdrop-blur-sm rounded-full p-3">
                                                    <i class="fas fa-search-plus text-white text-xl"></i>
                                                </div>
                                            </div>
                                            <div class="absolute bottom-2 left-2 right-2">
                                                <div class="bg-black/50 backdrop-blur-sm rounded-lg p-2 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                                    <p class="text-white text-xs font-medium truncate">{{ $gallery->title }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endforeach
                            </div>
                        </div>
                    @endif
                @endforeach
            @else
                <!-- No Galleries Available -->
                <div class="text-center py-20">
                    <div class="w-32 h-32 bg-gradient-to-br from-gray-100 to-gray-200 rounded-full flex items-center justify-center mx-auto mb-8">
                        <i class="fas fa-images text-gray-400 text-4xl"></i>
                    </div>
                    <h3 class="text-3xl font-bold text-gray-600 mb-4">No Galleries Available</h3>
                    <p class="text-gray-500 max-w-lg mx-auto text-lg">
                        We're currently updating our gallery. Please check back soon for our latest photos and collections.
                    </p>
                </div>
            @endif
        </div>
    </section>

    <!-- Lightbox Modal -->
    <div id="lightbox" class="fixed inset-0 bg-black/90 z-50 hidden items-center justify-center p-4">
        <div class="relative max-w-4xl max-h-full">
            <button onclick="closeLightbox()" class="absolute -top-12 right-0 text-white hover:text-motorcare-orange text-2xl">
                <i class="fas fa-times"></i>
            </button>
            <img id="lightbox-image" src="" alt="" class="max-w-full max-h-full object-contain rounded-lg">
            <div id="lightbox-caption" class="absolute bottom-0 left-0 right-0 bg-black/50 text-white p-4 rounded-b-lg">
                <p class="text-center"></p>
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

    <script>
        // Lightbox Functionality
        function openLightbox(imageSrc, caption) {
            const lightbox = document.getElementById('lightbox');
            const lightboxImage = document.getElementById('lightbox-image');
            const lightboxCaption = document.getElementById('lightbox-caption').querySelector('p');

            lightboxImage.src = imageSrc;
            lightboxImage.alt = caption;
            lightboxCaption.textContent = caption;

            lightbox.classList.remove('hidden');
            lightbox.classList.add('flex');
            document.body.style.overflow = 'hidden';
        }

        function closeLightbox() {
            const lightbox = document.getElementById('lightbox');
            lightbox.classList.add('hidden');
            lightbox.classList.remove('flex');
            document.body.style.overflow = 'auto';
        }

        // Close lightbox on escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeLightbox();
            }
        });

        // Close lightbox when clicking outside image
        document.getElementById('lightbox').addEventListener('click', function(e) {
            if (e.target === this) {
                closeLightbox();
            }
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
</body>
</html>
