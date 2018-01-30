<?php



Route::get('/', 'PortalController@diverge');
Route::get('portals/general_portal', ['as' => 'portals.general_portal', 'uses' => 'PortalController@general_portal']);


// uelmar map region search route
Route::get('portals/search_ph_region/{code}', ['as' => 'portal_ph_region_search', 'uses' => 'PortalController@portal_ph_region_search']);
Route::get('portals/search_international/{code}', ['as' => 'portal_international_search', 'uses' => 'PortalController@portal_international_search']);

// Management Portal
Route::get('management/users','ManagementController@user')->name('datatables');
Route::get('management/companies','ManagementController@company')->name('datatables');
Route::get('management/openings','ManagementController@opening')->name('datatables');
Route::get('management/userdata','ManagementController@userData')->name('datatables.users');
Route::get('management/companydata','ManagementController@companyData')->name('datatables.companies');
Route::get('management/openingdata','ManagementController@openingData')->name('datatables.openings');



Route::get('hiring_portal/user_index', 'HiringPortalController@user_index');
Route::get('hiring_portal/user_index_show/{id}', ['as' => 'hiring_portal.user_index_show', 'uses' => 'HiringPortalController@user_index_show']);


Route::get('hiring_portal', 'HiringPortalController@index');

// save applicant route
Route::post('save_applicant_index/{applicant_saved_id}', ['as' => 'save_applicant_index', 'uses' => 'HiringPortalController@save_applicant_index']);

Route::delete('unsave_applicant_index/{applicant_saved_id}', ['as' => 'unsave_applicant_index', 'uses' => 'HiringPortalController@unsave_applicant_index']);

Route::get('saved/applicants/list','HiringPortalController@user_bookmark_lists');

Route::get('hiring_portal/show/{company_id}', ['as' => 'hiring_portal.show', 'uses' => 'HiringPortalController@show']);
Route::post('hiring_portal/show/{company_id}', ['as' => 'hiring_portal.show', 'uses' => 'HiringPortalController@show']);

Route::get('hiring_portal/application/{id}', ['as' => 'hiring_portal.application_detail', 'uses' => 'HiringPortalController@application_detail']);


Route::get('companies/companysearch', 'CompaniesController@index');

Route::get('companies', ['as' => 'companies.index', 'uses' => 'CompaniesController@index']);
Route::get('companies/create', ['as' => 'companies.create', 'uses' => 'CompaniesController@create']);
Route::get('companies/{id}', ['as' => 'companies.show', 'uses' => 'CompaniesController@show']);
Route::post('companies', ['as' => 'companies.store', 'uses' => 'CompaniesController@store']);
Route::get('companies/{id}/edit', ['as' => 'companies.edit', 'uses' => 'CompaniesController@edit']);
Route::patch('companies/{id}', ['as' => 'companies.update', 'uses' => 'CompaniesController@update']);
Route::delete('companies/{id}', ['as' => 'companies.destroy', 'uses' => 'CompaniesController@destroy']);

// Application routes...
Route::get('applications/applied_index', ['as' => 'applications.applied_index', 'uses' => 'ApplicationController@applied_index']);
Route::get('applications/create/{opening_id}', ['as' => 'applications.create', 'uses' => 'ApplicationController@create']);
Route::get('applications/{id}', ['as' => 'applications.show', 'uses' => 'ApplicationController@show']);
Route::post('applications/store', ['as' => 'applications.store', 'uses' => 'ApplicationController@store']);



Route::get('resumes/create', ['as' => 'resumes.create', 'uses' => 'ResumesController@create']);
Route::get('resumes/show', ['as' => 'resumes.show', 'uses' => 'ResumesController@show']);
Route::post('resumes', ['as' => 'resumes.store', 'uses' => 'ResumesController@store']);
Route::get('resumes/{id}/edit', ['as' => 'resumes.edit', 'uses' => 'ResumesController@edit']);
Route::patch('resumes/{id}', ['as' => 'resumes.update', 'uses' => 'ResumesController@update']);


// Route::resource('companies', 'CompaniesController');

Route::get('scouts/company_scout', 'ScoutsController@company_scout');
Route::get('scouts/company_scout/{id}', ['as' => 'scouts.company_scout_note', 'uses' => 'ScoutsController@company_scout_note']);
Route::get('scouts/create/{scout_user_id}', ['as' => 'scouts.create', 'uses' => 'ScoutsController@create']);
Route::post('scouts', ['as' => 'scouts.store', 'uses' => 'ScoutsController@store']);


Route::get('contact', 'PagesController@contact');
Route::get('about', 'PagesController@about');    // 追加


Route::get('openings/general_portal','OpeningsController@general_portal');

Route::get('openings', ['as' => 'openings.index', 'uses' => 'OpeningsController@index']);

// Route::get('openings_bookmark/{opening_id}', ['as' => 'openings.bookmark_openings_index', 'uses' => 'OpeningsController@bookmark_openings_index']);

Route::get('bookmarked/list','OpeningsController@bookmark_lists');

Route::get('search/opening/use/language',['as'=>'search_opening_with_language', 'uses'=>'OpeningsController@search_opening_with_language']);

Route::post('openings_bookmark/{opening_id}', ['as' => 'openings.bookmark_openings_index', 'uses' => 'OpeningsController@bookmark_openings_index']);

Route::delete('openings_unbookmark/{opening_id}', ['as' => 'openings.unbookmark_openings_index', 'uses' => 'OpeningsController@unbookmark_openings_index']);
// Route::post('openings_unbookmark/{opening_id}', ['as' => 'openings.unbookmark_openings_index', 'uses' => 'OpeningsController@unbookmark_openings_index']);
// Route::post('openings_unbookmark/{opening_id}', ['as' => 'openings.unbookmark_openings_index', 'uses' => 'OpeningsController@unbookmark_openings_index']);
Route::get('openings/create/{company_id}','OpeningsController@create');
Route::get('openings/{id}','OpeningsController@show');
Route::post('openings', ['as' => 'openings.store', 'uses' => 'OpeningsController@store']);

//Jesray programming language tag route
Route::get('portals/search_international/{code}', ['as' => 'portal_international_search', 'uses' => 'PortalController@portal_international_search']);


// Route::post('openings', 'OpeningsController@store')->name('openings.store');

// FOLLOW COMPANIES
Route::get('followed/list','CompaniesController@follow_company_lists');
Route::post('companies_follow/{company_id}', ['as' => 'companies.follow_companies_index', 'uses' => 'CompaniesController@follow_companies_index']);
Route::delete('companies_unfollow/{company_id}', ['as' => 'companies.unfollow_companies_index', 'uses' => 'CompaniesController@unfollow_companies_index']);


// Authentication routes...
Route::get('auth/login', ['as' => 'auth.login', 'uses' => 'Auth\AuthController@getLogin']);
Route::post('auth/login', ['as' => 'auth.login', 'uses' => 'Auth\AuthController@postLogin']);
Route::get('auth/logout', ['as' => 'auth.logout', 'uses' => 'Auth\AuthController@getLogout']);


Route::get('auth/register/{status}', 'Auth\AuthController@judge');
Route::post('auth/register/{status}', 'Auth\AuthController@postRegister');

// Password reset link request routes...
Route::get('password/email', 'Auth\PasswordController@getEmail');
Route::post('password/email', 'Auth\PasswordController@postEmail');

// Password reset routes...
Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
Route::post('password/reset', 'Auth\PasswordController@postReset');
