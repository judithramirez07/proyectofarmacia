
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ArchivoController;
use App\Http\Controllers\EditarController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EdicionController;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|CAMBIAR VISTA A INICIO
*/

Route::get('/', function () {
    return view('inicio');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::resource('producto', ProductoController::class);

Route::post('producto/{producto}/agrega-sucursal', [ProductoController::class,'agregaSucursal'])->name('producto.agrega-sucursal');

Route::get('/productoEdit', [App\Http\Controllers\EditarController::class, 'index'])->name('productoEdit');

//USERS ROUTES

Route::resource('users', UserController::class);

Route::get('/edit', [App\Http\Controllers\EdicionController::class, 'index'])->name('edit');

//POST

Route::resource('posts', PostController::class);

Route::resource('/posts', 'PostController@index');

//RUTA DE ARCHIVOS
Route::get('archivo/descargar/{archivo}', [ArchivoController::class, 'descargar'])->name('archivo.descargar');
Route::resource('archivo', ArchivoController::class)->except(['edit', 'update','show']);

//RESTABLECIMIENTO DE CONTRASEÑA

Route::get('/forgot-password', function () {
    return view('auth.forgot-password');
})->middleware('guest')->name('password.request');

Route::post('/forgot-password', function (Request $request) {
    $request->validate(['email' => 'required|email']);

    $status = Password::sendResetLink(
        $request->only('email')
    );

    return $status === Password::RESET_LINK_SENT
                ? back()->with(['status' => __($status)])
                : back()->withErrors(['email' => __($status)]);
})->middleware('guest')->name('password.email');

Route::get('/reset-password/{token}', function ($token) {
    return view('auth.reset-password', ['token' => $token]);
})->middleware('guest')->name('password.reset');

Route::post('/reset-password', function (Request $request) {
    $request->validate([
        'token' => 'required',
        'email' => 'required|email',
        'password' => 'required|min:8|confirmed',
    ]);

    $status = Password::reset(
        $request->only('email', 'password', 'password_confirmation', 'token'),
        function ($user, $password) {
            $user->forceFill([
                'password' => Hash::make($password)
            ])->setRememberToken(Str::random(60));

            $user->save();

            event(new PasswordReset($user));
        }
    );

    return $status === Password::PASSWORD_RESET
                ? redirect()->route('login')->with('status', __($status))
                : back()->withErrors(['email' => [__($status)]]);
})->middleware('guest')->name('password.update');