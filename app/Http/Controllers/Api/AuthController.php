<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Traits\ApiResponder;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

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
}
