<!-- Top Bar -->
<div class="bg-motorcare-brown text-gray-100 text-sm py-2">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-between items-center">
        <div class="flex flex-wrap items-center space-x-6">
            <span class="flex items-center"><i class="fas fa-map-marker-alt text-motorcare-orange mr-2"></i>Plot 53 Kitgum House, Kampala
</span>
            <span class="flex items-center"><i class="fas fa-envelope text-motorcare-orange mr-2"></i>info@motorcareuganda.com</span>
            <span class="flex items-center"><i class="fas fa-phone-alt text-motorcare-orange mr-2"></i>+256 312 238100</span>
        </div>
        <div class="flex items-center space-x-4 text-lg">
            <a href="#" class="hover:text-motorcare-orange"><i class="fab fa-facebook-f"></i></a>
            <a href="#" class="hover:text-motorcare-orange"><i class="fab fa-twitter"></i></a>
            <a href="#" class="hover:text-motorcare-orange"><i class="fab fa-instagram"></i></a>
            <a href="#" class="hover:text-motorcare-orange"><i class="fab fa-tiktok"></i></a>
            <a href="#" class="hover:text-motorcare-orange"><i class="fab fa-youtube"></i></a>
        </div>
    </div>
</div>
<!-- Main Navbar -->
<nav class="bg-white text-gray-800 shadow-lg rounded-b-xl sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">
            <!-- Logo -->
            <div class="flex-shrink-0 flex items-center">
                <img class="h-12 w-auto mr-2 p-1" src="/uploads/logo/logo.png" alt="Motorcare Uganda Logo">
            </div>
            <!-- Desktop Menu -->
            <div class="hidden md:flex space-x-8 items-center">
                <a href="{{ route('home') }}" class="hover:text-motorcare-orange font-medium transition duration-200">Home</a>
                <a href="{{ route('about') }}" class="hover:text-motorcare-orange font-medium transition duration-200">About Us</a>
                <a href="{{ route('brands') }}" class="hover:text-motorcare-orange font-medium transition duration-200">Our Brands</a>
                <a href="{{ route('offices') }}" class="hover:text-motorcare-orange font-medium transition duration-200">Offices</a>
                <a href="{{ route('gallery') }}" class="hover:text-motorcare-orange font-medium transition duration-200">Gallery</a>
                <a href="{{ route('contact') }}" class="hover:text-motorcare-orange font-medium transition duration-200">Contact Us</a>
                <button id="menu-overlay-button" class="ml-4 text-2xl focus:outline-none">
                    <i class="fas fa-bars"></i>
                </button>
            </div>
            <!-- Mobile menu button -->
            <div class="md:hidden flex items-center">
                <button id="mobile-menu-button" class="focus:outline-none">
                    <svg class="h-7 w-7 text-gray-700" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
    <!-- Mobile Menu -->
    <div id="mobile-menu" class="md:hidden hidden px-4 pb-4 bg-white rounded-b-xl shadow-lg">
        <a href="{{ route('home') }}" class="block py-2 text-gray-800 hover:text-motorcare-orange font-medium transition">Home</a>
        <a href="{{ route('about') }}" class="block py-2 text-gray-800 hover:text-motorcare-orange font-medium transition">About Us</a>
        <a href="{{ route('brands') }}" class="block py-2 text-gray-800 hover:text-motorcare-orange font-medium transition">Our Brands</a>
        <a href="{{ route('offices') }}" class="block py-2 text-gray-800 hover:text-motorcare-orange font-medium transition">Offices</a>
        <a href="{{ route('gallery') }}" class="block py-2 text-gray-800 hover:text-motorcare-orange font-medium transition">Gallery</a>
        <a href="{{ route('contact') }}" class="block py-2 text-gray-800 hover:text-motorcare-orange font-medium transition">Contact Us</a>
    </div>
    <!-- Drawer Menu -->
    <div id="drawer-overlay" class="fixed inset-0 bg-black bg-opacity-40 z-50 hidden"></div>
    <aside id="drawer-menu" class="fixed top-0 right-0 h-full w-80 max-w-full bg-white shadow-lg z-50 transform translate-x-full transition-transform duration-300 flex flex-col">
        <button id="close-drawer" class="self-end m-6 text-3xl text-gray-700 hover:text-motorcare-orange focus:outline-none">
            <i class="fas fa-times"></i>
        </button>
        <!-- Search -->
        <div class="px-8 mt-2 mb-6">
            <input type="text" placeholder="Search..." class="w-full px-4 py-2 rounded bg-gray-100 text-gray-800 focus:outline-none focus:ring-2 focus:ring-motorcare-orange" />
        </div>
        <!-- Menu Links -->
        <nav class="flex-1 flex flex-col space-y-4 px-8">
            <a href="{{ route('home') }}" class="block text-lg text-gray-800 hover:text-motorcare-orange font-semibold transition">Home</a>
            <a href="{{ route('about') }}" class="block text-lg text-gray-800 hover:text-motorcare-orange font-semibold transition">About Us</a>
            <a href="{{ route('brands') }}" class="block text-lg text-gray-800 hover:text-motorcare-orange font-semibold transition">Our Brands</a>
            <a href="{{ route('offices') }}" class="block text-lg text-gray-800 hover:text-motorcare-orange font-semibold transition">Offices</a>
            <a href="{{ route('gallery') }}" class="block text-lg text-gray-800 hover:text-motorcare-orange font-semibold transition">Gallery</a>
            <a href="{{ route('contact') }}" class="block text-lg text-gray-800 hover:text-motorcare-orange font-semibold transition">Contact Us</a>
        </nav>
        <!-- Social Icons -->
        <div class="px-8 pb-8 mt-8">
            <div class="flex space-x-5">
                <a href="#" class="text-gray-400 hover:text-motorcare-orange text-2xl"><i class="fab fa-facebook-f"></i></a>
                <a href="#" class="text-gray-400 hover:text-motorcare-orange text-2xl"><i class="fab fa-twitter"></i></a>
                <a href="#" class="text-gray-400 hover:text-motorcare-orange text-2xl"><i class="fab fa-instagram"></i></a>
                <a href="#" class="text-gray-400 hover:text-motorcare-orange text-2xl"><i class="fab fa-tiktok"></i></a>
                <a href="#" class="text-gray-400 hover:text-motorcare-orange text-2xl"><i class="fab fa-youtube"></i></a>
            </div>
        </div>
    </aside>
    <script>
        // Mobile menu toggle
        document.addEventListener('DOMContentLoaded', function() {
            const btn = document.getElementById('mobile-menu-button');
            const menu = document.getElementById('mobile-menu');
            btn.addEventListener('click', function() {
                menu.classList.toggle('hidden');
            });
        });
        document.addEventListener('DOMContentLoaded', function() {
            const drawerBtn = document.getElementById('menu-overlay-button');
            const drawer = document.getElementById('drawer-menu');
            const drawerOverlay = document.getElementById('drawer-overlay');
            const closeDrawer = document.getElementById('close-drawer');
            function openDrawer() {
                drawer.classList.remove('translate-x-full');
                drawer.classList.add('translate-x-0');
                drawerOverlay.classList.remove('hidden');
            }
            function closeDrawerFn() {
                drawer.classList.add('translate-x-full');
                drawer.classList.remove('translate-x-0');
                drawerOverlay.classList.add('hidden');
            }
            drawerBtn.addEventListener('click', openDrawer);
            closeDrawer.addEventListener('click', closeDrawerFn);
            drawerOverlay.addEventListener('click', closeDrawerFn);
        });
    </script>
</nav>