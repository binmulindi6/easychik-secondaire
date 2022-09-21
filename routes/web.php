<?php

use App\Models\User;
use App\Models\Eleve;
use App\Models\Classe;
use App\Models\Employer;
use App\Models\AnneeScolaire;
use App\Models\Frequentation;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CoursController;
use App\Http\Controllers\EleveController;
use App\Http\Controllers\ClasseController;
use App\Http\Controllers\ExamenController;
use App\Http\Controllers\PeriodeController;
use App\Http\Controllers\EmployerController;
use App\Http\Controllers\FonctionController;
use App\Http\Controllers\ResultatController;
use App\Http\Controllers\Date\DateController;
use App\Http\Controllers\TrimestreController;
use App\Http\Controllers\EvaluationController;
use App\Http\Controllers\Admin\EcoleController;
use App\Http\Controllers\EleveExamenController;
use App\Http\Controllers\AnneeScolaireController;
use App\Http\Controllers\FrequentationController;
use App\Http\Controllers\CategorieCoursController;
use App\Http\Controllers\TypeEvaluationController;
use App\Http\Controllers\EleveEvaluationController;
use App\Http\Controllers\FrequentationEleveController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::get('/dashboard', function () {
    $eleves = Eleve::count();
    $employers = Employer::count();
    $classes = Classe::count();
    $users = User::count();
    return view('dashboard', [
        'page_name' => 'Dashboard',
        'eleves' => $eleves,
        'employers' => $employers,
        'classes' => $classes,
        'users' => $users,
    ]);
})->middleware(['auth'])->name('dashboard');

//Route::get('/current-year', [DateController::class, 'test']);
Route::put('/update/{id}', [FonctionController::class, 'test'])->name('fonctions.test');


//Ressours
Route::middleware(['auth'])->group(function () {
    
    Route::resource('annee-scolaires', AnneeScolaireController::class);
    Route::resource('categorie-cours', CategorieCoursController::class);
    Route::resource('classes', ClasseController::class);
    Route::resource('cours', CoursController::class);
    Route::resource('eleves', EleveController::class);
    Route::resource('employers', EmployerController::class);
    Route::resource('evaluations', EvaluationController::class);
    Route::resource('examens', ExamenController::class);
    Route::resource('fonctions', FonctionController::class);
    Route::get('frequentations/create/eleve/{id}', [FrequentationEleveController::class, 'create'])->name('frequentations.link');
    Route::resource('frequentations', FrequentationController::class);
    Route::resource('periodes', PeriodeController::class);
    Route::resource('trimestres', TrimestreController::class);
    Route::resource('type-evaluations', TypeEvaluationController::class);

    Route::get('resultat/periode/{periode_id}/{eleve_id}', [ResultatController::class, 'periode'])->name('resultat.periode');
    Route::get('resultat/examen/{trimestre_id}/{eleve_id}', [ResultatController::class, 'examen'])->name('resultat.examen');
    Route::get('resultat/trimestre/{trimestre_id}/{eleve_id}', [ResultatController::class, 'trimestre'])->name('resultat.trimestre');
    Route::get('resultat/bulletin/{annee_scolaire_id}/{eleve_id}', [ResultatController::class, 'bulletin'])->name('resultat.bulletin');

    Route::get('eleves/{eleve}/examens/{trimestre}', [EleveController::class, 'ficheExamen'])->name('eleves.examens');
    Route::get('eleves/{eleve}/examens/edit/{examen}', [EleveExamenController::class, 'edit'])->name('eleves.examens.edit');
    Route::put('eleves/examens/{pivot}', [EleveExamenController::class, 'update'])->name('eleves.examens.update');

    Route::get('eleves/{eleve}/evaluations/{periode}', [EleveController::class, 'ficheEvaluations'])->name('eleves.evaluations');
    Route::get('eleves/{eleve}/evaluations/edit/{examen}', [EleveEvaluationController::class, 'edit'])->name('eleves.evaluations.edit');
    Route::put('eleves/evaluations/{pivot}', [EleveEvaluationController::class, 'update'])->name('eleves.evaluations.update');



    Route::get('users', [UserController::class, 'index'])->name('users.index');
    Route::put('users/{id}', [UserController::class, 'changeStatut'])->name('users.statut');
    Route::delete('users/{id}', [UserController::class, 'destroy'])->name('users.destroy');
    Route::get('users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::get('ecole', [EcoleController::class, 'index'])->name('ecole.index');

});

require __DIR__.'/auth.php';
