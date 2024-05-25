<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Http\Requests\StoreSaleRequest;
use App\Http\Requests\UpdateSaleRequest;
use App\Http\Resources\SaleCollection;
use App\Models\SaleLine;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $param = isset($request->query()['param']) ?  $request->query()['param'] : "";
        $size = isset($request->query()['size']) ?  $request->query()['size'] : 5;

        return response()->json([
            new SaleCollection(Sale::where("code", "like", "%" . $param . "%")
                ->orderBy('id', 'desc')
                ->paginate($size))
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSaleRequest $request)
    {
        $saleLines = $request['sale_lines'];

        if (count($saleLines) > 0) {

            $sale = Sale::create([...$request['sale'], 'code' => Str::uuid()->toString()]);

            foreach ($saleLines as $line) {
                $line['sale_id'] =  $sale['id'];
                SaleLine::create($line);
            }

            return response()->json([
                'item' => $sale
            ], 201);
        }

        return response()->json([
            'message' => 'Sale must have at least one line.'
        ], 400);
    }

    /**
     * Display the specified resource.
     */
    public function show(Sale $sale)
    {
        return response()->json([
            'item' => $sale
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSaleRequest $request, Sale $sale)
    {
        return response()->json([
            'message' => 'Updated succesfuly!',
            'item' => $sale->update($request->validated())
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sale $sale)
    {
        return response()->json([
            'message' => 'Deleted succesfuly!',
            'item' => $sale->delete()
        ]);
    }
}
