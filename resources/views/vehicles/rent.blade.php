<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Rent Vehicle - NexaDrive</title>
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
    document.documentElement.style.colorScheme='dark';
  } else {
    document.documentElement.classList.remove('dark');
    document.documentElement.setAttribute('data-theme','light');
    document.documentElement.style.colorScheme='light';
  }
">
    @include('components.sidebar')

    <div class="lg:ml-64 min-h-screen">
        <header class="bg-white dark:bg-gray-800 shadow-sm border-b border-gray-200 dark:border-gray-700 sticky top-0 z-40">
            <div class="flex items-center justify-between h-16 px-4 sm:px-6 lg:px-8">
                <div class="flex-1 lg:flex-none">
                    <h1 class="text-xl font-semibold text-gray-900 dark:text-white">Rent Vehicle</h1>
                </div>
                <div class="flex items-center gap-3">
                    <a href="{{ route('vehicles.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 text-gray-700 dark:text-gray-300 text-sm font-medium rounded-lg transition-colors">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Back
                    </a>
                </div>
            </div>
        </header>

        <main class="p-4 sm:p-6 lg:p-8">
            @if(session('success'))
            <div class="mb-6 bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-lg p-4 text-sm text-green-800 dark:text-green-200">
                {{ session('success') }}
            </div>
            @endif

            <div class="grid grid-cols-1 xl:grid-cols-3 gap-8">
                <!-- Vehicle Summary & Gallery -->
                <div class="xl:col-span-1 space-y-6">
                    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg border border-gray-200 dark:border-gray-700 p-6">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Vehicle Summary</h3>
                        <div class="flex items-center gap-4">
                            <div class="w-24 h-16 rounded-lg overflow-hidden bg-gray-100 dark:bg-gray-700">
                                @php($first = ($vehicle->images ?? [])[0] ?? null)
                                @if($first)
                                <img id="rentMainImage" src="{{ Storage::url($first) }}" class="w-full h-full object-cover" />
                                @endif
                            </div>
                            <div>
                                <p class="text-gray-900 dark:text-white font-semibold">{{ $vehicle->make }} {{ $vehicle->model }}</p>
                                <p class="text-sm text-gray-600 dark:text-gray-400">{{ $vehicle->year }} · {{ $vehicle->color }} · {{ $vehicle->car_type }}</p>
                                <p class="text-sm text-gray-600 dark:text-gray-400">Plate: {{ $vehicle->license_plate }}</p>
                                <p class="text-sm text-gray-600 dark:text-gray-400">Daily: ₱{{ number_format($vehicle->daily_rate, 0) }}</p>
                            </div>
                        </div>
                        @php($images = $vehicle->images ?? [])
                        @if(!empty($images))
                        <div class="mt-4 aspect-video w-full overflow-hidden rounded-xl bg-gray-100 dark:bg-gray-700">
                            <img id="rentMainLarge" src="{{ Storage::url($images[0]) }}" alt="Vehicle" class="w-full h-full object-cover">
                        </div>
                        <div class="grid grid-cols-3 gap-3 mt-3">
                            @foreach($images as $idx => $img)
                            <button type="button" class="relative rounded-lg overflow-hidden border border-gray-200 dark:border-gray-700 hover:opacity-90" onclick="document.getElementById('rentMainLarge').src='{{ Storage::url($img) }}'">
                                <img src="{{ Storage::url($img) }}" class="w-full h-20 object-cover" alt="Vehicle {{ $idx+1 }}">
                            </button>
                            @endforeach
                        </div>
                        @endif
                    </div>

                    <!-- Vehicle Information -->
                    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg border border-gray-200 dark:border-gray-700 p-6">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Vehicle Information</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Car ID</p>
                                <p class="text-gray-900 dark:text-white font-semibold">{{ $vehicle->car_id }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">License Plate</p>
                                <p class="text-gray-900 dark:text-white font-semibold">{{ $vehicle->license_plate }}</p>
                            </div>
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
                            <div>
                                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Availability</p>
                                <p class="text-gray-900 dark:text-white font-semibold">{{ $vehicle->availability }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Insurance</p>
                                <p class="text-gray-900 dark:text-white font-semibold">{{ $vehicle->insurance }}</p>
                            </div>
                            <div class="md:col-span-2">
                                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Last Service</p>
                                <p class="text-gray-900 dark:text-white font-semibold">{{ \Carbon\Carbon::parse($vehicle->last_service)->format('M d, Y') }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Rent Form -->
                <div class="xl:col-span-2">
                    <form method="POST" action="{{ route('vehicles.rent.store', $vehicle) }}" id="rentForm" class="space-y-6">
                        @csrf

                        <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 border border-gray-200 dark:border-gray-700">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-6">Renter Information</h3>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <div>
                                    <label class="text-sm font-medium text-gray-700 dark:text-gray-300">Full Name</label>
                                    <input type="text" name="renter_name" class="mt-1 w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white" required />
                                </div>
                                <div>
                                    <label class="text-sm font-medium text-gray-700 dark:text-gray-300">Government ID / Number</label>
                                    <input type="text" name="renter_id" class="mt-1 w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white" required />
                                </div>
                                <div>
                                    <label class="text-sm font-medium text-gray-700 dark:text-gray-300">Contact</label>
                                    <input type="text" name="contact" class="mt-1 w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white" required />
                                </div>
                            </div>
                        </div>

                        <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 border border-gray-200 dark:border-gray-700">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-6">Rental Details</h3>
                            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                                <div>
                                    <label class="text-sm font-medium text-gray-700 dark:text-gray-300">Start Date</label>
                                    <input type="date" name="start_date" id="start_date" class="mt-1 w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white" required />
                                </div>
                                <div>
                                    <label class="text-sm font-medium text-gray-700 dark:text-gray-300">End Date</label>
                                    <input type="date" name="end_date" id="end_date" class="mt-1 w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white" required />
                                </div>
                                <div>
                                    <label class="text-sm font-medium text-gray-700 dark:text-gray-300">Daily Rate (editable)</label>
                                    <input type="number" step="0.01" name="daily_rate" id="daily_rate" value="{{ $vehicle->daily_rate }}" class="mt-1 w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white" required />
                                </div>
                                <div>
                                    <label class="text-sm font-medium text-gray-700 dark:text-gray-300">Days</label>
                                    <input type="number" id="days" readonly class="mt-1 w-full px-4 py-3 rounded-lg border border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-white" />
                                </div>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-4">
                                <div>
                                    <label class="text-sm font-medium text-gray-700 dark:text-gray-300">Discount</label>
                                    <input type="number" step="0.01" name="discount" id="discount" value="0" class="mt-1 w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white" />
                                </div>
                                <div>
                                    <label class="text-sm font-medium text-gray-700 dark:text-gray-300">Extra Fees</label>
                                    <input type="number" step="0.01" name="extra_fees" id="extra_fees" value="0" class="mt-1 w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white" />
                                </div>
                                <div>
                                    <label class="text-sm font-medium text-gray-700 dark:text-gray-300">Subtotal</label>
                                    <input type="number" id="subtotal" readonly class="mt-1 w-full px-4 py-3 rounded-lg border border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-white" />
                                </div>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-4">
                                <div class="md:col-span-2">
                                    <label class="text-sm font-medium text-gray-700 dark:text-gray-300">Notes</label>
                                    <textarea name="notes" rows="3" class="mt-1 w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white"></textarea>
                                </div>
                                <div>
                                    <label class="text-sm font-medium text-gray-700 dark:text-gray-300">Total</label>
                                    <input type="number" id="total" readonly class="mt-1 w-full px-4 py-3 rounded-lg border border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-white" />
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center justify-end gap-3">
                            <a href="{{ route('vehicles.index') }}" class="px-6 py-3 bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 text-gray-700 dark:text-gray-300 rounded-lg">Cancel</a>
                            <button type="submit" class="px-6 py-3 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white rounded-lg">Save Rental</button>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>

    <script>
        function computeDays(start, end) {
            if (!start || !end) return 0;
            const s = new Date(start);
            const e = new Date(end);
            const ms = e - s;
            if (isNaN(ms) || ms < 0) return 0;
            const days = Math.ceil(ms / (1000 * 60 * 60 * 24));
            return Math.max(1, days);
        }

        function recalc() {
            const start = document.getElementById('start_date').value;
            const end = document.getElementById('end_date').value;
            const rate = parseFloat(document.getElementById('daily_rate').value) || 0;
            const discount = parseFloat(document.getElementById('discount').value) || 0;
            const extras = parseFloat(document.getElementById('extra_fees').value) || 0;

            const days = computeDays(start, end);
            const subtotal = days * rate;
            const total = Math.max(0, subtotal - discount + extras);

            document.getElementById('days').value = days;
            document.getElementById('subtotal').value = subtotal.toFixed(2);
            document.getElementById('total').value = total.toFixed(2);
        }

        ['start_date', 'end_date', 'daily_rate', 'discount', 'extra_fees'].forEach(id => {
            document.addEventListener('input', (e) => {
                if (e.target && e.target.id === id) recalc();
            });
        });

        window.addEventListener('load', recalc);
        document.addEventListener('DOMContentLoaded', recalc);
    </script>
</body>

</html>