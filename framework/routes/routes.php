<?php
    use Framework\Core\Route;

$route = new Route;
    $route->run();
    // Default Route
    $route->respond('get', '/', function () {
        $user = new Classes\Utils\User;
        $home = new App\Controllers\Home($user);
        $home->index();
    });
    // Community
    $route->respond('get', '/community/downloads', function () {
        $user = new Classes\Utils\User;
        $community = new App\Controllers\Community($user);
        $community->downloads();
    });
    $route->respond('get', '/community/discord', function () {
        $user = new Classes\Utils\User;
        $community = new App\Controllers\Community($user);
        $community->discord();
    });
    $route->respond('get', '/community/news', function () {
        $user = new Classes\Utils\User;
        $community = new App\Controllers\Community($user);
        $community->news();
    });
    $route->respond('get', '/community/patchnotes', function () {
        $user = new Classes\Utils\User;
        $community = new App\Controllers\Community($user);
        $community->patchnotes();
    });
    $route->respond('get', '/community/pvprankings', function () {
        $user = new Classes\Utils\User;
        $community = new App\Controllers\Community($user);
        $community->pvprankings();
    });
    $route->respond('get', '/community/guildrankings', function () {
        $user = new Classes\Utils\User;
        $community = new App\Controllers\Community($user);
        $community->guildrankings();
    });
    $route->respond('get', '/community/staffteam', function () {
        $user = new Classes\Utils\User;
        $community = new App\Controllers\Community($user);
        $community->staffteam();
    });
    // Server Info
    $route->respond('get', '/serverinfo/about', function () {
        $user = new Classes\Utils\User;
        $serverInfo = new App\Controllers\ServerInfo($user);
        $serverInfo->about();
    });
    $route->respond('get', '/serverinfo/drops', function () {
        $user = new Classes\Utils\User;
        $serverInfo = new App\Controllers\ServerInfo($user);
        $serverInfo->drops();
    });
    $route->respond('get', '/serverinfo/dropfinder', function () {
        $user = new Classes\Utils\User;
        $serverInfo = new App\Controllers\ServerInfo($user);
        $serverInfo->dropfinder();
    });
    $route->respond('get', '/serverinfo/bossrecords', function () {
        $user = new Classes\Utils\User;
        $serverInfo = new App\Controllers\ServerInfo($user);
        $serverInfo->bossrecords();
    });
    $route->respond('get', '/serverinfo/terms', function () {
        $user = new Classes\Utils\User;
        $serverInfo = new App\Controllers\ServerInfo($user);
        $serverInfo->terms();
    });
    // Auth
    /* $route->respond('get', '/auth/logout', function () {
        $user = new Classes\Utils\User;
        $auth = new App\Controllers\Auth($user);
        $auth->logout();
    }); */
    // User
    $route->respond('get', '/user/profile', function () {
        $userClass = new Classes\Utils\User;
        $user = new App\Controllers\User($userClass);
        $user->profile();
    });
    $route->respond('get', '/user/donate', function () {
        $userClass = new Classes\Utils\User;
        $user = new App\Controllers\User($userClass);
        $user->donate();
    });
    $route->respond('get', '/user/donate_complete', function () {
        $userClass = new Classes\Utils\User;
        $user = new App\Controllers\User($userClass);
        $user->donate_complete();
    });
    $route->respond('get', '/user/donate_process', function () {
        $userClass = new Classes\Utils\User;
        $user = new App\Controllers\User($userClass);
        $user->donate_process();
    });
    //$route->respond('get', '/user/logout', function () {User::logout();});
    $route->respond('get', '/user/messages', function () {
        $userClass = new Classes\Utils\User;
        $user = new App\Controllers\User($userClass);
        $user->messages();
    });
    $route->respond('get', '/user/promotions', function () {
        $userClass = new Classes\Utils\User;
        $user = new App\Controllers\User($userClass);
        $user->promotions();
    });
    $route->respond('get', '/user/pvprewards', function () {
        $userClass = new Classes\Utils\User;
        $user = new App\Controllers\User($userClass);
        $user->pvprewards();
    });
    $route->respond('get', '/user/referers', function () {
        $userClass = new Classes\Utils\User;
        $user = new App\Controllers\User($userClass);
        $user->referers();
    });
    $route->respond('get', '/user/settings', function () {
        $userClass = new Classes\Utils\User;
        $user = new App\Controllers\User($userClass);
        $user->settings();
    });
    $route->respond('get', '/user/settings/privacy', function () {
        $userClass = new Classes\Utils\User;
        $user = new App\Controllers\User($userClass);
        $user->settings();
    });
    $route->respond('get', '/user/settings/signature', function () {
        $userClass = new Classes\Utils\User;
        $user = new App\Controllers\User($userClass);
        $user->settings();
    });
    $route->respond('get', '/user/support', function () {
        $userClass = new Classes\Utils\User;
        $user = new App\Controllers\User($userClass);
        $user->support();
    });
    $route->respond('get', '/user/vote', function () {
        $userClass = new Classes\Utils\User;
        $user = new App\Controllers\User($userClass);
        $user->vote();
    });
    $route->respond('get', '/user/users', function () {
        $userClass = new Classes\Utils\User;
        $user = new App\Controllers\User($userClass);
        $user->users();
    });
    $route->respond('get', '/user/friends', function () {
        $userClass = new Classes\Utils\User;
        $user = new App\Controllers\User($userClass);
        $user->friends();
    });
    // Must be loaded after all other user routes
    $route->respond('get', '/user/(int:id)', function ($id) {
        $userClass = new Classes\Utils\User;
        $user = new App\Controllers\User($userClass);
        $user->user($id);
    });
    // Forum
    $route->respond('get', '/forum', function () {
        $user = new Classes\Utils\User;
        $forum = new App\Controllers\Forum();
        $forum->forum();
    });
    $route->respond('get', '/forum/topics/(any:id)', function ($id) {
        $user = new Classes\Utils\User;
        $forum = new App\Controllers\Forum();
        $forum->topics($id);
    });
    $route->respond('get', '/forum/post/(any:id)', function ($id) {
        $user = new Classes\Utils\User;
        $forum = new App\Controllers\Forum();
        $forum->posts($id);
    });
    $route->respond('get', '/forum/topics/view_topic/(any:id)', function ($id) {
        $user = new Classes\Utils\User;
        $forum = new App\Controllers\Forum();
        $forum->view_topic($id);
    });
    // Admin
    $route->respond('get', '/admin', function () {
        $user = new Classes\Utils\User;
        $admin = new App\Controllers\Admin();
        $admin->index();
    });
    $route->respond('get', '/admin/core/settings', function () {
        echo 'core settings';
    });
    $route->respond('get', '/admin/core/user/(any:id)', function ($id) {
        echo 'core settings: id: ' . $id;
    });

    //Errors
    $route->respond('get', '/errors/301', function () {
        $user = new Classes\Utils\User;
        $errors = new App\Controllers\Errors();
        $errors->error301();
    });
    $route->respond('get', '/errors/307', function () {
        $user = new Classes\Utils\User;
        $errors = new App\Controllers\Errors();
        $errors->error307();
    });
    $route->respond('get', '/errors/400', function () {
        $user = new Classes\Utils\User;
        $errors = new App\Controllers\Errors();
        $errors->error400();
    });
    $route->respond('get', '/errors/401', function () {
        $user = new Classes\Utils\User;
        $errors = new App\Controllers\Errors();
        $errors->error401();
    });
    $route->respond('get', '/errors/403', function () {
        $user = new Classes\Utils\User;
        $errors = new App\Controllers\Errors();
        $errors->error403();
    });
    $route->respond('get', '/errors/404', function () {
        $user = new Classes\Utils\User;
        $errors = new App\Controllers\Errors();
        $errors->error404();
    });
    $route->respond('get', '/errors/405', function () {
        $user = new Classes\Utils\User;
        $errors = new App\Controllers\Errors();
        $errors->error405();
    });
    $route->respond('get', '/errors/408', function () {
        $user = new Classes\Utils\User;
        $errors = new App\Controllers\Errors();
        $errors->error408();
    });
    $route->respond('get', '/errors/500', function () {
        $user = new Classes\Utils\User;
        $errors = new App\Controllers\Errors();
        $errors->error500();
    });
    $route->respond('get', '/errors/502', function () {
        $user = new Classes\Utils\User;
        $errors = new App\Controllers\Errors();
        $errors->error502();
    });

    // Post Responses
    // Auth
    $route->respond('post', '/auth/login', function () {
        $user = new Classes\Utils\User;
        $auth = new App\Controllers\Auth($user);
        $auth->login();
    });
    $route->respond('post', '/auth/logout', function () {
        $user = new Classes\Utils\User;
        $auth = new App\Controllers\Auth($user);
        $auth->logout();
    });

    // Promotions
    $route->respond('post', '/user/promotions', function () {
        $userClass = new Classes\Utils\User;
        $user = new App\Controllers\User($userClass);
        $user->promotions();
    });
