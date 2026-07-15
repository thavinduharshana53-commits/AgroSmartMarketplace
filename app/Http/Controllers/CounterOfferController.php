<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Offer;

class CounterOfferController extends Controller
{
    public function counter(Request $request, Offer $offer){

        $request->validate([
            'counter_price' => 'required|numeric|min:1',
            'counter_note'  => 'nullable|string|max:500',
        ]);

        $offer->update([
            'counter_price' => $request->counter_price,
            'counter_note'  => $request->counter_note,
            'status'        => 'countered',
        ]);

        return back()->with('success', 'Counter offer sent successfully!');

    }
}
