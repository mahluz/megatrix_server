<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

// Pages needed pre-go-live

# View Profile
# Edit Profile
# Compose Email
# Inbox
# View Email
# Calendar
# Member Management (data tables)
# FAQs
# Support Form
# Better Fancy-checkbox

// Component Pages
Route::get('/',
    [
        'uses' => 'StandardPagesController@dashboard',
        'as' => 'admin.dashboard'
    ]);

Route::get('widgets',
    [
        'uses' => 'StandardPagesController@widgets',
        'as' => 'admin.widgets'
    ]);

// > App Pages


Route::get('/log-in',
[
    'uses' => 'AuthScreensController@login',
    'as' => 'admin.logIn'
]);

Route::get('/forgot-password',
[
    'uses' => 'AuthScreensController@forgotPassword',
    'as' => 'admin.forgotPassword'
]);

Route::get('/forgot-password-success',
[
    'uses' => 'AuthScreensController@forgotPasswordSuccess',
    'as' => 'admin.forgotPasswordSuccess'
]);

Route::get('/sign-up',
[
    'uses' => 'AuthScreensController@signUp',
    'as' => 'admin.signUp'
]);

Route::get('/sign-up-success',
[
    'uses' => 'AuthScreensController@signUpSuccess',
    'as' => 'admin.signUpSuccess'
]);

Route::group(['prefix' => 'app-pages'], function()
{
    Route::get('/faqs',
    [
        'uses' => 'AppPagesController@faqs',
        'as' => 'admin.appPages.faqs'
    ]);


    Route::get('/inbox',
    [
        'uses' => 'AppPagesController@inbox',
        'as' => 'admin.appPages.inbox'
    ]);

    Route::get('/inbox/view',
    [
        'uses' => 'AppPagesController@inboxView',
        'as' => 'admin.appPages.inbox.view'
    ]);

    Route::get('/inbox/compose',
    [
        'uses' => 'AppPagesController@inboxCompose',
        'as' => 'admin.appPages.inbox.compose'
    ]);

    Route::get('/profile',
    [
        'uses' => 'AppPagesController@profile',
        'as' => 'admin.appPages.profile'
    ]);

    Route::get('/profile/update',
    [
        'uses' => 'AppPagesController@profileUpdate',
        'as' => 'admin.appPages.profile.update'
    ]);

    Route::get('/orders',
    [
        'uses' => 'AppPagesController@orders',
        'as' => 'admin.appPages.orders'
    ]);

    Route::get('/calendar',
    [
        'uses' => 'AppPagesController@calendar',
        'as' => 'admin.appPages.calendar'
    ]);

    Route::get('/enquiry',
    [
        'uses' => 'AppPagesController@enquiry',
        'as' => 'admin.appPages.enquiry'
    ]);

    Route::get('/page-not-found',
    [
        'uses' => 'AppPagesController@pageNotFound',
        'as' => 'admin.appPages.pageNotFound'
    ]);
});

// Fundamentals
Route::get('tables',
    [
        'uses' => 'StandardPagesController@tables',
        'as' => 'admin.tables'
    ]);

Route::get('forms',
    [
        'uses' => 'StandardPagesController@forms',
        'as' => 'admin.forms'
    ]);

Route::get('chart-js',
    [
        'uses' => 'StandardPagesController@chartJs',
        'as' => 'admin.chartJs'
    ]);

// > UI Components
Route::group(['prefix' => 'ui-components'], function()
{
    Route::get('buttons',
        [
            'uses' => 'UIComponentsController@buttons',
            'uses' => function () {
                return view('admin.uiComponents.buttons')->with('activePage', 'uiComponents.buttons');
            },
        'as' => 'admin.uiComponents.buttons'
    ]);

    Route::get('badges-and-labels',
        [
            'uses' => 'UIComponentsController@badgesAndLabels',
            'uses' => function () {
                return view('admin.uiComponents.badgesAndLabels')->with('activePage', 'uiComponents.badgesAndLabels');
            },
        'as' => 'admin.uiComponents.badgesAndLabels'
    ]);

    Route::get('typography',
        [
            'uses' => 'UIComponentsController@typography',
            'uses' => function () {
                return view('admin.uiComponents.typography')->with('activePage', 'uiComponents.typography');
            },
        'as' => 'admin.uiComponents.typography'
    ]);

    Route::get('grid-system',
        [
            'uses' => 'UIComponentsController@gridSystem',
            'uses' => function () {
                return view('admin.uiComponents.gridSystem')->with('activePage', 'uiComponents.gridSystem');
            },
        'as' => 'admin.uiComponents.gridSystem'
    ]);

    Route::get('panels',
        [
            'uses' => 'UIComponentsController@panels',
            'uses' => function () {
                return view('admin.uiComponents.panels')->with('activePage', 'uiComponents.panels');
            },
        'as' => 'admin.uiComponents.panels'
    ]);

    Route::get('pagination',
        [
            'uses' => 'UIComponentsController@pagination',
            'uses' => function () {
                return view('admin.uiComponents.pagination')->with('activePage', 'uiComponents.pagination');
            },
        'as' => 'admin.uiComponents.pagination'
    ]);

    Route::get('progress-bars',
        [
            'uses' => 'UIComponentsController@progressBars',
            'uses' => function () {
                return view('admin.uiComponents.progressBars')->with('activePage', 'uiComponents.progressBars');
            },
        'as' => 'admin.uiComponents.progressBars'
    ]);

    Route::get('alerts',
        [
            'uses' => 'UIComponentsController@alerts',
            'uses' => function () {
                return view('admin.uiComponents.alerts')->with('activePage', 'uiComponents.alerts');
            },
        'as' => 'admin.uiComponents.alerts'
    ]);
});

Route::get('/toggle-skin-colour/{identifier}', function($identifier)
{
    if ($identifier === 'default') {
        Session::forget('skin.colour');
    } else {
        Session::put('skin.colour', $identifier);
    }
});