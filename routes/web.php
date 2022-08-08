<?php

use Illuminate\Support\Facades\Auth;
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

Route::get('auth/logout', 'AuthController@logout');

Route::middleware(['auth'])->group(function () {
	Route::get('/', 'DashboardController@index');
	Route::get('dashboard', 'DashboardController@index');
	
	Route::get('users/datatable', 'UserController@datatable')->name('users.datatable');
	Route::get('users/changePassword', 'UserController@changePassword')->name('users.changePassword');
	Route::post('users/savePassword', 'UserController@savePassword')->name('users.savePassword');
	Route::resource('users', UserController::class);

	Route::get('access_masters/datatable', 'AccessMasterController@datatable')->name('access_masters.datatable');
	Route::resource('access_masters', AccessMasterController::class);

	Route::get('access_groups/datatable', 'AccessGroupController@datatable')->name('access_groups.datatable');
	Route::resource('access_groups', AccessGroupController::class);

	Route::get('categories/datatable', 'CategoryController@datatable')->name('categories.datatable');
	Route::resource('categories', CategoryController::class);

	Route::get('events/datatable', 'EventController@datatable')->name('events.datatable');
	Route::resource('events', EventController::class);

	Route::get('orders/datatable', 'OrderTicketController@datatable')->name('orders.datatable');
	Route::resource('orders', OrderTicketController::class);

	Route::get('organizers/datatable', 'OrganizerController@datatable')->name('organizers.datatable');
	Route::get('organizers/{id}/manageTeam', 'OrganizerController@manageTeam')->name('organizers.manageTeam');
	Route::get('organizers/{id}/role/create', 'OrganizerController@createRole')->name('organizers.createRole');
	Route::post('organizers/{id}/role/store', 'OrganizerController@storeRole')->name('organizers.storeRole');
	Route::get('organizers/{id_organizer}/role/{id_role}/edit', 'OrganizerController@editRole')->name('organizers.editRole');
	Route::put('organizers/{id_organizer}/role/{id_role}/update', 'OrganizerController@updateRole')->name('organizers.updateRole');
	Route::get('organizers/{id}/member/create', 'OrganizerController@createMember')->name('organizers.createMember');
	Route::post('organizers/{id}/member/store', 'OrganizerController@storeMember')->name('organizers.storeMember');
	Route::get('organizers/{id_organizer}/member/{id_member}/edit', 'OrganizerController@editMember')->name('organizers.editMember');
	Route::put('organizers/{id_organizer}/member/{id_member}/update', 'OrganizerController@updateMember')->name('organizers.updateMember');
	Route::resource('organizers', OrganizerController::class);

	Route::get('promos/datatable', 'PromoController@datatable')->name('promos.datatable');
	Route::resource('promos', PromoController::class);

	Route::get('role_permissions/datatable', 'RolePermissionController@datatable')->name('role_permissions.datatable');
	Route::resource('role_permissions', RolePermissionController::class);

	Route::get('tags/datatable', 'TagsController@datatable')->name('tags.datatable');
	Route::resource('tags', TagsController::class);

	Route::get('types/datatable', 'TypeController@datatable')->name('types.datatable');
	Route::resource('types', TypeController::class);

	Route::resource('reports', ReportController::class);

	Route::get('members/datatable', 'MemberController@datatable')->name('members.datatable');
	Route::resource('members', MemberController::class);
});

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
