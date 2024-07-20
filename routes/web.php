<?php

use App\Http\Controllers\ActualiteController;
use App\Http\Controllers\CircuitController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DemandeController;
use App\Http\Controllers\EquipeController;
use App\Http\Controllers\Front\ContenuSiteWebController;
use App\Http\Controllers\HabileteController;
use App\Http\Controllers\HolyDayController;
use App\Http\Controllers\PaiementController;
use App\Http\Controllers\PartnerController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\PieceJointeController;
use App\Http\Controllers\PointenrollementController;
use App\Http\Controllers\ProduitController;
use App\Http\Controllers\ReclammationController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\SlideController;
use App\Http\Controllers\SocialController;
use App\Http\Controllers\TableauController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;

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

/*App Vue*/

Route::redirect('/', 'site');
Route::get('site', function () {
    return view('vue.index');
});

/*App Vue*/


Route::get('/disconnect', [usersController::class, 'disconnect']);

Route::get('/voirStatutDeMaDemande/{code_demande}', [ClientController::class, 'voirStatutDeMaDemande']);
Route::get('/recuPdf/{code_demande}', [ClientController::class, 'generatePDF']);




//Route protégé par l'authentication
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::prefix('users')->middleware('CheckHabiletesPermissions:gestion-utilisateurs')->group(function () {
        Route::get('/', [UsersController::class, 'get'])->name('user');
        Route::post('/add', [UsersController::class, 'insert'])->name('user.add');
        Route::put('/edit/{user}', [UsersController::class, 'update'])->name('user.edit');
        Route::put('active/{user}', [UsersController::class, 'actif'])->name('user.active');
    });

    Route::prefix('role')->group(function () {
        Route::get('/', [RoleController::class, 'get'])->name('roles');
        Route::post('add', [RoleController::class, 'insert'])->name('roles.store');
        Route::put('edit/{role}', [RoleController::class, 'update'])->name('roles.update');
    });


    // Route::prefix('produit')->middleware('CheckHabiletesPermissions:gestion-des-services')->group(function () {
    //     Route::get('/', [ProduitController::class, 'index'])->name('products')->withoutMiddleware('CheckHabiletesPermissions:gestion-des-services');
    //     Route::post('/store', [ProduitController::class, 'insert'])->name('products.store');
    //     Route::put('/edit/{product}', [ProduitController::class, 'update'])->name('products.update');
    // });




    Route::get('client', [ClientController::class, 'index'])->name('client')->middleware('CheckHabiletesPermissions:gestion-utilisateurs');

    Route::prefix('demande')->group(function () {
        Route::get('/', [demandeController::class, 'get4admin'])->name('demande')->middleware('CheckHabiletesPermissions:gestion-demandes');
        Route::post('/', [demandeController::class, 'search4admin'])->name('demandeSearch')->middleware('CheckHabiletesPermissions:gestion-demandes');
        Route::get('/{id}', [demandeController::class, 'show'])->name('demande.show')->middleware('CheckHabiletesPermissions:consulter-demande,gestion-demandes');

        Route::post('/manage', [DemandeController::class, 'manage'])->name('demande.manage')->middleware('CheckHabiletesPermissions:gestion-demandes');

        Route::post('/manage/count', [DemandeController::class, 'manageCount'])->name('demande.manage.count')->middleware('CheckHabiletesPermissions:gestion-demandes');
    });

    Route::prefix('pre-demande')->group(function () {
        Route::get('/', [demandeController::class, 'preDemande'])->name('pre.demande')->middleware('CheckHabiletesPermissions:gestion-pre-demande');
        Route::get('/{id}', [demandeController::class, 'preDemandeShow'])->name('pre.demande.show')->middleware('CheckHabiletesPermissions:gestion-pre-demande');
    });

    Route::prefix('productionDocument')->group(function () {
        Route::post('/', [DemandeController::class, 'postFichierProduction'])->name('productionDocument_postFichierProduction');
        Route::get('/', [DemandeController::class, 'getFichierProduction']);
        Route::get('/liste', [DemandeController::class, 'getFichierProductionListe'])->middleware('CheckHabiletesPermissions:consulter-liste-de-production');
    });

    Route::get('paiement', [PaiementController::class, 'index'])->name('paiement')->middleware('CheckHabiletesPermissions:gestion-moyen-paiement');

    Route::prefix('pointenrollement')->middleware('CheckHabiletesPermissions:gestion-point-enrolements')->group(function () {
        Route::get('/', [PointenrollementController::class, 'index'])->name('pointenrollement');
        Route::get('/{id}', [PointenrollementController::class, 'details'])->name('pointenrollement.details');
        Route::post('/add', [PointenrollementController::class, 'insert'])->name('pointenrollement.store');
        Route::put('/edit/{id}', [PointenrollementController::class, 'update'])->name('pointenrollement.edit');

        //Gestion des produits par point d'enrolement

        Route::post('/link_product/{id}', [PointenrollementController::class, 'linkProduct'])->name('pointenrollement.link_product');

        Route::get('/unlink_product/{service_id}/{id_point_enrolement}', [PointenrollementController::class, 'unlinkProduct'])->name('pointenrollement.unlink_product');
        Route::get('/delete_produit_a_gerer/{id}', [PointenrollementController::class, 'delete_produit_a_gerer']);
    });

    Route::prefix('slider')->group(function () {
        Route::get('/', [SlideController::class, 'index'])->name('slider');
        Route::get('/create', [SlideController::class, 'create'])->name('slider.create');
        Route::post('/store', [SlideController::class, 'store'])->name('slider.store');

        Route::get('/edit/{slider}', [SlideController::class, 'edit'])->name('slider.edit');
        
        Route::put('/edit/{slider}', [SlideController::class, 'update'])->name('slider.update');

        Route::get('/delete/{slider}', [SlideController::class, 'delete'])->name('slider.delete');   
    });

    Route::prefix('partners')->group(function () {
        Route::get('/', [PartnerController::class, 'index'])->name('partners');
        Route::post('/store', [PartnerController::class, 'store'])->name('partners.store');
        Route::put('/edit/{partner}', [PartnerController::class, 'update'])->name('partners.update');
    });

    Route::prefix('actuality')->group(function () {
        Route::get('/', [ContenuSiteWebController::class, 'index'])->name('actuality');

        Route::get('/create', [ContenuSiteWebController::class, 'create'])->name('actuality.create');

        Route::get('/edit/{actuality}', [ContenuSiteWebController::class, 'edit'])->name('actuality.edit');

        Route::put('/edit-actuality/{actuality}', [ContenuSiteWebController::class, 'modify4admin_actuality'])->name('actuality.update');


        // Route::put('/modifyimageActuality', [ContenuSiteWebController::class, 'modifyimage4admin_actuality'])->name('actuality.modifyImage');

        // Route::put('/modifysecondimageActuality', [ContenuSiteWebController::class, 'modifysecondimage4admin_actuality'])->name('actuality.modifySecondPic');

        Route::post('/store', [ContenuSiteWebController::class, 'add4admin_actuality'])->name('actuality.store');

        Route::get('/delete/{actuality}', [ContenuSiteWebController::class, 'delete'])->name('actuality.delete');
    });

    Route::prefix('socials')->group(function () {
        Route::get('/', [SocialController::class, 'index'])->name('socials');
        Route::post('/store', [SocialController::class, 'store'])->name('socials.store');
        Route::put('/edit/{partner}', [SocialController::class, 'update'])->name('socials.update');
    });
    Route::prefix('holidays')->middleware('CheckHabiletesPermissions:gestion-calendrier-point-enrolement')->group(function () {
        Route::get('/', [HolyDayController::class, 'index'])->name('holidays');
        Route::get('/create', [HolyDayController::class, 'create'])->name('holiday.create');
        Route::get('/edit/{holiday}', [HolyDayController::class, 'edit'])->name('holiday.edit');
        Route::get('/delete/{holiday}', [HolyDayController::class, 'delete'])->name('holiday.delete');
        Route::post('/store', [HolyDayController::class, 'store'])->name('holidays.store');
        Route::put('/edit/{holiday}', [HolyDayController::class, 'update'])->name('holidays.update');
    });


    Route::prefix('services')->middleware('CheckHabiletesPermissions:gestion-portail-web')->group(function () {
        Route::get('/', [ServiceController::class, 'index'])->name('services')->withoutMiddleware('CheckHabiletesPermissions:gestion-des-services');
        Route::put('/edit/{service}', [ServiceController::class, 'edit'])->name('services.edit');

        Route::post('/store', [ServiceController::class, 'store'])->name('services.store');
        Route::get('/delete/{service}', [ServiceController::class, 'delete'])->name('services.delete');
    });

    Route::prefix('about')->group(function(){
        Route::get('/', [ContenuSiteWebController::class,'aboutUs'])->name('aboutUs');
        Route::get('/create', [ContenuSiteWebController::class,'aboutUs_create'])->name('about-us.create');
        Route::get('/edit/{aboutUs}', [ContenuSiteWebController::class,'aboutUs_edit'])->name('about-us.edit');
        Route::put('/edit/{aboutUs}', [ContenuSiteWebController::class,'aboutUs_update'])->name('about-us.update');
        Route::post('/store', [ContenuSiteWebController::class,'aboutUs_store'])->name('about-us.store');
    });

    Route::prefix('circuit')->middleware('CheckHabiletesPermissions')->group(function () {
        Route::get('/', [CircuitController::class, 'index'])->name('circuit');
        Route::post('/', [CircuitController::class, 'store'])->name('circuit.store');
        Route::put('/{id}', [CircuitController::class, 'update'])->name('circuit.update');
        Route::get('/{id}', [CircuitController::class, 'destroy'])->name('circuit.delete');
        Route::get('/add/{id}', [CircuitController::class, 'add'])->name('circuit.add');
    });

    Route::prefix('groupes')->middleware('CheckHabiletesPermissions')->group(function () {
        Route::get('/', [HabileteController::class, 'index'])->name('groupes');
        Route::post('/', [HabileteController::class, 'store'])->name('groupes.store');
        Route::put('/{id}', [HabileteController::class, 'update'])->name('groupes.update');
        Route::get('/{id}', [HabileteController::class, 'destroy'])->name('groupes.destroy');
    });

    Route::prefix('permissions')->middleware('CheckHabiletesPermissions')->group(function () {
        Route::get('/{id}', [PermissionController::class, 'index'])->name('permissions');
        Route::post('/', [PermissionController::class, 'habiletePermissions'])->name('permissions.habiletes.permissions');
    });
});



