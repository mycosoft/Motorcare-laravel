<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Our Brands - Motorcare Uganda</title>
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
            <h1 class="text-5xl font-bold mb-6">Our Brands</h1>
            <p class="text-xl text-gray-200 max-w-3xl mx-auto">Representing world-class automotive brands in Uganda</p>
        </div>
    </section>

    <!-- Brands Showcase Section -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4">
            @if($brands->count() > 0)
                <!-- Masonry Style Brand Grid -->
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-6">
                    @foreach($brands as $brand)
                        <div class="group relative bg-white rounded-3xl shadow-md hover:shadow-2xl transition-all duration-700 overflow-hidden transform hover:-translate-y-3 hover:rotate-1">
                            <!-- Brand Card -->
                            <div class="relative aspect-square p-6 bg-gradient-to-br from-gray-50 via-white to-gray-100 flex flex-col items-center justify-center">
                                <!-- Brand Logo -->
                                <div class="relative w-full h-32 mb-4 flex items-center justify-center">
                                    <img src="{{ $brand->logo_url }}"
                                         alt="{{ $brand->name }}"
                                         class="max-w-full max-h-full object-contain group-hover:scale-125 transition-transform duration-700 filter group-hover:brightness-110">
                                </div>

                                <!-- Brand Name -->
                                <h3 class="text-lg font-bold text-motorcare-brown text-center mb-2 group-hover:text-motorcare-orange transition-colors duration-300">
                                    {{ $brand->name }}
                                </h3>

                                <!-- Hover Overlay -->
                                <div class="absolute inset-0 bg-gradient-to-t from-motorcare-orange/0 via-transparent to-transparent group-hover:from-motorcare-orange/10 transition-all duration-500"></div>

                                <!-- Action Button (appears on hover) -->
                                @if($brand->link)
                                    <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                                        <a href="{{ $brand->link }}"
                                           target="_blank"
                                           class="bg-motorcare-orange text-white px-4 py-2 rounded-full text-sm font-semibold hover:bg-orange-500 transition-colors duration-300 transform translate-y-4 group-hover:translate-y-0">
                                            <i class="fas fa-external-link-alt mr-1"></i>
                                            Visit
                                        </a>
                                    </div>
                                @endif

                                <!-- Decorative Corner -->
                                <div class="absolute top-3 right-3 w-3 h-3 bg-motorcare-orange/20 rounded-full group-hover:bg-motorcare-orange/40 transition-colors duration-300"></div>
                            </div>

                            <!-- Bottom Accent -->
                            <div class="h-1 bg-gradient-to-r from-transparent via-motorcare-orange to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                        </div>
                    @endforeach
                </div>
            @else
                <!-- No Brands Available -->
                <div class="text-center py-20">
                    <div class="w-32 h-32 bg-gradient-to-br from-gray-100 to-gray-200 rounded-full flex items-center justify-center mx-auto mb-8">
                        <i class="fas fa-car text-gray-400 text-4xl"></i>
                    </div>
                    <h3 class="text-3xl font-bold text-gray-600 mb-4">No Brands Available</h3>
                    <p class="text-gray-500 max-w-lg mx-auto text-lg">
                        We're currently updating our brand portfolio. Please check back soon for our latest automotive partnerships.
                    </p>
                </div>
            @endif
        </div>
    </section>

    @include('partials.footer')


</body>
</html>