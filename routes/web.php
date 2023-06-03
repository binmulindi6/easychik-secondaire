<?php

use App\Models\User;
use App\Models\Eleve;
use App\Models\Classe;
use App\Models\Employer;
use App\Models\Encadrement;
use App\Models\AnneeScolaire;
use App\Models\EleveConduite;
use App\Models\Frequentation;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CoursController;
use App\Http\Controllers\EleveController;
use App\Http\Controllers\FraisController;
use App\Http\Controllers\UserEncadrement;
use App\Http\Controllers\ClasseController;
use App\Http\Controllers\ExamenController;
use App\Http\Controllers\NiveauController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ParrainController;
use App\Http\Controllers\PeriodeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RapportController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\TravailController;
use App\Http\Controllers\ConduiteController;
use App\Http\Controllers\CotationController;
use App\Http\Controllers\EmployerController;
use App\Http\Controllers\FonctionController;
use App\Http\Controllers\ResultatController;
use App\Http\Controllers\Date\DateController;
use App\Http\Controllers\TrimestreController;
use App\Http\Controllers\EvaluationController;
use App\Http\Controllers\ParentAuthController;
use App\Http\Controllers\Admin\EcoleController;
use App\Http\Controllers\EleveExamenController;
use App\Http\Controllers\EncadrementController;
use App\Http\Controllers\ImportExcelController;
use App\Http\Controllers\AnneeScolaireController;
use App\Http\Controllers\EleveConduiteController;
use App\Http\Controllers\FrequentationController;
use App\Http\Controllers\PaiementFraisController;
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

///Apis
Route::get('/charts', [HomeController::class, 'chart']);
Route::put('api/eleves/evaluations/{pivot}', [EleveEvaluationController::class, 'updateViaApi'])->name('eleves.evaluations.update.api');
Route::put('api/eleves/examens/{pivot}', [EleveExamenController::class, 'updateViaApi'])->name('eleves.examens.update.api');


Route::get('/dashboard', [HomeController::class, 'index'])->middleware(['auth', 'isActive'])->name('dashboard');

// //Route::get('/current-year', [DateController::class, 'test']);
// //Route::put('/update/{id}', [FonctionController::class, 'test'])->name('fonctions.test');
// //parents
// // Route::get('parentauth/login', [ParentAuthController::class, 'login'])->name('parentauth.login');
// // Route::post('parentauth/authenticate', [ParentAuthController::class, 'authenticate'])->name('parentauth.authenticate');


// // Route::prefix('authP')
// //         ->as('auth.')
// //         ->group(function() {
// //             Route::namespace('Auth\Login')
// //                 ->group(function() {
//                 Route::get('parentauth/login', [ParentAuthController::class, 'index'])->name('parentauth.login');
//                 Route::post('parentauth/login', [ParentAuthController::class, 'auth'])->name('parentauth.login');
//                 Route::post('logout', 'ParentAuthController@logout')->name('parentauth.logout');
// //       });
// //  });

