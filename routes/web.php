<?php

use App\Http\Controllers\ActivityController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HewaniController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\IngredientController;
use App\Http\Controllers\NabatiController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RecommendationController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ScreeningController;
use App\Http\Controllers\ScreeningProdukHewaniController;
use App\Http\Controllers\ScreeningProdukNabatiController;
use App\Http\Controllers\ScreeningProdukJadiController;

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


Route::prefix('user')->name('user.')->group(function() {
    Route::get('/create', [UserController::class, 'create'])->name('create');
    Route::post('/', [UserController::class, 'store'])->name('store');
});

// TA Routes Start
Route::middleware('auth')->group(function() {
    Route::get('/', [HomeController::class, 'index'])->name('index');
    
    Route::get('/tes', [ProductController::class, 'tes'])->name('tes');
    Route::prefix('user')->name('user.')->group(function() {
        Route::get('/{user_id}', [UserController::class, 'show'])->name('show');
        Route::put('/{user_id}', [UserController::class, 'update'])->name('update');
        Route::delete('/{user_id}', [UserController::class, 'destroy'])->name('destroy');
    });
    
    Route::prefix('product')->name('product.')->group(function() {
        Route::get('/', [ProductController::class, 'index'])->name('index');
        Route::get('/create', [ProductController::class, 'create'])->name('create');
        Route::post('/', [ProductController::class, 'store'])->name('store');
        Route::get('/{product_id}', [ProductController::class, 'show'])->name('show');
        Route::get('/{product_id}/edit', [ProductController::class, 'edit'])->name('edit');
        Route::put('/{product_id}', [ProductController::class, 'update'])->name('update');
        Route::delete('/{product_id}', [ProductController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('ingredient')->name('ingredient.')->group(function() {
        Route::get('/', [IngredientController::class, 'index'])->name('index');
        Route::get('/{product_id}/create', [IngredientController::class, 'create'])->name('create');
        Route::post('/', [IngredientController::class, 'store'])->name('store');
        Route::get('/{ingredient_id}', [IngredientController::class, 'show'])->name('show');
        Route::get('/{ingredient_id}/edit', [IngredientController::class, 'edit'])->name('edit');
        Route::put('/{ingredient_id}', [IngredientController::class, 'update'])->name('update');
        Route::put('/{ingredient_id}/status-halal', [IngredientController::class, 'updateStatusHalal'])->name('update.status-halal');
        Route::delete('/{ingredient_id}', [IngredientController::class, 'destroy'])->name('destroy');
        
        Route::get('/{ingredient_id}/check/certificate', [IngredientController::class, 'checkCertificate'])->name('certificate');
        Route::get('/{ingredient_id}/process/certificate', [IngredientController::class, 'processCertificate'])->name('certificate.process');
    });

    Route::prefix('screening')->name('screening.')->group(function() {
        Route::get('/history-hewani', [ScreeningProdukHewaniController::class, 'index'])->name('history-hewani');
        Route::get('/history-nabati', [ScreeningProdukNabatiController::class, 'index'])->name('history-nabati');
        Route::get('/history-produk-jadi', [ScreeningProdukJadiController::class, 'index'])->name('history-produk-jadi');

        Route::get('/hewani', [ScreeningProdukHewaniController::class, 'create'])->name('hewani');
        Route::get('/nabati', [ScreeningProdukNabatiController::class, 'create'])->name('nabati');
        Route::get('/produk-jadi', [ScreeningProdukJadiController::class, 'create'])->name('produk-jadi');

        Route::post('/hewani', [ScreeningProdukHewaniController::class, 'store'])->name('check-hewani');
        Route::post('/nabati', [ScreeningProdukNabatiController::class, 'store'])->name('check-nabati');
        Route::post('/produk-jadi', [ScreeningProdukJadiController::class, 'store'])->name('check-produk-jadi');
        
        Route::delete('/{screening_produk_hewani_id}', [ScreeningProdukHewaniController::class, 'destroy'])->name('destroy-hewani');
        Route::delete('/{screening_produk_nabati_id}', [ScreeningProdukNabatiController::class, 'destroy'])->name('destroy-nabati');
        Route::delete('/{screening_produk_jadi_id}', [ScreeningProdukJadiController::class, 'destroy'])->name('destroy-produk-jadi');
    });

    Route::prefix('activity')->name('activity.')->group(function() {
        Route::post('/', [ActivityController::class, 'store'])->name('store');
        Route::get('/{ingredient_id}/rule', [ActivityController::class, 'getRuleResult'])->name('rule');
    });

    Route::prefix('recommendation')->name('recommendation.')->group(function() {
        Route::get('/', [RecommendationController::class, 'index'])->name('index');
    });

    Route::prefix('history')->name('history.')->group(function() {
        Route::get('/', [HistoryController::class, 'index'])->name('index');
    });

    Route::prefix('hewani')->name('hewani.')->group(function() {
        Route::get('/{ingredient_id}/check/uji-lab-babi', [HewaniController::class, 'checkUjiLabBabi'])->name('uji-lab-babi');

        Route::get('/{ingredient_id}/check/kelompok-bahan', [HewaniController::class, 'checkKelompokBahan'])->name('kelompok-bahan');
        Route::get('/{ingredient_id}/process/kelompok-bahan', [HewaniController::class, 'processKelompokBahan'])->name('kelompok-bahan.process');
        
        Route::get('/{ingredient_id}/check/bahan-baku', [HewaniController::class, 'checkBahanBaku'])->name('bahan-baku');
        Route::get('/{ingredient_id}/process/bahan-baku', [HewaniController::class, 'processBahanBaku'])->name('bahan-baku.process');
        
        Route::get('/{ingredient_id}/check/kehalalan-bahan', [HewaniController::class, 'checkKehalalanBahan'])->name('kehalalan-bahan');
        Route::get('/{ingredient_id}/process/kehalalan-bahan', [HewaniController::class, 'processKehalalanBahan'])->name('kehalalan-bahan.process');
        
        Route::get('/{ingredient_id}/check/sembelih', [HewaniController::class, 'checkSembelih'])->name('sembelih');

        Route::get('/{ingredient_id}/check/pengolahan-tambahan', [HewaniController::class, 'checkPengolahanTambahan'])->name('pengolahan-tambahan');
        Route::get('/{ingredient_id}/process/pengolahan-tambahan', [HewaniController::class, 'processPengolahanTambahan'])->name('pengolahan-tambahan.process');
        
        Route::get('/{ingredient_id}/check/btp', [HewaniController::class, 'checkBTP'])->name('btp');
    });

    Route::prefix('nabati')->name('nabati.')->group(function() {
        Route::get('/{ingredient_id}/check/uji-lab-babi-etanol', [NabatiController::class, 'checkUjiLabBabiEtanol'])->name('uji-lab-babi-etanol');

        Route::get('/{ingredient_id}/check/kelompok-bahan', [NabatiController::class, 'checkKelompokBahan'])->name('kelompok-bahan');
        Route::get('/{ingredient_id}/process/kelompok-bahan', [NabatiController::class, 'processKelompokBahan'])->name('kelompok-bahan.process');
        
        Route::get('/{ingredient_id}/check/potensi-bahan-kritis', [NabatiController::class, 'checkPotensiBahanKritis'])->name('potensi-bahan-kritis');
        Route::get('/{ingredient_id}/process/potensi-bahan-kritis', [NabatiController::class, 'processPotensiBahanKritis'])->name('potensi-bahan-kritis.process');

        Route::get('/{ingredient_id}/check/titik-kritis', [NabatiController::class, 'checkTitikKritis'])->name('titik-kritis');
    });
});

// TA Routes End

Route::controller(AuthController::class)->middleware('loggedin')->group(function() {
    Route::get('login', 'loginView')->name('login.index');
    Route::post('login', 'login')->name('login.check');
});

Route::middleware('auth')->group(function() {
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
    Route::controller(PageController::class)->group(function() {
        Route::get('dashboard-overview-1-page', 'dashboardOverview1')->name('dashboard-overview-1');
        Route::get('dashboard-overview-2-page', 'dashboardOverview2')->name('dashboard-overview-2');
        Route::get('dashboard-overview-4-page', 'dashboardOverview4')->name('dashboard-overview-4');
        Route::get('categories-page', 'categories')->name('categories');
        Route::get('add-product-page', 'addProduct')->name('add-product');
        Route::get('product-list-page', 'productList')->name('product-list');
        Route::get('product-grid-page', 'productGrid')->name('product-grid');
        Route::get('transaction-list-page', 'transactionList')->name('transaction-list');
        Route::get('transaction-detail-page', 'transactionDetail')->name('transaction-detail');
        Route::get('seller-list-page', 'sellerList')->name('seller-list');
        Route::get('seller-detail-page', 'sellerDetail')->name('seller-detail');
        Route::get('reviews-page', 'reviews')->name('reviews');
        Route::get('inbox-page', 'inbox')->name('inbox');
        Route::get('file-manager-page', 'fileManager')->name('file-manager');
        Route::get('point-of-sale-page', 'pointOfSale')->name('point-of-sale');
        Route::get('chat-page', 'chat')->name('chat');
        Route::get('post-page', 'post')->name('post');
        Route::get('calendar-page', 'calendar')->name('calendar');
        Route::get('crud-data-list-page', 'crudDataList')->name('crud-data-list');
        Route::get('crud-form-page', 'crudForm')->name('crud-form');
        Route::get('users-layout-1-page', 'usersLayout1')->name('users-layout-1');
        Route::get('users-layout-2-page', 'usersLayout2')->name('users-layout-2');
        Route::get('users-layout-3-page', 'usersLayout3')->name('users-layout-3');
        Route::get('profile-overview-1-page', 'profileOverview1')->name('profile-overview-1');
        Route::get('profile-overview-2-page', 'profileOverview2')->name('profile-overview-2');
        Route::get('profile-overview-3-page', 'profileOverview3')->name('profile-overview-3');
        Route::get('wizard-layout-1-page', 'wizardLayout1')->name('wizard-layout-1');
        Route::get('wizard-layout-2-page', 'wizardLayout2')->name('wizard-layout-2');
        Route::get('wizard-layout-3-page', 'wizardLayout3')->name('wizard-layout-3');
        Route::get('blog-layout-1-page', 'blogLayout1')->name('blog-layout-1');
        Route::get('blog-layout-2-page', 'blogLayout2')->name('blog-layout-2');
        Route::get('blog-layout-3-page', 'blogLayout3')->name('blog-layout-3');
        Route::get('pricing-layout-1-page', 'pricingLayout1')->name('pricing-layout-1');
        Route::get('pricing-layout-2-page', 'pricingLayout2')->name('pricing-layout-2');
        Route::get('invoice-layout-1-page', 'invoiceLayout1')->name('invoice-layout-1');
        Route::get('invoice-layout-2-page', 'invoiceLayout2')->name('invoice-layout-2');
        Route::get('faq-layout-1-page', 'faqLayout1')->name('faq-layout-1');
        Route::get('faq-layout-2-page', 'faqLayout2')->name('faq-layout-2');
        Route::get('faq-layout-3-page', 'faqLayout3')->name('faq-layout-3');
        Route::get('login-page', 'login')->name('login');
        Route::get('register-page', 'register')->name('register');
        Route::get('error-page-page', 'errorPage')->name('error-page');
        Route::get('update-profile-page', 'updateProfile')->name('update-profile');
        Route::get('change-password-page', 'changePassword')->name('change-password');
        Route::get('regular-table-page', 'regularTable')->name('regular-table');
        Route::get('tabulator-page', 'tabulator')->name('tabulator');
        Route::get('modal-page', 'modal')->name('modal');
        Route::get('slide-over-page', 'slideOver')->name('slide-over');
        Route::get('notification-page', 'notification')->name('notification');
        Route::get('tab-page', 'tab')->name('tab');
        Route::get('accordion-page', 'accordion')->name('accordion');
        Route::get('button-page', 'button')->name('button');
        Route::get('alert-page', 'alert')->name('alert');
        Route::get('progress-bar-page', 'progressBar')->name('progress-bar');
        Route::get('tooltip-page', 'tooltip')->name('tooltip');
        Route::get('dropdown-page', 'dropdown')->name('dropdown');
        Route::get('typography-page', 'typography')->name('typography');
        Route::get('icon-page', 'icon')->name('icon');
        Route::get('loading-icon-page', 'loadingIcon')->name('loading-icon');
        Route::get('regular-form-page', 'regularForm')->name('regular-form');
        Route::get('datepicker-page', 'datepicker')->name('datepicker');
        Route::get('tom-select-page', 'tomSelect')->name('tom-select');
        Route::get('file-upload-page', 'fileUpload')->name('file-upload');
        Route::get('wysiwyg-editor-classic', 'wysiwygEditorClassic')->name('wysiwyg-editor-classic');
        Route::get('wysiwyg-editor-inline', 'wysiwygEditorInline')->name('wysiwyg-editor-inline');
        Route::get('wysiwyg-editor-balloon', 'wysiwygEditorBalloon')->name('wysiwyg-editor-balloon');
        Route::get('wysiwyg-editor-balloon-block', 'wysiwygEditorBalloonBlock')->name('wysiwyg-editor-balloon-block');
        Route::get('wysiwyg-editor-document', 'wysiwygEditorDocument')->name('wysiwyg-editor-document');
        Route::get('validation-page', 'validation')->name('validation');
        Route::get('chart-page', 'chart')->name('chart');
        Route::get('slider-page', 'slider')->name('slider');
        Route::get('image-zoom-page', 'imageZoom')->name('image-zoom');
    });
});
