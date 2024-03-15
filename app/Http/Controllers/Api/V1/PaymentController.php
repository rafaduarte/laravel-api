<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //return Payment::all();
        return Payment::with('invoice')->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $payment = Payment::create($request->all());

        if($payment->isValidAmount()) {
            return response()->json($payment, 201);
        } else {
            $payment->delete();
            return response()->json(['message' => 'O valor do pagamento deve ser maior que zero']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
       $payment = Payment::find($id);

       if($payment) {
        return response()->json($payment, 200);
       } else {
        return response()->json(['message' => 'Pagamento não encontrado']);
       }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $payment = Payment::find($id);
        $payment->update($request->all());
        return response()->json($payment, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return Payment::find($id)->delete();
    }
}
