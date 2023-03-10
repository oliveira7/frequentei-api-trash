<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    ActivityController,
    DomainController,
    UserController,
};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

Route::prefix('api/v1')->group(function () {
    Route::prefix('users')->group(function () {
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

        Route::prefix('activities')->group(function () {
            Route::get('/', [ActivityController::class, 'index'])->name('activity.index');
            Route::post('/', [ActivityController::class, 'store'])->name('activity.store');
            Route::get('/{activityId}', [ActivityController::class, 'show'])->name('activity.show');
            Route::put('/{activityId}', [ActivityController::class, 'update'])->name('activity.update');
            Route::delete('/{activityId}', [ActivityController::class, 'destroy'])->name('activity.destroy');
        });

        Route::prefix('domains')->group(function () {
            Route::get('/', [DomainController::class, 'index'])->name('domain.index');
            Route::post('/', [DomainController::class, 'store'])->name('domain.store');
            Route::get('/{domainId}', [DomainController::class, 'show'])->name('domain.show');
            Route::put('/{domainId}', [DomainController::class, 'update'])->name('domain.update');
            Route::delete('/{domainId}', [DomainController::class, 'destroy'])->name('domain.destroy');
        });
    });
});
