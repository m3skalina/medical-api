<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Invoice\InvoiceStoreRequest;
use App\Http\Resources\Invoice\InvoiceResource;
use App\Models\Invoice;
use App\Models\Sale;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {

        $invoices = Invoice::query()
            ->where('point_id', auth()->user()->point_id)
            ->orderByDesc('invoice_code')
            ->paginate(10);

        return response()->json(
            InvoiceResource::collection($invoices)
        );
    }

    /**
     * Store a resource.
     */
    public function store(InvoiceStoreRequest $request): JsonResponse
    {

        try {

            $invoice_code = 1;

            $latest_invoice = Invoice::query()
                ->where('point_id', auth()->user()->point_id)
                ->latest()
                ->first();

            if ($latest_invoice) {
                $invoice_code = $latest_invoice->invoice_code + 1;
            }

            $sales_amount_total = Sale::query()
                ->where('point_id', auth()->user()->point_id)
                ->whereDate('date', '>=', $request->validated('date_from'))
                ->whereDate('date', '<=', $request->validated('date_to'))
                ->sum('amount');

            $invoice = Invoice::create([
                'point_id' => auth()->user()->point_id,
                'invoice_code' => $invoice_code,
                'date' => $request->validated('date_invoice'),
                'amount' => $sales_amount_total,
            ]);

            return response()->json(
                InvoiceResource::make($invoice)
            );

        } catch (\Exception $e) {

            Log::error('Exception on invoice.store: '.$e->getMessage());

            return response()->json('Server Error', 500);

        }
    }
}
