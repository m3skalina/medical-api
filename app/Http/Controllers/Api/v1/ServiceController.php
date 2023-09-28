<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Service\ServiceStoreRequest;
use App\Http\Requests\Service\ServiceUpdateRequest;
use App\Http\Resources\Service\ServiceResource;
use App\Models\Service;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class ServiceController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Service::class, 'service');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {

        $services = Service::query()
            ->where('point_id', auth()->user()->point_id)
            ->orderBy('name')
            ->paginate(10);

        return response()->json(
            ServiceResource::collection($services)
        );

    }

    /**
     * Display the specified resource.
     */
    public function show(Service $service): JsonResponse
    {

        return response()->json(
            ServiceResource::make($service)
        );

    }

    /**
     * Store a resource.
     */
    public function store(ServiceStoreRequest $request): JsonResponse
    {

        try {

            $service = Service::create([
                'point_id' => auth()->user()->point_id,
                'name' => $request->validated('name'),
                'price' => $request->validated('price'),
                'is_active' => $request->validated('is_active'),
            ]);

            return response()->json(
                ServiceResource::make($service)
            );

        } catch (\Exception $e) {

            Log::error('Exception on service.store: '.$e->getMessage());

            return response()->json('Server Error', 500);

        }

    }

    /**
     * Update a resource
     */
    public function update(ServiceUpdateRequest $request, Service $service): JsonResponse
    {

        try {

            $service->update([
                'name' => $request->validated('name'),
                'price' => $request->validated('price'),
                'is_active' => $request->validated('is_active'),
            ]);

            return response()->json(
                ServiceResource::make($service)
            );

        } catch (\Exception $e) {

            Log::error('Exception on service.update: '.$e->getMessage());

            return response()->json('Server Error', 500);
        }

    }

    /**
     * Update status field of a resource
     */
    public function updateStatus(Service $service): JsonResponse
    {

        $this->authorize('updateStatus', $service);

        try {

            $service->update([
                'is_active' => ! $service->is_active,
            ]);

            return response()->json(
                ServiceResource::make($service)
            );

        } catch (\Exception $e) {

            Log::error('Exception on service.updateStatus: '.$e->getMessage());

            return response()->json('Server Error', 500);
        }
    }

    /**
     * Delete a resource
     */
    public function delete(Service $service): JsonResponse
    {

        $this->authorize('delete', $service);

        try {

            $service->delete();

            return response()->json();

        } catch (\Exception $e) {

            Log::error('Exception on service.delete: '.$e->getMessage());

            return response()->json('Server Error', 500);
        }

    }
}
