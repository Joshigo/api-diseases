<?php

use App\Http\Controllers\AnswerController;
use App\Http\Controllers\DiseaseController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\QuestionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::post('patients/setLocation', [PatientController::class, 'setLocation']);


Route::apiResources([
    'diseases' => DiseaseController::class,
    'questions' => QuestionController::class,
    'patients' => PatientController::class,
    'answers' => AnswerController::class,
]);

Route::get('/questionsAdmin', [QuestionController::class, 'questionsAdmin']);
