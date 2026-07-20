<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportsController extends Controller
{
    public function index(Request $request)
    {
        $validated = $request->validate([
            'search' => [ 'nullable', 'string', 'max:100',],

            'status' => ['nullable','in:pending,confirmed,ready_for_pickup,completed,cancelled', ],

            'date_from' => ['nullable','date',],

            'date_to' => ['nullable','date','after_or_equal:date_from',],
        ]);

        $search = trim($validated['search'] ?? '');
        $status = $validated['status'] ?? '';
        $dateFrom = $validated['date_from'] ?? '';
        $dateTo = $validated['date_to'] ?? '';

        /*
         * Apply the selected filters to all report calculations
         * and order records.
         */
        $reportQuery = Order::query()
            ->when(
                $search !== '',
                function ($query) use ($search) {
                    $query->where(
                        function ($orderQuery) use ($search) {
                            $orderQuery
                                ->where(
                                    'order_id',
                                    'like',
                                    "%{$search}%"
                                )
                                ->orWhereHas(
                                    'product',
                                    fn ($productQuery) =>
                                        $productQuery->where(
                                            'product_name',
                                            'like',
                                            "%{$search}%"
                                        )
                                )
                                ->orWhereHas(
                                    'buyer',
                                    fn ($buyerQuery) =>
                                        $buyerQuery->where(
                                            'name',
                                            'like',
                                            "%{$search}%"
                                        )
                                )
                                ->orWhereHas(
                                    'farmer',
                                    fn ($farmerQuery) =>
                                        $farmerQuery->where(
                                            'name',
                                            'like',
                                            "%{$search}%"
                                        )
                                );
                        }
                    );
                }
            )
            ->when(
                $status !== '',
                fn ($query) =>
                    $query->where('order_status', $status)
            )
            ->when(
                $dateFrom !== '',
                fn ($query) =>
                    $query->whereDate(
                        'created_at',
                        '>=',
                        $dateFrom
                    )
            )
            ->when(
                $dateTo !== '',
                fn ($query) =>
                    $query->whereDate(
                        'created_at',
                        '<=',
                        $dateTo
                    )
            );

        /*
         * Summary statistics.
         */
        $totalOrders = (clone $reportQuery)->count();

        $completedOrders = (clone $reportQuery)
            ->where('order_status', 'completed')
            ->count();

        $cancelledOrders = (clone $reportQuery)
            ->where('order_status', 'cancelled')
            ->count();

        $totalSales = (float) (clone $reportQuery)
            ->where('order_status', 'completed')
            ->sum('total_amount');

        $averageOrderValue = $completedOrders > 0
            ? $totalSales / $completedOrders
            : 0;

        /*
         * Detailed order records.
         */
        $orders = (clone $reportQuery)
            ->with(['product', 'buyer', 'farmer',])
            ->latest()
            ->paginate(12)
            ->withQueryString();

        return view(
            'admin.reports',
            compact(
                'orders',
                'totalOrders',
                'completedOrders',
                'cancelledOrders',
                'totalSales',
                'averageOrderValue',
                'search',
                'status',
                'dateFrom',
                'dateTo'
            )
        );
    }

    public function downloadPdf(Request $request)
    {
        $validated = $request->validate([
            'search' => ['nullable', 'string','max:100',],

            'status' => [
                'nullable',
                'in:pending,confirmed,ready_for_pickup,completed,cancelled',
            ],

            'date_from' => ['nullable','date',],

            'date_to' => [
                'nullable',
                'date',
                'after_or_equal:date_from',
            ],
        ]);

        $search = trim($validated['search'] ?? '');
        $status = $validated['status'] ?? '';
        $dateFrom = $validated['date_from'] ?? '';
        $dateTo = $validated['date_to'] ?? '';

        $reportQuery = Order::query()
            ->when(
                $search !== '',
                function ($query) use ($search) {
                    $query->where(
                        function ($orderQuery) use ($search) {
                            $orderQuery
                                ->where(
                                    'order_id',
                                    'like',
                                    "%{$search}%"
                                )
                                ->orWhereHas(
                                    'product',
                                    fn ($productQuery) =>
                                        $productQuery->where(
                                            'product_name',
                                            'like',
                                            "%{$search}%"
                                        )
                                )
                                ->orWhereHas(
                                    'buyer',
                                    fn ($buyerQuery) =>
                                        $buyerQuery->where(
                                            'name',
                                            'like',
                                            "%{$search}%"
                                        )
                                )
                                ->orWhereHas(
                                    'farmer',
                                    fn ($farmerQuery) =>
                                        $farmerQuery->where(
                                            'name',
                                            'like',
                                            "%{$search}%"
                                        )
                                );
                        }
                    );
                }
            )
            ->when(
                $status !== '',
                fn ($query) =>
                    $query->where('order_status', $status)
            )
            ->when(
                $dateFrom !== '',
                fn ($query) =>
                    $query->whereDate(
                        'created_at',
                        '>=',
                        $dateFrom
                    )
            )
            ->when(
                $dateTo !== '',
                fn ($query) =>
                    $query->whereDate(
                        'created_at',
                        '<=',
                        $dateTo
                    )
            );

        $totalOrders = (clone $reportQuery)->count();

        $completedOrders = (clone $reportQuery)
            ->where('order_status', 'completed')
            ->count();

        $cancelledOrders = (clone $reportQuery)
            ->where('order_status', 'cancelled')
            ->count();

        $totalSales = (float) (clone $reportQuery)
            ->where('order_status', 'completed')
            ->sum('total_amount');

        $averageOrderValue = $completedOrders > 0
            ? $totalSales / $completedOrders
            : 0;

        // PDF එකට pagination නැතුව selected records සියල්ල ලබාගන්නවා.
        $orders = (clone $reportQuery)
            ->with([
                'product',
                'buyer',
                'farmer',
            ])
            ->latest()
            ->get();

        $pdf = Pdf::loadView(
            'admin.pdf.salesOrdersReport',
            compact(
                'orders',
                'totalOrders',
                'completedOrders',
                'cancelledOrders',
                'totalSales',
                'averageOrderValue',
                'search',
                'status',
                'dateFrom',
                'dateTo'
            )
        )->setPaper('a4', 'landscape');

        return $pdf->download(
            'agrosmart-sales-orders-report-' .
            now()->format('Y-m-d-His') .
            '.pdf'
        );
    }
}