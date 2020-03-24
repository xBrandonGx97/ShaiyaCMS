<?php
    use Framework\Core\Route;

$dispatcher = FastRoute\simpleDispatcher(function (FastRoute\RouteCollector $r) {
    $userClass = new Classes\Utils\User;
    $home = new App\Controllers\Home($userClass);

    // Default Route
    $r->addRoute('GET', '/', [($home), 'index']);

    // Community
    $r->addGroup('/community', function (FastRoute\RouteCollector $r) {
        $userClass = new Classes\Utils\User;
        $community = new App\Controllers\Community($userClass);

        $r->addRoute('GET', '/downloads', [($community), 'downloads']);
        $r->addRoute('GET', '/discord', [($community), 'discord']);
        $r->addRoute('GET', '/news', [($community), 'news']);
        $r->addRoute('GET', '/patchnotes', [($community), 'patchnotes']);
        $r->addRoute('GET', '/pvprankings', [($community), 'pvprankings']);
        $r->addRoute('GET', '/guildrankings', [($community), 'guildrankings']);
        $r->addRoute('GET', '/staffteam', [($community), 'staffteam']);
    });
    // Server Info
    $r->addGroup('/serverinfo', function (FastRoute\RouteCollector $r) {
        $userClass = new Classes\Utils\User;
        $serverInfo = new App\Controllers\ServerInfo($userClass);

        $r->addRoute('GET', '/about', [($serverInfo), 'about']);
        $r->addRoute('GET', '/drops', [($serverInfo), 'drops']);
        $r->addRoute('GET', '/dropfinder', [($serverInfo), 'dropfinder']);
        $r->addRoute('GET', '/bossrecords', [($serverInfo), 'bossrecords']);
        $r->addRoute('GET', '/terms', [($serverInfo), 'terms']);
    });
    // Auth
    $r->addGroup('/auth', function (FastRoute\RouteCollector $r) {
        $userClass = new Classes\Utils\User;
        $auth = new App\Controllers\Auth($userClass);

        $r->addRoute('POST', '/login', [($auth), 'login']);
        $r->addRoute('POST', '/logout', [($auth), 'logout']);
    });
    // User
    $r->addGroup('/user', function (FastRoute\RouteCollector $r) {
        $userClass = new Classes\Utils\User;
        $user = new App\Controllers\User($userClass);

        $r->addRoute('GET', '/profile', [($user), 'profile']);
        $r->addRoute('GET', '/donate', [($user), 'donate']);
        $r->addRoute('GET', '/donate_complete', [($user), 'donate_complete']);
        $r->addRoute('GET', '/donate_process', [($user), 'donate_process']);
        $r->addRoute('GET', '/messages', [($user), 'messages']);
        $r->addRoute('GET', '/promotions', [($user), 'promotions']);
        $r->addRoute('GET', '/pvprewards', [($user), 'pvprewards']);
        $r->addRoute('GET', '/referers', [($user), 'referers']);
        $r->addRoute('GET', '/settings', [($user), 'settings']);
        $r->addRoute('GET', '/settings/privacy', [($user), 'settings']);
        $r->addRoute('GET', '/settings/signature', [($user), 'settings']);
        $r->addRoute('GET', '/support', [($user), 'support']);
        $r->addRoute('GET', '/vote', [($user), 'vote']);
        $r->addRoute('GET', '/users', [($user), 'users']);
        $r->addRoute('GET', '/friends', [($user), 'friends']);
        $r->addRoute('GET', '/{id:\d+}', [($user), 'user']);

        // Post
        $r->addRoute('POST', '/promotions', [($user), 'promotions']);
    });
    // Forum
    $r->addGroup('/forum', function (FastRoute\RouteCollector $r) {
        $userClass = new Classes\Utils\User;
        $forum = new App\Controllers\Forum($userClass);

        $r->addRoute('GET', '', [($forum), 'forum']);
        $r->addRoute('GET', '/topics/{id:\d+}', [($forum), 'topics']);
        $r->addRoute('GET', '/post/{id:\d+}', [($forum), 'posts']);
        $r->addRoute('GET', '/topics/view_topic/{id:\d+}', [($forum), 'view_topic']);
    });
    // Admin
    $r->addGroup('/admin', function (FastRoute\RouteCollector $r) {
        $userClass = new Classes\Utils\User;
        $admin = new App\Controllers\Admin($userClass);

        $r->addRoute('GET', '', [($admin), 'index']);
        $r->addRoute('GET', '/core/settings', [($admin), 'index']);
        $r->addRoute('GET', '/core/user/{id:\d+}', [($admin), 'index']);
    });
    // Errors
    $r->addGroup('/errors', function (FastRoute\RouteCollector $r) {
        $userClass = new Classes\Utils\User;
        $errors = new App\Controllers\Errors($userClass);

        $r->addRoute('GET', '/301', [($errors), 'error301']);
        $r->addRoute('GET', '/307', [($errors), 'error307']);
        $r->addRoute('GET', '/400', [($errors), 'error400']);
        $r->addRoute('GET', '/401', [($errors), 'error401']);
        $r->addRoute('GET', '/403', [($errors), 'error403']);
        $r->addRoute('GET', '/404', [($errors), 'error404']);
        $r->addRoute('GET', '/405', [($errors), 'error405']);
        $r->addRoute('GET', '/408', [($errors), 'error408']);
        $r->addRoute('GET', '/500', [($errors), 'error500']);
        $r->addRoute('GET', '/502', [($errors), 'error502']);
    });
});
