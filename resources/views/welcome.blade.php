<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Motorcare Uganda - Car Dealership</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        :root {
            --motorcare-brown: #555555;
            --motorcare-orange: #F7931E;
        }
        .bg-motorcare-brown { background-color: var(--motorcare-brown); }
        .text-motorcare-brown { color: var(--motorcare-brown); }
        .bg-motorcare-orange { background-color: var(--motorcare-orange); }
        .text-motorcare-orange { color: var(--motorcare-orange); }

        /* Hero Slider Styles */
        .hero-slide {
            opacity: 0;
            transition: opacity 1s ease-in-out;
            background-size: cover !important;
            background-position: center !important;
            background-repeat: no-repeat !important;
            z-index: 1;
        }
        .hero-slide.active {
            opacity: 1 !important;
            z-index: 2;
        }

        /* Ensure slider container is visible */
        #hero-slider {
            z-index: 1;
        }

        /* Debug: Make sure first slide is visible immediately */
        .hero-slide:first-child {
            opacity: 1;
        }
    </style>
</head>
<body class="bg-gray-50 font-sans">
    @include('partials.header')
    <!-- Hero Section -->
    <section class="relative h-[100vh] overflow-hidden">
        <!-- Hero Slider -->
        <div id="hero-slider" class="absolute inset-0 w-full h-full z-0">
            <div class="hero-slide active absolute inset-0 w-full h-full" style="background-image: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('/uploads/sliders/slider1.jpg'); background-size: cover; background-position: center; background-repeat: no-repeat; opacity: 1;"></div>
            <div class="hero-slide absolute inset-0 w-full h-full" style="background-image: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('/uploads/sliders/slider2.jpg'); background-size: cover; background-position: center; background-repeat: no-repeat; opacity: 0;"></div>
            <div class="hero-slide absolute inset-0 w-full h-full" style="background-image: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('/uploads/sliders/slider3.jpg'); background-size: cover; background-position: center; background-repeat: no-repeat; opacity: 0;"></div>
            <div class="hero-slide absolute inset-0 w-full h-full" style="background-image: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('/uploads/sliders/slider4.jpg'); background-size: cover; background-position: center; background-repeat: no-repeat; opacity: 0;"></div>
        </div>

        <!-- Navigation Dots -->
        <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 z-30 flex space-x-3">
            <button class="slider-dot active w-3 h-3 rounded-full bg-white bg-opacity-70 hover:bg-opacity-100 transition-all duration-300" data-slide="0"></button>
            <button class="slider-dot w-3 h-3 rounded-full bg-white bg-opacity-40 hover:bg-opacity-100 transition-all duration-300" data-slide="1"></button>
            <button class="slider-dot w-3 h-3 rounded-full bg-white bg-opacity-40 hover:bg-opacity-100 transition-all duration-300" data-slide="2"></button>
            <button class="slider-dot w-3 h-3 rounded-full bg-white bg-opacity-40 hover:bg-opacity-100 transition-all duration-300" data-slide="3"></button>
        </div>

        <!-- Content -->
        <div class="relative z-20 h-full flex items-center py-28">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full">
                <div class="max-w-2xl text-left text-white py-16">
                    <h1 class="text-3xl md:text-4xl font-bold mb-4 leading-tight">Drive Your Future with <span class="text-motorcare-orange">Motorcare</span></h1>
                    <div class="w-24 h-1 bg-motorcare-orange mb-4"></div>
                    <p class="text-lg md:text-xl mb-6 font-medium leading-relaxed">Premium automotive solutions and trusted service.<br>Discover the best in vehicle sales and maintenance.</p>
                    <div class="flex flex-col sm:flex-row gap-4">
                        <a href="#brands" class="px-8 py-3 rounded-full bg-motorcare-orange text-white font-semibold shadow hover:bg-orange-500 transition text-lg flex items-center justify-center gap-2"><i class="fas fa-car"></i> Explore Our Brands</a>
                        <a href="#contact" class="px-8 py-3 rounded-full border-2 border-white text-white font-semibold hover:bg-white hover:text-motorcare-brown transition text-lg flex items-center justify-center gap-2"><i class="fas fa-envelope"></i> Contact Us</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- About Us -->
    <section class="py-16 bg-white">
        <div class="max-w-4xl mx-auto px-4 text-center">
            <h2 class="text-3xl font-bold text-motorcare-brown mb-4">About Motorcare Uganda</h2>
            <div class="w-24 h-1 bg-motorcare-orange mx-auto mb-8"></div>

            <p class="text-gray-700 text-lg mb-8">Motorcare Uganda, part of the KJAER GROUP, is a leading car dealership offering top automotive services, parts, and fleet management solutions. With a legacy of excellence and a commitment to customer satisfaction, we bring you the best in vehicle sales, maintenance, and aftersales support.</p>



            <a href="#contact" class="inline-block px-8 py-3 rounded-full bg-motorcare-orange text-white font-semibold shadow hover:bg-orange-500 transition text-lg">
                <i class="fas fa-arrow-down mr-2"></i>Learn More
            </a>
        </div>
    </section>

    <!-- Our Services -->
    <section class="py-16 bg-gray-100">
        <div class="max-w-6xl mx-auto px-4">
            <h2 class="text-3xl font-bold text-motorcare-brown text-center mb-4">Our Services</h2>
            <div class="w-24 h-1 bg-motorcare-orange mx-auto mb-8"></div>
            <p class="text-gray-700 text-center text-lg mb-10 max-w-3xl mx-auto">Discover the comprehensive range of automotive services offered by Motorcare Uganda.</p>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Service 1 -->
                <div class="bg-white rounded-lg overflow-hidden shadow-md hover:shadow-lg transition-shadow duration-300 group">
                    <div class="h-1.5 bg-motorcare-orange w-0 group-hover:w-full transition-all duration-300"></div>
                    <div class="p-5">
                        <div class="w-14 h-14 rounded-full bg-gray-100 flex items-center justify-center mb-4 mx-auto">
                            <i class="fas fa-handshake text-2xl text-motorcare-orange"></i>
                        </div>
                        <h3 class="font-bold text-lg mb-2 text-center text-motorcare-brown">Full Maintenance Leasing</h3>
                        <p class="text-gray-600 text-sm text-center">Comprehensive leasing solutions with full maintenance.</p>
                    </div>
                </div>

                <!-- Service 2 -->
                <div class="bg-white rounded-lg overflow-hidden shadow-md hover:shadow-lg transition-shadow duration-300 group">
                    <div class="h-1.5 bg-motorcare-orange w-0 group-hover:w-full transition-all duration-300"></div>
                    <div class="p-5">
                        <div class="w-14 h-14 rounded-full bg-gray-100 flex items-center justify-center mb-4 mx-auto">
                            <i class="fas fa-tools text-2xl text-motorcare-orange"></i>
                        </div>
                        <h3 class="font-bold text-lg mb-2 text-center text-motorcare-brown">Automotive Repair</h3>
                        <p class="text-gray-600 text-sm text-center">Expert repair and servicing for various automotive issues.</p>
                    </div>
                </div>

                <!-- Service 3 -->
                <div class="bg-white rounded-lg overflow-hidden shadow-md hover:shadow-lg transition-shadow duration-300 group">
                    <div class="h-1.5 bg-motorcare-orange w-0 group-hover:w-full transition-all duration-300"></div>
                    <div class="p-5">
                        <div class="w-14 h-14 rounded-full bg-gray-100 flex items-center justify-center mb-4 mx-auto">
                            <i class="fas fa-wrench text-2xl text-motorcare-orange"></i>
                        </div>
                        <h3 class="font-bold text-lg mb-2 text-center text-motorcare-brown">Preventative Maintenance</h3>
                        <p class="text-gray-600 text-sm text-center">Regular checks to prevent future problems and extend vehicle life.</p>
                    </div>
                </div>

                <!-- Service 4 -->
                <div class="bg-white rounded-lg overflow-hidden shadow-md hover:shadow-lg transition-shadow duration-300 group">
                    <div class="h-1.5 bg-motorcare-orange w-0 group-hover:w-full transition-all duration-300"></div>
                    <div class="p-5">
                        <div class="w-14 h-14 rounded-full bg-gray-100 flex items-center justify-center mb-4 mx-auto">
                            <i class="fas fa-snowflake text-2xl text-motorcare-orange"></i>
                        </div>
                        <h3 class="font-bold text-lg mb-2 text-center text-motorcare-brown">Air Conditioning Service</h3>
                        <p class="text-gray-600 text-sm text-center">Keep your car's climate control system in top condition.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Cars Section -->
    <section class="py-16 bg-gray-50">
        <div class="max-w-6xl mx-auto px-4">
            <h2 class="text-3xl font-bold text-motorcare-brown text-center mb-4">Featured Cars</h2>
            <div class="w-24 h-1 bg-motorcare-orange mx-auto mb-8"></div>
            <p class="text-gray-700 text-center text-lg mb-10 max-w-3xl mx-auto">Explore our premium selection of vehicles from top manufacturers.</p>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Hyundai Vehicle -->
                <div class="group relative bg-white rounded-2xl overflow-hidden shadow-md hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2">
                    <div class="relative overflow-hidden">
                        <img src="/uploads/home/hyundai.jpg" alt="Hyundai Palisade" class="w-full h-72 object-cover group-hover:scale-110 transition-transform duration-500">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/50 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        <div class="absolute top-4 left-4 bg-motorcare-orange text-white px-3 py-1 rounded-full text-sm font-semibold">Featured</div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-motorcare-brown mb-3 group-hover:text-motorcare-orange transition-colors duration-300">Hyundai Palisade</h3>
                        <p class="text-gray-600 text-sm mb-4 line-clamp-2">Discover our range of reliable and stylish Hyundai vehicles, combining innovation with exceptional value.</p>
                        <div class="flex items-center justify-between">
                            <a href="#" class="text-motorcare-orange font-semibold hover:text-orange-500 transition text-sm">View Details</a>
                        </div>
                    </div>
                </div>

                <!-- Ford Vehicle -->
                <div class="group relative bg-white rounded-2xl overflow-hidden shadow-md hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2">
                    <div class="relative overflow-hidden">
                        <img src="/uploads/home/ford.jpg" alt="Ford Ranger" class="w-full h-72 object-cover group-hover:scale-110 transition-transform duration-500">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/50 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        <div class="absolute top-4 left-4 bg-motorcare-orange text-white px-3 py-1 rounded-full text-sm font-semibold">Featured</div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-motorcare-brown mb-3 group-hover:text-motorcare-orange transition-colors duration-300">Ford Ranger</h3>
                        <p class="text-gray-600 text-sm mb-4 line-clamp-2">Explore our collection of powerful and dependable Ford vehicles, built for performance and durability.</p>
                        <div class="flex items-center justify-between">
                            <a href="#" class="text-motorcare-orange font-semibold hover:text-orange-500 transition text-sm">View Details</a>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Request a Quote CTA -->
    <section class="py-16 relative overflow-hidden" style="background-image: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), url('https://backoffice.ford.ug/wp-content/uploads/2023/08/Banner-HP-Ford-Desktop-1920x655-3.webp'); background-size: cover; background-position: center; background-repeat: no-repeat;">
        <div class="max-w-4xl mx-auto px-4 text-center relative z-10">
            <h2 class="text-3xl font-bold text-white mb-4">Ready to Drive Your Dream Car?</h2>
            <p class="text-gray-200 text-lg mb-8">Get a personalized quote for your next vehicle.</p>

            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="#contact" class="px-8 py-3 rounded-full bg-motorcare-orange text-white font-semibold hover:bg-orange-500 transition">Request a Quote</a>
                <a href="tel:+256-XXX-XXXX" class="px-8 py-3 rounded-full border-2 border-white text-white font-semibold hover:bg-white hover:text-motorcare-brown transition">Call Us Now</a>
            </div>
        </div>
    </section>

    <!-- Move to Green -->
    <section class="py-16 bg-white">
        <div class="max-w-6xl mx-auto px-4 flex flex-col md:flex-row items-center gap-12">
            <!-- Image -->
            <div class="flex-1">
                <img src="/uploads/images/222.jpg" alt="Electric Vehicle" class="w-full h-80 object-cover rounded-lg shadow-lg" />
            </div>

            <!-- Content -->
            <div class="flex-1">
                <h2 class="text-3xl font-bold text-motorcare-brown mb-6">Move to Green with Motorcare</h2>

                <div class="space-y-4 text-gray-700 mb-8">
                    <p>It's our ambition to be a green company and move people to green transportation solutions.</p>

                    <p>One of our standout initiatives is the introduction of fully electric vehicles across all our brands. In a market where electric vehicles are still emerging, we've been pioneers in bringing this environmentally friendly option to Uganda through our move to green campaign, reducing the carbon footprint of our offerings.</p>
                </div>

                <a href="#contact" class="inline-block px-8 py-3 rounded-full bg-green-600 text-white font-semibold shadow hover:bg-green-700 transition">
                    <i class="fas fa-leaf mr-2"></i>Learn About Our Green Initiative
                </a>
            </div>
        </div>
    </section>

    <!-- Our Brands Carousel -->
    <section id="brands" class="py-4 bg-gray-50">
        <div class="w-full overflow-hidden relative pb-4">
            <div id="brands-carousel" class="flex items-center space-x-8 animate-brands-scroll">
                <div class="flex-shrink-0 w-56 h-40 bg-white rounded-xl shadow-lg hover:shadow-2xl border border-gray-100 p-6 flex items-center justify-center transition-all duration-300 transform hover:-translate-y-1">
                    <img src="/uploads/brands/brand1.jpg" alt="Brand 1" class="max-h-24 max-w-full w-auto object-contain grayscale hover:grayscale-0 transition-all duration-300" />
                </div>
                <div class="flex-shrink-0 w-56 h-40 bg-white rounded-xl shadow-lg hover:shadow-2xl border border-gray-100 p-6 flex items-center justify-center transition-all duration-300 transform hover:-translate-y-1">
                    <img src="/uploads/brands/brand2.jpg" alt="Brand 2" class="max-h-24 max-w-full w-auto object-contain grayscale hover:grayscale-0 transition-all duration-300" />
                </div>
                <div class="flex-shrink-0 w-56 h-40 bg-white rounded-xl shadow-lg hover:shadow-2xl border border-gray-100 p-6 flex items-center justify-center transition-all duration-300 transform hover:-translate-y-1">
                    <img src="/uploads/brands/brand3.png" alt="Brand 3" class="max-h-24 max-w-full w-auto object-contain grayscale hover:grayscale-0 transition-all duration-300" />
                </div>
                <div class="flex-shrink-0 w-56 h-40 bg-white rounded-xl shadow-lg hover:shadow-2xl border border-gray-100 p-6 flex items-center justify-center transition-all duration-300 transform hover:-translate-y-1">
                    <img src="/uploads/brands/brand4.png" alt="Brand 4" class="max-h-24 max-w-full w-auto object-contain grayscale hover:grayscale-0 transition-all duration-300" />
                </div>
                <div class="flex-shrink-0 w-56 h-40 bg-white rounded-xl shadow-lg hover:shadow-2xl border border-gray-100 p-6 flex items-center justify-center transition-all duration-300 transform hover:-translate-y-1">
                    <img src="/uploads/brands/brand5.png" alt="Brand 5" class="max-h-24 max-w-full w-auto object-contain grayscale hover:grayscale-0 transition-all duration-300" />
                </div>
                <!-- Repeat for smooth infinite effect -->
                <div class="flex-shrink-0 w-56 h-40 bg-white rounded-xl shadow-lg hover:shadow-2xl border border-gray-100 p-6 flex items-center justify-center transition-all duration-300 transform hover:-translate-y-1">
                    <img src="/uploads/brands/brand1.jpg" alt="Brand 1" class="max-h-24 max-w-full w-auto object-contain grayscale hover:grayscale-0 transition-all duration-300" />
                </div>
                <div class="flex-shrink-0 w-56 h-40 bg-white rounded-xl shadow-lg hover:shadow-2xl border border-gray-100 p-6 flex items-center justify-center transition-all duration-300 transform hover:-translate-y-1">
                    <img src="/uploads/brands/brand2.jpg" alt="Brand 2" class="max-h-24 max-w-full w-auto object-contain grayscale hover:grayscale-0 transition-all duration-300" />
                </div>
                <div class="flex-shrink-0 w-56 h-40 bg-white rounded-xl shadow-lg hover:shadow-2xl border border-gray-100 p-6 flex items-center justify-center transition-all duration-300 transform hover:-translate-y-1">
                    <img src="/uploads/brands/brand3.png" alt="Brand 3" class="max-h-24 max-w-full w-auto object-contain grayscale hover:grayscale-0 transition-all duration-300" />
                </div>
                <div class="flex-shrink-0 w-56 h-40 bg-white rounded-xl shadow-lg hover:shadow-2xl border border-gray-100 p-6 flex items-center justify-center transition-all duration-300 transform hover:-translate-y-1">
                    <img src="/uploads/brands/brand4.png" alt="Brand 4" class="max-h-24 max-w-full w-auto object-contain grayscale hover:grayscale-0 transition-all duration-300" />
                </div>
                <div class="flex-shrink-0 w-56 h-40 bg-white rounded-xl shadow-lg hover:shadow-2xl border border-gray-100 p-6 flex items-center justify-center transition-all duration-300 transform hover:-translate-y-1">
                    <img src="/uploads/brands/brand5.png" alt="Brand 5" class="max-h-24 max-w-full w-auto object-contain grayscale hover:grayscale-0 transition-all duration-300" />
                </div>
            </div>
        </div>
        <style>
            @keyframes brands-scroll {
                0% { transform: translateX(0); }
                100% { transform: translateX(-50%); }
            }
            .animate-brands-scroll {
                animation: brands-scroll 40s linear infinite;
                width: max-content;
            }
        </style>
    </section>

    @include('partials.footer')

    <!-- Hero Slider JavaScript -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const slides = document.querySelectorAll('.hero-slide');
            const dots = document.querySelectorAll('.slider-dot');
            let currentSlide = 0;
            let autoSlideInterval;

            console.log('Hero slider initialized with', slides.length, 'slides');

            function updateDots(activeIndex) {
                dots.forEach((dot, i) => {
                    dot.classList.remove('active');
                    if (i === activeIndex) {
                        dot.classList.add('active');
                        dot.classList.remove('bg-opacity-40');
                        dot.classList.add('bg-opacity-70');
                    } else {
                        dot.classList.remove('bg-opacity-70');
                        dot.classList.add('bg-opacity-40');
                    }
                });
            }

            function showSlide(index) {
                console.log('Showing slide', index);
                slides.forEach((slide, i) => {
                    slide.classList.remove('active');
                    slide.style.opacity = '0';
                    if (i === index) {
                        slide.classList.add('active');
                        slide.style.opacity = '1';
                    }
                });
                updateDots(index);
                currentSlide = index;
            }

            function nextSlide() {
                currentSlide = (currentSlide + 1) % slides.length;
                console.log('Moving to slide', currentSlide);
                showSlide(currentSlide);
            }

            function startAutoSlide() {
                autoSlideInterval = setInterval(nextSlide, 6000); // Slower: 6 seconds
            }

            function stopAutoSlide() {
                clearInterval(autoSlideInterval);
            }

            // Add click event listeners to dots
            dots.forEach((dot, index) => {
                dot.addEventListener('click', () => {
                    stopAutoSlide();
                    showSlide(index);
                    startAutoSlide(); // Restart auto-slide after manual navigation
                });
            });

            // Initialize first slide
            if (slides.length > 0) {
                showSlide(0);
                startAutoSlide();
            }
        });


    </script>
</body>
</html>