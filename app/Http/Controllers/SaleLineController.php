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
            'status' => 200,
            'data' => SaleLine::paginate(10)

        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSaleLineRequest $request)
    {
        return response()->json([
            'status' => 201,
            'message' => 'Created succesfuly!',
            'item' => SaleLine::create($request->validated())
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(SaleLine $saleLine)
    {
        return response()->json([
            'status' => 200,
            'item' => $saleLine
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSaleLineRequest $request, SaleLine $saleLine)
    {
        return response()->json([
            'status' => 200,
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
            'status' => 200,
            'message' => 'Deleted succesfuly!',
            'item' => $saleLine->delete()
        ]);
    }
}
