<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    DomainController,
    UserController,
};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

Route::group(['prefix' => 'api/v1'], function () {
    Route::group(['prefix' => 'users'], function () {
        Route::put('/{id}', [UserController::class, 'update']);
    });

    Route::post('/register', function (Request $request) {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json(['token' => $token]);
    });

    Route::post('/login', function (Request $request) {
        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json(['token' => $token]);
    });

    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/logout', function (Request $request) {
            auth()->user()->tokens()->delete();

            return response()->json(['message' => 'Logged out']);
        });

        Route::group(['prefix' => 'domains'], function () {
            Route::get('/', [DomainController::class, 'index']);
            Route::post('/', [DomainController::class, 'store']);
            Route::get('/{id}', [DomainController::class, 'show']);
            Route::put('/{id}', [DomainController::class, 'update']);
            Route::delete('/{id}', [DomainController::class, 'destroy']);
        });
    });
});
