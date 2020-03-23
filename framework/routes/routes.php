<?php
    use Framework\Core\Route;

// Default Route
    Route::respond('get', '/', function () {App\Controllers\Home::index();});
    // Community
    Route::respond('get', '/community/downloads', function () {App\Controllers\Community::downloads();});
    Route::respond('get', '/community/discord', function () {App\Controllers\Community::discord();});
    Route::respond('get', '/community/news', function () {App\Controllers\Community::news();});
    Route::respond('get', '/community/patchnotes', function () {App\Controllers\Community::patchnotes();});
    Route::respond('get', '/community/pvprankings', function () {App\Controllers\Community::pvprankings();});
    Route::respond('get', '/community/guildrankings', function () {App\Controllers\Community::guildrankings();});
    Route::respond('get', '/community/staffteam', function () {App\Controllers\Community::staffteam();});
    // Server Info
    Route::respond('get', '/serverinfo/about', function () {App\Controllers\ServerInfo::about();});
    Route::respond('get', '/serverinfo/drops', function () {App\Controllers\ServerInfo::drops();});
    Route::respond('get', '/serverinfo/dropfinder', function () {App\Controllers\ServerInfo::dropfinder();});
    Route::respond('get', '/serverinfo/bossrecords', function () {App\Controllers\ServerInfo::bossrecords();});
    Route::respond('get', '/serverinfo/terms', function () {App\Controllers\ServerInfo::terms();});
    // Auth
    Route::respond('get', '/auth/logout', function () {App\Controllers\Auth::logout();});
    // User
    Route::respond('get', '/user/profile', function () {App\Controllers\User::profile();});
    Route::respond('get', '/user/donate', function () {App\Controllers\User::donate();});
    Route::respond('get', '/user/donate_complete', function () {App\Controllers\User::donate_complete();});
    Route::respond('get', '/user/donate_process', function () {App\Controllers\User::donate_process();});
    //Route::respond('get', '/user/logout', function () {User::logout();});
    Route::respond('get', '/user/messages', function () {App\Controllers\User::messages();});
    Route::respond('get', '/user/promotions', function () {App\Controllers\User::promotions();});
    Route::respond('get', '/user/pvprewards', function () {App\Controllers\User::pvprewards();});
    Route::respond('get', '/user/referers', function () {App\Controllers\User::referers();});
    Route::respond('get', '/user/settings', function () {App\Controllers\User::settings();});
    Route::respond('get', '/user/settings/privacy', function () {App\Controllers\User::settings();});
    Route::respond('get', '/user/settings/signature', function () {App\Controllers\User::settings();});
    Route::respond('get', '/user/support', function () {App\Controllers\User::support();});
    Route::respond('get', '/user/vote', function () {App\Controllers\User::vote();});
    Route::respond('get', '/user/users', function () {App\Controllers\User::users();});
    Route::respond('get', '/user/friends', function () {App\Controllers\User::friends();});
    // Must be loaded after all other user routes
    Route::respond('get', '/user/(int:id)', function ($id) {App\Controllers\User::user($id);});
    // Forum
    Route::respond('get', '/forum', function () {App\Controllers\Forum::forum();});
    Route::respond('get', '/forum/topics/(any:id)', function ($id) {App\Controllers\Forum::topics($id);});
    Route::respond('get', '/forum/post/(any:id)', function ($id) {App\Controllers\Forum::posts($id);});
    Route::respond('get', '/forum/topics/view_topic/(any:id)', function ($id) {App\Controllers\Forum::view_topic($id);});
    // Admin
    Route::respond('get', '/admin', function () {
        Admin::index();
    });
    Route::respond('get', '/admin/core/settings', function () {
        echo 'core settings';
    });
    Route::respond('get', '/admin/core/user/(any:id)', function ($id) {
        echo 'core settings: id: ' . $id;
    });

    //Errors
    Route::respond('get', '/errors/301', function () {App\Controllers\Errors::error301();});
    Route::respond('get', '/errors/307', function () {App\Controllers\Errors::error307();});
    Route::respond('get', '/errors/400', function () {App\Controllers\Errors::error400();});
    Route::respond('get', '/errors/401', function () {App\Controllers\Errors::error401();});
    Route::respond('get', '/errors/403', function () {App\Controllers\Errors::error403();});
    Route::respond('get', '/errors/404', function () {App\Controllers\Errors::error404();});
    Route::respond('get', '/errors/405', function () {App\Controllers\Errors::error405();});
    Route::respond('get', '/errors/408', function () {App\Controllers\Errors::error408();});
    Route::respond('get', '/errors/500', function () {App\Controllers\Errors::error500();});
    Route::respond('get', '/errors/502', function () {App\Controllers\Errors::error502();});

    // Post Responses
    // Auth
    Route::respond('post', '/auth/login', function () {App\Controllers\Auth::login();});
    Route::respond('post', '/auth/logout', function () {App\Controllers\Auth::logout();});

    // Promotions
    Route::respond('post', '/user/promotions', function () {App\Controllers\User::promotions();});
