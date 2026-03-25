<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function show($id)
{
    if (auth()->id() != $id) {
        return response()->json(['message' => 'No autorizado'], 403);
    }

    $user = User::find($id);

    if (!$user) {
        return response()->json(['message' => 'Usuario no encontrado'], 404);
    }

    return response()->json($user);
}

public function update(Request $request, $id)
{
    if (auth()->id() != $id) {
        return response()->json(['message' => 'No autorizado'], 403);
    }

    $user = User::find($id);

    if (!$user) {
        return response()->json(['message' => 'Usuario no encontrado'], 404);
    }

    $request->validate([
        'name' => 'sometimes|required|string',
        'email' => 'sometimes|required|email|unique:users,email,' . $user->id,
        'password' => ['sometimes', 'required', 'min:8']
    ]);

    if ($request->has('name')) {
        $user->name = $request->name;
    }

    if ($request->has('email')) {
        $user->email = $request->email;
    }

    if ($request->has('password')) {
        $user->password = Hash::make($request->password);
    }

    $user->save();

    return response()->json($user);
}

}
