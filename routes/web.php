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

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;

// check
Route::get('/', static function (){
    $domain = Request::root();
    return Redirect::to($domain);
});

Route::get('/registration-complete', static function (){
    return view('registration-complete');
});

Auth::routes();

Route::get('/admin', 'AdminController@index')->name('admin');
Route::get('/users', 'UserController@index')->name('users');

Route::get('/registration-complete', static function(){
    return view('registration-complete');
});

// Admin Section
//Login Page
Route::get('admin-login', 'Auth\AdminLoginController@showLoginForm')->name('admin-login');

//Submit Login
Route::post('admin-login', ['as'=>'admin-login','uses'=>'Auth\AdminLoginController@login']);

// Dashboard Page
Route::get('admin/dashboard', 'AdminController@index')->name('admin-dashboard');

//Manage Users Page
Route::get('admin/manage-users', 'AdminController@manageUsersPage')->name('manage-users');

// Verify User Form
Route::post('/verify-user/{id}', ['uses' => 'AdminController@verifyUser']);

// Delete User Form
Route::post('/delete-user/{id}', ['uses' => 'AdminController@deleteUser']);

//Fund User Page
Route::get('admin/fund-user/{id}',
    ['as'=>'admin.fund-user', 'uses'=>'AdminController@fundUserPage']
);

// Fund User Form
Route::post('/funds-user/{id}', ['uses' => 'AdminController@fundUser']);

//User Withdrawal Page
Route::get('admin/fund-withdrawal/{id}',
    ['as'=>'admin.fund-withdrawal', 'uses'=>'AdminController@fundWithdrawalPage']
);

// User Withdrawal Form
Route::post('/fund-withdrawal/{id}', ['uses' => 'AdminController@fundWithdrawal']);

//Change Date Page
Route::get('admin/change-date/{id}',
    ['as'=>'admin.change-date', 'uses'=>'AdminController@changeDatePage']
);

// Change Date Form
Route::post('/change-date/{id}', ['uses' => 'AdminController@changeDate']);

// Block User Payment Form
Route::post('/block-transfer/{id}', ['uses' => 'AdminController@blockTransfer']);

//Fund Transfers Page
Route::get('admin/fund-transfers', 'AdminController@fundTransfersPage')->name('fund-transfers');

//All Transactions Page
Route::get('admin/all-transactions', 'AdminController@allTransactionsPage')->name('all-transactions');

//Admin Settings Page
Route::get('admin/admin-settings', 'AdminController@adminSettingsPage')->name('admin-settings');

//Update Admin Account
Route::post('admin/update-account', 'AdminController@updateAdminAccount')->name('update-admin-account');


// User Section
// User Dashboard Page
Route::get('users/dashboard', 'UserController@index')->name('account-dashboard');

//User Account Statement
Route::get('users/account-statement', 'UserController@accountStatementPage')->name('account-statement');

//Funds Transfer Page
Route::get('users/funds-transfer', 'UserController@fundsTransferPage')->name('funds-transfer');

//Airtime and Bills Page
Route::get('users/airtime-bills', 'UserController@airtimeBillsPage')->name('airtime-bills');

//Loans and Investment Page
Route::get('users/loans-investment', 'UserController@loansInvestmentPage')->name('loans-investment');

//Sports and Gaming Page
Route::get('users/sports-gaming', 'UserController@sportsGamingPage')->name('sports-gaming');

//Credit Card Request Page
Route::get('users/credit-card-request', 'UserController@creditCardRequestPage')->name('credit-card-request');

//Start funds transfer
Route::post('/start-funds-transfer', 'UserController@startFundsTransfer');

//Currency Conversion
Route::get('users/currency-conversion/{id}', 'UserController@currencyConversionPage');
Route::post('users/currency-conversion/{id}', ['uses' => 'UserController@currencyConversion']);

//Cost of Transfer
Route::get('users/cost-of-transfer/{id}', 'UserController@costOfTransferPage');
Route::post('users/cost-of-transfer/{id}', ['uses' => 'UserController@costOfTransfer']);

//Tax Revenue
Route::get('users/tax-revenue/{id}', 'UserController@taxRevenuePage');
Route::post('users/tax-revenue/{id}', ['uses' => 'UserController@taxRevenue']);

//Funds Transfer COT Page
Route::get('users/funds-transfer-cot/{id}', 'UserController@fundsTransferCotPage');

//Funds Transfer COT Form
Route::post('/funds-transfer-cot/{id}', ['uses' => 'UserController@fundsTransferCot']);

//Funds Transfer Pin Page
Route::get('users/funds-transfer-pin/{id}', 'UserController@fundsTransferPinPage');

//funds transfer pin form
Route::post('/funds-transfer-pin/{id}', ['uses' => 'UserController@fundsTransferPin']);

//Funds Transfer OTP Page
Route::get('users/funds-transfer-otp/{id}', 'UserController@fundsTransferOtpPage');

//funds transfer OTP form
Route::post('/funds-transfer-otp/{id}', ['uses' => 'UserController@fundsTransferOtp']);

//Funds Transfer Complete Page
Route::get('users/funds-transfer-complete/{id}', 'UserController@fundsTransferCompletePage');

//Account Settings Page
Route::get('users/account-settings', 'UserController@accountSettingsPage')->name('account-settings');

//Update account
Route::post('/update-account', 'UserController@updateAccount');

// Github Deployment
Route::get('/github/deployment/{pass}', 'GithubDeploymentController@deploy');

