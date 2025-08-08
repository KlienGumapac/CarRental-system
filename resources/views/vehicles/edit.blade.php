<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Vehicle - NexaDrive</title>

    <!-- Vite Assets -->
    @if(file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @endif

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body class="bg-gray-50 dark:bg-gray-900 min-h-screen" x-data="{}" x-init="
    // Initialize dark mode on page load
    const savedDarkMode = localStorage.getItem('darkMode');
    const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
    if (savedDarkMode === 'true' || (!savedDarkMode && prefersDark)) {
        document.documentElement.classList.add('dark');
        document.documentElement.setAttribute('data-theme', 'dark');
        document.documentElement.style.colorScheme = 'dark';
        document.documentElement.style.setProperty('color-scheme', 'dark');
    } else {
        document.documentElement.classList.remove('dark');
        document.documentElement.setAttribute('data-theme', 'light');
        document.documentElement.style.colorScheme = 'light';
        document.documentElement.style.setProperty('color-scheme', 'light');
    }
">
    <!-- Sidebar -->
    @include('components.sidebar')

    <!-- Main Content - Full Screen -->
    <div class="lg:ml-64 min-h-screen bg-gray-50 dark:bg-gray-900">
        <!-- Top Navigation -->
        <header class="bg-white dark:bg-gray-800 shadow-sm border-b border-gray-200 dark:border-gray-700 sticky top-0 z-40">
            <div class="flex items-center justify-between h-16 px-4 sm:px-6 lg:px-8">
                <!-- Mobile Menu Button -->
                <button onclick="openSidebar()" class="lg:hidden p-2 rounded-md text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>

                <!-- Page Title -->
                <div class="flex-1 lg:flex-none">
                    <h1 class="text-xl font-semibold text-gray-900 dark:text-white">Edit Vehicle</h1>
                </div>

                <!-- Back Button -->
                <div class="flex items-center space-x-4">
                    <a href="{{ route('vehicles.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 text-gray-700 dark:text-gray-300 text-sm font-medium rounded-lg transition-colors">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Back to Vehicles
                    </a>
                </div>
            </div>
        </header>

        <!-- Full Screen Content -->
        <main class="min-h-screen p-4 sm:p-6 lg:p-8">
            <!-- Success/Error Messages -->
            @if(session('success'))
            <div class="mb-6 bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-lg p-4">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-green-800 dark:text-green-200">{{ session('success') }}</p>
                    </div>
                </div>
            </div>
            @endif

            @if(session('error'))
            <div class="mb-6 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-lg p-4">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-red-800 dark:text-red-200">{{ session('error') }}</p>
                    </div>
                </div>
            </div>
            @endif

            <!-- Edit Form - Full Screen -->
            <div class="w-full">
                <form action="{{ route('vehicles.update', $vehicle) }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                    @csrf
                    @method('PUT')

                    <!-- Header -->
                    <div class="bg-gradient-to-r from-blue-600 to-indigo-600 rounded-2xl p-8 text-white mb-8">
                        <div class="flex items-center space-x-6">
                            <div class="w-16 h-16 bg-white/20 rounded-2xl flex items-center justify-center backdrop-blur-sm">
                                <i class="fas fa-car text-white text-3xl"></i>
                            </div>
                            <div>
                                <h2 class="text-3xl font-bold mb-2">Edit Vehicle</h2>
                                <p class="text-blue-100 text-lg">{{ $vehicle->make }} {{ $vehicle->model }}</p>
                                <p class="text-blue-200 text-sm mt-1">Update vehicle information and images</p>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 xl:grid-cols-3 gap-8">
                        <!-- Left Column - Vehicle Information -->
                        <div class="xl:col-span-2 space-y-6">
                            <!-- Basic Information Card -->
                            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg border border-gray-200 dark:border-gray-700 p-6">
                                <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-6 flex items-center">
                                    <div class="w-8 h-8 bg-blue-100 dark:bg-blue-900/20 rounded-lg flex items-center justify-center mr-3">
                                        <svg class="w-5 h-5 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    </div>
                                    Basic Information
                                </h3>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Car ID</label>
                                        <input type="text" name="car_id" value="{{ old('car_id', $vehicle->car_id) }}" class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:focus:ring-blue-400 dark:focus:border-blue-400 transition-colors">
                                        @error('car_id')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">License Plate</label>
                                        <input type="text" name="license_plate" value="{{ old('license_plate', $vehicle->license_plate) }}" class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:focus:ring-blue-400 dark:focus:border-blue-400 transition-colors">
                                        @error('license_plate')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Make</label>
                                        <input type="text" name="make" value="{{ old('make', $vehicle->make) }}" class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:focus:ring-blue-400 dark:focus:border-blue-400 transition-colors">
                                        @error('make')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Model</label>
                                        <input type="text" name="model" value="{{ old('model', $vehicle->model) }}" class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:focus:ring-blue-400 dark:focus:border-blue-400 transition-colors">
                                        @error('model')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Year</label>
                                        <input type="number" name="year" value="{{ old('year', $vehicle->year) }}" min="1900" max="{{ date('Y') + 1 }}" class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:focus:ring-blue-400 dark:focus:border-blue-400 transition-colors">
                                        @error('year')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Color</label>
                                        <input type="text" name="color" value="{{ old('color', $vehicle->color) }}" class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:focus:ring-blue-400 dark:focus:border-blue-400 transition-colors">
                                        @error('color')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Specifications Card -->
                            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg border border-gray-200 dark:border-gray-700 p-6">
                                <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-6 flex items-center">
                                    <div class="w-8 h-8 bg-green-100 dark:bg-green-900/20 rounded-lg flex items-center justify-center mr-3">
                                        <svg class="w-5 h-5 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    </div>
                                    Specifications
                                </h3>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Car Type</label>
                                        <select name="car_type" class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:focus:ring-blue-400 dark:focus:border-blue-400 transition-colors">
                                            <option value="sedan" {{ old('car_type', $vehicle->car_type) == 'sedan' ? 'selected' : '' }}>Sedan</option>
                                            <option value="suv" {{ old('car_type', $vehicle->car_type) == 'suv' ? 'selected' : '' }}>SUV</option>
                                            <option value="luxury" {{ old('car_type', $vehicle->car_type) == 'luxury' ? 'selected' : '' }}>Luxury</option>
                                            <option value="sports" {{ old('car_type', $vehicle->car_type) == 'sports' ? 'selected' : '' }}>Sports</option>
                                            <option value="hatchback" {{ old('car_type', $vehicle->car_type) == 'hatchback' ? 'selected' : '' }}>Hatchback</option>
                                            <option value="wagon" {{ old('car_type', $vehicle->car_type) == 'wagon' ? 'selected' : '' }}>Wagon</option>
                                        </select>
                                        @error('car_type')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Transmission</label>
                                        <select name="transmission" class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:focus:ring-blue-400 dark:focus:border-blue-400 transition-colors">
                                            <option value="automatic" {{ old('transmission', $vehicle->transmission) == 'automatic' ? 'selected' : '' }}>Automatic</option>
                                            <option value="manual" {{ old('transmission', $vehicle->transmission) == 'manual' ? 'selected' : '' }}>Manual</option>
                                            <option value="cvt" {{ old('transmission', $vehicle->transmission) == 'cvt' ? 'selected' : '' }}>CVT</option>
                                        </select>
                                        @error('transmission')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Fuel Type</label>
                                        <select name="fuel_type" class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:focus:ring-blue-400 dark:focus:border-blue-400 transition-colors">
                                            <option value="gasoline" {{ old('fuel_type', $vehicle->fuel_type) == 'gasoline' ? 'selected' : '' }}>Gasoline</option>
                                            <option value="diesel" {{ old('fuel_type', $vehicle->fuel_type) == 'diesel' ? 'selected' : '' }}>Diesel</option>
                                            <option value="electric" {{ old('fuel_type', $vehicle->fuel_type) == 'electric' ? 'selected' : '' }}>Electric</option>
                                            <option value="hybrid" {{ old('fuel_type', $vehicle->fuel_type) == 'hybrid' ? 'selected' : '' }}>Hybrid</option>
                                        </select>
                                        @error('fuel_type')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Seating Capacity</label>
                                        <input type="number" name="seating_capacity" value="{{ old('seating_capacity', $vehicle->seating_capacity) }}" min="1" max="20" class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:focus:ring-blue-400 dark:focus:border-blue-400 transition-colors">
                                        @error('seating_capacity')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Mileage (km)</label>
                                        <input type="number" name="mileage" value="{{ old('mileage', $vehicle->mileage) }}" min="0" class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:focus:ring-blue-400 dark:focus:border-blue-400 transition-colors">
                                        @error('mileage')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Daily Rate (₱)</label>
                                        <input type="number" name="daily_rate" value="{{ old('daily_rate', $vehicle->daily_rate) }}" min="0" step="0.01" class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:focus:ring-blue-400 dark:focus:border-blue-400 transition-colors">
                                        @error('daily_rate')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Additional Information Card -->
                            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg border border-gray-200 dark:border-gray-700 p-6">
                                <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-6 flex items-center">
                                    <div class="w-8 h-8 bg-purple-100 dark:bg-purple-900/20 rounded-lg flex items-center justify-center mr-3">
                                        <svg class="w-5 h-5 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                        </svg>
                                    </div>
                                    Additional Information
                                </h3>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Availability</label>
                                        <select name="availability" class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:focus:ring-blue-400 dark:focus:border-blue-400 transition-colors">
                                            <option value="Available" {{ old('availability', $vehicle->availability) == 'Available' ? 'selected' : '' }}>Available</option>
                                            <option value="Rented" {{ old('availability', $vehicle->availability) == 'Rented' ? 'selected' : '' }}>Rented</option>
                                            <option value="Maintenance" {{ old('availability', $vehicle->availability) == 'Maintenance' ? 'selected' : '' }}>Maintenance</option>
                                        </select>
                                        @error('availability')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Condition</label>
                                        <select name="condition" class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:focus:ring-blue-400 dark:focus:border-blue-400 transition-colors">
                                            <option value="Excellent" {{ old('condition', $vehicle->condition) == 'Excellent' ? 'selected' : '' }}>Excellent</option>
                                            <option value="Good" {{ old('condition', $vehicle->condition) == 'Good' ? 'selected' : '' }}>Good</option>
                                            <option value="Fair" {{ old('condition', $vehicle->condition) == 'Fair' ? 'selected' : '' }}>Fair</option>
                                            <option value="Poor" {{ old('condition', $vehicle->condition) == 'Poor' ? 'selected' : '' }}>Poor</option>
                                        </select>
                                        @error('condition')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Insurance</label>
                                        <input type="text" name="insurance" value="{{ old('insurance', $vehicle->insurance) }}" class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:focus:ring-blue-400 dark:focus:border-blue-400 transition-colors">
                                        @error('insurance')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Last Service Date</label>
                                        <input type="date" name="last_service" value="{{ old('last_service', $vehicle->last_service) }}" class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:focus:ring-blue-400 dark:focus:border-blue-400 transition-colors">
                                        @error('last_service')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Right Column - Image Gallery -->
                        <div class="xl:col-span-1 space-y-6">
                            <!-- Image Gallery Card -->
                            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg border border-gray-200 dark:border-gray-700 p-6">
                                <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-6 flex items-center">
                                    <div class="w-8 h-8 bg-pink-100 dark:bg-pink-900/20 rounded-lg flex items-center justify-center mr-3">
                                        <svg class="w-5 h-5 text-pink-600 dark:text-pink-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                    </div>
                                    Vehicle Gallery
                                </h3>

                                <!-- Current Images -->
                                <div class="mb-6">
                                    <h4 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Current Images</h4>
                                    <div class="grid grid-cols-1 gap-4" id="currentImages">
                                        @if($vehicle->images && count($vehicle->images) > 0)
                                        @foreach($vehicle->images as $index => $image)
                                        <div class="relative group">
                                            <img src="{{ Storage::url($image) }}" alt="Vehicle image {{ $index + 1 }}" class="w-full h-48 object-cover rounded-xl border border-gray-200 dark:border-gray-600">
                                            <div class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition-opacity rounded-xl flex items-center justify-center">
                                                <button type="button" onclick="removeImage('{{ $image }}')" class="bg-red-500 hover:bg-red-600 text-white rounded-full w-10 h-10 flex items-center justify-center transition-colors">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                    </svg>
                                                </button>
                                            </div>
                                            <input type="hidden" name="remove_images[]" value="{{ $image }}" class="remove-image-input" disabled>
                                        </div>
                                        @endforeach
                                        @else
                                        <div class="col-span-full text-center py-8">
                                            <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                            </svg>
                                            <p class="text-gray-500 dark:text-gray-400">No images uploaded</p>
                                        </div>
                                        @endif
                                    </div>
                                </div>

                                <!-- Add New Images -->
                                <div>
                                    <h4 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Add New Images</h4>
                                    <div class="border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-xl p-6 text-center hover:border-blue-500 dark:hover:border-blue-400 transition-colors">
                                        <input type="file" id="newImages" name="images[]" multiple accept="image/*" class="hidden">
                                        <label for="newImages" class="cursor-pointer">
                                            <svg class="w-12 h-12 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                                            </svg>
                                            <p class="text-gray-600 dark:text-gray-400">Click to upload new images</p>
                                            <p class="text-sm text-gray-500 dark:text-gray-500 mt-1">Up to 3 images, max 2MB each</p>
                                        </label>
                                    </div>
                                </div>

                                <!-- New Image Previews -->
                                <div id="newImagePreviews" class="hidden mt-6">
                                    <h4 class="text-lg font-medium text-gray-900 dark:text-white mb-4">New Image Previews</h4>
                                    <div class="grid grid-cols-1 gap-4" id="newImageGrid">
                                        <!-- New image previews will be added here -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex items-center justify-center space-x-4 pt-8">
                        <a href="{{ route('vehicles.index') }}" class="px-8 py-4 bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 text-gray-700 dark:text-gray-300 rounded-xl font-medium transition-colors">
                            <svg class="w-5 h-5 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                            Cancel
                        </a>
                        <button type="submit" class="px-8 py-4 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white rounded-xl font-medium transition-all duration-200 transform hover:scale-105 active:scale-95">
                            <svg class="w-5 h-5 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Update Vehicle
                        </button>
                    </div>
                </form>
            </div>
        </main>
    </div>

    <script>
        // Image removal functionality
        function removeImage(imagePath) {
            const imageContainer = event.target.closest('.relative');
            const hiddenInput = imageContainer.querySelector('.remove-image-input');

            // Enable the hidden input to mark for removal
            hiddenInput.disabled = false;

            // Add visual feedback
            imageContainer.style.opacity = '0.5';
            imageContainer.style.filter = 'grayscale(100%)';

            // Add a "removed" indicator
            const removedBadge = document.createElement('div');
            removedBadge.className = 'absolute top-2 right-2 bg-red-500 text-white text-xs px-2 py-1 rounded-full';
            removedBadge.textContent = 'Removed';
            imageContainer.appendChild(removedBadge);
        }

        // New image upload functionality
        const newImageInput = document.getElementById('newImages');
        const newImagePreviews = document.getElementById('newImagePreviews');
        const newImageGrid = document.getElementById('newImageGrid');
        const uploadedFiles = [];

        newImageInput.addEventListener('change', function(e) {
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
                    createNewImagePreview(file, uploadedFiles.length - 1);
                }
            });

            // Show previews container if there are images
            if (uploadedFiles.length > 0) {
                newImagePreviews.classList.remove('hidden');
            } else {
                newImagePreviews.classList.add('hidden');
            }
        });

        function createNewImagePreview(file, index) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const previewDiv = document.createElement('div');
                previewDiv.className = 'relative group';
                previewDiv.innerHTML = `
                    <div class="relative">
                        <img src="${e.target.result}" alt="New image ${index + 1}" class="w-full h-48 object-cover rounded-xl border border-gray-200 dark:border-gray-600">
                        <div class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition-opacity rounded-xl flex items-center justify-center">
                            <button type="button" onclick="removeNewImage(${index})" class="bg-red-500 hover:bg-red-600 text-white rounded-full w-10 h-10 flex items-center justify-center transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-2 truncate">${file.name}</p>
                `;
                newImageGrid.appendChild(previewDiv);
            };
            reader.readAsDataURL(file);
        }

        function removeNewImage(index) {
            // Remove from uploadedFiles array
            uploadedFiles.splice(index, 1);

            // Clear and rebuild previews
            newImageGrid.innerHTML = '';
            uploadedFiles.forEach((file, newIndex) => {
                createNewImagePreview(file, newIndex);
            });

            // Hide previews container if no images
            if (uploadedFiles.length === 0) {
                newImagePreviews.classList.add('hidden');
            }

            // Update the file input
            updateNewFileInput();
        }

        function updateNewFileInput() {
            // Create a new DataTransfer object
            const dt = new DataTransfer();

            // Add all uploaded files to the DataTransfer
            uploadedFiles.forEach(file => {
                dt.items.add(file);
            });

            // Set the files to the input
            newImageInput.files = dt.files;
        }
    </script>
</body>

</html>