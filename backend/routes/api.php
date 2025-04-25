<?php
// routes/api.php
use App\Http\Controllers\API\ReferenceDataController;
use App\Http\Controllers\API\RegistrationController;
use Illuminate\Support\Facades\Route;

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

// Reference data endpoints
Route::get('/countries', [ReferenceDataController::class, 'getCountries']);
Route::get('/colleges', [ReferenceDataController::class, 'getColleges']);
Route::get('/departments', [ReferenceDataController::class, 'getDepartments']);

// Registration endpoint
Route::post('/register', [RegistrationController::class, 'register']);