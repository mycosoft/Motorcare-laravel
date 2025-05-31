<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - Motorcare Uganda</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Kalam:wght@300;400;700&display=swap" rel="stylesheet">
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
            <h1 class="text-5xl font-bold mb-6">Contact Us</h1>
            <p class="text-xl text-gray-200 max-w-3xl mx-auto">Get in touch with our team for all your automotive needs</p>
        </div>
    </section>

    <!-- Contact Information Section -->
    <section class="py-14 bg-white">
        <div class="max-w-6xl mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-motorcare-brown mb-4">Get In Touch</h2>
                <div class="w-24 h-1 bg-motorcare-orange mx-auto mb-6"></div>
                <p class="text-gray-600 max-w-2xl mx-auto">We're here to help with all your automotive needs. Reach out to us through any of the following channels.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-10">
                <!-- Location 1 -->
                <div class="text-center group">
                    <div class="w-20 h-20 bg-motorcare-orange/10 rounded-2xl flex items-center justify-center mx-auto mb-4 group-hover:bg-motorcare-orange group-hover:scale-110 transition-all duration-300">
                        <i class="fas fa-map-marker-alt text-motorcare-orange group-hover:text-white text-2xl transition-colors duration-300"></i>
                    </div>
                    <h4 class="text-lg font-bold text-motorcare-brown mb-2">Jinja Road Branch</h4>
                    <p class="text-gray-600 text-sm">Plot 95 Jinja Road<br>Kampala, Uganda</p>
                </div>

                <!-- Location 2 -->
                <div class="text-center group">
                    <div class="w-20 h-20 bg-motorcare-orange/10 rounded-2xl flex items-center justify-center mx-auto mb-4 group-hover:bg-motorcare-orange group-hover:scale-110 transition-all duration-300">
                        <i class="fas fa-building text-motorcare-orange group-hover:text-white text-2xl transition-colors duration-300"></i>
                    </div>
                    <h4 class="text-lg font-bold text-motorcare-brown mb-2">Motorcare Ford Uganda</h4>
                    <p class="text-gray-600 text-sm">Kitgum House<br>Kampala, Uganda</p>
                </div>

                <!-- Phone -->
                <div class="text-center group">
                    <div class="w-20 h-20 bg-motorcare-orange/10 rounded-2xl flex items-center justify-center mx-auto mb-4 group-hover:bg-motorcare-orange group-hover:scale-110 transition-all duration-300">
                        <i class="fas fa-phone text-motorcare-orange group-hover:text-white text-2xl transition-colors duration-300"></i>
                    </div>
                    <h4 class="text-lg font-bold text-motorcare-brown mb-2">Call Us</h4>
                    <p class="text-gray-600 text-sm">0312 238100<br>0392 044244</p>
                </div>

                <!-- Email -->
                <div class="text-center group">
                    <div class="w-20 h-20 bg-motorcare-orange/10 rounded-2xl flex items-center justify-center mx-auto mb-4 group-hover:bg-motorcare-orange group-hover:scale-110 transition-all duration-300">
                        <i class="fas fa-envelope text-motorcare-orange group-hover:text-white text-2xl transition-colors duration-300"></i>
                    </div>
                    <h4 class="text-lg font-bold text-motorcare-brown mb-2">Email Us</h4>
                    <p class="text-gray-600 text-sm">info@motorcareuganda.com<br>sales@motorcareuganda.com</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Form & Map Section -->
    <section class="py-16 bg-gray-100">
        <div class="max-w-6xl mx-auto px-4">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                <!-- Contact Form -->
                <div class="bg-white rounded-2xl shadow-lg p-8">
                    <h3 class="text-2xl font-bold text-motorcare-brown mb-6">Send us a Message</h3>

                    <!-- Success/Error Messages -->
                    @if(session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-6">
                            <div class="flex items-center">
                                <i class="fas fa-check-circle mr-2"></i>
                                {{ session('success') }}
                            </div>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-6">
                            <div class="flex items-center">
                                <i class="fas fa-exclamation-circle mr-2"></i>
                                {{ session('error') }}
                            </div>
                        </div>
                    @endif

                    <form action="{{ route('contact.submit') }}" method="POST" class="space-y-6">
                        @csrf

                        <!-- Name -->
                        <div>
                            <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">Full Name *</label>
                            <input type="text"
                                   id="name"
                                   name="name"
                                   value="{{ old('name') }}"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-motorcare-orange focus:border-transparent transition-colors duration-300 @error('name') border-red-500 @enderror"
                                   placeholder="Enter your full name"
                                   required>
                            @error('name')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div>
                            <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">Email Address *</label>
                            <input type="email"
                                   id="email"
                                   name="email"
                                   value="{{ old('email') }}"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-motorcare-orange focus:border-transparent transition-colors duration-300 @error('email') border-red-500 @enderror"
                                   placeholder="Enter your email address"
                                   required>
                            @error('email')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Phone -->
                        <div>
                            <label for="phone" class="block text-sm font-semibold text-gray-700 mb-2">Phone Number</label>
                            <input type="tel"
                                   id="phone"
                                   name="phone"
                                   value="{{ old('phone') }}"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-motorcare-orange focus:border-transparent transition-colors duration-300 @error('phone') border-red-500 @enderror"
                                   placeholder="Enter your phone number">
                            @error('phone')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Inquiry Type -->
                        <div>
                            <label for="inquiry_type" class="block text-sm font-semibold text-gray-700 mb-2">Inquiry Type *</label>
                            <select id="inquiry_type"
                                    name="inquiry_type"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-motorcare-orange focus:border-transparent transition-colors duration-300 @error('inquiry_type') border-red-500 @enderror"
                                    required>
                                <option value="">Select inquiry type</option>
                                <option value="general" {{ old('inquiry_type') == 'general' ? 'selected' : '' }}>General Inquiry</option>
                                <option value="sales" {{ old('inquiry_type') == 'sales' ? 'selected' : '' }}>Vehicle Sales</option>
                                <option value="service" {{ old('inquiry_type') == 'service' ? 'selected' : '' }}>Service & Maintenance</option>
                                <option value="parts" {{ old('inquiry_type') == 'parts' ? 'selected' : '' }}>Parts & Accessories</option>
                            </select>
                            @error('inquiry_type')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Subject -->
                        <div>
                            <label for="subject" class="block text-sm font-semibold text-gray-700 mb-2">Subject *</label>
                            <input type="text"
                                   id="subject"
                                   name="subject"
                                   value="{{ old('subject') }}"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-motorcare-orange focus:border-transparent transition-colors duration-300 @error('subject') border-red-500 @enderror"
                                   placeholder="Enter message subject"
                                   required>
                            @error('subject')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Message -->
                        <div>
                            <label for="message" class="block text-sm font-semibold text-gray-700 mb-2">Message *</label>
                            <textarea id="message"
                                      name="message"
                                      rows="5"
                                      class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-motorcare-orange focus:border-transparent transition-colors duration-300 @error('message') border-red-500 @enderror"
                                      placeholder="Enter your message"
                                      required>{{ old('message') }}</textarea>
                            @error('message')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <button type="submit"
                                class="w-full bg-motorcare-orange text-white font-semibold py-3 px-6 rounded-lg hover:bg-orange-500 transition-colors duration-300 flex items-center justify-center">
                            <i class="fas fa-paper-plane mr-2"></i>
                            Send Message
                        </button>
                    </form>
                </div>

                <!-- Map & Additional Info -->
                <div class="space-y-8">
                    <!-- Map -->
                    <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                        <div class="p-6 border-b border-gray-200">
                            <h3 class="text-xl font-bold text-motorcare-brown">Find Us</h3>
                        </div>
                        <div class="h-80 relative">
                            <iframe
                                src="https://www.google.com/maps?q=Kitgum+House+Kampala+Uganda&output=embed"
                                width="100%"
                                height="100%"
                                style="border:0;"
                                allowfullscreen=""
                                loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade"
                                class="rounded-b-2xl">
                            </iframe>
                            <!-- Fallback for when maps don't load -->
                            <div class="absolute inset-0 bg-gray-200 flex items-center justify-center rounded-b-2xl" style="z-index: -1;">
                                <div class="text-center">
                                    <i class="fas fa-map-marked-alt text-4xl text-gray-400 mb-2"></i>
                                    <p class="text-gray-500">Motorcare Ford Uganda</p>
                                    <p class="text-sm text-gray-400">Kitgum House, Kampala</p>
                                    <a href="https://maps.google.com/?q=Kitgum+House+Kampala+Uganda"
                                       target="_blank"
                                       class="text-motorcare-orange hover:text-orange-500 text-sm mt-2 inline-block">
                                        <i class="fas fa-external-link-alt mr-1"></i>
                                        Open in Google Maps
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Business Hours -->
                    <div class="bg-white rounded-2xl shadow-lg p-6">
                        <h3 class="text-xl font-bold text-motorcare-brown mb-4">Business Hours</h3>
                        <div class="space-y-3">
                            <div class="flex justify-between items-center">
                                <span class="text-gray-600">Monday - Friday</span>
                                <span class="font-semibold text-motorcare-brown">8:00 AM - 6:00 PM</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-gray-600">Saturday</span>
                                <span class="font-semibold text-motorcare-brown">8:00 AM - 4:00 PM</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-gray-600">Sunday</span>
                                <span class="font-semibold text-red-500">Closed</span>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Contact -->
                    <div class="bg-motorcare-brown rounded-2xl shadow-lg p-6 text-white">
                        <h3 class="text-xl font-bold mb-4">Need Immediate Assistance?</h3>
                        <div class="space-y-3">
                            <a href="tel:+256312238100" class="flex items-center hover:text-gray-300 transition-colors duration-300">
                                <i class="fas fa-phone mr-3"></i>
                                <span>Call: 0312 238100</span>
                            </a>
                            <a href="https://wa.me/256312238100" target="_blank" class="flex items-center hover:text-gray-300 transition-colors duration-300">
                                <i class="fab fa-whatsapp mr-3"></i>
                                <span>WhatsApp Us</span>
                            </a>
                            <a href="mailto:info@motorcareuganda.com" class="flex items-center hover:text-gray-300 transition-colors duration-300">
                                <i class="fas fa-envelope mr-3"></i>
                                <span>Email Us</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('partials.footer')

    <script>
        // Form Enhancement
        document.addEventListener('DOMContentLoaded', function() {
            // Auto-hide success/error messages after 5 seconds
            const alerts = document.querySelectorAll('.bg-green-100, .bg-red-100');
            alerts.forEach(alert => {
                setTimeout(() => {
                    alert.style.transition = 'opacity 0.5s ease-out';
                    alert.style.opacity = '0';
                    setTimeout(() => {
                        alert.remove();
                    }, 500);
                }, 5000);
            });

            // Form validation enhancement
            const form = document.querySelector('form');
            const submitButton = form.querySelector('button[type="submit"]');

            form.addEventListener('submit', function() {
                submitButton.disabled = true;
                submitButton.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Sending...';
            });
        });
    </script>
</body>
</html>
