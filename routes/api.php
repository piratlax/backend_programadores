<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProgrammerController;

Route::post("/login", [AuthController::class, "login"]);
Route::post("/signup", [AuthController::class, "signup"]);

Route::group(["middleware" => "auth:sanctum"], function () {
    Route::post("/logout", [AuthController::class, "logout"]);
    Route::get("/programmers", ProgrammerController::class);
});
