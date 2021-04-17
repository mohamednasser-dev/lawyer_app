<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Auth User
Route::post('login', 'API\AuthController@login');
Route::get('logout', 'API\AuthController@logout');
Route::get('password/forgot/{email}', 'API\ManulPasswordController@forgot');
Route::post('password/reset', 'API\ManulPasswordController@reset');
//Home Page ..
Route::get('home_data', 'API\HomePageController@index');

// Users Actions
Route::get('users', 'API\UsersController@index');
Route::get('select_user', 'API\UsersController@select_user');
Route::get('user_by_id/{id}', 'API\UsersController@show');
Route::post('add_users', 'API\UsersController@store');
Route::post('edit_user', 'API\UsersController@update');
Route::get('delete_user/{id}', 'API\UsersController@destroy');
Route::get('select_user_permission/{id}', 'API\UsersController@select_user_permission');
Route::post('update_permission', 'API\UsersController@update_permission');

//Clients actions
Route::get('clients', 'API\ClientController@index');
Route::post('add_client', 'API\ClientController@store');
Route::get('client_by_id/{id}', 'API\ClientController@show');
Route::post('edit_client', 'API\ClientController@update');
Route::get('delete_client/{id}', 'API\ClientController@destroy');


//case actions
Route::get('select/data/to_add_case', 'API\ClientController@select_data_to_add_case');
//client Profile
Route::get('client_Profile/{id}', 'API\ClientProfileController@client_cases');
Route::post('add_clientNote', 'API\ClientProfileController@store');
Route::post('edit_clientNote/{id}', 'API\ClientProfileController@Edit_Note');
Route::get('delete_clientNote/{id}', 'API\ClientProfileController@delte_Note');

//client attachments
Route::get('client_attachments/{id}', 'API\CientAttachmentController@index');
Route::post('add_client_attachments', 'API\CientAttachmentController@store');
Route::post('edit_client_attachments', 'API\CientAttachmentController@update');
Route::get('delete_client_attachment/{id}', 'API\CientAttachmentController@destroy');


// Mohdareen Actions
Route::get('mohdars', 'API\mohdareenApiController@index');
Route::get('mohder_by_id/{id}', 'API\mohdareenApiController@mohder_by_id');
Route::get('update_status/{id}', 'API\mohdareenApiController@updateStatus');
Route::post('add_mohdars', 'API\mohdareenApiController@store');
Route::post('edit_mohdars/{id}', 'API\mohdareenApiController@update');
Route::get('delete_mohdar/{id}', 'API\mohdareenApiController@destroy');


//category
Route::get('categories', 'API\CategoryController@index');
Route::post('add_category', 'API\CategoryController@store');
Route::get('category_by_id/{id}', 'API\CategoryController@category_by_id');
Route::post('edit_category', 'API\CategoryController@update');
Route::get('delete_category/{id}', 'API\CategoryController@destroy');





//not customized yet

//Cases Actions
Route::post('Cases', 'API\casesApiController@index');
Route::post('add_Cases', 'API\casesApiController@store');
Route::get('delete_Case/{id}', 'API\casesApiController@destroy');
Route::post('edit_Case', 'API\casesApiController@update');
Route::get('caseData/{id}', 'API\casesApiController@caseData');
Route::get('getSessionNotes/{id}', 'API\casesApiController@getSessionNotes');
Route::post('caseClientsData', 'API\casesApiController@caseClientsData');

//Cases Session Actions
Route::post('caseSessions', 'API\sessionApiController@index');
Route::post('addSession', 'API\sessionApiController@store');
Route::post('editSession', 'API\sessionApiController@edit');
Route::post('changeSessionStatus', 'API\sessionApiController@changeSessionStatus');
Route::post('showSession', 'API\sessionApiController@show');
Route::post('deleteSession', 'API\sessionApiController@destroy');

//Cases Session Notes Actions
Route::post('sessionsNote', 'API\sessionNoteApiController@index');
Route::post('addSessionNote', 'API\sessionNoteApiController@store');
Route::post('deleteSessionNote', 'API\sessionNoteApiController@destroy');
Route::post('editSessionNote', 'API\sessionNoteApiController@edit');
Route::post('changeNoteStatus', 'API\sessionNoteApiController@changeNoteStatus');

//Cases Attachment Actions
Route::post('caseAttachment', 'API\attachmentApiController@index');
