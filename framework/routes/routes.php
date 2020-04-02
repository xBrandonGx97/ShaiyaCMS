<?php
use Framework\Core\Route;

$dispatcher = FastRoute\simpleDispatcher(function (FastRoute\RouteCollector $r) {
    $session = new Classes\Utils\Session;
    $userClass = new Classes\Utils\User($session);
    $home = new App\Controllers\Home($userClass);

    // Default Route
    $r->addRoute('GET', '/', [($home), 'index']);
    // News
    $r->addRoute('POST', '/news', [($home), 'news']);
    // Server Time
    $r->addRoute('POST', '/servertime', [($home), 'serverTime']);

    // Community
    $r->addGroup('/community', function (FastRoute\RouteCollector $r) {
        $session = new Classes\Utils\Session;
        $userClass = new Classes\Utils\User($session);

        $community = new App\Controllers\Community($userClass);

        $r->addRoute('GET', '/downloads', [($community), 'downloads']);
        $r->addRoute('GET', '/discord', [($community), 'discord']);
        $r->addRoute('GET', '/news', [($community), 'news']);
        $r->addRoute('GET', '/patchnotes', [($community), 'patchnotes']);
        $r->addRoute('GET', '/pvprankings', [($community), 'pvprankings']);
        $r->addRoute('GET', '/guildrankings', [($community), 'guildrankings']);
        $r->addRoute('GET', '/staffteam', [($community), 'staffteam']);

        // Patch Notes
        $r->addRoute('POST', '/rankings', [($community), 'rankings']);
        $r->addRoute('POST', '/getPatchNotes', [($community), 'getPatchNotes']);
    });
    // Server Info
    $r->addGroup('/serverinfo', function (FastRoute\RouteCollector $r) {
        $session = new Classes\Utils\Session;
        $userClass = new Classes\Utils\User($session);

        $serverInfo = new App\Controllers\ServerInfo($userClass);

        $r->addRoute('GET', '/about', [($serverInfo), 'about']);
        $r->addRoute('GET', '/drops', [($serverInfo), 'drops']);
        $r->addRoute('GET', '/dropfinder', [($serverInfo), 'dropfinder']);
        $r->addRoute('GET', '/bossrecords', [($serverInfo), 'bossrecords']);
        $r->addRoute('GET', '/terms', [($serverInfo), 'terms']);

        $r->addRoute('POST', '/dropfinder', [($serverInfo), 'dropfinder']);
    });
    // Auth
    $r->addGroup('/auth', function (FastRoute\RouteCollector $r) {
        $session = new Classes\Utils\Session;
        $userClass = new Classes\Utils\User($session);
        $auth = new App\Controllers\Auth($userClass, $session);

        $r->addRoute('POST', '/login', [($auth), 'login']);
        $r->addRoute('POST', '/logout', [($auth), 'logout']);

        $r->addRoute('GET', '/newDevice/verify/{name}', [($auth), 'verifyNewDevice']);
    });
    // User
    $r->addGroup('/user', function (FastRoute\RouteCollector $r) {
        $session = new Classes\Utils\Session;
        $userClass = new Classes\Utils\User($session);

        $user = new App\Controllers\User($userClass);

        $r->addRoute('GET', '/profile', [($user), 'profile']);
        $r->addRoute('GET', '/settings', [($user), 'settings']);
        $r->addRoute('GET', '/users', [($user), 'users']);
    });
    // Admin
    $r->addGroup('/admin', function (FastRoute\RouteCollector $r) {
        $session = new Classes\Utils\Session;
        $userClass = new Classes\Utils\User($session);

        $admin = new App\Controllers\Admin\Admin($userClass);
        $account = new App\Controllers\Admin\Account($userClass);
        $misc = new App\Controllers\Admin\Misc($userClass);
        $sExtended = new App\Controllers\Admin\SExtended($userClass);
        $auth = new App\Controllers\Admin\Auth($userClass);

        $r->addRoute('GET', '', [($admin), 'index']);

        // Auth
        $r->addRoute('GET', '/auth/login', [($auth), 'login']);

        // Admin
        $r->addRoute('GET', '/accessLogs', [($admin), 'accessLogs']);
        $r->addRoute('GET', '/commandLogs', [($admin), 'commandLogs']);

        // Account

        // GET
        $r->addRoute('GET', '/account/ban', [($account), 'ban']);
        $r->addRoute('GET', '/account/bannedUsers', [($account), 'bannedUsers']);
        $r->addRoute('GET', '/account/dpHandout', [($account), 'dpHandout']);
        $r->addRoute('GET', '/account/edit', [($account), 'edit']);
        $r->addRoute('GET', '/account/ipSearch', [($account), 'ipSearch']);
        $r->addRoute('GET', '/account/search', [($account), 'search']);
        $r->addRoute('GET', '/account/unban', [($account), 'unban']);

        // POST
        $r->addRoute('POST', '/account/ban', [($account), 'ban']);
        $r->addRoute('POST', '/account/dpHandout', [($account), 'dpHandout']);
        $r->addRoute('POST', '/account/edit', [($account), 'edit']);
        $r->addRoute('POST', '/account/ipSearch', [($account), 'ipSearch']);
        $r->addRoute('POST', '/account/search', [($account), 'search']);
        $r->addRoute('POST', '/account/unban', [($account), 'unban']);

        // Player
        $r->addRoute('GET', '/player/chatSearch', [($admin), 'index']);
        $r->addRoute('GET', '/player/edit', [($admin), 'index']);
        $r->addRoute('GET', '/player/editWhItems', [($admin), 'index']);
        $r->addRoute('GET', '/player/deleteWhItems', [($admin), 'index']);
        $r->addRoute('GET', '/player/itemDelete', [($admin), 'index']);
        $r->addRoute('GET', '/player/itemEdit', [($admin), 'index']);
        $r->addRoute('GET', '/player/jail', [($admin), 'index']);
        $r->addRoute('GET', '/player/linkedGear', [($admin), 'index']);
        $r->addRoute('GET', '/player/restore', [($admin), 'index']);
        $r->addRoute('GET', '/player/unJail', [($admin), 'index']);

        // Misc
        $r->addRoute('GET', '/misc/disbandGuild', [($misc), 'disbandGuild']);
        $r->addRoute('GET', '/misc/guildLeaderChange', [($misc), 'guildLeaderChange']);
        $r->addRoute('GET', '/misc/guildNameChange', [($misc), 'guildNameChange']);
        $r->addRoute('GET', '/misc/guildSearch', [($misc), 'guildSearch']);
        $r->addRoute('GET', '/misc/itemList', [($misc), 'itemList']);
        $r->addRoute('GET', '/misc/itemSearch', [($misc), 'itemSearch']);
        $r->addRoute('GET', '/misc/mobList', [($misc), 'mobList']);
        $r->addRoute('GET', '/misc/playersOnline', [($misc), 'playersOnline']);
        $r->addRoute('GET', '/misc/statPadders', [($misc), 'statPadders']);
        $r->addRoute('GET', '/misc/worldChat', [($misc), 'worldChat']);

        // POST
        $r->addRoute('POST', '/misc/itemSearch', [($misc), 'itemSearch']);

        // SExtended
        $r->addRoute('GET', '/sExtended/sendNotice', [($sExtended), 'sendNotice']);
        $r->addRoute('GET', '/sExtended/sendPlayerNotice', [($sExtended), 'sendPlayerNotice']);

        // POST
        $r->addRoute('POST', '/sExtended/sendNotice', [($sExtended), 'sendNotice']);
        $r->addRoute('POST', '/sExtended/sendPlayerNotice', [($sExtended), 'sendPlayerNotice']);

        // Game Sage
        $r->addRoute('GET', '/gs/playersOnline', [($admin), 'index']);
        $r->addRoute('GET', '/gs/worldChat', [($admin), 'index']);

        /* $r->addRoute('GET', '/core/settings', [($admin), 'index']);
        $r->addRoute('GET', '/core/user/{id:\d+}', [($admin), 'index']); */
    });
    // Errors
    $r->addGroup('/errors', function (FastRoute\RouteCollector $r) {
        $session = new Classes\Utils\Session;
        $userClass = new Classes\Utils\User($session);
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
