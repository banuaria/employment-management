<?php

// use App\Jobs\TestRedisJob;

use App\Livewire\Dashboard\About\AboutIndex;
use App\Livewire\Dashboard\Absent\AbsentIndex;
use App\Livewire\Dashboard\Area\AreaIndex;
use App\Livewire\Dashboard\Bonus\BonusIndex;
use App\Livewire\Dashboard\Bpjs\BpjsIndex;
use App\Livewire\Dashboard\Cleaning\CleaningIndex;
use App\Livewire\Dashboard\Config\ConfigIndex;
use App\Livewire\Dashboard\Contact\ContactIndex;
use App\Livewire\Dashboard\Cut\CutIndex;
use App\Livewire\Dashboard\CutSalary\CutSalaryIndex;
use App\Livewire\Dashboard\DashboardIndex;
use App\Livewire\Dashboard\Denda\DendaIndex;
use App\Livewire\Dashboard\DendaSLA\DendaSLAIndex;
use App\Livewire\Dashboard\Employee\EmployeeIndex;
use App\Livewire\Dashboard\Faq\FaqIndex;
use App\Livewire\Dashboard\FaqCategory\FaqCategoryIndex;
use App\Livewire\Dashboard\Home\HomeIndex;
use App\Livewire\Dashboard\Insentif\InsentifIndex;
use App\Livewire\Dashboard\Lainya\LainyaIndex;
use App\Livewire\Dashboard\Lembur\LemburIndex;
use App\Livewire\Dashboard\Location\LocationIndex;
use App\Livewire\Dashboard\LocationCategory\LocationCategoryIndex;
use App\Livewire\Dashboard\Makan\MakanIndex;
use App\Livewire\Dashboard\Policy\PolicyIndex;
use App\Livewire\Dashboard\Post\PostCreate;
use App\Livewire\Dashboard\Post\PostEdit;
use App\Livewire\Dashboard\Post\PostIndex;
use App\Livewire\Dashboard\PostCategory\PostCategoryIndex;
use App\Livewire\Dashboard\PostSubcategory\PostSubcategoryIndex;
use App\Livewire\Dashboard\PostTag\PostTagIndex;
use App\Livewire\Dashboard\Previous\PreviousIndex;
use App\Livewire\Dashboard\Product\ProductCreate;
use App\Livewire\Dashboard\Product\ProductEdit;
use App\Livewire\Dashboard\Product\ProductIndex;
use App\Livewire\Dashboard\ProductCategory\ProductCategoryIndex;
use App\Livewire\Dashboard\ProductSubcategory\ProductSubcategoryIndex;
use App\Livewire\Dashboard\ProductTag\ProductTagIndex;
use App\Livewire\Dashboard\Profile\ProfileIndex;
use App\Livewire\Dashboard\Retribution\RetributionIndex;
use App\Livewire\Dashboard\Stand\StandIndex;
use App\Livewire\Dashboard\Store\StoreIndex;
use App\Livewire\Dashboard\Summary\SummaryIndex;
use App\Livewire\Dashboard\Term\TermIndex;
use App\Livewire\Dashboard\User\UserIndex;
use App\Livewire\Dashboard\Vendor\VendorIndex;
use App\Livewire\Main\MainAbout;
use App\Livewire\Main\MainContact;
use App\Livewire\Main\MainFaq;
use App\Livewire\Main\MainIndex;
use App\Livewire\Main\MainPolicy;
use App\Livewire\Main\MainPost;
use App\Livewire\Main\MainPostDetail;
use App\Livewire\Main\MainProduct;
use App\Livewire\Main\MainProductDetail;
use App\Livewire\Main\MainSearch;
use App\Livewire\Main\MainTerm;
use App\Livewire\Main\MainStore;
use Illuminate\Support\Facades\Route;
use UniSharp\LaravelFilemanager\Lfm;

// Route::get('/test-redis-job', function () {  // php artisan queue:work redis
//     TestRedisJob::dispatch();
//     return 'Job dispatched!';
// });

// Route::get('/test-redis-job-emails', function () {  // php artisan queue:work redis --queue=emails
//     TestRedisJob::dispatch()->onQueue('emails');
//     return 'Job emails dispatched!';
// });

