<?php
    use Core\Route;

// Default Route
    Route::respond('get', '/', function () {Home_Controller::index();});
    // Community
    Route::respond('get', '/community/downloads', function () {Community_Controller::downloads();});
    Route::respond('get', '/community/discord', function () {Community_Controller::discord();});
    Route::respond('get', '/community/news', function () {Community_Controller::news();});
    Route::respond('get', '/community/patchnotes', function () {Community_Controller::patchnotes();});
    Route::respond('get', '/community/pvprankings', function () {Community_Controller::pvprankings();});
    Route::respond('get', '/community/guildrankings', function () {Community_Controller::guildrankings();});
    Route::respond('get', '/community/staffteam', function () {Community_Controller::staffteam();});
    // Server Info
    Route::respond('get', '/serverinfo/about', function () {ServerInfo_Controller::about();});
    Route::respond('get', '/serverinfo/drops', function () {ServerInfo_Controller::drops();});
    Route::respond('get', '/serverinfo/dropfinder', function () {ServerInfo_Controller::dropfinder();});
    Route::respond('get', '/serverinfo/bossrecords', function () {ServerInfo_Controller::bossrecords();});
    Route::respond('get', '/serverinfo/terms', function () {ServerInfo_Controller::terms();});
    // Auth
    Route::respond('get', '/auth/logout', function () {Auth_Controller::logout();});
    // User
    Route::respond('get', '/user/profile', function () {User_Controller::profile();});
    Route::respond('get', '/user/donate', function () {User_Controller::donate();});
    Route::respond('get', '/user/donate_complete', function () {User_Controller::donate_complete();});
    Route::respond('get', '/user/donate_process', function () {User_Controller::donate_process();});
    //Route::respond('get', '/user/logout', function () {User_Controller::logout();});
    Route::respond('get', '/user/messages', function () {User_Controller::messages();});
    Route::respond('get', '/user/promotions', function () {User_Controller::promotions();});
    Route::respond('get', '/user/pvprewards', function () {User_Controller::pvprewards();});
    Route::respond('get', '/user/referers', function () {User_Controller::referers();});
    Route::respond('get', '/user/settings', function () {User_Controller::settings();});
    Route::respond('get', '/user/settings/privacy', function () {User_Controller::settings();});
    Route::respond('get', '/user/settings/signature', function () {User_Controller::settings();});
    Route::respond('get', '/user/support', function () {User_Controller::support();});
    Route::respond('get', '/user/vote', function () {User_Controller::vote();});
    Route::respond('get', '/user/users', function () {User_Controller::users();});
    Route::respond('get', '/user/friends', function () {User_Controller::friends();});
    // Must be loaded after all other user routes
    Route::respond('get', '/user/(int:id)', function ($id) {User_Controller::user($id);});
    // Forum
    Route::respond('get', '/forum', function () {Forum_Controller::forum();});
    Route::respond('get', '/forum/topics/(any:id)', function ($id) {Forum_Controller::topics($id);});
    Route::respond('get', '/forum/post/(any:id)', function ($id) {Forum_Controller::posts($id);});
    Route::respond('get', '/forum/topics/view_topic/(any:id)', function ($id) {Forum_Controller::view_topic($id);});
    // Admin
    Route::respond('get', '/admin', function () {
        Admin_Controller::index();
    });
    Route::respond('get', '/admin/core/settings', function () {
        echo 'core settings';
    });
    Route::respond('get', '/admin/core/user/(any:id)', function ($id) {
        echo 'core settings: id: ' . $id;
    });

    //Errors
    Route::respond('get', '/errors/301', function () {Errors_Controller::error301();});
    Route::respond('get', '/errors/307', function () {Errors_Controller::error307();});
    Route::respond('get', '/errors/400', function () {Errors_Controller::error400();});
    Route::respond('get', '/errors/401', function () {Errors_Controller::error401();});
    Route::respond('get', '/errors/403', function () {Errors_Controller::error403();});
    Route::respond('get', '/errors/404', function () {Errors_Controller::error404();});
    Route::respond('get', '/errors/405', function () {Errors_Controller::error405();});
    Route::respond('get', '/errors/408', function () {Errors_Controller::error408();});
    Route::respond('get', '/errors/500', function () {Errors_Controller::error500();});
    Route::respond('get', '/errors/502', function () {Errors_Controller::error502();});

    // Post Responses
    // Auth
    Route::respond('post', '/auth/login', function () {Auth_Controller::login();});
    // Promotions
    Route::respond('post', '/user/promotions', function () {User_Controller::promotions();});
