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
}
