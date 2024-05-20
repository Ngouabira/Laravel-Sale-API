<?php

namespace App\Http\Controllers;

use App\Models\SaleLine;
use Illuminate\Http\Request;
use App\Http\Resources\SaleLineCollection;
use App\Http\Requests\StoreSaleLineRequest;
use App\Http\Requests\UpdateSaleLineRequest;
use App\Http\Resources\SaleLineResource;

class SaleLineController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $param = isset($request->query()['param']) ?  $request->query()['param'] : "";
        $size = isset($request->query()['size']) ?  $request->query()['size'] : 5;

        return response()->json(
            new SaleLineCollection(SaleLine::where("price", "like", "%" . $param . "%")->orWhere("quantity", "like", "%" . $param . "%")->paginate($size))
        );
    }
    

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSaleLineRequest $request)
    {
        return response()->json([
            'message' => 'Created succesfuly!',
            'data' => new SaleLineResource(SaleLine::create($request->validated()))
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(SaleLine $saleLine)
    {
        return response()->json([
            'data' => new SaleLineResource($saleLine)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSaleLineRequest $request, SaleLine $saleLine)
    {
        return response()->json([
            'message' => 'Updated succesfuly!',
            'data' => new SaleLineResource($saleLine->update($request->validated()))
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SaleLine $saleLine)
    {
        if($saleLine->delete()){

            return response()->json([
                'message' => 'Deleted succesfuly!',
                 
            ]);
        }
        return response()->json([
            'message' => 'Somethings does wrong!',
             
        ]);
    }
}
