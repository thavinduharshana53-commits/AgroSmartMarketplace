<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <title>Sales and Orders Report</title>

    <style>
        @page {
            margin: 24px;
        }

        body {
            font-family: DejaVu Sans, sans-serif;
            color: #0f172a;
            font-size: 12px;
            line-height: 1.45;
        }

        .header {
            padding-bottom: 14px;
            margin-bottom: 18px;
            border-bottom: 2px solid #059669;
        }

        .brand {
            color: #047857;
            font-size: 25px;
            font-weight: bold;
        }

        .title {
            margin-top: 5px;
            font-size: 19px;
            font-weight: bold;
        }

        .subtitle {
            margin-top: 6px;
            color: #64748b;
            font-size: 11px;
        }

        .summary-table {
            width: 100%;
            margin-bottom: 18px;
            border-spacing: 8px;
        }

        .summary-card {
            padding: 13px;
            border: 1px solid #cbd5e1;
            border-radius: 6px;
            background: #f8fafc;
        }

        .summary-label {
            color: #64748b;
            font-size: 11px;
        }

        .summary-value {
            margin-top: 6px;
            font-size: 17px;
            font-weight: bold;
        }

        .sales {
            color: #047857;
        }

        .filter-info {
            padding: 11px;
            margin-bottom: 15px;
            font-size: 11px;
            border: 1px solid #a7f3d0;
            background: #ecfdf5;
        }

        .orders-table {
            width: 100%;
            font-size: 11px;
            border-collapse: collapse;
        }

        .orders-table th {
            padding: 9px 7px;
            color: #334155;
            text-align: left;
            font-size: 11px;
            font-weight: bold;
            background: #e2e8f0;
            border: 1px solid #cbd5e1;
        }

        .orders-table td {
            padding: 9px 7px;
            vertical-align: middle;
            font-size: 11px;
            border: 1px solid #e2e8f0;
        }

        .amount {
            font-weight: bold;
            white-space: nowrap;
        }

        .status {
            font-weight: bold;
            text-transform: capitalize;
        }

        .footer {
            margin-top: 18px;
            padding-top: 11px;
            color: #64748b;
            font-size: 10.5px;
            border-top: 1px solid #cbd5e1;
        }

        .text-right {
            text-align: right;
        }
</style>
</head>

<body>

    <div class="header">

        <div class="brand">
            AgroSmart Marketplace
        </div>

        <div class="title">
            Sales and Orders Report
        </div>

        <div class="subtitle">
            Generated on {{ now()->format('d M Y, h:i A') }}
            by {{ auth()->user()->name }}
        </div>

    </div>

    <table class="summary-table">

        <tr>
            <td class="summary-card">
                <div class="summary-label">Total Orders</div>

                <div class="summary-value">
                    {{ number_format($totalOrders) }}
                </div>
            </td>

            <td class="summary-card">
                <div class="summary-label">Completed Orders</div>

                <div class="summary-value">
                    {{ number_format($completedOrders) }}
                </div>
            </td>

            <td class="summary-card">
                <div class="summary-label">Cancelled Orders</div>

                <div class="summary-value">
                    {{ number_format($cancelledOrders) }}
                </div>
            </td>

            <td class="summary-card">
                <div class="summary-label">Total Sales Revenue</div>

                <div class="summary-value sales">
                    Rs. {{ number_format($totalSales, 2) }}
                </div>
            </td>

            <td class="summary-card">
                <div class="summary-label">Average Sale Value</div>

                <div class="summary-value">
                    Rs. {{ number_format($averageOrderValue, 2) }}
                </div>
            </td>
        </tr>

    </table>

    <div class="filter-info">

        <strong>Reporting Period:</strong>

        {{ $dateFrom !== '' ? $dateFrom : 'Beginning' }}

        to

        {{ $dateTo !== '' ? $dateTo : 'Present' }}

        &nbsp; | &nbsp;

        <strong>Status:</strong>

        {{ $status !== ''
            ? ucwords(str_replace('_', ' ', $status))
            : 'All Statuses' }}

        @if($search !== '')

            &nbsp; | &nbsp;

            <strong>Search:</strong>
            {{ $search }}

        @endif

    </div>

    <table class="orders-table">

        <thead>
            <tr>
                <th>Order ID</th>
                <th>Product</th>
                <th>Buyer</th>
                <th>Farmer</th>
                <th>Quantity</th>
                <th>Accepted Price</th>
                <th>Total Amount</th>
                <th>Status</th>
                <th>Date</th>
            </tr>
        </thead>

        <tbody>

            @forelse($orders as $order)

                <tr>
                    <td>
                        #{{ str_pad(
                            $order->order_id,
                            4,
                            '0',
                            STR_PAD_LEFT
                        ) }}
                    </td>

                    <td>
                        {{ $order->product?->product_name ?? 'Unavailable' }}
                    </td>

                    <td>
                        {{ $order->buyer?->name ?? 'Unknown' }}
                    </td>

                    <td>
                        {{ $order->farmer?->name ?? 'Unknown' }}
                    </td>

                    <td>
                        {{ number_format((float) $order->quantity, 2) }} kg
                    </td>

                    <td class="amount">
                        Rs. {{ number_format(
                            (float) $order->accepted_price,
                            2
                        ) }}
                    </td>

                    <td class="amount">
                        Rs. {{ number_format(
                            (float) $order->total_amount,
                            2
                        ) }}
                    </td>

                    <td class="status">
                        {{ ucwords(str_replace(
                            '_',
                            ' ',
                            $order->order_status
                        )) }}
                    </td>

                    <td>
                        {{ $order->created_at->format('d M Y') }}
                    </td>
                </tr>

            @empty

                <tr>
                    <td colspan="9" style="text-align: center;">
                        No order records found for the selected filters.
                    </td>
                </tr>

            @endforelse

        </tbody>

    </table>

    <div class="footer">

        <span>
            This report was generated automatically by AgroSmart Marketplace.
        </span>

        <span style="float: right;">
            Confidential Administrative Report
        </span>

    </div>

</body>

</html>