<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>People Care - Motorcare Uganda</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        :root {
            --motorcare-brown: #555555;
            --motorcare-orange: #F7931E;
        }
        
        .bg-motorcare-brown {
            background-color: var(--motorcare-brown);
        }
        
        .bg-motorcare-orange {
            background-color: var(--motorcare-orange);
        }
        
        .text-motorcare-brown {
            color: var(--motorcare-brown);
        }
        
        .text-motorcare-orange {
            color: var(--motorcare-orange);
        }
        
        .hover\:text-motorcare-orange:hover {
            color: var(--motorcare-orange);
        }
        
        .hover\:bg-orange-500:hover {
            background-color: #f97316;
        }

        .pdf-container {
            height: calc(100vh - 200px);
            min-height: 900px;
        }


    </style>
</head>
<body class="bg-gray-50 font-sans">
    @include('partials.header')

    <!-- Hero Section -->
    <section class="relative bg-motorcare-brown text-white py-20">
        <div class="absolute inset-0 bg-black/30"></div>
        <div class="relative max-w-6xl mx-auto px-4 text-center">
            <h1 class="text-5xl font-bold mb-6">People Care</h1>
            <p class="text-xl text-gray-200 max-w-3xl mx-auto">At Motorcare Uganda, we believe our people are our greatest asset. Discover our comprehensive approach to employee welfare, development, and care.</p>
        </div>
    </section>

    <!-- PDF Viewer Section -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Section Header -->
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-motorcare-brown mb-4">People Care Policy</h2>
                <div class="w-24 h-1 bg-motorcare-orange mx-auto mb-6"></div>
                <p class="text-gray-600 text-lg max-w-3xl mx-auto">
                    Our comprehensive People Care policy outlines our commitment to creating a supportive, inclusive, and growth-oriented workplace for all our team members.
                </p>
            </div>

            <!-- PDF Embed Container -->
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <div class="pdf-container">
                    <!-- Primary PDF Embed -->
                    <iframe 
                        src="/uploads/about/peoplecare.pdf#toolbar=1&navpanes=1&scrollbar=1&page=1&view=FitH" 
                        width="100%" 
                        height="100%" 
                        style="border: none;"
                        title="People Care Policy Document">
                    </iframe>
                </div>
                
                <!-- PDF Controls and Download -->
                <div class="bg-gray-50 px-6 py-4 border-t border-gray-200">
                    <div class="flex flex-col sm:flex-row justify-between items-center gap-4">
                        <div class="flex items-center text-gray-600">
                            <i class="fas fa-file-pdf text-red-500 mr-2"></i>
                            <span class="text-sm">People Care Policy Document</span>
                        </div>
                        <div class="flex gap-3">
                            <a href="/uploads/about/peoplecare.pdf" 
                               target="_blank" 
                               class="inline-flex items-center px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white text-sm font-medium rounded-lg transition duration-200">
                                <i class="fas fa-external-link-alt mr-2"></i>
                                Open in New Tab
                            </a>
                            <a href="/uploads/about/peoplecare.pdf" 
                               download="Motorcare-People-Care-Policy.pdf"
                               class="inline-flex items-center px-4 py-2 bg-motorcare-orange hover:bg-orange-500 text-white text-sm font-medium rounded-lg transition duration-200">
                                <i class="fas fa-download mr-2"></i>
                                Download PDF
                            </a>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </section>

    @include('partials.footer')


</body>
</html>
