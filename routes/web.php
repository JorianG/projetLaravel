<?php

use App\Http\Controllers\EleveController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\EvaluationController;
use App\Models\Eleve;
use App\Models\Module;
use App\Models\Evaluation;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



Route::middleware(['auth'])->group(function () {

    Route::get('/', function () {
        return view('welcome');
    });
    
    Route::resource('eleve', EleveController::class);
    Route::resource('module', ModuleController::class)->middleware('can:access-module-management');
    Route::resource('evaluation', EvaluationController::class)->middleware('can:access-evaluation-management');

    Route::get('/evaluation/{evaluation}/notesInf10', [EvaluationController::class, 'notesInf10'])
        ->name('evaluation.notesInf10');

    Route::get('/notes/{evaluationsId}', function ($evaluationsId) {

        $evaluations = Evaluation::find($evaluationsId); 
        $evaluations->load('evaluationEleves');

        $evaluations->load('module');
        $evaluations->load('evaluationEleves.eleve');  
        $evaluations->paginate(10);
        // dd($evaluations);
        return view('module.notes', compact('evaluations'));     

       
    })->middleware('can:access-module-management');

    Route::get('/notesEleve/{idEtu}', function ($idEtu) {
        $eleve = Eleve::find($idEtu);

        $eleve->load('evaluationEleves');
        $eleve->load('evaluationEleves.evaluation');
        // dd($eleve);
        return view('eleve.notes', compact('eleve'));


    })->name('notesEleve');

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::post('/evaluation/{evaluation}/grade', [EvaluationController::class, 'addGrade'])
        ->name('evaluation.addGrade')
        ->middleware('can:access-evaluation-management');
    
    Route::delete('/evaluation/{evaluation}/grade/{evaluationEleve}', [EvaluationController::class, 'deleteGrade'])
        ->name('evaluation.deleteGrade')
        ->middleware('can:access-evaluation-management');
});

Auth::routes();


