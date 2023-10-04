<?php

use App\Http\Controllers\AdminController;

use App\Http\Controllers\Backend\AmenitiesController;
use App\Http\Controllers\Backend\BlogCategoryController;
use App\Http\Controllers\Backend\BlogController;
use App\Http\Controllers\Backend\BlogTagController;
use App\Http\Controllers\Backend\CityController;
use App\Http\Controllers\Backend\NeighborhoodcityController;
use App\Http\Controllers\Backend\CountryController;
use App\Http\Controllers\Backend\FacilitiesController;
use App\Http\Controllers\Backend\ImagePresetController;
use App\Http\Controllers\Backend\PlanController;
use App\Http\Controllers\Backend\PlanFeaturesController;
use App\Http\Controllers\Backend\PropertyController;
use App\Http\Controllers\Backend\PropertyTypeController;
use App\Http\Controllers\Backend\PropertysizeController;
use App\Http\Controllers\Backend\StateController;
use App\Http\Controllers\Backend\TestimonialController;
use App\Http\Controllers\Backend\RoleController;
use App\Http\Controllers\Backend\UserRoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Backend\SettingController;
use Illuminate\Support\Facades\Route;



// Admin Group Middleware
Route::middleware(['auth', 'roles:admin'])->prefix('admin')->group(function () {
    // Admin Dashboard All Routes
    Route::controller(AdminController::class)->group(function () {
        Route::get('/dashboard', 'AdminDashboard')->name('admin.dashboard');
        Route::get('/profile', 'AdminProfile')->name('admin.profile');
        Route::post('/profile/store', 'AdminProfileStore')->name('admin.profile.store');
        Route::get('/change/password', 'AdminChangePassword')->name('admin.change.password');
        Route::post('/password/update', 'AdminPasswordUpdate')->name('admin.password.update');
        // Agent User All Routes
        Route::get('/agents', 'AllAgents')->name('admin.agents');
        Route::get('/agent/add', 'AgentAdd')->name('admin.agent_add');
        Route::post('/agent/store', 'AgentStore')->name('admin.agent_store');
        Route::get('/agent/edit/{id}', 'AgentEdit')->name('admin.agent_edit');
        Route::put('/agent/update', 'AgentUpdate')->name('admin.agent_update');
        Route::put('/agent/status', 'AgentStatusUpdate')->name('admin.agent_status');
        Route::get('/agent/varification/{id}', 'AgentEmailVerification')->name('admin.agent_email_varification');
        Route::delete('/agent/delete/{id}', 'AgentDelete')->name('admin.agent_delete');


        //Agent Package Plan
        Route::get('/buy/package_history', 'AdminPackageHistory')->name('admin.package_history');
        Route::get('/buy/package_invoice/{id}', 'AdminPackageInvoice')->name('admin.package_invoice');
        Route::delete('/buy/package_history/{id}', 'AdminPackageHistoryDelete')->name('admin.package_history.delete');
        Route::get('/plan/addon/{id}', 'AdminPackageAdd')->name('admin.agentplan.add');
        Route::post('/plan/addon/store', 'AdminPackageStore')->name('admin.agentplan.store');
        Route::post('/plan/check_plan', 'AdminPlanCheck')->name('admin.agentplan.check_plan');
        Route::post('/plan/check_type', 'AdminPlanCheckType')->name('admin.agentplan.plantype');
        // Admin User All Route 
        Route::get('/all/admin', 'AllAdmin')->name('all.admin');
        Route::get('/add/admin', 'AddAdmin')->name('add.admin');
        Route::post('/store/admin', 'StoreAdmin')->name('store.admin');
        Route::get('/edit/admin/{id}', 'EditAdmin')->name('edit.admin');
        Route::post('/update/admin/{id}', 'UpdateAdmin')->name('update.admin');
        Route::get('/delete/admin/{id}', 'DeleteAdmin')->name('delete.admin');
    });
    // Image Preset All Routes
    Route::resource('image_preset', ImagePresetController::class)->middleware('can:image_preset.index, image_preset.create, image_preset.update, image_preset.delete');
    Route::get('/image_preset/status/{image_preset}', [ImagePresetController::class, 'StatusUpdate'])->name('image_preset.status');

    // Property Type All Routes
    Route::resource('ptypes', PropertyTypeController::class)->middleware('can:property_types.index, property_types.create, property_types.update, property_types.delete');
    // Buy Plan Type All Routes
    Route::resource('plan', PlanController::class);
    Route::patch('/plan/status/{plan}', [PlanController::class, 'StatusUpdate'])->name('plan.status');

    // Buy Plan Feature Type All Routes
    Route::resource('planFeatures', PlanFeaturesController::class);
    Route::patch('/planFeatures/status/{planFeatures}', [PlanFeaturesController::class, 'StatusUpdate'])->name('planFeatures.status');

    // Property  All Routes
    Route::resource('properties', PropertyController::class)->middleware('can:properties.menu,properties.index, properties.create, properties.update, properties.delete');
    Route::controller(PropertyController::class)->group(function () {
        Route::post('/properties/states', 'states')->name('properties.states');
        Route::patch('/properties/update_img/{property}', 'update_img')->name('properties.update_img');
        Route::get('/properties/multi_img_delete/{id}', 'multiImageDestory')->name('properties.multi_img_delete');
        Route::patch('/properties/multi_img_update/{property}', 'multiImageUpdate')->name('properties.multi_img_update');
        Route::patch('/properties/multi_img_update_one/{id}', 'multiImageUpdateOne')->name('properties.multi_img_update_one');
        Route::patch('/properties/facility_update/{property}', 'facilityUpdate')->name('properties.facility_update');
        Route::get('/properties/facility_delete/{id}', 'facilityDestory')->name('properties.facility_delete');
        Route::patch('/properties/status/{property}', 'StatusUpdate')->name('properties.status');
        // Agent Property Messsage Route from dashboard
        Route::get('/property/message/', 'AdminPropertyMessage')->name('admin.property.message');
        Route::get('/message/details/{id}', 'AdminMessageDetails')->name('admin.message.details');
        Route::get('/property/ajax_load', 'Ajax_Load')->name('admin.property.ajax_load');
    });
    //
    // Property Testimonial  All Routes
    Route::resource('testimonial', TestimonialController::class);
    // Blog Category  All Routes
    Route::resource('blog_category', BlogCategoryController::class);
    // Blog Post  All Routes
    Route::resource('blog', BlogController::class);
    // Blog Post  All Routes
    Route::resource('blog_tag', BlogTagController::class);
    // Property Amenities  All Routes
    Route::resource('amenities', AmenitiesController::class)->middleware('can:amenities.index, amenities.create, amenities.update, amenities.delete');
    // Property Amenities  All Routes
    Route::resource('facilities', FacilitiesController::class)->middleware('can:facilities.index, facilities.create, facilities.update, facilities.delete');
    // Property Size  All Routes
    Route::resource('propertysize', PropertysizeController::class)->middleware('can:propertysize.index, propertysize.create, propertysize.update, propertysize.delete');
    // Property Country All Routes
    Route::resource('countries', CountryController::class)->middleware('can:country.index, country.create, country.update, country.delete');
    Route::patch('/countries/status/{country}', [CountryController::class, 'StatusUpdate'])->name('countries.status');
    // Property State All Routes
    Route::resource('states', StateController::class)->middleware('can:state.index, state.create, state.update, state.delete');
    Route::patch('/states/status/{state}', [StateController::class, 'StatusUpdate'])->name('states.status');
    // Property Module All Routes
    Route::resource('modules', ModuleController::class)->middleware('can:module.index, module.create, module.update, modules.delete');
    Route::patch('/modules/status/{state}', [ModuleController::class, 'StatusUpdate'])->name('modules.status');

    // Property Budget Range All Routes
    Route::resource('budgetrange', BudgetRangeController::class)->middleware('can:budgetrange.index, budgetrange.create, budgetrange.update, budgetrange.delete');
    Route::patch('/budgetrange/status/{budgetrange}', [BudgetRangeController::class, 'StatusUpdate'])->name('budgetrange.status');


    // Property Cities Type All Routes
    Route::resource('cities', CityController::class)->middleware('can:city.index, city.create, city.update, city.delete');
    Route::controller(CityController::class)->group(function () {
        Route::get('/city/ajax_load', 'ajax_Load')->name('cities.ajax_load');
        Route::post('/city/states', 'states')->name('cities.states');
        Route::post('/city/cities', 'cities')->name('cities.cities');
        Route::patch('/city/status/{state}', 'StatusUpdate')->name('cities.status');
        //
    });
    // Property Cities Type All Routes
    Route::resource('neighborhoodcities', NeighborhoodcityController::class)->middleware('can:neighborhoodcities.index, neighborhoodcities.create, neighborhoodcities.update, neighborhoodcities.delete');
    Route::controller(NeighborhoodcityController::class)->group(function () {
        Route::post('/neighborhoodcities/states', 'states')->name('neighborhoodcities.states');
        Route::post('/neighborhoodcities/cities', 'cities')->name('neighborhoodcities.cities');
        Route::post('/neighborhoodcities/allneighborhoodcities', 'neighborhoodcity')->name('neighborhoodcities.allneighborhoodcities');
        Route::patch('/neighborhoodcities/status/{state}', 'StatusUpdate')->name('neighborhoodcities.status');
        Route::get('/import/neighborhoodcities',  'ImportPermission')->name('import.neighborhoodcities');
        Route::get('/export/neighborhoodcities', 'Export')->name('export.neighborhoodcities');
        Route::post('/import/neighborhoodcitiesall', 'Import')->name('import.neighborhoodcities.all');
        //
    });
    // Admin Blog Comment Route 
    Route::get('/blogpost/comment', [BlogController::class, 'AdminBlogComment'])->name('admin.blog.comment');
    Route::get('/comment/reply/{id}', [BlogController::class, 'AdminCommentReply'])->name('admin.comment.reply');

    Route::post('/reply/message', [BlogController::class, 'ReplyMessage'])->name('reply.message');
    // SMTP Setting  All Route 
    Route::controller(SettingController::class)->group(function () {
        Route::get('/site/setting', 'SiteSetting')->name('site.setting');
        Route::patch('/update/site/setting/{id}', 'UpdateSiteSetting')->name('update.site.setting');
        Route::get('/smtp/setting', 'SmtpSetting')->name('smtp.setting');
        Route::patch('/update/smpt/setting/{id}', 'UpdateSmtpSetting')->name('update.smpt.setting');
    });

    // Permission All Route 
    Route::resource('permission', RoleController::class);

    Route::resource('roles', UserRoleController::class);
    Route::controller(RoleController::class)->group(function () {
        Route::get('/import/permission/ajax_load', 'Ajax_Data')->name('permission.ajax_load');
        Route::get('/import/permission',  'ImportPermission')->name('import.permission');
        Route::get('/export', 'Export')->name('export');
        Route::post('/import', 'Import')->name('import');
        Route::get('/add/roles/permission', 'AddRolesPermission')->name('add.roles.permission');
        Route::post('/role/permission/store', 'RolePermissionStore')->name('role.permission.store');
        Route::get('/all/roles/permission',  'AllRolesPermission')->name('all.roles.permission');
        Route::get('/admin/edit/roles/{id}', 'AdminEditRoles')->name('admin.edit.roles');
        Route::post('/admin/roles/update/{id}', 'AdminRolesUpdate')->name('admin.roles.update');
        Route::get('/admin/delete/roles/{id}', 'AdminDeleteRoles')->name('admin.delete.roles');
    });
    Route::controller(UserController::class)->group(function () {
        // User All Routes
        Route::get('/users', 'AllUsers')->name('admin.users');
        Route::get('/users/add', 'UserAdd')->name('admin.user_add');
        Route::post('/users/store', 'UserStore')->name('admin.user_store');
        Route::get('/users/edit/{id}', 'UserEdit')->name('admin.user_edit');
        Route::put('/users/update', 'UserUpdate')->name('admin.user_update');
        Route::put('/users/status', 'UserStatusUpdate')->name('admin.user_status');
        Route::delete('/users/delete/{id}', 'UserDelete')->name('admin.user_delete');
    });
});
// End Group Admin Middleware