//
Route::get('/resetPassword/{id}', [UsersController::class, 'resetPassword']);
Route::put('/updatePassword', [UsersController::class, 'updatePassword']);
Route::get('/administration', [usersController::class, 'login'])->name('admin_oni');
Route::post('/administration', [UsersController::class, 'handleLogin']);


Route::get('/rdv', function () {
    return view('visiteur.rdv');
});
Route::post('/rdv2', [DemandeController::class, 'rdv2']);
Route::post('/rdv3', [DemandeController::class, 'rdv3']);


Route::get('/content/{tagdur}', function ($tagdur) {
    return view('visiteur.contenusiteweb')->with('tagdur', $tagdur);
});
Route::get('/article', [ContenuSiteWebController::class, 'get4admin_article'])->name('article');
Route::put('/modifyArticle', [ContenuSiteWebController::class, 'modify4admin_article']);
Route::put('/modifyimageArticle', [ContenuSiteWebController::class, 'modifyimage4admin_article']);
Route::get('/modifyArticle/{id}', [ContenuSiteWebController::class, 'modify4admin_articleGetId']);
Route::put('/modifyArticle/{id}', [ContenuSiteWebController::class, 'modify4admin_articleputId']);







Route::get('/reclammation', [ContenuSiteWebController::class, 'get4admin_reclammation'])->name('reclammation');
Route::put('/traiterReclammation', [ReclammationController::class, 'traiter']);


