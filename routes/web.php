<?php
Route::get('/', function () { return redirect('/admin/home'); });

// Authentication Routes...
$this->get('login', 'Auth\LoginController@showLoginForm')->name('auth.login');
$this->post('login', 'Auth\LoginController@login')->name('auth.login');
$this->post('logout', 'Auth\LoginController@logout')->name('auth.logout');

// Change Password Routes...
$this->get('change_password', 'Auth\ChangePasswordController@showChangePasswordForm')->name('auth.change_password');
$this->patch('change_password', 'Auth\ChangePasswordController@changePassword')->name('auth.change_password');

// Password Reset Routes...
$this->get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('auth.password.reset');
$this->post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('auth.password.reset');
$this->get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
$this->post('password/reset', 'Auth\ResetPasswordController@reset')->name('auth.password.reset');

Route::group(['middleware' => ['auth'], 'prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('/home', 'HomeController@index');
    
    Route::resource('roles', 'Admin\RolesController');
    Route::post('roles_mass_destroy', ['uses' => 'Admin\RolesController@massDestroy', 'as' => 'roles.mass_destroy']);
    Route::resource('relatiemanagers', 'Admin\RelatiemanagersController');
    Route::post('relatiemanagers_mass_destroy', ['uses' => 'Admin\RelatiemanagersController@massDestroy', 'as' => 'relatiemanagers.mass_destroy']);
    Route::post('relatiemanagers_restore/{id}', ['uses' => 'Admin\RelatiemanagersController@restore', 'as' => 'relatiemanagers.restore']);
    Route::delete('relatiemanagers_perma_del/{id}', ['uses' => 'Admin\RelatiemanagersController@perma_del', 'as' => 'relatiemanagers.perma_del']);
    Route::resource('users', 'Admin\UsersController');
    Route::post('users_mass_destroy', ['uses' => 'Admin\UsersController@massDestroy', 'as' => 'users.mass_destroy']);
    Route::resource('bedrijfs', 'Admin\BedrijfsController');
    Route::post('bedrijfs_mass_destroy', ['uses' => 'Admin\BedrijfsController@massDestroy', 'as' => 'bedrijfs.mass_destroy']);
    Route::post('bedrijfs_restore/{id}', ['uses' => 'Admin\BedrijfsController@restore', 'as' => 'bedrijfs.restore']);
    Route::delete('bedrijfs_perma_del/{id}', ['uses' => 'Admin\BedrijfsController@perma_del', 'as' => 'bedrijfs.perma_del']);
    Route::resource('rapportage_module_1s', 'Admin\RapportageModule1sController');
    Route::resource('klantens', 'Admin\KlantensController');
    Route::post('klantens_mass_destroy', ['uses' => 'Admin\KlantensController@massDestroy', 'as' => 'klantens.mass_destroy']);
    Route::post('klantens_restore/{id}', ['uses' => 'Admin\KlantensController@restore', 'as' => 'klantens.restore']);
    Route::delete('klantens_perma_del/{id}', ['uses' => 'Admin\KlantensController@perma_del', 'as' => 'klantens.perma_del']);
    Route::resource('mod1s', 'Admin\Mod1sController');
    Route::post('mod1s_mass_destroy', ['uses' => 'Admin\Mod1sController@massDestroy', 'as' => 'mod1s.mass_destroy']);
    Route::post('mod1s_restore/{id}', ['uses' => 'Admin\Mod1sController@restore', 'as' => 'mod1s.restore']);
    Route::delete('mod1s_perma_del/{id}', ['uses' => 'Admin\Mod1sController@perma_del', 'as' => 'mod1s.perma_del']);



 
});
