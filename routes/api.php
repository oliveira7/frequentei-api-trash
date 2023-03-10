<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    AddressController,
    ActivityController,
    DomainController,
    EnrollmentController,
    FrequencyController,
    UserController,
    ScheduleController,
    LocationController,
};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

Route::prefix('api/v1')->middleware('missing.parameter')->group(function () {
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
        Route::post('/logout', function () {
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

        Route::prefix('adresses')->group(function () {
            Route::get('/', [AddressController::class, 'index'])->name('address.index');
            Route::post('/', [AddressController::class, 'store'])->name('address.store');
            Route::get('/{addressId}', [AddressController::class, 'show'])->name('address.show');
            Route::put('/{addressId}', [AddressController::class, 'update'])->name('address.update');
            Route::delete('/{addressId}', [AddressController::class, 'destroy'])->name('address.destroy');
        });

        Route::prefix('enrollments')->group(function () {
            Route::get('/', [EnrollmentController::class, 'index'])->name('enrollment.index');
            Route::post('/', [EnrollmentController::class, 'store'])->name('enrollment.store');
            Route::get('/{enrollmentId}', [EnrollmentController::class, 'show'])->name('enrollment.show');
            Route::put('/{enrollmentId}', [EnrollmentController::class, 'update'])->name('enrollment.update');
            Route::delete('/{enrollmentId}', [EnrollmentController::class, 'destroy'])->name('enrollment.destroy');
        });

        Route::prefix('locations')->group(function () {
            Route::get('/', [LocationController::class, 'index'])->name('location.index');
            Route::post('/', [LocationController::class, 'store'])->name('location.store');
            Route::get('/{locationId}', [LocationController::class, 'show'])->name('location.show');
            Route::put('/{locationId}', [LocationController::class, 'update'])->name('location.update');
            Route::delete('/{locationId}', [LocationController::class, 'destroy'])->name('location.destroy');
        });

        Route::prefix('schedules')->group(function () {
            Route::get('/', [ScheduleController::class, 'index'])->name('schedule.index');
            Route::post('/', [ScheduleController::class, 'store'])->name('schedule.store');
            Route::get('/{scheduleId}', [ScheduleController::class, 'show'])->name('schedule.show');
            Route::put('/{scheduleId}', [ScheduleController::class, 'update'])->name('schedule.update');
            Route::delete('/{scheduleId}', [ScheduleController::class, 'destroy'])->name('schedule.destroy');
        });

        Route::prefix('frequencies')->group(function () {
            Route::get('/', [FrequencyController::class, 'index'])->name('frequency.index');
            Route::post('/', [FrequencyController::class, 'store'])->name('frequency.store');
            Route::get('/{frequencyId}', [FrequencyController::class, 'show'])->name('frequency.show');
            Route::put('/{frequencyId}', [FrequencyController::class, 'update'])->name('frequency.update');
            Route::delete('/{frequencyId}', [FrequencyController::class, 'destroy'])->name('frequency.destroy');
        });
    });
});
