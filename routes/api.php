<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\EleveExamenController;
use App\Http\Controllers\FrequentationController;
use App\Http\Controllers\EleveEvaluationController;
use App\Http\Controllers\HoraireController;
use App\Http\Controllers\PresenceController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/horaires', [HoraireController::class, 'storeApi'])->name('api.horaires.store');
Route::get('/charts', [HomeController::class, 'chart']);

Route::post('/presences/store', [PresenceController::class, 'storeApi'])->name('presences.api.store');
// Route::put('api/eleves/evaluations/{pivot}', [EleveEvaluationController::class, 'updateViaApi'])->name('eleves.evaluations.update.api');
// Route::put('api/eleves/examens/{pivot}', [EleveExamenController::class, 'updateViaApi'])->name('eleves.examens.update.api');
// //freqs
// Route::post('frequentation/store/api', [FrequentationController::class, 'storeApi'])->name('frequentations.api..store');