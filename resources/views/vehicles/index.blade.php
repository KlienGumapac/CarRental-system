<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vehicles - NexaDrive</title>

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
                    <h1 class="text-xl font-semibold text-gray-900 dark:text-white">Vehicles</h1>
                </div>

                <!-- Add Vehicle Button -->
                <div class="flex items-center space-x-4">
                    <a href="{{ route('vehicles.create') }}" class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white text-sm font-medium rounded-lg shadow-sm transition-all duration-200 transform hover:scale-105 active:scale-95">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        Add Vehicle
                    </a>
                </div>
            </div>
        </header>

        <!-- Page Content -->
        <main class="p-4 sm:p-6 lg:p-8">
            <!-- Success Message -->
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

            <!-- Error Message -->
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

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-200 dark:border-gray-700 p-6 transform hover:scale-105 transition-all duration-300">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-indigo-500 rounded-xl flex items-center justify-center">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Vehicles</p>
                            <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $vehicles->count() }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-200 dark:border-gray-700 p-6 transform hover:scale-105 transition-all duration-300">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 bg-gradient-to-r from-green-500 to-emerald-500 rounded-xl flex items-center justify-center">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Available</p>
                            <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $vehicles->where('availability', 'Available')->count() }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-200 dark:border-gray-700 p-6 transform hover:scale-105 transition-all duration-300">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 bg-gradient-to-r from-yellow-500 to-orange-500 rounded-xl flex items-center justify-center">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Rented</p>
                            <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $vehicles->where('availability', 'Rented')->count() }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-200 dark:border-gray-700 p-6 transform hover:scale-105 transition-all duration-300">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 bg-gradient-to-r from-purple-500 to-pink-500 rounded-xl flex items-center justify-center">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Revenue</p>
                            <p class="text-2xl font-bold text-gray-900 dark:text-white">₱{{ number_format($vehicles->sum('daily_rate'), 2) }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Search and Filter Bar -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-200 dark:border-gray-700 p-6 mb-8">
                <div class="flex flex-col sm:flex-row gap-4">
                    <div class="flex-1">
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </div>
                            <input type="text" placeholder="Search vehicles..." class="block w-full pl-10 pr-3 py-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:focus:ring-blue-400 dark:focus:border-blue-400 transition-colors">
                        </div>
                    </div>
                    <div class="flex gap-3">
                        <select class="px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:focus:ring-blue-400 dark:focus:border-blue-400 transition-colors">
                            <option value="">All Types</option>
                            <option value="sedan">Sedan</option>
                            <option value="suv">SUV</option>
                            <option value="luxury">Luxury</option>
                            <option value="sports">Sports</option>
                        </select>
                        <select class="px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:focus:ring-blue-400 dark:focus:border-blue-400 transition-colors">
                            <option value="">All Status</option>
                            <option value="available">Available</option>
                            <option value="rented">Rented</option>
                            <option value="maintenance">Maintenance</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Vehicles Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                @if($vehicles->count() > 0)
                @foreach($vehicles as $vehicle)
                <div class="group relative bg-white dark:bg-gray-800 rounded-2xl shadow-lg hover:shadow-2xl border border-gray-100 dark:border-gray-700 overflow-hidden transform hover:scale-105 transition-all duration-500 hover:-translate-y-2">
                    <!-- Image Container -->
                    <div class="relative h-64 overflow-hidden">
                        @if($vehicle->images && count($vehicle->images) > 0)
                        <img src="{{ Storage::url($vehicle->images[0]) }}"
                            alt="{{ $vehicle->make }} {{ $vehicle->model }}"
                            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700"
                            onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                        @endif
                        <div class="w-full h-full bg-gradient-to-br from-blue-500 via-purple-500 to-pink-500 flex items-center justify-center {{ $vehicle->images && count($vehicle->images) > 0 ? 'hidden' : '' }}">
                            <svg class="w-20 h-20 text-white opacity-60" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                            </svg>
                        </div>

                        <!-- Gradient Overlay -->
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>

                        <!-- Status Badge -->
                        <div class="absolute top-4 right-4">
                            @if($vehicle->availability === 'Available')
                            <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-semibold bg-emerald-500 text-white shadow-lg">
                                <span class="w-2 h-2 bg-white rounded-full mr-2 animate-pulse"></span>
                                Available
                            </span>
                            @elseif($vehicle->availability === 'Rented')
                            <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-semibold bg-amber-500 text-white shadow-lg">
                                <span class="w-2 h-2 bg-white rounded-full mr-2"></span>
                                Rented
                            </span>
                            @else
                            <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-semibold bg-red-500 text-white shadow-lg">
                                <span class="w-2 h-2 bg-white rounded-full mr-2"></span>
                                {{ $vehicle->availability }}
                            </span>
                            @endif
                        </div>

                        <!-- Quick Actions Overlay -->
                        <div class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition-all duration-300 flex items-center justify-center">
                            <div class="flex space-x-3">
                                <a href="{{ route('vehicles.show', $vehicle) }}" class="bg-white/20 backdrop-blur-sm text-white px-4 py-2 rounded-lg hover:bg-white/30 transition-colors duration-200" title="View">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                </a>
                                <a href="{{ route('vehicles.rent', $vehicle) }}" class="bg-white/20 backdrop-blur-sm text-white px-4 py-2 rounded-lg hover:bg-white/30 transition-colors duration-200" title="Rent">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                    </svg>
                                </a>
                                <a href="{{ route('vehicles.edit', $vehicle) }}" class="bg-white/20 backdrop-blur-sm text-white px-4 py-2 rounded-lg hover:bg-white/30 transition-colors duration-200" title="Edit">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                    </svg>
                                </a>
                                <button class="bg-white/20 backdrop-blur-sm text-white px-4 py-2 rounded-lg hover:bg-white/30 transition-colors duration-200" onclick="confirmDeleteVehicle('{{ $vehicle->id }}', '{{ $vehicle->make }} {{ $vehicle->model }}')" title="Delete">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Content -->
                    <div class="p-6">
                        <!-- Vehicle Info -->
                        <div class="mb-4">
                            <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors duration-200">
                                {{ $vehicle->make }} {{ $vehicle->model }}
                            </h3>
                            <div class="flex items-center text-sm text-gray-600 dark:text-gray-400 space-x-2">
                                <span class="bg-gray-100 dark:bg-gray-700 px-2 py-1 rounded-md">{{ $vehicle->year }}</span>
                                <span class="bg-gray-100 dark:bg-gray-700 px-2 py-1 rounded-md">{{ $vehicle->color }}</span>
                                <span class="bg-gray-100 dark:bg-gray-700 px-2 py-1 rounded-md">{{ $vehicle->car_type }}</span>
                            </div>
                        </div>

                        <!-- Specs Grid -->
                        <div class="grid grid-cols-2 gap-3 mb-4">
                            <div class="flex items-center text-xs text-gray-500 dark:text-gray-400">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                                </svg>
                                ₱{{ number_format($vehicle->daily_rate, 0) }}/day
                            </div>
                            <div class="flex items-center text-xs text-gray-500 dark:text-gray-400">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                {{ $vehicle->seating_capacity }} seats
                            </div>
                            <div class="flex items-center text-xs text-gray-500 dark:text-gray-400">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                </svg>
                                {{ $vehicle->transmission }}
                            </div>
                            <div class="flex items-center text-xs text-gray-500 dark:text-gray-400">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                {{ number_format($vehicle->mileage) }} km
                            </div>
                        </div>

                        <!-- Action Row: Price and Rent Button -->
                        <div class="flex items-center justify-between pt-4 border-t border-gray-100 dark:border-gray-700">
                            <div class="flex items-center space-x-2">
                                <span class="text-2xl font-bold text-gray-900 dark:text-white">₱{{ number_format($vehicle->daily_rate, 0) }}</span>
                                <span class="text-sm text-gray-500 dark:text-gray-400">/day</span>
                            </div>
                            <a href="{{ route('vehicles.rent', $vehicle) }}" class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white text-sm font-medium rounded-lg shadow-sm transition-colors duration-200">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                </svg>
                                Rent
                            </a>
                        </div>
                    </div>

                    <!-- Hover Effect Border -->
                    <div class="absolute inset-0 rounded-2xl border-2 border-transparent group-hover:border-blue-500/20 transition-all duration-500 pointer-events-none"></div>
                </div>
                @endforeach
                @else
                <!-- Empty State -->
                <div class="col-span-full">
                    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg border border-gray-200 dark:border-gray-700 p-16 text-center">
                        <div class="w-24 h-24 bg-gradient-to-r from-blue-500 to-indigo-500 rounded-2xl flex items-center justify-center mx-auto mb-8 shadow-lg">
                            <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">No Vehicles Found</h3>
                        <p class="text-gray-600 dark:text-gray-400 mb-8 text-lg">Get started by adding your first vehicle to the fleet.</p>
                        <a href="{{ route('vehicles.create') }}" class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white text-lg font-medium rounded-xl shadow-lg transition-all duration-200 transform hover:scale-105 active:scale-95">
                            <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            Add Your First Vehicle
                        </a>
                    </div>
                </div>
                @endif
            </div>
        </main>
    </div>

    <!-- Vehicle Details Modal -->
    <div id="vehicleModal" class="fixed inset-0 z-50 hidden">
        <!-- Backdrop -->
        <div class="absolute inset-0 bg-black/60 backdrop-blur-sm" onclick="closeVehicleModal()"></div>

        <!-- Modal Content -->
        <div class="relative min-h-screen flex items-center justify-center p-4">
            <div class="bg-white dark:bg-gray-900 rounded-3xl shadow-2xl max-w-6xl w-full max-h-[90vh] overflow-hidden transform transition-all duration-500 scale-95 opacity-0" id="modalContent">
                <!-- Modal Header -->
                <div class="relative bg-gradient-to-r from-blue-600 to-indigo-600 text-white p-8">
                    <button onclick="closeVehicleModal()" class="absolute top-6 right-6 text-white/80 hover:text-white transition-colors">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                    <div class="flex items-center space-x-4">
                        <div class="w-16 h-16 bg-white/20 rounded-2xl flex items-center justify-center backdrop-blur-sm">
                            <i class="fas fa-car text-white text-3xl"></i>
                        </div>
                        <div>
                            <h2 class="text-3xl font-bold" id="modalTitle">Vehicle Details</h2>
                            <p class="text-blue-100 mt-1">Complete vehicle information and gallery</p>
                        </div>
                    </div>
                </div>

                <!-- Modal Body -->
                <div class="p-8 overflow-y-auto max-h-[calc(90vh-200px)]">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                        <!-- Image Gallery -->
                        <div class="space-y-6">
                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-4">Vehicle Gallery</h3>

                            <!-- Main Image -->
                            <div class="relative rounded-2xl overflow-hidden bg-gray-100 dark:bg-gray-800 h-80">
                                <img id="mainImage" src="" alt="Vehicle" class="w-full h-full object-cover">
                                <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent"></div>
                                <div id="mainImageFallback" class="hidden w-full h-full flex items-center justify-center">
                                    <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                    </svg>
                                </div>
                            </div>

                            <!-- Thumbnail Gallery -->
                            <div class="grid grid-cols-3 gap-4" id="thumbnailGallery">
                                <!-- Thumbnails will be populated here -->
                            </div>
                        </div>

                        <!-- Vehicle Information -->
                        <div class="space-y-6">
                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-4">Vehicle Information</h3>

                            <!-- Basic Info -->
                            <div class="bg-gray-50 dark:bg-gray-800 rounded-2xl p-6">
                                <h4 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Basic Information</h4>
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label class="text-sm font-medium text-gray-500 dark:text-gray-400">Make & Model</label>
                                        <p class="text-gray-900 dark:text-white font-semibold" id="modalMakeModel">-</p>
                                    </div>
                                    <div>
                                        <label class="text-sm font-medium text-gray-500 dark:text-gray-400">Year</label>
                                        <p class="text-gray-900 dark:text-white font-semibold" id="modalYear">-</p>
                                    </div>
                                    <div>
                                        <label class="text-sm font-medium text-gray-500 dark:text-gray-400">Color</label>
                                        <p class="text-gray-900 dark:text-white font-semibold" id="modalColor">-</p>
                                    </div>
                                    <div>
                                        <label class="text-sm font-medium text-gray-500 dark:text-gray-400">Type</label>
                                        <p class="text-gray-900 dark:text-white font-semibold" id="modalType">-</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Specifications -->
                            <div class="bg-gray-50 dark:bg-gray-800 rounded-2xl p-6">
                                <h4 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Specifications</h4>
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label class="text-sm font-medium text-gray-500 dark:text-gray-400">Transmission</label>
                                        <p class="text-gray-900 dark:text-white font-semibold" id="modalTransmission">-</p>
                                    </div>
                                    <div>
                                        <label class="text-sm font-medium text-gray-500 dark:text-gray-400">Fuel Type</label>
                                        <p class="text-gray-900 dark:text-white font-semibold" id="modalFuelType">-</p>
                                    </div>
                                    <div>
                                        <label class="text-sm font-medium text-gray-500 dark:text-gray-400">Seating Capacity</label>
                                        <p class="text-gray-900 dark:text-white font-semibold" id="modalSeatingCapacity">-</p>
                                    </div>
                                    <div>
                                        <label class="text-sm font-medium text-gray-500 dark:text-gray-400">Mileage</label>
                                        <p class="text-gray-900 dark:text-white font-semibold" id="modalMileage">-</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Pricing & Status -->
                            <div class="bg-gradient-to-r from-blue-50 to-indigo-50 dark:from-blue-900/20 dark:to-indigo-900/20 rounded-2xl p-6">
                                <h4 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Pricing & Status</h4>
                                <div class="flex items-center justify-between">
                                    <div>
                                        <label class="text-sm font-medium text-gray-500 dark:text-gray-400">Daily Rate</label>
                                        <p class="text-3xl font-bold text-blue-600 dark:text-blue-400" id="modalDailyRate">-</p>
                                    </div>
                                    <div class="text-right">
                                        <label class="text-sm font-medium text-gray-500 dark:text-gray-400">Status</label>
                                        <div id="modalStatus">-</div>
                                    </div>
                                </div>
                            </div>

                            <!-- Additional Info -->
                            <div class="bg-gray-50 dark:bg-gray-800 rounded-2xl p-6">
                                <h4 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Additional Information</h4>
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label class="text-sm font-medium text-gray-500 dark:text-gray-400">Insurance</label>
                                        <p class="text-gray-900 dark:text-white font-semibold" id="modalInsurance">-</p>
                                    </div>
                                    <div>
                                        <label class="text-sm font-medium text-gray-500 dark:text-gray-400">Condition</label>
                                        <p class="text-gray-900 dark:text-white font-semibold" id="modalCondition">-</p>
                                    </div>
                                    <div class="col-span-2">
                                        <label class="text-sm font-medium text-gray-500 dark:text-gray-400">Last Service</label>
                                        <p class="text-gray-900 dark:text-white font-semibold" id="modalLastService">-</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div id="deleteModal" class="fixed inset-0 z-50 hidden">
        <!-- Backdrop -->
        <div class="absolute inset-0 bg-black/60 backdrop-blur-sm" onclick="closeDeleteModal()"></div>

        <!-- Modal Content -->
        <div class="relative min-h-screen flex items-center justify-center p-4">
            <div class="bg-white dark:bg-gray-900 rounded-2xl shadow-2xl max-w-md w-full transform transition-all duration-300 scale-95 opacity-0" id="deleteModalContent">
                <!-- Modal Header -->
                <div class="relative bg-gradient-to-r from-red-600 to-pink-600 text-white p-6 rounded-t-2xl">
                    <button onclick="closeDeleteModal()" class="absolute top-4 right-4 text-white/80 hover:text-white transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                    <div class="flex items-center space-x-3">
                        <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center backdrop-blur-sm">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-xl font-bold">Delete Vehicle</h2>
                            <p class="text-red-100 text-sm">This action cannot be undone</p>
                        </div>
                    </div>
                </div>

                <!-- Modal Body -->
                <div class="p-6">
                    <div class="text-center">
                        <div class="w-16 h-16 bg-red-100 dark:bg-red-900/20 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-red-600 dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">Are you sure?</h3>
                        <p class="text-gray-600 dark:text-gray-400 mb-6">
                            You are about to delete <span class="font-semibold text-gray-900 dark:text-white" id="deleteVehicleName">this vehicle</span>.
                            This action will permanently remove the vehicle and all associated images from the system.
                        </p>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex space-x-3">
                        <button onclick="closeDeleteModal()" class="flex-1 px-4 py-3 text-gray-700 dark:text-gray-300 bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 rounded-xl font-medium transition-colors duration-200">
                            Cancel
                        </button>
                        <form id="deleteVehicleForm" method="POST" class="flex-1">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <button type="submit" class="w-full px-4 py-3 bg-gradient-to-r from-red-600 to-pink-600 hover:from-red-700 hover:to-pink-700 text-white rounded-xl font-medium transition-all duration-200 transform hover:scale-105 active:scale-95">
                                Delete Vehicle
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
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

        // Vehicle Modal Functions
        function openVehicleModal(id, make, model, year, color, type, transmission, fuelType, dailyRate, availability, mileage, seatingCapacity, insurance, lastService, condition, images) {
            const modal = document.getElementById('vehicleModal');
            const modalContent = document.getElementById('modalContent');

            // Parse images JSON
            const imageArray = JSON.parse(images);

            // Update modal content
            document.getElementById('modalTitle').textContent = `${make} ${model}`;
            document.getElementById('modalMakeModel').textContent = `${make} ${model}`;
            document.getElementById('modalYear').textContent = year;
            document.getElementById('modalColor').textContent = color;
            document.getElementById('modalType').textContent = type;
            document.getElementById('modalTransmission').textContent = transmission;
            document.getElementById('modalFuelType').textContent = fuelType;
            document.getElementById('modalSeatingCapacity').textContent = `${seatingCapacity} seats`;
            document.getElementById('modalMileage').textContent = `${Number(mileage).toLocaleString()} km`;
            document.getElementById('modalDailyRate').textContent = `₱${Number(dailyRate).toLocaleString()}`;
            document.getElementById('modalInsurance').textContent = insurance;
            document.getElementById('modalCondition').textContent = condition;
            document.getElementById('modalLastService').textContent = new Date(lastService).toLocaleDateString();

            // Update status badge
            const statusElement = document.getElementById('modalStatus');
            if (availability === 'Available') {
                statusElement.innerHTML = '<span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-semibold bg-emerald-500 text-white"><span class="w-2 h-2 bg-white rounded-full mr-2 animate-pulse"></span>Available</span>';
            } else if (availability === 'Rented') {
                statusElement.innerHTML = '<span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-semibold bg-amber-500 text-white"><span class="w-2 h-2 bg-white rounded-full mr-2"></span>Rented</span>';
            } else {
                statusElement.innerHTML = `<span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-semibold bg-red-500 text-white"><span class="w-2 h-2 bg-white rounded-full mr-2"></span>${availability}</span>`;
            }

            // Update image gallery
            updateImageGallery(imageArray);

            // Show modal with animation
            modal.classList.remove('hidden');
            setTimeout(() => {
                modalContent.classList.remove('scale-95', 'opacity-0');
                modalContent.classList.add('scale-100', 'opacity-100');
            }, 10);
        }

        function closeVehicleModal() {
            const modal = document.getElementById('vehicleModal');
            const modalContent = document.getElementById('modalContent');

            modalContent.classList.add('scale-95', 'opacity-0');
            modalContent.classList.remove('scale-100', 'opacity-100');

            setTimeout(() => {
                modal.classList.add('hidden');
            }, 300);
        }

        function updateImageGallery(images) {
            const mainImage = document.getElementById('mainImage');
            const thumbnailGallery = document.getElementById('thumbnailGallery');

            // Clear existing thumbnails
            thumbnailGallery.innerHTML = '';

            if (images && images.length > 0) {
                // Set main image
                mainImage.src = `/storage/${images[0]}`;
                mainImage.onerror = function() {
                    this.style.display = 'none';
                    document.getElementById('mainImageFallback').style.display = 'flex';
                };

                // Create thumbnails
                images.forEach((image, index) => {
                    const thumbnail = document.createElement('div');
                    thumbnail.className = 'relative cursor-pointer rounded-lg overflow-hidden h-20 hover:opacity-80 transition-opacity thumbnail';
                    thumbnail.onclick = () => {
                        mainImage.src = `/storage/${image}`;
                        // Update active thumbnail
                        document.querySelectorAll('.thumbnail').forEach(thumb => thumb.classList.remove('ring-2', 'ring-blue-500'));
                        thumbnail.classList.add('ring-2', 'ring-blue-500');
                    };

                    thumbnail.innerHTML = `
                        <img src="/storage/${image}" alt="Vehicle image ${index + 1}" class="w-full h-full object-cover" onerror="this.parentElement.style.display='none';">
                    `;

                    if (index === 0) {
                        thumbnail.classList.add('ring-2', 'ring-blue-500');
                    }

                    thumbnailGallery.appendChild(thumbnail);
                });
            } else {
                // Show placeholder
                mainImage.src = '';
                mainImage.style.backgroundColor = '#f3f4f6';
                mainImage.innerHTML = `
                    <div class="w-full h-full flex items-center justify-center">
                        <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                        </svg>
                    </div>
                `;
            }
        }

        // Close modal on escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeVehicleModal();
                closeDeleteModal();
            }
        });

        // Delete Vehicle Functions
        function confirmDeleteVehicle(vehicleId, vehicleName) {
            const modal = document.getElementById('deleteModal');
            const modalContent = document.getElementById('deleteModalContent');
            const deleteForm = document.getElementById('deleteVehicleForm');
            const vehicleNameElement = document.getElementById('deleteVehicleName');

            // Update form action and vehicle name
            deleteForm.action = `/vehicles/${vehicleId}`;
            vehicleNameElement.textContent = vehicleName;

            // Show modal with animation
            modal.classList.remove('hidden');
            setTimeout(() => {
                modalContent.classList.remove('scale-95', 'opacity-0');
                modalContent.classList.add('scale-100', 'opacity-100');
            }, 10);
        }

        // Add form submission handler to show loading state
        document.getElementById('deleteVehicleForm').addEventListener('submit', function(e) {
            const submitButton = this.querySelector('button[type="submit"]');
            const originalText = submitButton.innerHTML;

            // Show loading state
            submitButton.innerHTML = `
                <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white inline" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                Deleting...
            `;
            submitButton.disabled = true;
        });

        function closeDeleteModal() {
            const modal = document.getElementById('deleteModal');
            const modalContent = document.getElementById('deleteModalContent');

            modalContent.classList.add('scale-95', 'opacity-0');
            modalContent.classList.remove('scale-100', 'opacity-100');

            setTimeout(() => {
                modal.classList.add('hidden');
            }, 300);
        }
    </script>
</body>

</html>