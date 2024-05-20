<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Http\Resources\CategoryCollection;
use App\Http\Resources\CategoryResource;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $param = isset($request->query()['param']) ?  $request->query()['param'] : "";
        $size = isset($request->query()['size']) ?  $request->query()['size'] : 5;

        return response()->json(
          new CategoryCollection(Category::where("name", "like", "%" . $param . "%")->orWhere("description", "like", "%" . $param . "%")->paginate($size))
          
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        if (!$request->validated()) {
            return response()->json($request->validator->errors(), 422);
        }

        return response()->json([
            'message' => 'Created succesfuly!',
            'data' => new CategoryResource(Category::create($request->validated()))
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return response()->json([
            'data' => new CategoryResource($category)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        return response()->json([
            'message' => 'Updated succesfuly!',
            'data' => new CategoryResource($category->update($request->validated()))
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        if($category->delete()){

            return response()->json([
                'message' => 'Deleted succesfuly!',
              
            ]);
        }
        return response()->json([
            'message' => 'Somethings does wrong!',
          
        ]);
    }
}
