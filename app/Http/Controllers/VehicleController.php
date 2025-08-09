<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use App\Models\Vehicle;

class VehicleController extends Controller
{
    /**
     * Display the vehicles page
     */
    public function index()
    {
        $vehicles = Vehicle::latest()->get();
        return view('vehicles.index', compact('vehicles'));
    }

    /**
     * Show the form for creating a new vehicle
     */
    public function create()
    {
        return view('vehicles.create');
    }

    /**
     * Store a newly created vehicle
     */
    public function store(Request $request)
    {
        // Debug: Log the seating capacity value
        Log::info('Seating capacity value:', [
            'raw_value' => $request->seating_capacity,
            'type' => gettype($request->seating_capacity),
            'int_value' => (int) $request->seating_capacity
        ]);

        // Debug: Log file upload information
        Log::info('File upload debug:', [
            'has_files' => $request->hasFile('images'),
            'files_count' => $request->hasFile('images') ? count($request->file('images')) : 0,
            'all_files' => $request->allFiles(),
        ]);

        $request->validate([
            'car_id' => 'required|string|max:10|unique:vehicles',
            'license_plate' => 'required|string|max:20|unique:vehicles',
            'make' => 'required|string|max:50',
            'model' => 'required|string|max:50',
            'year' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'color' => 'required|string|max:30',
            'car_type' => 'required|string|max:30',
            'transmission' => 'required|string|max:20',
            'fuel_type' => 'required|string|max:20',
            'daily_rate' => 'required|numeric|min:0',
            'availability' => 'required|string|max:20',
            'mileage' => 'required|integer|min:0',
            'seating_capacity' => 'required|integer|min:1|max:20',
            'insurance' => 'required|string|max:50',
            'last_service' => 'required|date',
            'condition' => 'required|string|max:30',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        // Handle image uploads
        $imagePaths = [];
        if ($request->hasFile('images')) {
            // Create vehicles directory if it doesn't exist
            $vehiclesPath = storage_path('app/public/vehicles');
            if (!file_exists($vehiclesPath)) {
                mkdir($vehiclesPath, 0755, true);
            }

            foreach ($request->file('images') as $index => $image) {
                Log::info("Processing image {$index}:", [
                    'original_name' => $image->getClientOriginalName(),
                    'mime_type' => $image->getMimeType(),
                    'size' => $image->getSize(),
                    'is_valid' => $image->isValid(),
                    'error' => $image->getError()
                ]);

                if ($image->isValid()) {
                    // Generate unique filename
                    $filename = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                    $path = $image->storeAs('vehicles', $filename, 'public');
                    $imagePaths[] = $path;

                    // Debug: Log the uploaded image
                    Log::info('Image uploaded successfully:', [
                        'original_name' => $image->getClientOriginalName(),
                        'stored_path' => $path,
                        'size' => $image->getSize()
                    ]);
                } else {
                    Log::error('Image upload failed:', [
                        'original_name' => $image->getClientOriginalName(),
                        'error' => $image->getError()
                    ]);
                }
            }
        }

        // Debug: Log the image paths
        Log::info('Image paths to save:', $imagePaths);

        // Prepare vehicle data
        $vehicleData = [
            'car_id' => $request->car_id,
            'license_plate' => $request->license_plate,
            'make' => $request->make,
            'model' => $request->model,
            'year' => $request->year,
            'color' => $request->color,
            'car_type' => $request->car_type,
            'transmission' => $request->transmission,
            'fuel_type' => $request->fuel_type,
            'daily_rate' => $request->daily_rate,
            'availability' => $request->availability,
            'mileage' => $request->mileage,
            'seating_capacity' => (int) $request->seating_capacity, // Ensure it's an integer
            'insurance' => $request->insurance,
            'last_service' => $request->last_service,
            'condition' => $request->condition,
        ];

        // Only add images if there are any
        if (!empty($imagePaths)) {
            $vehicleData['images'] = $imagePaths;
        }

        // Debug: Log the final vehicle data
        Log::info('Vehicle data to save:', $vehicleData);

        // Create the vehicle
        $vehicle = Vehicle::create($vehicleData);

        return redirect()->route('vehicles.index')
            ->with('success', 'Vehicle added successfully!');
    }

    /**
     * Display the specified vehicle (details page)
     */
    public function show(Vehicle $vehicle)
    {
        return view('vehicles.show', compact('vehicle'));
    }

    /**
     * Show rent form for a vehicle
     */
    public function rent(Vehicle $vehicle)
    {
        return view('vehicles.rent', compact('vehicle'));
    }

    /**
     * Store rental submission (placeholder)
     */
    public function rentStore(Request $request, Vehicle $vehicle)
    {
        $validated = $request->validate([
            'renter_name' => 'required|string|max:100',
            'renter_id' => 'required|string|max:50',
            'contact' => 'required|string|max:50',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'daily_rate' => 'required|numeric|min:0',
            'discount' => 'nullable|numeric|min:0',
            'extra_fees' => 'nullable|numeric|min:0',
            'notes' => 'nullable|string|max:500',
        ]);

        // For now, just redirect back with calculated total preview
        $start = new \Carbon\Carbon($validated['start_date']);
        $end = new \Carbon\Carbon($validated['end_date']);
        $days = max(1, $start->diffInDays($end) ?: 1);
        $rate = (float) $validated['daily_rate'];
        $discount = (float) ($validated['discount'] ?? 0);
        $extras = (float) ($validated['extra_fees'] ?? 0);
        $subtotal = $days * $rate;
        $total = max(0, $subtotal - $discount + $extras);

        return redirect()->route('vehicles.rent', $vehicle)
            ->with('success', 'Rental computed successfully.')
            ->with('preview', [
                'days' => $days,
                'rate' => $rate,
                'discount' => $discount,
                'extras' => $extras,
                'subtotal' => $subtotal,
                'total' => $total,
            ]);
    }

    /**
     * Show the form for editing the specified vehicle
     */
    public function edit(Vehicle $vehicle)
    {
        return view('vehicles.edit', compact('vehicle'));
    }

    /**
     * Update the specified vehicle in storage
     */
    public function update(Request $request, Vehicle $vehicle)
    {
        $request->validate([
            'car_id' => 'required|string|max:10|unique:vehicles,car_id,' . $vehicle->id,
            'license_plate' => 'required|string|max:20|unique:vehicles,license_plate,' . $vehicle->id,
            'make' => 'required|string|max:50',
            'model' => 'required|string|max:50',
            'year' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'color' => 'required|string|max:30',
            'car_type' => 'required|string|max:30',
            'transmission' => 'required|string|max:20',
            'fuel_type' => 'required|string|max:20',
            'daily_rate' => 'required|numeric|min:0',
            'availability' => 'required|string|max:20',
            'mileage' => 'required|integer|min:0',
            'seating_capacity' => 'required|integer|min:1|max:20',
            'insurance' => 'required|string|max:50',
            'last_service' => 'required|date',
            'condition' => 'required|string|max:30',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        // Handle image uploads
        $imagePaths = $vehicle->images ?? [];

        if ($request->hasFile('images')) {
            // Create vehicles directory if it doesn't exist
            $vehiclesPath = storage_path('app/public/vehicles');
            if (!file_exists($vehiclesPath)) {
                mkdir($vehiclesPath, 0755, true);
            }

            foreach ($request->file('images') as $index => $image) {
                if ($image->isValid()) {
                    // Generate unique filename
                    $filename = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                    $path = $image->storeAs('vehicles', $filename, 'public');
                    $imagePaths[] = $path;
                }
            }
        }

        // Handle image removal
        if ($request->has('remove_images')) {
            $removeImages = $request->remove_images;
            foreach ($removeImages as $imagePath) {
                if (Storage::disk('public')->exists($imagePath)) {
                    Storage::disk('public')->delete($imagePath);
                }
                $imagePaths = array_diff($imagePaths, [$imagePath]);
            }
        }

        // Prepare vehicle data
        $vehicleData = [
            'car_id' => $request->car_id,
            'license_plate' => $request->license_plate,
            'make' => $request->make,
            'model' => $request->model,
            'year' => $request->year,
            'color' => $request->color,
            'car_type' => $request->car_type,
            'transmission' => $request->transmission,
            'fuel_type' => $request->fuel_type,
            'daily_rate' => $request->daily_rate,
            'availability' => $request->availability,
            'mileage' => $request->mileage,
            'seating_capacity' => (int) $request->seating_capacity,
            'insurance' => $request->insurance,
            'last_service' => $request->last_service,
            'condition' => $request->condition,
            'images' => array_values($imagePaths), // Re-index array
        ];

        // Update the vehicle
        $vehicle->update($vehicleData);

        return redirect()->route('vehicles.index')
            ->with('success', 'Vehicle updated successfully!');
    }

    /**
     * Remove the specified vehicle from storage
     */
    public function destroy(Vehicle $vehicle)
    {
        try {
            // Log the deletion attempt
            Log::info('Vehicle deletion started:', [
                'vehicle_id' => $vehicle->id,
                'vehicle_name' => $vehicle->make . ' ' . $vehicle->model
            ]);

            // Delete associated images from storage
            if ($vehicle->images && is_array($vehicle->images)) {
                foreach ($vehicle->images as $imagePath) {
                    if (Storage::disk('public')->exists($imagePath)) {
                        Storage::disk('public')->delete($imagePath);
                        Log::info('Deleted image:', ['path' => $imagePath]);
                    }
                }
            }

            // Delete the vehicle record
            $vehicle->delete();

            Log::info('Vehicle deleted successfully:', [
                'vehicle_id' => $vehicle->id,
                'vehicle_name' => $vehicle->make . ' ' . $vehicle->model
            ]);

            return redirect()->route('vehicles.index')
                ->with('success', 'Vehicle deleted successfully!');
        } catch (\Exception $e) {
            Log::error('Vehicle deletion failed:', [
                'vehicle_id' => $vehicle->id,
                'error' => $e->getMessage()
            ]);

            return redirect()->route('vehicles.index')
                ->with('error', 'Failed to delete vehicle. Please try again.');
        }
    }
}
