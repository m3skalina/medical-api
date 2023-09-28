<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Sale\SaleFilterRequest;
use App\Http\Resources\Sale\SaleResource;
use App\Models\Sale;
use Illuminate\Http\JsonResponse;

class SaleController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Sale::class, 'sale');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(SaleFilterRequest $request): JsonResponse
    {

        $baseQuery = Sale::query()
            ->where('point_id', auth()->user()->point_id);

        if (! empty($request->input('service_id'))) {
            $baseQuery->where(function ($q) use ($request) {
                return $q->where('service_id', $request->validated('service_id'));
            });
        }

        if (! empty($request->input('date_from'))) {
            $baseQuery->where(function ($q) use ($request) {
                return $q->whereDate('date', '>=', $request->validated('date_from'));
            });
        }

        if (! empty($request->input('date_to'))) {
            $baseQuery->where(function ($q) use ($request) {
                return $q->whereDate('date', '<=', $request->validated('date_to'));
            });
        }

        $sales = $baseQuery
            ->with([
                'service',
                'point',
            ])
            ->orderByDesc('date')
            ->paginate(10);

        return response()->json(
            SaleResource::collection($sales)
        );

    }
}
