<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Collection
     */
    public function index()
    {
        return User::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param UserRequest $request
     * @return Response
     */
    public function store(UserRequest $request)
    {
        return User::create($request->validated());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UserRequest $request
     * @return JsonResponse
     */
    public function update(UserRequest $request)
    {
        $user = User::findOrFail($request['user_id']);
        $user->fill($request->except(['user_id']));
        $user->save();
        return response()->json($user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param UserRequest $request
     * @return Response
     */
    public function destroy(UserRequest $request)
    {
        $user = User::findOrFail($request['user_id']);
        if($user->delete()) return response(null, 204);
    }
}