// //Ressours
Route::middleware(['auth', 'isActive'])->group(function () {

    //Globalss Roussoures

    Route::resource('annee-scolaires', AnneeScolaireController::class);
    Route::resource('categorie-cours', CategorieCoursController::class);
    Route::resource('classes', ClasseController::class);
    Route::resource('cours', CoursController::class);
    Route::get('eleve-parent/{parent}', [EleveController::class, 'linkParent'])->name('eleve-parent.link');
    Route::resource('eleves', EleveController::class);
    Route::get('employers/link', [EmployerController::class, 'linkEmployer'])->name('employers.link');
    Route::resource('employers', EmployerController::class);
    Route::resource('evaluations', EvaluationController::class);
    Route::resource('examens', ExamenController::class);
    Route::resource('fonctions', FonctionController::class);
    Route::get('frequentations/create/eleve/{id}', [FrequentationEleveController::class, 'create'])->name('frequentations.link');
    Route::resource('frequentations', FrequentationController::class);
    Route::resource('periodes', PeriodeController::class);
    Route::resource('trimestres', TrimestreController::class);
    Route::resource('type-evaluations', TypeEvaluationController::class);
    Route::get('encadrements/create/classe/{id}', [UserEncadrement::class, 'createClasse'])->name('encadrements.linkClasse');
    Route::get('encadrements/create/user/{id}', [UserEncadrement::class, 'create'])->name('encadrements.link');
    Route::resource('encadrements', EncadrementController::class);
    Route::resource('niveaux', NiveauController::class);
    Route::get('conduites/create/eleve/{eleve_id}/periode/{periode_id}', [EleveConduiteController::class, 'create'])->name('conduites.link');
    // Route::get('conduites/create/eleve/{eleve_id}/periode/{periode_id}/{from}', [EleveConduiteController::class, 'create'])->name('conduites.link');
    Route::post('conduites/store', [EleveConduiteController::class, 'store'])->name('eleveconduites.store');
    Route::resource('conduites', ConduiteController::class);
    Route::get('profile', [ProfileController::class, 'index'])->name('profile.index');
    // Route::get('parents/eleves/{parent}', [ParrainController::class]);
    Route::get('eleve-parent/{parent}/{eleve}', [ParrainController::class, 'linkParentEleve'])->name('parent-eleve.link');
    Route::resource('parents', ParrainController::class);
    Route::resource('messages', MessageController::class);
    Route::get('messages/create/{id}', [MessageController::class, 'toUser'])->name('messages.to');
    Route::resource('frais', FraisController::class);
    Route::get('paiements/eleves/create/{id}', [PaiementFraisController::class, 'linkEleve'])->name('paiements.linkEleve');
    Route::resource('paiements', PaiementFraisController::class);


    //Resultat

    Route::get('resultat/periode/{periode_id}/{eleve_id}', [ResultatController::class, 'periode'])->name('resultat.periode');
    Route::get('resultat/examen/{trimestre_id}/{eleve_id}', [ResultatController::class, 'examen'])->name('resultat.examen');
    Route::get('resultat/trimestre/{trimestre_id}/{eleve_id}', [ResultatController::class, 'trimestre'])->name('resultat.trimestre');
    Route::get('resultat/bulletin/{annee_scolaire_id}/{eleve_id}', [ResultatController::class, 'bulletin'])->name('resultat.bulletin');

    //joker
    Route::post('resultat/periode/{periode_id}/{eleve_id}', [ResultatController::class, 'periodeStore'])->name('resultat.periode.store');
    Route::post('resultat/trimestre/{trimestre_id}/{eleve_id}', [ResultatController::class, 'trimestreStore'])->name('resultat.trimestre.store');
    Route::post('resultat/bulletin/{annee_scolaire_id}/{eleve_id}', [ResultatController::class, 'bulletinStore'])->name('resultat.bulletin.store');
    
    //classe resultats
    Route::get('classes/{id}/resultat/periode/{periode_id}/{annee_scolaire_id}', [ClasseController::class, 'resultatPeriode'])->name('classes.resultat.periode');
    Route::get('classes/{id}/resultat/trimestre/{trimestre_id}/{annee_scolaire_id}', [ClasseController::class, 'resultatTrimestre'])->name('classes.resultat.trimestre');
    Route::get('classes/{id}/resultat/bulletin/{annee_scolaire_id}', [ClasseController::class, 'resultatAnnee'])->name('classes.resultat.annee');
    Route::get('classes/{id}/eleves', [ClasseController::class, 'eleves'])->name('classes.eleves');
    Route::get('classes/{id}/cours', [ClasseController::class, 'cours'])->name('classes.cours');

    //Travails
    Route::get('travails', [TravailController::class, 'index'])->name('travails.index');

    //Cotation
    Route::get('cotations/evaluations', [CotationController::class, 'index'])->name('cotations.index');
    Route::get('cotations/examens', [CotationController::class, 'examens'])->name('cotations.examens');
    Route::get('cotations/evaluation/{id}', [CotationController::class, 'showEvaluation'])->name('cotations.evaluations.show');
    Route::get('cotations/examens/{id}', [CotationController::class, 'showExamen'])->name('cotations.examens.show');
    Route::post('cotations/examens/search', [CotationController::class, 'searchExamen'])->name('cotations.examens.search');
    Route::post('cotations/evaluations/search', [CotationController::class, 'searchEvaluation'])->name('cotations.evaluations.search');


    //Eleves - Evaluations & Examens

    //Examens
    Route::get('eleves/{eleve}/examens/{trimestre}', [EleveController::class, 'ficheExamen'])->name('eleves.examens');
    Route::get('eleves/{eleve}/examens/edit/{examen}', [EleveExamenController::class, 'edit'])->name('eleves.examens.edit');
    Route::put('eleves/examens/{pivot}', [EleveExamenController::class, 'update'])->name('eleves.examens.update');

    //Evalustions
    Route::get('eleves/{eleve}/evaluations/{periode}', [EleveController::class, 'ficheEvaluations'])->name('eleves.evaluations');
    Route::get('eleves/{eleve}/evaluations/edit/{examen}', [EleveEvaluationController::class, 'edit'])->name('eleves.evaluations.edit');
    Route::put('eleves/evaluations/{pivot}', [EleveEvaluationController::class, 'update'])->name('eleves.evaluations.update');

    //eleve fichePaie
    Route::get('eleves/paiements/eleve/{id}', [EleveController::class, 'fichePaiements'])->name('eleves.paiements');
    Route::get('eleves/paiements/{eleve}/{frequentation}', [EleveController::class, 'showPaiements'])->name('eleves.paiements.show');
    Route::post('eleves/paiements/{eleve}', [EleveController::class, 'createPaiements'])->name('eleves.paiements.create');
    
    //Searchs
    Route::post('eleves/search', [EleveController::class, 'search'])->name('eleves.search');
    Route::post('eleves/search/{parent}', [EleveController::class, 'searchEleve'])->name('eleve-parent.search');
    Route::post('examens/search', [ExamenController::class, 'search'])->name('examens.search');
    Route::post('evaluations/search', [EvaluationController::class, 'search'])->name('evaluations.search');
    Route::post('frequentations/search', [FrequentationController::class, 'search'])->name('frequentations.search');
    Route::post('annee-scolaires/search', [AnneeScolaireController::class, 'search'])->name('annees.search');
    Route::post('trimestres/search', [TrimestreController::class, 'search'])->name('trimestres.search');
    Route::post('periodes/search', [PeriodeController::class, 'search'])->name('periodes.search');
    Route::post('paiements/search', [PaiementFraisController::class, 'search'])->name('paiements.search');
    Route::post('paiements/eleves/search', [PaiementFraisController::class, 'searchEleve'])->name('paiements.searchEleve');
    //Route::post('evaluations/search', [EvaluationController::class, 'search'])->name('evaluations.search');

    //Users
    Route::get('users/update/{id}', [UserController::class, 'show'])->name('users.update');
    Route::get('users', [UserController::class, 'index'])->name('users.index');
    Route::get('users/create', [UserController::class, 'create'])->name('users.create');
    Route::get('users/create/employer/{id}', [UserController::class, 'create'])->name('users.create.employer');
    Route::post('users/store', [UserController::class, 'store'])->name('users.store');
    Route::get('users/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::get('users/show', [UserController::class, 'show'])->name('users.show');
    Route::put('users/{id}', [UserController::class, 'changeStatut'])->name('users.statut');
    Route::delete('users/{id}', [UserController::class, 'destroy'])->name('users.destroy');
    Route::get('users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::get('ecole', [EcoleController::class, 'index'])->name('ecole.index');

    //parents
    Route::get('parents/login', [ParrainController::class, 'login'])->name('parents.login');
    Route::post('parents/authenticate', [ParrainController::class, 'authenticate'])->name('parents.authenticate');
    Route::put('parents/statut/{id}', [ParrainController::class, 'changeStatut'])->name('parents.statut');
    Route::get('date', [DateController::class, 'test']);
    
    //rapports
    // Route::get('rapports', [RapportController::class, 'index'])->name('rapports.index');
    Route::get('rapports/periode', [RapportController::class, 'periode'])->name('rapports.index');
    Route::get('rapports/annuel', [RapportController::class, 'annuel'])->name('rapports.annuel');
    Route::post('rapports/annuel', [RapportController::class, 'rapportAnnuel'])->name('rapports.annuel.get');
    Route::post('rapports/periode', [RapportController::class, 'rapportPeriode'])->name('rapports.periode.get');

    //settings
    Route::get('settings', [SettingController::class, 'index'])->name('settings.index');
    Route::post('settings/store', [SettingController::class, 'store'])->name('settings.store');

    //import Excel
    Route::get('import/excel', [ImportExcelController::class, 'index'])->name('import.excel.index');
    Route::post('import/excel', [ImportExcelController::class, 'import'])->name('import.excel.post');



});

require __DIR__ . '/auth.php';