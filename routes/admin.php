<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Auth\AdminLoginController;
use App\Http\Controllers\Admin\Auth\ForgotPasswordController;
use App\Http\Controllers\Admin\Auth\ResetPasswordController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\SectionController;
use App\Http\Controllers\Admin\AboutController;
use App\Http\Controllers\Admin\MenuBuilderController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\TeamController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\CounterController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\PackageController;
use App\Http\Controllers\Admin\DestinationController;
use App\Http\Controllers\Admin\PartnerController;
use App\Http\Controllers\Admin\NewsEventController;
use App\Http\Controllers\Admin\StoryController;
use App\Http\Controllers\Admin\NoticeController;



Route::get('/login', [AdminLoginController::class, 'viewLogin'])->name('login.view');
Route::post('admin-login', [AdminLoginController::class, 'login'])->name('login');
Route::post('logout', [AdminLoginController::class, 'logout'])->name('logout');

Route::prefix('passwords')->group(function () {
    Route::get('forget-password', [ForgotPasswordController::class, 'getEmail'])->name('forget.password');
    Route::post('forget-password', [ForgotPasswordController::class, 'postEmail'])->name('forget.password.store');

    Route::get('reset-password/{token}', [ResetPasswordController::class, 'getPassword'])->name('reset.password');
    Route::post('reset-password', [ResetPasswordController::class, 'updatePassword'])->name('reset.password.store');
});
Route::middleware('admin')->group(function () {

    /* ============> Dashboard <=========== */
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.home');

    /* ============> Categories <=========== */
    Route::prefix('categories')->group(function () {
        Route::get('/index', [CategoryController::class, 'index'])->name('category.index');
        Route::get('/create', [CategoryController::class, 'create'])->name('category.create');
        Route::post('/store', [CategoryController::class, 'store'])->name('category.store');
        Route::get('/edit/{id}', [CategoryController::class, 'edit'])->name('category.edit');
        Route::post('/update/{id}', [CategoryController::class, 'update'])->name('category.update');
        Route::get('/delete/{id}', [CategoryController::class, 'destroy'])->name('category.delete');
        Route::get('/show/{id}', [CategoryController::class,'show'])->name('category.show');

    });

    /* ============> Configuration <=========== */
    Route::group(['prefix'=>'settings'], function(){   
        Route::get('/index', [SettingController::class, 'index'])->name('settings.index');
        Route::post('/update', [SettingController::class, 'update'])->name('settings.update');     
        Route::get('/profile/view', [SettingController::class, 'profileView'])->name('profile.view');     
        Route::post('/profile/update', [SettingController::class, 'profileUpdate'])->name('profile.update');     
        Route::get('/password/change', [SettingController::class, 'passwordChange'])->name('password.change');   
        Route::post('/password/update', [SettingController::class, 'passwordUpdate'])->name('password.update');   
    });

    /* ============> Sections <=========== */
    Route::group(['prefix'=>'sections'], function(){   
        Route::get('/index', [SectionController::class, 'index'])->name('section.index');
        Route::get('/create', [SectionController::class, 'create'])->name('section.create');
        Route::post('/store', [SectionController::class, 'store'])->name('section.store');
        Route::get('/edit/{id}', [SectionController::class, 'edit'])->name('section.edit');
        Route::post('/update/{id}', [SectionController::class, 'update'])->name('section.update');
        Route::get('/delete/{id}', [SectionController::class, 'destroy'])->name('section.delete');
        Route::get('/show/{id}', [SectionController::class,'show'])->name('section.show');

    });


    
    /* ============> About <=========== */
    Route::group(['prefix'=>'abouts'], function(){   
        Route::get('/index', [AboutController::class, 'index'])->name('about.index');
        // Route::get('/create', [AboutController::class, 'create'])->name('about.create');
        // Route::post('/store', [AboutController::class, 'store'])->name('about.store');
        Route::get('/edit/{id}', [AboutController::class, 'edit'])->name('about.edit');
        Route::post('/update/{id}', [AboutController::class, 'update'])->name('about.update');
        Route::get('/delete/{id}', [AboutController::class, 'destroy'])->name('about.delete');
        Route::get('/show/{id}', [AboutController::class,'show'])->name('about.show');

    });

    /* ===========> Manage Menu Builder <========== */
    Route::group(['prefix'=>'menus'], function(){        
        // Route::get('/menu/builder', MenuBuilder::class)->name('menu.builder.create')
        Route::get('/manage/menus/{id?}', [MenuBuilderController::class, 'index'])->name('menuBuilder');
        Route::post('store/menu', [MenuBuilderController::class, 'store'])->name('menu.store');
        Route::get('delete/menuitem/{id}', [MenuBuilderController::class, 'deleteMenuItem'])->name('deleteMenuItem');
        Route::get('create/menu', [MenuBuilderController::class, 'createMenu'])->name('createMenu');
        Route::get('update/menu', [MenuBuilderController::class, 'updateMenu'])->name('updateMenu');
        Route::get('add/item/menu', [MenuBuilderController::class, 'addItemToMenu'])->name('addItemToMenu');
        Route::post('update/menuitem/{id}', [MenuBuilderController::class, 'updateMenuItem'])->name('updateMenuItem');
        Route::get('delete/menu/{id}', [MenuBuilderController::class, 'destroy'])->name('deleteMenu');
    });

    /* ============> Pages <=========== */
    Route::prefix('pages')->group(function () {
        Route::get('/index', [PageController::class, 'index'])->name('page.index');
        Route::get('/create', [PageController::class, 'create'])->name('page.create');
        Route::post('/store', [PageController::class, 'store'])->name('page.store');
        Route::get('/edit/{id}', [PageController::class, 'edit'])->name('page.edit');
        Route::post('/update/{id}', [PageController::class, 'update'])->name('page.update');
        Route::get('/delete/{id}', [PageController::class, 'destroy'])->name('page.delete');
        Route::get('/show/{id}', [PageController::class,'show'])->name('page.show');

    });

    /* ============> Manage Team  <=========== */
    Route::prefix('teams')->group(function () {
        Route::get('/index', [TeamController::class, 'index'])->name('team.index');
        Route::get('/create', [TeamController::class, 'create'])->name('team.create');
        Route::post('/store', [TeamController::class, 'store'])->name('team.store');
        Route::get('/edit/{id}', [TeamController::class, 'edit'])->name('team.edit');
        Route::post('/update/{id}', [TeamController::class, 'update'])->name('team.update');
        Route::get('/delete/{id}', [TeamController::class, 'destroy'])->name('team.delete');
        Route::get('/show/{id}', [TeamController::class,'show'])->name('team.show');

    });

    /* ============> Manage Team  <=========== */
    Route::prefix('testimonials')->group(function () {
        Route::get('/index', [TestimonialController::class, 'index'])->name('testimonial.index');
        Route::get('/create', [TestimonialController::class, 'create'])->name('testimonial.create');
        Route::post('/store', [TestimonialController::class, 'store'])->name('testimonial.store');
        Route::get('/edit/{id}', [TestimonialController::class, 'edit'])->name('testimonial.edit');
        Route::post('/update/{id}', [TestimonialController::class, 'update'])->name('testimonial.update');
        Route::get('/delete/{id}', [TestimonialController::class, 'destroy'])->name('testimonial.delete');
        Route::get('/show/{id}', [TestimonialController::class,'show'])->name('testimonial.show');

    });

    /* ============> Manage Slider   <=========== */
    Route::prefix('slider')->group(function () {
        Route::get('/index', [SliderController::class, 'index'])->name('slider.index');
        Route::get('/create', [SliderController::class, 'create'])->name('slider.create');
        Route::post('/store', [SliderController::class, 'store'])->name('slider.store');
        Route::get('/edit/{id}', [SliderController::class, 'edit'])->name('slider.edit');
        Route::post('/update/{id}', [SliderController::class, 'update'])->name('slider.update');
        Route::get('/delete/{id}', [SliderController::class, 'destroy'])->name('slider.delete');
        Route::get('/show/{id}', [SliderController::class,'show'])->name('slider.show');

    });

    /* ============> Manage Counter   <=========== */
    Route::prefix('counters')->group(function () {
        Route::get('/index', [CounterController::class, 'index'])->name('counter.index');
        Route::get('/create', [CounterController::class, 'create'])->name('counter.create');
        Route::post('/store', [CounterController::class, 'store'])->name('counter.store');
        Route::get('/edit/{id}', [CounterController::class, 'edit'])->name('counter.edit');
        Route::post('/update/{id}', [CounterController::class, 'update'])->name('counter.update');
        Route::get('/delete/{id}', [CounterController::class, 'destroy'])->name('counter.delete');
        Route::get('/show/{id}', [CounterController::class,'show'])->name('counter.show');

    });

    /* ============> Manage Service   <=========== */
    Route::prefix('service')->group(function () {
        Route::get('/index', [ServiceController::class, 'index'])->name('service.index');
        Route::get('/create', [ServiceController::class, 'create'])->name('service.create');
        Route::post('/store', [ServiceController::class, 'store'])->name('service.store');
        Route::get('/edit/{id}', [ServiceController::class, 'edit'])->name('service.edit');
        Route::post('/update/{id}', [ServiceController::class, 'update'])->name('service.update');
        Route::get('/delete/{id}', [ServiceController::class, 'destroy'])->name('service.delete');
        Route::get('/show/{id}', [ServiceController::class,'show'])->name('service.show');

    });

    /* ============> Manage Gallery   <=========== */
    Route::prefix('gallery')->group(function () {
        Route::get('/index', [GalleryController::class, 'index'])->name('gallery.index');
        Route::get('/create', [GalleryController::class, 'create'])->name('gallery.create');
        Route::post('/store', [GalleryController::class, 'store'])->name('gallery.store');
        Route::get('/edit/{id}', [GalleryController::class, 'edit'])->name('gallery.edit');
        Route::post('/update/{id}', [GalleryController::class, 'update'])->name('gallery.update');
        Route::get('/delete/{id}', [GalleryController::class, 'destroy'])->name('gallery.delete');
        Route::get('/show/{id}', [GalleryController::class,'show'])->name('gallery.show');

    });
    
    /* ============> Manage Partner   <=========== */
    Route::prefix('partner')->group(function () {
        Route::get('/index', [PartnerController::class, 'index'])->name('partner.index');
        Route::get('/create', [PartnerController::class, 'create'])->name('partner.create');
        Route::post('/store', [PartnerController::class, 'store'])->name('partner.store');
        Route::get('/edit/{id}', [PartnerController::class, 'edit'])->name('partner.edit');
        Route::post('/update/{id}', [PartnerController::class, 'update'])->name('partner.update');
        Route::get('/delete/{id}', [PartnerController::class, 'destroy'])->name('partner.delete');
        Route::get('/show/{id}', [PartnerController::class,'show'])->name('partner.show');

    });

    /* ============> Manage News & Event   <=========== */
    Route::resource('news-events', NewsEventController::class);

    /* ============> Manage Inspiring Stories   <=========== */
    Route::resource('story', StoryController::class);

    /* ============> Manage Notice   <=========== */
    Route::resource('notice', NoticeController::class);

    

    

});
