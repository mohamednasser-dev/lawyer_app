<?php

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

Auth::routes();
Route::group(['middleware' => ['auth']], function () {
    Route::get('/', 'HomeController@index');
    Route::get('home', 'HomeController@index')->name('home');
});

Route::group(['middleware' => ['auth', 'Check_package']], function () {

    Route::resource('users', 'UsersController');
    Route::post('users/update', 'UsersController@update')->name('users.update');
    Route::get('users/destroy/{id}', 'UsersController@destroy');

    Route::get('manager/home', 'HomeController@manager_home')->name('manager_home');

    //employers routes
    Route::resource('employers', 'EmployersController');



    //manager governments
    Route::resource('governments', 'GovernmentsController');
    Route::get('governments/destroy/{id}', 'GovernmentsController@destroy');

    //manager locations
    Route::resource('locations', 'LocationsController');
    Route::get('locations/change_status/{id}', 'LocationsController@change_status')->name('locations.change_status');
    Route::get('locations/destroy/{id}', 'LocationsController@destroy');

    //manager points
    Route::resource('points', 'PointsController');
    Route::get('points/destroy/{id}', 'PointsController@destroy');

    Route::get('my_package', 'HomeController@my_package')->name('my_package');
//Clients
    Route::resource('clients', 'ClientsController');
    Route::post('clients/update', 'ClientsController@update')->name('clients.update');
    Route::get('clients/destroy/{id}', 'ClientsController@destroy');
//categories
    Route::resource('categories', 'CategoryController');
    Route::post('categories/update', 'CategoryController@update')->name('categories.update');
    Route::get('categories/destroy/{id}', 'CategoryController@destroy');
//cases
    Route::resource('cases', 'CasesController');
    Route::get('addCase', 'CasesController@getClients');
    Route::get('printCase/{id}', 'API\AuthController@printCase')->name('print.case.details');
// Mohdareen
    Route::resource('mohdareen', 'MohdareenController');
    Route::get('mohdareen/getCase/{case_num}', 'MohdareenController@getCaseToSelect');
    Route::post('mohdareen/update', 'MohdareenController@update')->name('mohdareen.update');
    Route::get('mohdareen/destroy/{id}', 'MohdareenController@destroy');
    Route::get('mohdareen/updateStatus/{id}', 'MohdareenController@updateStatus');
    Route::get('mohdareen-export', 'MohdareenController@export');
    Route::get('mohdareendata/{id}', 'HomeController@showMohData');
    Route::get('sessionnotes/{id}', 'HomeController@showSessionNotes');
    Route::get('/getClients', 'MohdareenController@getClients')->name('getClients');
//Case Details
    Route::resource('caseDetails', 'CaseDetailsController');
    Route::get('caseDetails/getSearchResult/{search}', 'CaseDetailsController@getSearchResult');
    Route::post('caseDetails/update', 'CaseDetailsController@update')->name('caseDetails.update');
    Route::post('caseDetails/updateCase', 'CaseDetailsController@updateCase')->name('caseDetails.updateCase');
    Route::post('caseDetails/addNewClient', 'CaseDetailsController@addNewClient')->name('caseDetails.addNewClient');
    Route::get('openCaseDetails/{id}/show', 'CaseDetailsController@openCaseDetails');
    Route::get('caseDetails/destroy/{id}', 'CaseDetailsController@destroy');
    Route::get('deleteClient/{case_id}/{client_id}', 'CaseDetailsController@deleteClient');
    Route::get('updateStatusSession/{id}', 'CaseDetailsController@updateStatus');
    Route::get('getSessionNotes/{id}', 'CaseDetailsController@getSessionNotes');
    Route::get('getSessions/{id}', 'CaseDetailsController@getSessions');
    Route::get('getClientByType/{type}/{caseId}', 'CaseDetailsController@getClientByType');
    Route::get('showSessionData/{sessionId}', 'CaseDetailsController@showSessionData');
//client attachments
    Route::get('clientattachment/{id}', 'ClientAttachmentController@index');
    Route::get('clientattachment/{id}/create', 'ClientAttachmentController@create');
    Route::post('clientattachment/{id}/store', 'ClientAttachmentController@store');
//id is for attachment
    Route::get('clientattachment/{id}/edit', 'ClientAttachmentController@edit');
    Route::get('clientattachment/{id}/delete', 'ClientAttachmentController@destroy');
    Route::post('clientattachment/{id}/update', 'ClientAttachmentController@update');
//Notes Report in Case Details
    Route::get('printSessionNotes/{id}', 'CaseDetailsController@printSessionNotes');
//Case Report
    Route::get('caseDetails/printCase/{id}', 'CaseDetailsController@printCase');
//Case delete
    Route::get('caseDetails/delete/{id}', 'CaseDetailsController@delete');
//notes operations
    Route::resource('notes', 'Session_NotesController');
    Route::post('notes/update', 'Session_NotesController@update')->name('notes.update');
    Route::get('destroy/{id}', 'Session_NotesController@destroy');
    Route::get('updateStatus/{id}', 'Session_NotesController@updateStatus');
    Route::get('notes/exportNotes/{id}', 'Session_NotesController@exportNotes');
//case attacments
//Reports
    Route::resource('dailyReport', 'ReportsController');
    Route::post('daily', 'ReportsController@search')->name('daily');
    Route::get('dailyReport/{id}/{type}', 'ReportsController@edit');
    Route::get('dailyPdf/{id}/{type}', 'ReportsController@pdfexport');
    Route::get('MonthlyReport', 'ReportsController@monthlyPage');
    Route::get('dailyReport/searchMonthly/{month}/{year}/{type}', 'ReportsController@searchMonthly');
    Route::get('monthlyPdf/{month}/{year}/{type}', 'ReportsController@pdfMonthexport');
//id is for case id
    Route::get('attachment/{id}', 'CaseAttachmentController@index');
    Route::get('attachment/{id}/create', 'CaseAttachmentController@create');
    Route::post('attachment/{id}/store', 'CaseAttachmentController@store');
//id is for attachment
    Route::get('attachment/{id}/edit', 'CaseAttachmentController@edit');
    Route::get('attachment/{id}/delete', 'CaseAttachmentController@destroy');
    Route::post('attachment/{id}/update', 'CaseAttachmentController@update');
//permission
    Route::resource('permission', 'PermissionController');
// client profile
    Route::get('profile/{id}', 'ClientProfileController@profile');
    Route::get('profile/deletenote/{id}', 'ClientProfileController@delete_Note');
    Route::get('profile/{id}/edit_note', 'ClientProfileController@edit_note');
    Route::post('profile/{id}/edit_notes', 'ClientProfileController@update_note');
    Route::post('profile/store/{id}', 'ClientProfileController@store');
    Route::get('profile/client_cases/{id}', 'ClientProfileController@client_cases');


});
Route::group(['middleware' => ['auth']], function () {

    //edit user profile
    Route::get('userprofile', 'ProfileController@edit');
    Route::post('userprofiles', 'ProfileController@submit');
// Packages
    Route::resource('packages', 'PackagesController');
    Route::get('packages/destroy/{id}', 'PackagesController@destroy');
    Route::post('packages/update', 'PackagesController@update')->name('packages.update');

    Route::resource('subscribers', 'SubscribersController');
    Route::get('subSearch', 'SubscribersController@search');
    Route::get('subscribers/updateStatus/{type}/{id}', 'SubscribersController@updateStatus')->name('subscribers.updateStatus');
//    Route::get('subscribers/updateStatus/{type}/{id}', 'SubscribersController@updateStatusActive')->name('subscribers.updateStatusActive');
    Route::post('subscribers/update', 'SubscribersController@update')->name('subscribers.update');
    Route::post('subscribers/updatedata', 'SubscribersController@updateData')->name('subscribers.edit');
    Route::get('subscribers/{id}/delete', 'SubscribersController@destroy');
    Route::get('subscribers/search/new', 'SubscribersController@search_new')->name('subscribers.search');
    Route::get('endReservation', 'EndReservationsController@index');

    //user packages to renew
    Route::get('packages/renew/page', 'UsersController@renew_package')->name('renew_package');

});
Route::get('reservtion', 'ReservationController@index');
Route::get('theme/{theme}', 'HomeController@change_them');
Route::get('storeLocation', 'GovernmentsController@storeLocations');


//lang
Route::get('lang/{lang}', function ($lang) {
    if (session()->has('lang')) {
        session()->forget('lang');
    }
    if ($lang == 'ar') {
        session()->put('lang', 'ar');
    } else {
        session()->put('lang', 'en');

    }
    return back();
});
