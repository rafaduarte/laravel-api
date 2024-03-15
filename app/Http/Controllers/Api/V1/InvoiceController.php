<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //return Invoice::all();
        return Invoice::with('user')->get();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //return Invoice::create($request->all());
        $invoice = Invoice::storeMaiorQueZero($request->all());

        if($invoice) {
            return response()->json($invoice, 201);
        } else {
            return response()->json(['message' => '0 valor da fatura deve ser maior que zero']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $invoice = Invoice::find($id);

        if($invoice) {
            return response()->json($invoice, 200);
        } else {
            return response()->json(['message' => 'Pagamento não encontrado']);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $invoices = Invoice::find($id);
        $invoices->update($request->all());
        return response()->json($invoices, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
       return Invoice::find($id)->delete();
    }
}
