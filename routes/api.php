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
Route::get('coming_session_pagination', 'API\HomePageController@coming_session_pagination');
Route::get('previous_session_pagination', 'API\HomePageController@previous_session_pagination');
Route::get('mohder_pagination', 'API\HomePageController@mohder_pagination');

// clients Actions
Route::get('users', 'API\UsersController@index');
Route::get('select_user', 'API\UsersController@select_user');
Route::get('user_by_id/{id}', 'API\UsersController@show');
Route::post('add_users', 'API\UsersController@store');
Route::post('edit_user', 'API\UsersController@update');
Route::post('update_profile', 'API\UsersController@update_profile');
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
Route::get('select/data/to_add_case', 'API\casesApiController@select_data_to_add_case');
//client Profile
Route::get('client_Profile/{id}', 'API\ClientProfileController@client_cases');
Route::get('client_Profile/notes/pagination/{id}', 'API\ClientProfileController@client_notes_pagination');
Route::get('client_Profile/cases/pagination/{id}', 'API\ClientProfileController@client_cases_pagination');
Route::post('add_clientNote', 'API\ClientProfileController@store');
Route::post('edit_clientNote', 'API\ClientProfileController@Edit_Note');
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
Route::post('caseClients/store', 'API\casesApiController@storeCaseClient');
Route::post('caseClients/destroy', 'API\casesApiController@destroyCaseClient');
Route::get('caseClients/data_by_id/{id}/{type}', 'API\casesApiController@caseClientDataByID');

//Cases Session Actions
Route::get('case/sessions/{id}', 'API\sessionApiController@index');
Route::post('addSession', 'API\sessionApiController@store');
Route::post('editSession', 'API\sessionApiController@edit');
Route::get('changeSessionStatus/{id}', 'API\sessionApiController@changeSessionStatus');
Route::post('showSession', 'API\sessionApiController@show');
Route::get('deleteSession/{id}', 'API\sessionApiController@destroy');

//Cases Session Notes Actions
Route::get('sessionsNote/{id}', 'API\sessionNoteApiController@index');
Route::post('addSessionNote', 'API\sessionNoteApiController@store');
Route::post('editSessionNote', 'API\sessionNoteApiController@edit');
Route::get('changeNoteStatus/{id}', 'API\sessionNoteApiController@changeNoteStatus');
Route::get('removeNoteStatus/{id}', 'API\sessionNoteApiController@destroy');

//Cases Attachment Actions
Route::get('caseAttachment/{id}', 'API\attachmentApiController@index');
Route::post('add_case_attachment', 'API\attachmentApiController@store');
Route::post('update_case_attachment/{id}', 'API\attachmentApiController@update');
Route::get('remove_attachment/{id}', 'API\attachmentApiController@destroy');

//searches
Route::post('search-users', 'API\UsersController@search');
Route::post('search-clients', 'API\ClientController@search');
Route::post('search-cases', 'API\casesApiController@search');
Route::post('search-session', 'API\sessionApiController@search');
Route::post('search-note', 'API\sessionNoteApiController@search');
Route::post('search-client-attachment', 'API\CientAttachmentController@search');
Route::post('search-case-attachment', 'API\attachmentApiController@search');
Route::post('search-mohdareen', 'API\mohdareenApiController@search');









Route::get('printCase/{id}', 'API\AuthController@printCase');



// registration form
Route::post('register', 'Landing\RegisterationController@store');
Route::post('registeration', 'Landing\RegisterationController@storeApi');
