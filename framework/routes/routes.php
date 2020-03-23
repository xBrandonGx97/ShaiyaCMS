<?php
    use Framework\Core\Route;

$route = new Route;
    $route->run();
    // Default Route
    $route->respond('get', '/', function () {
        $Home = new App\Controllers\Home();
        $Home->index();
    });
    // Community
    $route->respond('get', '/community/downloads', function () {
        $Community = new App\Controllers\Community();
        $Community->downloads();
    });
    $route->respond('get', '/community/discord', function () {
        $Community = new App\Controllers\Community();
        $Community->discord();
    });
    $route->respond('get', '/community/news', function () {
        $Community = new App\Controllers\Community();
        $Community->news();
    });
    $route->respond('get', '/community/patchnotes', function () {
        $Community = new App\Controllers\Community();
        $Community->patchnotes();
    });
    $route->respond('get', '/community/pvprankings', function () {
        $Community = new App\Controllers\Community();
        $Community->pvprankings();
    });
    $route->respond('get', '/community/guildrankings', function () {
        $Community = new App\Controllers\Community();
        $Community->guildrankings();
    });
    $route->respond('get', '/community/staffteam', function () {
        $Community = new App\Controllers\Community();
        $Community->staffteam();
    });
    // Server Info
    $route->respond('get', '/serverinfo/about', function () {
        $ServerInfo = new App\Controllers\ServerInfo();
        $ServerInfo->about();
    });
    $route->respond('get', '/serverinfo/drops', function () {
        $ServerInfo = new App\Controllers\ServerInfo();
        $ServerInfo->drops();
    });
    $route->respond('get', '/serverinfo/dropfinder', function () {
        $ServerInfo = new App\Controllers\ServerInfo();
        $ServerInfo->dropfinder();
    });
    $route->respond('get', '/serverinfo/bossrecords', function () {
        $ServerInfo = new App\Controllers\ServerInfo();
        $ServerInfo->bossrecords();
    });
    $route->respond('get', '/serverinfo/terms', function () {
        $ServerInfo = new App\Controllers\ServerInfo();
        $ServerInfo->terms();
    });
    // Auth
    $route->respond('get', '/auth/logout', function () {
        $Auth = new App\Controllers\Auth();
        $Auth->logout();
    });
    // User
    $route->respond('get', '/user/profile', function () {
        $User = new App\Controllers\User();
        $User->profile();
    });
    $route->respond('get', '/user/donate', function () {
        $User = new App\Controllers\User();
        $User->donate();
    });
    $route->respond('get', '/user/donate_complete', function () {
        $User = new App\Controllers\User();
        $User->donate_complete();
    });
    $route->respond('get', '/user/donate_process', function () {
        $User = new App\Controllers\User();
        $User->donate_process();
    });
    //$route->respond('get', '/user/logout', function () {User::logout();});
    $route->respond('get', '/user/messages', function () {
        $User = new App\Controllers\User();
        $User->messages();
    });
    $route->respond('get', '/user/promotions', function () {
        $User = new App\Controllers\User();
        $User->promotions();
    });
    $route->respond('get', '/user/pvprewards', function () {
        $User = new App\Controllers\User();
        $User->pvprewards();
    });
    $route->respond('get', '/user/referers', function () {
        $User = new App\Controllers\User();
        $User->referers();
    });
    $route->respond('get', '/user/settings', function () {
        $User = new App\Controllers\User();
        $User->settings();
    });
    $route->respond('get', '/user/settings/privacy', function () {
        $User = new App\Controllers\User();
        $User->settings();
    });
    $route->respond('get', '/user/settings/signature', function () {
        $User = new App\Controllers\User();
        $User->settings();
    });
    $route->respond('get', '/user/support', function () {
        $User = new App\Controllers\User();
        $User->support();
    });
    $route->respond('get', '/user/vote', function () {
        $User = new App\Controllers\User();
        $User->vote();
    });
    $route->respond('get', '/user/users', function () {
        $User = new App\Controllers\User();
        $User->users();
    });
    $route->respond('get', '/user/friends', function () {
        $User = new App\Controllers\User();
        $User->friends();
    });
    // Must be loaded after all other user routes
    $route->respond('get', '/user/(int:id)', function ($id) {
        $User = new App\Controllers\User();
        $User->user($id);
    });
    // Forum
    $route->respond('get', '/forum', function () {
        $Forum = new App\Controllers\Forum();
        $Forum->forum();
    });
    $route->respond('get', '/forum/topics/(any:id)', function ($id) {
        $Forum = new App\Controllers\Forum();
        $Forum->topics($id);
    });
    $route->respond('get', '/forum/post/(any:id)', function ($id) {
        $Forum = new App\Controllers\Forum();
        $Forum->posts($id);
    });
    $route->respond('get', '/forum/topics/view_topic/(any:id)', function ($id) {
        $Forum = new App\Controllers\Forum();
        $Forum->view_topic($id);
    });
    // Admin
    $route->respond('get', '/admin', function () {
        $Admin = new App\Controllers\Admin();
        $Admin->index();
    });
    $route->respond('get', '/admin/core/settings', function () {
        echo 'core settings';
    });
    $route->respond('get', '/admin/core/user/(any:id)', function ($id) {
        echo 'core settings: id: ' . $id;
    });

    //Errors
    $route->respond('get', '/errors/301', function () {
        $Errors = new App\Controllers\Errors();
        $Errors->error301();
    });
    $route->respond('get', '/errors/307', function () {
        $Errors = new App\Controllers\Errors();
        $Errors->error307();
    });
    $route->respond('get', '/errors/400', function () {
        $Errors = new App\Controllers\Errors();
        $Errors->error400();
    });
    $route->respond('get', '/errors/401', function () {
        $Errors = new App\Controllers\Errors();
        $Errors->error401();
    });
    $route->respond('get', '/errors/403', function () {
        $Errors = new App\Controllers\Errors();
        $Errors->error403();
    });
    $route->respond('get', '/errors/404', function () {
        $Errors = new App\Controllers\Errors();
        $Errors->error404();
    });
    $route->respond('get', '/errors/405', function () {
        $Errors = new App\Controllers\Errors();
        $Errors->error405();
    });
    $route->respond('get', '/errors/408', function () {
        $Errors = new App\Controllers\Errors();
        $Errors->error408();
    });
    $route->respond('get', '/errors/500', function () {
        $Errors = new App\Controllers\Errors();
        $Errors->error500();
    });
    $route->respond('get', '/errors/502', function () {
        $Errors = new App\Controllers\Errors();
        $Errors->error502();
    });

    // Post Responses
    // Auth
    $route->respond('post', '/auth/login', function () {
        $Auth = new App\Controllers\Auth();
        $Auth->login();
    });
    $route->respond('post', '/auth/logout', function () {
        $Auth = new App\Controllers\Auth();
        $Auth->logout();
    });

    // Promotions
    $route->respond('post', '/user/promotions', function () {
        $User = new App\Controllers\User();
        $User->promotions();
    });
