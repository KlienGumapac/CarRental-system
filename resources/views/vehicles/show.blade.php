<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Vehicle Details - NexaDrive</title>
    @if(file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @endif
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body class="bg-gray-50 dark:bg-gray-900 min-h-screen" x-data="{}" x-init="
  const savedDarkMode = localStorage.getItem('darkMode');
  const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
  if (savedDarkMode === 'true' || (!savedDarkMode && prefersDark)) {
    document.documentElement.classList.add('dark');
    document.documentElement.setAttribute('data-theme','dark');
    document.documentElement.style.colorScheme = 'dark';
    document.documentElement.style.setProperty('color-scheme','dark');
  } else {
    document.documentElement.classList.remove('dark');
    document.documentElement.setAttribute('data-theme','light');
    document.documentElement.style.colorScheme = 'light';
    document.documentElement.style.setProperty('color-scheme','light');
  }
">
    @include('components.sidebar')

    <div class="lg:ml-64 min-h-screen">
        <header class="bg-white dark:bg-gray-800 shadow-sm border-b border-gray-200 dark:border-gray-700 sticky top-0 z-40">
            <div class="flex items-center justify-between h-16 px-4 sm:px-6 lg:px-8">
                <button onclick="openSidebar()" class="lg:hidden p-2 rounded-md text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
                <div class="flex-1 lg:flex-none">
                    <h1 class="text-xl font-semibold text-gray-900 dark:text-white">Vehicle Details</h1>
                </div>
                <div class="flex items-center gap-3">
                    <a href="{{ route('vehicles.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 text-gray-700 dark:text-gray-300 text-sm font-medium rounded-lg transition-colors">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Back
                    </a>
                    <a href="{{ route('vehicles.edit', $vehicle) }}" class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white text-sm font-medium rounded-lg transition-colors">
                        <i class="fas fa-pen mr-2"></i> Edit
                    </a>
                </div>
            </div>
        </header>

        <main class="min-h-screen p-4 sm:p-6 lg:p-8">
            <!-- Header Banner -->
            <div class="bg-gradient-to-r from-blue-600 to-indigo-600 rounded-2xl p-8 text-white mb-8">
                <div class="flex items-center space-x-6">
                    <div class="w-16 h-16 bg-white/20 rounded-2xl flex items-center justify-center backdrop-blur-sm">
                        <i class="fas fa-car text-white text-3xl"></i>
                    </div>
                    <div>
                        <h2 class="text-3xl font-bold mb-2">{{ $vehicle->make }} {{ $vehicle->model }}</h2>
                        <p class="text-blue-100 text-lg">{{ $vehicle->year }} · {{ $vehicle->color }} · {{ $vehicle->car_type }}</p>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 xl:grid-cols-3 gap-8">
                <!-- Left: Gallery -->
                <div class="xl:col-span-1">
                    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg border border-gray-200 dark:border-gray-700 p-6">
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-4">Gallery</h3>
                        @php($images = $vehicle->images ?? [])
                        @if(!empty($images))
                        <div class="space-y-4">
                            <div class="aspect-video w-full overflow-hidden rounded-xl bg-gray-100 dark:bg-gray-700">
                                <img id="mainImage" src="{{ Storage::url($images[0]) }}" alt="Vehicle" class="w-full h-full object-cover">
                            </div>
                            <div class="grid grid-cols-3 gap-3">
                                @foreach($images as $idx => $img)
                                <button class="relative rounded-lg overflow-hidden border border-gray-200 dark:border-gray-700 hover:opacity-90" onclick="document.getElementById('mainImage').src='{{ Storage::url($img) }}'">
                                    <img src="{{ Storage::url($img) }}" class="w-full h-20 object-cover" alt="Vehicle {{ $idx+1 }}">
                                </button>
                                @endforeach
                            </div>
                        </div>
                        @else
                        <div class="aspect-video w-full rounded-xl bg-gray-100 dark:bg-gray-700 flex items-center justify-center">
                            <i class="fas fa-image text-gray-400 text-3xl"></i>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Right: Information -->
                <div class="xl:col-span-2 space-y-6">
                    <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 border border-gray-200 dark:border-gray-700">
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-6">Basic Information</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Make & Model</p>
                                <p class="text-gray-900 dark:text-white font-semibold">{{ $vehicle->make }} {{ $vehicle->model }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Year</p>
                                <p class="text-gray-900 dark:text-white font-semibold">{{ $vehicle->year }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Color</p>
                                <p class="text-gray-900 dark:text-white font-semibold">{{ $vehicle->color }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Type</p>
                                <p class="text-gray-900 dark:text-white font-semibold">{{ $vehicle->car_type }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 border border-gray-200 dark:border-gray-700 pricing-section">
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-6">Pricing & Status</h3>
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Daily Rate</p>
                                <p class="text-3xl font-bold text-blue-600 dark:text-blue-400">₱{{ number_format($vehicle->daily_rate, 0) }}</p>
                            </div>
                            <div class="text-right">
                                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Status</p>
                                @php($status = $vehicle->availability)
                                @if($status === 'Available')
                                <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-semibold bg-emerald-500 text-white shadow">
                                    <span class="w-2 h-2 bg-white rounded-full mr-2 animate-pulse"></span>
                                    Available
                                </span>
                                @elseif($status === 'Rented')
                                <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-semibold bg-amber-500 text-white shadow">Rented</span>
                                @else
                                <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-semibold bg-red-500 text-white shadow">{{ $status }}</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 border border-gray-200 dark:border-gray-700">
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-6">Specifications</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Transmission</p>
                                <p class="text-gray-900 dark:text-white font-semibold">{{ $vehicle->transmission }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Fuel Type</p>
                                <p class="text-gray-900 dark:text-white font-semibold">{{ $vehicle->fuel_type }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Seating Capacity</p>
                                <p class="text-gray-900 dark:text-white font-semibold">{{ $vehicle->seating_capacity }} seats</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Mileage</p>
                                <p class="text-gray-900 dark:text-white font-semibold">{{ number_format($vehicle->mileage) }} km</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 border border-gray-200 dark:border-gray-700">
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-6">Additional Information</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Insurance</p>
                                <p class="text-gray-900 dark:text-white font-semibold">{{ $vehicle->insurance }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Condition</p>
                                <p class="text-gray-900 dark:text-white font-semibold">{{ $vehicle->condition }}</p>
                            </div>
                            <div class="md:col-span-2">
                                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Last Service</p>
                                <p class="text-gray-900 dark:text-white font-semibold">{{ \Carbon\Carbon::parse($vehicle->last_service)->format('M d, Y') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

</body>

</html>