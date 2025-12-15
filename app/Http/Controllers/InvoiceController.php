<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class InvoiceController extends Controller
{
    public function receipt(Order $order)
    {
        abort_unless($order->user_id === auth()->id(), 403);

        $order->load(['items.product']); // sesuaikan relasi kamu (lihat catatan bawah)

        return view('orders.receipt', compact('order'));
    }

    public function downloadPdf(Order $order)
    {
        abort_unless($order->user_id === auth()->id(), 403);

        $order->load(['items.product']);

        $pdf = Pdf::loadView('orders.invoice-pdf', compact('order'))
            ->setPaper([0, 0, 226.77, 800], 'portrait'); 

        return $pdf->download('invoice-order-'.$order->id.'.pdf');
    }
}