//---- CMS ----//
Route::group(['prefix' => 'cms', 'middleware' => ['auth']], function(){
    Route::get('/dashboard', DashboardIndex::class)->name('cms.dashboard');

    Route::group(['middleware' => ['can:admin']], function () {
        Route::get('/home', HomeIndex::class)->name('cms.home');

        Route::name('cms.product.')->group(function () {
            Route::get('/products', ProductIndex::class)->name('index');
            Route::get('/product-create', ProductCreate::class)->name('create');
            Route::get('/product-edit/{id}', ProductEdit::class)->name('edit');
            Route::get('/product-categories', ProductCategoryIndex::class)->name('categories');
            Route::get('/product-subcategories', ProductSubcategoryIndex::class)->name('subcategories');
            Route::get('/product-tags', ProductTagIndex::class)->name('tags');
        });

        Route::get('/stores', StoreIndex::class)->name('cms.stores');

        Route::get('/about', AboutIndex::class)->name('cms.about');
        Route::get('/policy', PolicyIndex::class)->name('cms.policy');
        Route::get('/term', TermIndex::class)->name('cms.term');

        // Route::name('cms.faq.')->group(function () {
        //     Route::get('/faqs', FaqIndex::class)->name('index');
        //     Route::get('/faq-categories', FaqCategoryIndex::class)->name('categories');
        // });

        // Route::name('cms.location.')->group(function () {
        //     Route::get('/locations', LocationIndex::class)->name('index');
        //     Route::get('/location-categories', LocationCategoryIndex::class)->name('categories');
        // });

        // Route::get('/testimonies', TestimonyIndex::class)->name('cms.testimonies');
        Route::get('/summary', SummaryIndex::class)->name('cms.summary');
        Route::get('/users', UserIndex::class)->name('cms.users');
        Route::get('/area', AreaIndex::class)->name('cms.area');
        Route::get('/employee', EmployeeIndex::class)->name('cms.employee');
        Route::get('/lembur', LemburIndex::class)->name('cms.lembur');
        Route::get('/denda-sla', DendaIndex::class)->name('cms.denda');
        Route::get('/clean', CleaningIndex::class)->name('cms.clean');
        Route::get('/bonus', BonusIndex::class)->name('cms.bonus');
        Route::get('/insentif', InsentifIndex::class)->name('cms.insentif');    
        Route::get('/previous', PreviousIndex::class)->name('cms.previous');
        Route::get('/cutsalary', CutIndex::class)->name('cms.cutsalary');
        Route::get('/lainya', LainyaIndex::class)->name('cms.lainya');
        Route::get('/bpjs', BpjsIndex::class)->name('cms.bpjs');
        Route::get('/retribution', RetributionIndex::class)->name('cms.retribution');
        Route::get('/stand', StandIndex::class)->name('cms.stand');
        Route::get('/makan', MakanIndex::class)->name('cms.makan');
        Route::get('/absent', AbsentIndex::class)->name('cms.absent');
        Route::get('/vendor', VendorIndex::class)->name('cms.vendor');

        Route::get('/configs', ConfigIndex::class)->name('cms.configs');
    });

    // Route::name('cms.post.')->group(function () {
    //     Route::get('/posts', PostIndex::class)->name('index');
    //     Route::get('/post-create', PostCreate::class)->name('create');
    //     Route::get('/post-edit/{id}', PostEdit::class)->name('edit');
    //     Route::get('/post-categories', PostCategoryIndex::class)->name('categories');
    //     Route::get('/post-subcategories', PostSubcategoryIndex::class)->name('subcategories');
    //     Route::get('/post-tags', PostTagIndex::class)->name('tags');
    // })->middleware('role:admin,editor');

    Route::get('/profile', ProfileIndex::class)->name('cms.profile');

    Route::prefix('laravel-filemanager')->group(function () {
        Lfm::routes();
    });
});

Route::group(['prefix' => 'cms', 'middleware' => ['auth', 'editor']], function(){
});

//---- Auth ----//
require __DIR__.'/auth.php';

//---- Main ----//
Route::get('/', MainIndex::class)->name('main');
Route::get('/about', MainAbout::class)->name('about');
Route::get('/products/{slug_category}', MainProduct::class)->name('product.category');
Route::get('/products/{slug_category}/{slug_subcategory}/{slug}', MainProductDetail::class)->name('product.detail');
Route::get('/posts', MainPost ::class)->name('post.index');
Route::get('/posts/{slug}', MainPostDetail::class)->name('post.detail');
Route::get('/store', MainStore::class)->name('store');
Route::get('/contact-us', MainContact::class)->name('contact');
Route::get('/faq', MainFaq::class)->name('faq');
Route::get('/privacy-policy', MainPolicy::class)->name('policy');
Route::get('/terms-conditions', MainTerm::class)->name('term');
Route::get('/search', MainSearch::class)->name('search');
