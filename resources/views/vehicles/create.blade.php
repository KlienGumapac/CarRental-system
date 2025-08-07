<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Vehicle - NexaDrive</title>

    <!-- Vite Assets -->
    @if(file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @endif
</head>

<body class="bg-gray-50 dark:bg-gray-900 min-h-screen">
    <!-- Sidebar -->
    @include('components.sidebar')

    <!-- Main Content -->
    <div class="lg:ml-64">
        <!-- Top Navigation -->
        <header class="bg-white dark:bg-gray-800 shadow-sm border-b border-gray-200 dark:border-gray-700">
            <div class="flex items-center justify-between h-16 px-4 sm:px-6 lg:px-8">
                <!-- Mobile Menu Button -->
                <button onclick="openSidebar()" class="lg:hidden p-2 rounded-md text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>

                <!-- Page Title -->
                <div class="flex-1 lg:flex-none">
                    <h1 class="text-xl font-semibold text-gray-900 dark:text-white">Add New Vehicle</h1>
                </div>

                <!-- Back Button -->
                <div class="flex items-center space-x-4">
                    <a href="{{ route('vehicles.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 text-sm font-medium rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Back to Vehicles
                    </a>
                </div>
            </div>
        </header>

        <!-- Page Content -->
        <main class="p-4 sm:p-6 lg:p-8">
            <div class="max-w-4xl mx-auto">
                <!-- Form Card -->
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-200 dark:border-gray-700 overflow-hidden">
                    <div class="bg-gradient-to-r from-blue-600 to-indigo-600 px-6 py-4">
                        <h2 class="text-xl font-semibold text-white">Vehicle Information</h2>
                        <p class="text-blue-100 mt-1">Enter the details for the new vehicle</p>
                    </div>

                    <form method="POST" action="{{ route('vehicles.store') }}" enctype="multipart/form-data" class="p-6 space-y-8">
                        @csrf

                        <!-- Basic Information -->
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            <div>
                                <label for="car_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Car ID *
                                </label>
                                <input type="text" id="car_id" name="car_id" value="{{ old('car_id') }}" required
                                    class="block w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:focus:ring-blue-400 dark:focus:border-blue-400 transition-colors"
                                    placeholder="e.g., CR001">
                                @error('car_id')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="license_plate" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    License Plate *
                                </label>
                                <input type="text" id="license_plate" name="license_plate" value="{{ old('license_plate') }}" required
                                    class="block w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:focus:ring-blue-400 dark:focus:border-blue-400 transition-colors"
                                    placeholder="e.g., ABC123">
                                @error('license_plate')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="make" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Make *
                                </label>
                                <input type="text" id="make" name="make" value="{{ old('make') }}" required
                                    class="block w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:focus:ring-blue-400 dark:focus:border-blue-400 transition-colors"
                                    placeholder="e.g., Toyota">
                                @error('make')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="model" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Model *
                                </label>
                                <input type="text" id="model" name="model" value="{{ old('model') }}" required
                                    class="block w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:focus:ring-blue-400 dark:focus:border-blue-400 transition-colors"
                                    placeholder="e.g., Camry">
                                @error('model')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="year" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Year *
                                </label>
                                <input type="number" id="year" name="year" value="{{ old('year') }}" required min="1900" max="{{ date('Y') + 1 }}"
                                    class="block w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:focus:ring-blue-400 dark:focus:border-blue-400 transition-colors"
                                    placeholder="e.g., 2022">
                                @error('year')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="color" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Color *
                                </label>
                                <input type="text" id="color" name="color" value="{{ old('color') }}" required
                                    class="block w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:focus:ring-blue-400 dark:focus:border-blue-400 transition-colors"
                                    placeholder="e.g., Silver">
                                @error('color')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Vehicle Specifications -->
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            <div>
                                <label for="car_type" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Car Type *
                                </label>
                                <select id="car_type" name="car_type" required
                                    class="block w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:focus:ring-blue-400 dark:focus:border-blue-400 transition-colors">
                                    <option value="">Select Type</option>
                                    <option value="Sedan" {{ old('car_type') == 'Sedan' ? 'selected' : '' }}>Sedan</option>
                                    <option value="SUV" {{ old('car_type') == 'SUV' ? 'selected' : '' }}>SUV</option>
                                    <option value="Hatchback" {{ old('car_type') == 'Hatchback' ? 'selected' : '' }}>Hatchback</option>
                                    <option value="Coupe" {{ old('car_type') == 'Coupe' ? 'selected' : '' }}>Coupe</option>
                                    <option value="Convertible" {{ old('car_type') == 'Convertible' ? 'selected' : '' }}>Convertible</option>
                                    <option value="Wagon" {{ old('car_type') == 'Wagon' ? 'selected' : '' }}>Wagon</option>
                                    <option value="Van" {{ old('car_type') == 'Van' ? 'selected' : '' }}>Van</option>
                                    <option value="Truck" {{ old('car_type') == 'Truck' ? 'selected' : '' }}>Truck</option>
                                </select>
                                @error('car_type')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="transmission" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Transmission *
                                </label>
                                <select id="transmission" name="transmission" required
                                    class="block w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:focus:ring-blue-400 dark:focus:border-blue-400 transition-colors">
                                    <option value="">Select Transmission</option>
                                    <option value="Automatic" {{ old('transmission') == 'Automatic' ? 'selected' : '' }}>Automatic</option>
                                    <option value="Manual" {{ old('transmission') == 'Manual' ? 'selected' : '' }}>Manual</option>
                                    <option value="CVT" {{ old('transmission') == 'CVT' ? 'selected' : '' }}>CVT</option>
                                </select>
                                @error('transmission')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="fuel_type" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Fuel Type *
                                </label>
                                <select id="fuel_type" name="fuel_type" required
                                    class="block w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:focus:ring-blue-400 dark:focus:border-blue-400 transition-colors">
                                    <option value="">Select Fuel Type</option>
                                    <option value="Petrol" {{ old('fuel_type') == 'Petrol' ? 'selected' : '' }}>Petrol</option>
                                    <option value="Diesel" {{ old('fuel_type') == 'Diesel' ? 'selected' : '' }}>Diesel</option>
                                    <option value="Electric" {{ old('fuel_type') == 'Electric' ? 'selected' : '' }}>Electric</option>
                                    <option value="Hybrid" {{ old('fuel_type') == 'Hybrid' ? 'selected' : '' }}>Hybrid</option>
                                    <option value="Plug-in Hybrid" {{ old('fuel_type') == 'Plug-in Hybrid' ? 'selected' : '' }}>Plug-in Hybrid</option>
                                </select>
                                @error('fuel_type')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Pricing and Availability -->
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            <div>
                                <label for="daily_rate" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Daily Rate (₱) *
                                </label>
                                <input type="number" id="daily_rate" name="daily_rate" value="{{ old('daily_rate') }}" required min="0" step="0.01"
                                    class="block w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:focus:ring-blue-400 dark:focus:border-blue-400 transition-colors"
                                    placeholder="e.g., 2500.00">
                                @error('daily_rate')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="availability" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Availability *
                                </label>
                                <select id="availability" name="availability" required
                                    class="block w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:focus:ring-blue-400 dark:focus:border-blue-400 transition-colors">
                                    <option value="">Select Availability</option>
                                    <option value="Available" {{ old('availability') == 'Available' ? 'selected' : '' }}>Available</option>
                                    <option value="Rented" {{ old('availability') == 'Rented' ? 'selected' : '' }}>Rented</option>
                                    <option value="Maintenance" {{ old('availability') == 'Maintenance' ? 'selected' : '' }}>Maintenance</option>
                                    <option value="Out of Service" {{ old('availability') == 'Out of Service' ? 'selected' : '' }}>Out of Service</option>
                                </select>
                                @error('availability')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="mileage" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Mileage (km) *
                                </label>
                                <input type="number" id="mileage" name="mileage" value="{{ old('mileage') }}" required min="0"
                                    class="block w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:focus:ring-blue-400 dark:focus:border-blue-400 transition-colors"
                                    placeholder="e.g., 15000">
                                @error('mileage')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Additional Information -->
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            <div>
                                <label for="seating_capacity" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Seating Capacity *
                                </label>
                                <input type="number" id="seating_capacity" name="seating_capacity" value="{{ old('seating_capacity') }}" required min="1" max="5" step="1"
                                    class="block w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:focus:ring-blue-400 dark:focus:border-blue-400 transition-colors"
                                    placeholder="e.g., 5">
                                @error('seating_capacity')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="insurance" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Insurance *
                                </label>
                                <input type="text" id="insurance" name="insurance" value="{{ old('insurance') }}" required
                                    class="block w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:focus:ring-blue-400 dark:focus:border-blue-400 transition-colors"
                                    placeholder="e.g., Full Coverage">
                                @error('insurance')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="last_service" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Last Service Date *
                                </label>
                                <input type="date" id="last_service" name="last_service" value="{{ old('last_service') }}" required
                                    class="block w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:focus:ring-blue-400 dark:focus:border-blue-400 transition-colors">
                                @error('last_service')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Condition -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="condition" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Condition *
                                </label>
                                <select id="condition" name="condition" required
                                    class="block w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:focus:ring-blue-400 dark:focus:border-blue-400 transition-colors">
                                    <option value="">Select Condition</option>
                                    <option value="Excellent" {{ old('condition') == 'Excellent' ? 'selected' : '' }}>Excellent</option>
                                    <option value="Good" {{ old('condition') == 'Good' ? 'selected' : '' }}>Good</option>
                                    <option value="Fair" {{ old('condition') == 'Fair' ? 'selected' : '' }}>Fair</option>
                                    <option value="Poor" {{ old('condition') == 'Poor' ? 'selected' : '' }}>Poor</option>
                                </select>
                                @error('condition')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Image Upload -->
                        <div class="border-t border-gray-200 dark:border-gray-700 pt-8">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Vehicle Images</h3>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                <div>
                                    <label for="images" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                        Upload Images (Max 3)
                                    </label>
                                    <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 dark:border-gray-600 border-dashed rounded-lg hover:border-gray-400 dark:hover:border-gray-500 transition-colors">
                                        <div class="space-y-1 text-center">
                                            <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                                <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                            <div class="flex text-sm text-gray-600 dark:text-gray-400">
                                                <label for="images" class="relative cursor-pointer bg-white dark:bg-gray-700 rounded-md font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-blue-500">
                                                    <span>Upload files</span>
                                                    <input id="images" name="images[]" type="file" class="sr-only" multiple accept="image/*">
                                                </label>
                                                <p class="pl-1">or drag and drop</p>
                                            </div>
                                            <p class="text-xs text-gray-500 dark:text-gray-400">PNG, JPG, GIF up to 2MB each</p>
                                        </div>
                                    </div>
                                    @error('images.*')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <!-- Image Previews -->
                            <div id="imagePreviews" class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-6 hidden">
                                <!-- Image previews will be dynamically added here -->
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="flex items-center justify-end space-x-4 pt-6 border-t border-gray-200 dark:border-gray-700">
                            <a href="{{ route('vehicles.index') }}" class="px-6 py-3 border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 text-sm font-medium rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                                Cancel
                            </a>
                            <button type="submit" class="px-6 py-3 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white text-sm font-medium rounded-lg shadow-sm transition-all duration-200 transform hover:scale-105 active:scale-95">
                                <svg class="w-5 h-5 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                                Add Vehicle
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>

    <script>
        // File upload preview functionality
        const imageInput = document.getElementById('images');
        const imagePreviews = document.getElementById('imagePreviews');
        const uploadedFiles = [];

        imageInput.addEventListener('change', function(e) {
            const files = Array.from(e.target.files);

            if (uploadedFiles.length + files.length > 3) {
                alert('You can only upload up to 3 images total.');
                e.target.value = '';
                return;
            }

            // Add new files to existing ones
            files.forEach((file, index) => {
                if (file.type.startsWith('image/') && uploadedFiles.length < 3) {
                    uploadedFiles.push(file);
                    createImagePreview(file, uploadedFiles.length - 1);
                }
            });

            // Show previews container if there are images
            if (uploadedFiles.length > 0) {
                imagePreviews.classList.remove('hidden');
            } else {
                imagePreviews.classList.add('hidden');
            }

            // Update the file input with all selected files
            updateFileInput();
        });

        function createImagePreview(file, index) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const previewDiv = document.createElement('div');
                previewDiv.className = 'relative group';
                previewDiv.innerHTML = `
                    <div class="relative">
                        <img src="${e.target.result}" alt="Vehicle image ${index + 1}" class="w-full h-32 object-cover rounded-lg border border-gray-200 dark:border-gray-600">
                        <button type="button" onclick="removeImage(${index})" class="absolute -top-2 -right-2 bg-red-500 hover:bg-red-600 text-white rounded-full w-6 h-6 flex items-center justify-center text-sm font-bold transition-colors">
                            ×
                        </button>
                    </div>
                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-2 truncate">${file.name}</p>
                `;
                imagePreviews.appendChild(previewDiv);
            };
            reader.readAsDataURL(file);
        }

        function removeImage(index) {
            // Remove from uploadedFiles array
            uploadedFiles.splice(index, 1);

            // Clear and rebuild previews
            imagePreviews.innerHTML = '';
            uploadedFiles.forEach((file, newIndex) => {
                createImagePreview(file, newIndex);
            });

            // Hide previews container if no images
            if (uploadedFiles.length === 0) {
                imagePreviews.classList.add('hidden');
            }

            // Update the file input
            updateFileInput();
        }

        function updateFileInput() {
            // Create a new DataTransfer object
            const dt = new DataTransfer();

            // Add all uploaded files to the DataTransfer
            uploadedFiles.forEach(file => {
                dt.items.add(file);
            });

            // Set the files to the input
            imageInput.files = dt.files;
        }
    </script>
</body>

</html>