<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Resources\ProductCollection;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $param = isset($request->query()['param']) ?  $request->query()['param'] : "";
        $size = isset($request->query()['size']) ?  $request->query()['size'] : 5;

        return response()->json([
            new ProductCollection(Product::with('category')->where("name", "like", "%" . $param . "%")->orWhere("description", "like", "%" . $param . "%")->orWhere("price", "like", "%" . $param . "%")->paginate($size))
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        return response()->json([
            'message' => 'Created succesfuly!',
            'item' => Product::create($request->validated())
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return response()->json([
            'item' => $product
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        return response()->json([
            'message' => 'Updated succesfuly!',
            'item' => $product->update($request->validated())
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        return response()->json([
            'message' => 'Deleted succesfuly!',
            'item' => $product->delete()
        ]);
    }
}
