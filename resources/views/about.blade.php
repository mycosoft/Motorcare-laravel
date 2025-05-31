<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - Motorcare Uganda</title>
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
            <h1 class="text-5xl font-bold mb-6">About Motorcare Uganda</h1>
            <p class="text-xl text-gray-200 max-w-3xl mx-auto">Pioneering automotive solutions in Uganda since 1977</p>
        </div>
    </section>

    <!-- Background History Section -->
    <section class="py-16 bg-white">
        <div class="max-w-6xl mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-motorcare-brown mb-4">Background History</h2>
                <div class="w-24 h-1 bg-motorcare-orange mx-auto"></div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div class="space-y-6">
                    <div class="bg-gray-50 p-6 rounded-xl border-l-4 border-motorcare-orange">
                        <h3 class="text-xl font-bold text-motorcare-brown mb-3">1962 - The Beginning</h3>
                        <p class="text-gray-700">Christian Kjaer laid the cornerstone of what would later evolve into KJAER GROUP, establishing RENAULT KJAER, a local dealership in Svendborg, Denmark. Despite modest beginnings, Christian's vision and determination propelled RENAULT KJAER to prominence.</p>
                    </div>

                    <div class="bg-gray-50 p-6 rounded-xl border-l-4 border-motorcare-orange">
                        <h3 class="text-xl font-bold text-motorcare-brown mb-3">1977 - Global Expansion</h3>
                        <p class="text-gray-700">Export activities commenced with an order from the Danish Volunteer Service in Zambia, laying the groundwork for our global reach. In 1980, the company relocated to modern facilities in Svendborg's industrial hub.</p>
                    </div>

                    <div class="bg-gray-50 p-6 rounded-xl border-l-4 border-motorcare-orange">
                        <h3 class="text-xl font-bold text-motorcare-brown mb-3">1995 - Motorcare Uganda</h3>
                        <p class="text-gray-700">The offices matured into MOTORCARE Uganda for official Nissan distribution in 1995 and later acquired Ford and Hyundai in 2023, establishing our strong presence in the Ugandan automotive market.</p>
                    </div>
                </div>

                <div class="space-y-6">
                    <!-- Image Carousel -->
                    <div class="relative overflow-hidden rounded-2xl shadow-2xl">
                        <div id="historyCarousel" class="flex transition-transform duration-500 ease-in-out">
                            <!-- Slide 1 -->
                            <div class="w-full flex-shrink-0 relative">
                                <img src="/uploads/about/history1.jpg" alt="Early Adventures" class="w-full h-96 object-cover">
                                <div class="absolute inset-0 bg-gradient-to-r from-black/70 via-black/30 to-transparent"></div>
                                <div class="absolute inset-0 flex items-center">
                                    <div class="text-white p-8 max-w-lg">
                                        <div class="flex items-center mb-4">
                                            <div class="w-12 h-1 bg-motorcare-orange mr-4"></div>
                                            <span class="text-motorcare-orange font-semibold">1960s Era</span>
                                        </div>
                                        <h4 class="text-3xl font-bold mb-4">Early Adventures</h4>
                                        <p class="text-gray-200 text-lg leading-relaxed">Pioneering off-road expeditions that established our reputation for reliability and adventure in challenging terrains.</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Slide 2 -->
                            <div class="w-full flex-shrink-0 relative">
                                <img src="/uploads/about/history2.jpg" alt="Rally Heritage" class="w-full h-96 object-cover">
                                <div class="absolute inset-0 bg-gradient-to-r from-black/70 via-black/30 to-transparent"></div>
                                <div class="absolute inset-0 flex items-center">
                                    <div class="text-white p-8 max-w-lg">
                                        <div class="flex items-center mb-4">
                                            <div class="w-12 h-1 bg-motorcare-orange mr-4"></div>
                                            <span class="text-motorcare-orange font-semibold">1970s Era</span>
                                        </div>
                                        <h4 class="text-3xl font-bold mb-4">Rally Heritage</h4>
                                        <p class="text-gray-200 text-lg leading-relaxed">Our motorsport legacy forged through competitive racing and challenging rally events across diverse landscapes.</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Slide 3 -->
                            <div class="w-full flex-shrink-0 relative">
                                <img src="/uploads/about/history3.jpg" alt="Early Showroom" class="w-full h-96 object-cover">
                                <div class="absolute inset-0 bg-gradient-to-r from-black/70 via-black/30 to-transparent"></div>
                                <div class="absolute inset-0 flex items-center">
                                    <div class="text-white p-8 max-w-lg">
                                        <div class="flex items-center mb-4">
                                            <div class="w-12 h-1 bg-motorcare-orange mr-4"></div>
                                            <span class="text-motorcare-orange font-semibold">1980s Era</span>
                                        </div>
                                        <h4 class="text-3xl font-bold mb-4">First Showroom</h4>
                                        <p class="text-gray-200 text-lg leading-relaxed">The foundation of our retail presence, establishing the standards for customer service excellence that continue today.</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Slide 4 -->
                            <div class="w-full flex-shrink-0 relative">
                                <img src="/uploads/about/history4.jpg" alt="Modern Team" class="w-full h-96 object-cover">
                                <div class="absolute inset-0 bg-gradient-to-r from-black/70 via-black/30 to-transparent"></div>
                                <div class="absolute inset-0 flex items-center">
                                    <div class="text-white p-8 max-w-lg">
                                        <div class="flex items-center mb-4">
                                            <div class="w-12 h-1 bg-motorcare-orange mr-4"></div>
                                            <span class="text-motorcare-orange font-semibold">2020s Era</span>
                                        </div>
                                        <h4 class="text-3xl font-bold mb-4">Modern Excellence</h4>
                                        <p class="text-gray-200 text-lg leading-relaxed">Today's dedicated professionals continuing our legacy with innovation, sustainability, and unwavering commitment to quality.</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Navigation Arrows -->
                        <button onclick="previousSlide()" class="absolute left-4 top-1/2 transform -translate-y-1/2 bg-white/20 hover:bg-white/30 backdrop-blur-sm text-white p-3 rounded-full transition-all duration-300">
                            <i class="fas fa-chevron-left text-xl"></i>
                        </button>
                        <button onclick="nextSlide()" class="absolute right-4 top-1/2 transform -translate-y-1/2 bg-white/20 hover:bg-white/30 backdrop-blur-sm text-white p-3 rounded-full transition-all duration-300">
                            <i class="fas fa-chevron-right text-xl"></i>
                        </button>

                        <!-- Dots Navigation -->
                        <div class="absolute bottom-6 left-1/2 transform -translate-x-1/2 flex space-x-3">
                            <button onclick="goToSlide(0)" class="w-3 h-3 rounded-full bg-white/50 hover:bg-white transition-all duration-300 dot active"></button>
                            <button onclick="goToSlide(1)" class="w-3 h-3 rounded-full bg-white/50 hover:bg-white transition-all duration-300 dot"></button>
                            <button onclick="goToSlide(2)" class="w-3 h-3 rounded-full bg-white/50 hover:bg-white transition-all duration-300 dot"></button>
                            <button onclick="goToSlide(3)" class="w-3 h-3 rounded-full bg-white/50 hover:bg-white transition-all duration-300 dot"></button>
                        </div>
                    </div>

                    <!-- Heritage Stats -->
                    <div class="grid grid-cols-3 gap-4">
                        <div class="bg-motorcare-orange/10 border border-motorcare-orange/30 rounded-xl p-4 text-center">
                            <h5 class="text-2xl font-bold text-motorcare-brown">60+</h5>
                            <p class="text-gray-600 text-sm">Years of Excellence</p>
                        </div>
                        <div class="bg-motorcare-orange/10 border border-motorcare-orange/30 rounded-xl p-4 text-center">
                            <h5 class="text-2xl font-bold text-motorcare-brown">3</h5>
                            <p class="text-gray-600 text-sm">Major Brands</p>
                        </div>
                        <div class="bg-motorcare-orange/10 border border-motorcare-orange/30 rounded-xl p-4 text-center">
                            <h5 class="text-2xl font-bold text-motorcare-brown">1000+</h5>
                            <p class="text-gray-600 text-sm">Happy Customers</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Historical Gallery Section -->
    <section class="py-16 bg-gray-50">
        <div class="max-w-6xl mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-motorcare-brown mb-4">Our Heritage Gallery</h2>
                <div class="w-24 h-1 bg-motorcare-orange mx-auto mb-6"></div>
                <p class="text-gray-600 max-w-2xl mx-auto">A visual journey through decades of automotive excellence and memorable moments</p>
            </div>

            <!-- Polaroid/Vintage Style Layout - 4 in a Row -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 justify-items-center">
                <!-- Photo 1 -->
                <div class="group relative transform rotate-2 hover:rotate-0 transition-all duration-500 hover:scale-110 hover:z-10">
                    <div class="bg-white p-4 pb-16 shadow-2xl hover:shadow-3xl transition-shadow duration-300" style="box-shadow: 0 20px 40px rgba(0,0,0,0.15);">
                        <img src="/uploads/about/history1.jpg" alt="Early Adventures" class="w-72 h-56 object-cover">
                        <div class="absolute bottom-4 left-4 right-4 text-center">
                            <p class="text-gray-800 font-handwriting text-lg" style="font-family: 'Kalam', cursive;">Early Adventures - 1960s</p>
                        </div>
                        <!-- Tape effect -->
                        <div class="absolute -top-2 left-8 w-16 h-6 bg-yellow-200/80 transform -rotate-12 rounded-sm"></div>
                    </div>
                </div>

                <!-- Photo 2 -->
                <div class="group relative transform -rotate-1 hover:rotate-0 transition-all duration-500 hover:scale-110 hover:z-10">
                    <div class="bg-white p-4 pb-16 shadow-2xl hover:shadow-3xl transition-shadow duration-300" style="box-shadow: 0 20px 40px rgba(0,0,0,0.15);">
                        <img src="/uploads/about/history2.jpg" alt="Rally Heritage" class="w-72 h-56 object-cover">
                        <div class="absolute bottom-4 left-4 right-4 text-center">
                            <p class="text-gray-800 font-handwriting text-lg" style="font-family: 'Kalam', cursive;">Rally Heritage - 1970s</p>
                        </div>
                        <!-- Tape effect -->
                        <div class="absolute -top-2 right-8 w-16 h-6 bg-yellow-200/80 transform rotate-12 rounded-sm"></div>
                    </div>
                </div>

                <!-- Photo 3 -->
                <div class="group relative transform rotate-1 hover:rotate-0 transition-all duration-500 hover:scale-110 hover:z-10">
                    <div class="bg-white p-4 pb-16 shadow-2xl hover:shadow-3xl transition-shadow duration-300" style="box-shadow: 0 20px 40px rgba(0,0,0,0.15);">
                        <img src="/uploads/about/history3.jpg" alt="Early Showroom" class="w-72 h-56 object-cover">
                        <div class="absolute bottom-4 left-4 right-4 text-center">
                            <p class="text-gray-800 font-handwriting text-lg" style="font-family: 'Kalam', cursive;">First Showroom - 1980s</p>
                        </div>
                        <!-- Tape effect -->
                        <div class="absolute -top-2 left-12 w-16 h-6 bg-yellow-200/80 transform -rotate-6 rounded-sm"></div>
                    </div>
                </div>

                <!-- Photo 4 -->
                <div class="group relative transform -rotate-2 hover:rotate-0 transition-all duration-500 hover:scale-110 hover:z-10">
                    <div class="bg-white p-4 pb-16 shadow-2xl hover:shadow-3xl transition-shadow duration-300" style="box-shadow: 0 20px 40px rgba(0,0,0,0.15);">
                        <img src="/uploads/about/history4.jpg" alt="Modern Team" class="w-72 h-56 object-cover">
                        <div class="absolute bottom-4 left-4 right-4 text-center">
                            <p class="text-gray-800 font-handwriting text-lg" style="font-family: 'Kalam', cursive;">Modern Excellence - 2020s</p>
                        </div>
                        <!-- Tape effect -->
                        <div class="absolute -top-2 right-12 w-16 h-6 bg-yellow-200/80 transform rotate-6 rounded-sm"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Mission & Vision Section -->
    <section class="py-16 bg-gray-100">
        <div class="max-w-6xl mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-motorcare-brown mb-4">Our Mission & Vision</h2>
                <div class="w-24 h-1 bg-motorcare-orange mx-auto"></div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Mission -->
                <div class="bg-white rounded-xl p-8 hover:shadow-lg transition-shadow duration-300">
                    <div class="flex items-center mb-6">
                        <div class="w-16 h-16 bg-motorcare-orange rounded-full flex items-center justify-center mr-4">
                            <i class="fas fa-bullseye text-white text-2xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-motorcare-brown">Our Mission</h3>
                    </div>
                    <p class="text-gray-700 leading-relaxed">Top quality automotive services and green transportation solutions in emerging countries.</p>
                </div>

                <!-- Vision -->
                <div class="bg-white rounded-xl p-8 hover:shadow-lg transition-shadow duration-300">
                    <div class="flex items-center mb-6">
                        <div class="w-16 h-16 bg-motorcare-orange rounded-full flex items-center justify-center mr-4">
                            <i class="fas fa-eye text-white text-2xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-motorcare-brown">Our Vision</h3>
                    </div>
                    <p class="text-gray-700 leading-relaxed">It's our ambition to be a green company and move people to green transportation solutions.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Executive Management Section -->
    <section class="py-16 bg-white">
        <div class="max-w-6xl mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-motorcare-brown mb-4">Executive Management</h2>
                <div class="w-24 h-1 bg-motorcare-orange mx-auto"></div>
            </div>

            <div class="grid grid-cols-5 gap-6">
                <!-- Florence S Makada -->
                <div class="text-center">
                    <div class="w-full h-80 mb-4 overflow-hidden bg-gray-200 shadow-lg">
                        <img src="/uploads/team/florence.jpg" alt="Florence S Makada" class="w-full h-full object-cover">
                    </div>
                    <div class="bg-gray-600 text-white p-3">
                        <h4 class="font-bold text-sm mb-1">FLORENCE S MAKADA</h4>
                        <p class="text-gray-300 text-xs">Managing Director</p>
                    </div>
                </div>

                <!-- David Nyoike -->
                <div class="text-center">
                    <div class="w-full h-80 mb-4 overflow-hidden bg-gray-200 shadow-lg">
                        <img src="/uploads/team/david.jpg" alt="David Nyoike" class="w-full h-full object-cover">
                    </div>
                    <div class="bg-gray-600 text-white p-3">
                        <h4 class="font-bold text-sm mb-1">DAVID NYOIKE</h4>
                        <p class="text-gray-300 text-xs">National Aftersales Manager</p>
                    </div>
                </div>

                <!-- Benon Mascot -->
                <div class="text-center">
                    <div class="w-full h-80 mb-4 overflow-hidden bg-gray-200 shadow-lg">
                        <img src="/uploads/team/benon.jpg" alt="Benon Mascot" class="w-full h-full object-cover">
                    </div>
                    <div class="bg-gray-600 text-white p-3">
                        <h4 class="font-bold text-sm mb-1">BENON MASCOT</h4>
                        <p class="text-gray-300 text-xs">Deputy General Manager</p>
                    </div>
                </div>

                <!-- Phillip Candwong -->
                <div class="text-center">
                    <div class="w-full h-80 mb-4 overflow-hidden bg-gray-200 shadow-lg">
                        <img src="/uploads/team/phillip.jpg" alt="Phillip Candwong" class="w-full h-full object-cover">
                    </div>
                    <div class="bg-gray-600 text-white p-3">
                        <h4 class="font-bold text-sm mb-1">PHILLIP CANDWONG</h4>
                        <p class="text-gray-300 text-xs">Finance Manager</p>
                    </div>
                </div>

                <!-- Patrick Kayizzi -->
                <div class="text-center">
                    <div class="w-full h-80 mb-4 overflow-hidden bg-gray-200 shadow-lg">
                        <img src="/uploads/team/patrick.jpg" alt="Patrick Kayizzi" class="w-full h-full object-cover">
                    </div>
                    <div class="bg-gray-600 text-white p-3">
                        <h4 class="font-bold text-sm mb-1">PATRICK KAYIZZI</h4>
                        <p class="text-gray-300 text-xs">Sales Manager</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Whistleblowing Call-to-Action Section -->
    <section class="py-16 bg-gray-100">
        <div class="max-w-4xl mx-auto px-4 text-center">
            <h2 class="text-3xl font-bold text-motorcare-brown mb-4">Whistleblowing</h2>
            <div class="w-24 h-1 bg-motorcare-orange mx-auto mb-8"></div>

            <p class="text-gray-700 text-lg mb-6 max-w-3xl mx-auto">KJAER GROUP is committed to conducting business with integrity and doing the right thing for our customers, colleagues and society.</p>
            <p class="text-gray-600 mb-8 max-w-3xl mx-auto">We encourage all those who have serious concerns they wish to report, to make use of our Whistleblowing Scheme, where they can report in confidence and – if they choose to do so – anonymously.</p>

            <a href="https://kjaergroup.integrityline.com/frontpage" target="_blank" class="inline-flex items-center px-8 py-3 bg-motorcare-orange text-white font-semibold rounded-lg hover:bg-orange-500 transition-colors duration-300">
                Report Here
                <i class="fas fa-external-link-alt ml-2"></i>
            </a>
        </div>
    </section>


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
        // History Carousel Functionality
        let currentSlide = 0;
        const totalSlides = 4;
        const carousel = document.getElementById('historyCarousel');
        const dots = document.querySelectorAll('.dot');

        function updateCarousel() {
            const translateX = -currentSlide * 100;
            carousel.style.transform = `translateX(${translateX}%)`;

            // Update dots
            dots.forEach((dot, index) => {
                if (index === currentSlide) {
                    dot.classList.add('active');
                    dot.style.backgroundColor = 'white';
                } else {
                    dot.classList.remove('active');
                    dot.style.backgroundColor = 'rgba(255, 255, 255, 0.5)';
                }
            });
        }

        function nextSlide() {
            currentSlide = (currentSlide + 1) % totalSlides;
            updateCarousel();
        }

        function previousSlide() {
            currentSlide = (currentSlide - 1 + totalSlides) % totalSlides;
            updateCarousel();
        }

        function goToSlide(slideIndex) {
            currentSlide = slideIndex;
            updateCarousel();
        }

        // Auto-advance carousel every 5 seconds
        setInterval(nextSlide, 5000);

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
