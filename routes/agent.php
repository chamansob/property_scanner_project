
<?php

use App\Http\Controllers\AgentController;
use App\Http\Controllers\Agent\AgentPropertyController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaymentController;

// Agent Group Middleware
Route::middleware(['auth', 'verified', 'roles:agent'])->prefix('agent')->group(function () {
    Route::controller(AgentController::class)->group(function () {
        Route::get('/dashboard', 'AgentDashboard')->name('agent.dashboard');
        Route::get('/profile', 'AgentProfile')->name('agent.profile');
        Route::post('/profile/store', 'AgentProfileStore')->name('agent.profile.store');
        Route::get('/change/password', 'AgentChangePassword')->name('agent.change.password');
        Route::post('/password/update', 'AgentPasswordUpdate')->name('agent.password.update');
        
    });

    Route::controller(AgentPropertyController::class)->group(function () {
        Route::get('/properties/all', 'AgentProperty')->name('agent.properties');
        Route::get('/properties/show/{property}', 'show')->name('agent.properties.show');
        Route::get('/properties/create', 'create')->name('agent.properties.create');
        Route::post('/properties/store', 'store')->name('agent.properties.store');
        Route::post('/properties/states', 'states')->name('agent.properties.states');
        Route::get('/properties/edit/{property}', 'edit')->name('agent.properties.edit');
        Route::put('/properties/update/{property}', 'update')->name('agent.properties.update');
        Route::delete('/properties/delete', 'destory')->name('agent.properties.delete');
        Route::patch('/properties/update_img/{property}', 'update_img')->name('agent.properties.update_img');
        Route::get('/properties/multi_img_delete/{id}', 'multiImageDestory')->name('agent.properties.multi_img_delete');
        Route::patch('/properties/multi_img_update/{property}', 'multiImageUpdate')->name('agent.properties.multi_img_update');
        Route::patch('/properties/multi_img_update_one/{id}', 'multiImageUpdateOne')->name('agent.properties.multi_img_update_one');
        Route::patch('/properties/facility_update/{property}', 'facilityUpdate')->name('agent.properties.facility_update');
        Route::get('/properties/facility_delete/{id}', 'facilityDestory')->name('agent.properties.facility_delete');
        Route::patch('/properties/status/{property}', 'StatusUpdate')->name('property.status');
        Route::get('/property/ajax_load', 'Ajax_Load')->name('agent.property.ajax_load');
        // Agent Property Messsage Route from dashboard
        Route::get('/property/message/', 'AgentPropertyMessage')->name('agent.property.message');
        Route::get('/message/details/{id}', 'AgentMessageDetails')->name('agent.message.details');

        // Schedule Request Route 
        Route::get('/schedule/request/', 'AgentScheduleRequest')->name('agent.schedule.request');
        Route::get('/details/schedule/{id}', 'AgentDetailsSchedule')->name('agent.details.schedule');
        Route::post('/update/schedule/', 'AgentUpdateSchedule')->name('agent.update.schedule');
        Route::get('/delete/schedule/{id}', 'AgentDeleteSchedule')->name('agent.delete.schedule');
        // Agent Buy Package Route from dashboard
        Route::get('/buy/package', 'BuyPackage')->name('agent.buy.package');
        Route::post('/buy/plan', 'BuyPlan')->name('agent.buy.plan');        
        Route::get('/buy/package_history', 'PackageHistory')->name('agent.buy.package.package_history');
        Route::get('/buy/package_invoice/{id}', 'PackageInvoice')->name('agent.buy.package.package_invoice');
        Route::get('/buy/plan/store', 'BuyPlanStore')->name('agent.buy.plan.store');
        Route::post('/buy/plantype', 'BuyPlantype')->name('agent.buy.plantype');

            // Agent Paypal Paymentgateway Route from dashboard
    Route::controller(PaymentController::class)->group(function () {
        Route::post('make-payment', 'makePayment')->name('agent.make.payment');
        Route::get('cancel-payment', 'paymentCancel')->name('agent.cancel.payment');
        Route::get('payment-success', 'paymentSuccess')->name('agent.success.payment');
        });
        // Agent Neighborhoodcities Route from dashboard
        Route::post('/allneighborhoodcities', 'neighborhoodcity')->name('allneighborhoodcities');
    });
});
// End Group Agent Middleware