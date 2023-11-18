<?php

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\ValidationException;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/users', function () {
    try {
        if (request('is_admin') === 'true') {
            request()->validate([
                'name' => ['required'],
                'username' => ['required'],
                'email' => ['required'],
                'password' => ['required'],
            ]);

            $user = new User();
            $user->name = request('name');
            $user->username = request('username');
            $user->email = request('email');
            $user->password = request('password');
            $user->save();
            return [
                'success' => true,
                'status' => 201,
                'data' => $user
            ];
        } else {
            return [
                'message' => 'not allowed to use this api',
                'status' => 403
            ];
        }
    } catch (Exception $e) {
        return [
            'message' => $e->getMessage(),
            'status' => $e instanceof ValidationException ? 422 : 500
        ];
    }
});
