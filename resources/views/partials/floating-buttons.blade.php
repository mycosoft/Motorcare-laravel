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
document.addEventListener('DOMContentLoaded', function() {
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
    window.scrollToTop = function() {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    }

    // Contact Menu Toggle Functionality
    let contactMenuOpen = false;
    const contactMenu = document.getElementById('contactMenu');
    const contactButton = document.getElementById('contactButton');

    window.toggleContactMenu = function() {
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
});
</script>
