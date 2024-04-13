<?php

namespace App\Http\Controllers;

use App\Models\SaleLine;
use App\Http\Requests\StoreSaleLineRequest;
use App\Http\Requests\UpdateSaleLineRequest;

class SaleLineController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json([
            'data' => SaleLine::paginate(10)
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSaleLineRequest $request)
    {
        return response()->json([
            'message' => 'Created succesfuly!',
            'item' => SaleLine::create($request->validated())
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(SaleLine $saleLine)
    {
        return response()->json([
            'item' => $saleLine
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSaleLineRequest $request, SaleLine $saleLine)
    {
        return response()->json([
            'message' => 'Updated succesfuly!',
            'item' => $saleLine->update($request->validated())
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SaleLine $saleLine)
    {
        return response()->json([
            'message' => 'Deleted succesfuly!',
            'item' => $saleLine->delete()
        ]);
    }
}
