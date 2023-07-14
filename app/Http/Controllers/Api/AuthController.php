<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Traits\ApiResponder;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Laravel\Sanctum\Sanctum;

class AuthController extends Controller
{
    use ApiResponder;

    public function login(): JsonResponse
    {
        request()->validate([
            "email" => "required!email",
            "password" => "requiered|min:8|max:60",
            "device_name" => "required",
        ]);
        $user = User::select(["id", "name", "password", "email"])
            ->where("email", request("email"))
            ->first();

        if (!$user || !Hash::check(request("password"), $user->password)) {
            throw ValidationException::withMessages([
                "email" => [__("Credenciales incorrectas")]
            ]);
        }
        $token = $user->createToken(request("device_name"))->plainTextToken;
        return $this->success(
            __("Bienvenid@"),
            [
                "user" => $user->toArray(),
                "token" => $token,
            ]
        );
    }
    public function signup(): JsonResponse
    {
        request()->validate([
            "name" => "required|min:2|max:60",
            "email" => "required|email|unique:users",
            "password" => "required|min:8|max:30",
            "passwordConfirmation" => "required|same:password|min:8|max:30",
        ]);
        User::create([
            "name" => request("name"),
            "email" => request("email"),
            "password" => bcrypt(request("password")),
            "create_at" => now(),
        ]);
        return $this->success(
            __("Cuenta creada")
        );
    }
    public function logout(): JsonResponse
    {
        $token = request()->bearerToken();
        $model = Sanctum::$personalAccessTokenModel;
        $accessToken = $model::findToken($token);
        if ($accessToken) {
            $accessToken->delete();
            return $this->success(
                __("Hasta la proxima"),
                data: null,
                code: 204,
            );
        }
    }
}
