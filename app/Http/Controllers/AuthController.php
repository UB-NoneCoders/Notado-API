<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return UserResource::collection(User::all());
    }

    public function register(Request $request)
    {
        $request['password'] = bcrypt($request->password);
        $user = User::create($request->only('name', 'email', 'password'));
        $user->role_id = 1;

        return response()->json(
            [
                "data" => [
                    'message' => 'User Registered Successfully'
                ],
            ],
            201
        );
    }

    public function addRole(string $id, Request $request)
    {
        $data = $request->validate([
            'role_id' => 'required|exists:roles,id',
        ]);

        $user = User::find($id);
        if($user) {
            $user->addRole($data['role_id']);
            return new UserResource($user);
        }
        return response(['error' => 'Usuário não encontrado.'], 404);
    }

    public function removeRole(string $id, Request $request)
    {
        $data = $request->validate([
            'role_id' => 'required|exists:roles,id',
        ]);

        $user = User::find($id);
        if($user) {
            $user->removeRole($data['role_id']);
            return new UserResource($user);
        }
        return response(['error' => 'Usuário não encontrado.'], 404);
    }

    public function login(LoginRequest $request)
{
    if (Auth::attempt($request->only('email', 'password'))) {
        return response()->json([
            "data" => [
                "message" => "Authorized",
                "token" => $request->user()->createToken('login')->plainTextToken
            ]
        ], 200);
    }

    return response()->json(
        [
            "errors" => [
                'message' => 'Not Authorized'
            ],
        ],
        403
    );
}

    public function validateToken(Request $request)
    {
        if ($token = $request->bearerToken()) {
            $user = auth('sanctum')->user();
            $user->token = $token;
            return new UserResource($user);
        }
    }


    public function logout()
    {
        /** @var User $user */
        $user = Auth()->user();
        $user->tokens()->delete();

        return response(['message' => 'Logout realizado com sucesso.'], 200);
    }

    public function getRole(int $id) {
        return new UserResource(User::find($id)->load('role'));
    }

    public function update(Request $request, int $id)
{
    $data = $request->validate([
        'name' => 'sometimes|string|max:255',
        'email' => 'sometimes|email|max:255|unique:users,email,' . $id,
        'password' => 'sometimes|string|min:6|confirmed',
    ]);

    $user = User::find($id);

    if (!$user) {
        return response()->json(['error' => 'Usuário não encontrado.'], 404);
    }

    if (isset($data['name'])) {
        $user->name = $data['name'];
    }

    if (isset($data['email'])) {
        $user->email = $data['email'];
    }

    if (isset($data['password'])) {
        $user->password = bcrypt($data['password']);
    }
    $user->save();

    return new UserResource($user);
}

    
}