Route::get('/service', function () {
    return view('visiteur.service');
});
Route::get('/service/{tag}', [ServiceController::class, 'articleService']);
Route::get('/product/{tag}', [ServiceController::class, 'articleService']);


Route::get('/product', function () {
    return view('visiteur.produit');
});


Route::get('/trouver_un_centre', function () {
    return view('visiteur.trouver_un_centre');
});


Route::get('/contact', [ContactController::class, 'get'])->name('contact');
Route::post('/sendmessage', [ContenuSiteWebController::class, 'add4admin_reclammation']);

Route::get('/equipe', [EquipeController::class, 'getTeams'])->name('equipe');
Route::get('/actualite', [ActualiteController::class, 'getActualities'])->name('actualite');
Route::get('/actualite/{id}', [ActualiteController::class, 'oneActicle']);


Route::put('actifClient', [ClientController::class, 'actif']);


Route::post('statutDocument', [demandeController::class, 'get'])->name('statutDocument');
Route::get('/statutDocument', [demandeController::class, 'home']);
Route::put('demandeTraiter', [demandeController::class, 'updateStatus']);


Route::get('suivreMesDocuments', [demandeController::class, 'suivreMesDocuments'])->name('suivreMesDocuments');
Route::post('suivreMesDocuments', [demandeController::class, 'suivreMesDocumentsSearch']);






Route::get('tableau-chart', [TableauController::class, 'get4adminChart'])->name('tableau_chart');

Route::prefix('piece_jointes')->middleware('CheckHabiletesPermissions:possibilite-ajouter-document')->group(function () {
    Route::get('/', [PieceJointeController::class, 'index'])->name('piece_jointes');
    Route::post('/', [PieceJointeController::class, 'store'])->name('piece_jointes.store');
    Route::put('/{id}', [PieceJointeController::class, 'update'])->name('piece_jointes.update');
    Route::get('/{id}', [PieceJointeController::class, 'destroy'])->name('piece_jointes.delete');
    Route::get('/add/{id}', [PieceJointeController::class, 'add'])->name('piece_jointes.add');
});