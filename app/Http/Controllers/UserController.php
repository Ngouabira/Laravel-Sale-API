<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserCollection;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $param = isset($request->query()['param']) ?  $request->query()['param'] : "";
        return response()->json([
             new UserCollection(User::where("name", "like", "%" . $param . "%")->orWhere("email", "like", "%" . $param . "%")->orWhere("role", "like", "%" . $param . "%")->paginate(10))
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        return response()->json([
            'message' => 'Created succesfuly!',
            'item' => User::create($request->validated())
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return response()->json([
            'item' => new UserResource($user)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        return response()->json([
            'message' => 'Updated succesfuly!',
            'item' => $user->update($request->validated())
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        return response()->json([
            'message' => 'Deleted succesfuly!',
            'item' => $user->delete()
        ]);
    }
}
