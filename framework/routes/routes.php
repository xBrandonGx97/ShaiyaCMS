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
        // GET
        $r->addRoute('GET', '/downloads', [($community), 'downloads']);
        $r->addRoute('GET', '/discord', [($community), 'discord']);
        $r->addRoute('GET', '/news', [($community), 'news']);
        $r->addRoute('GET', '/patchnotes', [($community), 'patchnotes']);
        $r->addRoute('GET', '/pvprankings', [($community), 'pvprankings']);
        $r->addRoute('GET', '/guildrankings', [($community), 'guildrankings']);
        $r->addRoute('GET', '/staffteam', [($community), 'staffteam']);
        // POST
        $r->addRoute('POST', '/rankings', [($community), 'rankings']);
        $r->addRoute('POST', '/getPatchNotes', [($community), 'getPatchNotes']);
    });
    // Server Info
    $r->addGroup('/serverinfo', function (FastRoute\RouteCollector $r) {
        $session = new Classes\Utils\Session;
        $userClass = new Classes\Utils\User($session);

        $serverInfo = new App\Controllers\ServerInfo($userClass);
        // GET
        $r->addRoute('GET', '/about', [($serverInfo), 'about']);
        $r->addRoute('GET', '/drops', [($serverInfo), 'drops']);
        $r->addRoute('GET', '/dropfinder', [($serverInfo), 'dropfinder']);
        $r->addRoute('GET', '/bossrecords', [($serverInfo), 'bossrecords']);
        $r->addRoute('GET', '/terms', [($serverInfo), 'terms']);
        // POST
        $r->addRoute('POST', '/dropfinder', [($serverInfo), 'dropfinder']);
    });
    // Auth
    $r->addGroup('/auth', function (FastRoute\RouteCollector $r) {
        $session = new Classes\Utils\Session;
        $userClass = new Classes\Utils\User($session);
        $auth = new App\Controllers\Auth($userClass, $session);

        $r->addRoute('POST', '/login', [($auth), 'login']);
        $r->addRoute('POST', '/logout', [($auth), 'logout']);
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
        $sExtended = new App\Controllers\Admin\SExtended($userClass);
        $auth = new App\Controllers\Admin\Auth($userClass, $session);

        $r->addRoute('GET', '', [($admin), 'index']);

        // Auth
        $r->addRoute('GET', '/auth/login', [($auth), 'login']);
        $r->addRoute('GET', '/auth/signup', [($auth), 'signup']);
        $r->addRoute('GET', '/auth/logout', [($auth), 'logout']);

        // POST
        $r->addRoute('POST', '/auth/login', [($auth), 'login']);

        // Admin
        $r->addRoute('GET', '/accessLogs', [($admin), 'accessLogs']);
        $r->addRoute('GET', '/commandLogs', [($admin), 'commandLogs']);

        // Account
        $r->addGroup('/account', function (FastRoute\RouteCollector $r) {
            $session = new Classes\Utils\Session;
            $userClass = new Classes\Utils\User($session);
            $account = new App\Controllers\Admin\Account($userClass);

            // GET
            $r->addRoute('GET', '/ban', [($account), 'ban']);
            $r->addRoute('GET', '/bannedUsers', [($account), 'bannedUsers']);
            $r->addRoute('GET', '/dpHandout', [($account), 'dpHandout']);
            $r->addRoute('GET', '/edit', [($account), 'edit']);
            $r->addRoute('GET', '/ipSearch', [($account), 'ipSearch']);
            $r->addRoute('GET', '/search', [($account), 'search']);
            $r->addRoute('GET', '/unban', [($account), 'unban']);
            // POST
            $r->addRoute('POST', '/ban', [($account), 'ban']);
            $r->addRoute('POST', '/dpHandout', [($account), 'dpHandout']);
            $r->addRoute('POST', '/edit', [($account), 'edit']);
            $r->addRoute('POST', '/ipSearch', [($account), 'ipSearch']);
            $r->addRoute('POST', '/search', [($account), 'search']);
            $r->addRoute('POST', '/unban', [($account), 'unban']);
        });

        // Player
        $r->addGroup('/player', function (FastRoute\RouteCollector $r) {
            $session = new Classes\Utils\Session;
            $userClass = new Classes\Utils\User($session);
            $player = new App\Controllers\Admin\Player($userClass);

            // GET
            $r->addRoute('GET', '/chatSearch', [($player), 'chatSearch']);
            $r->addRoute('GET', '/edit', [($player), 'edit']);
            $r->addRoute('GET', '/editWhItems', [($player), 'editWhItems']);
            $r->addRoute('GET', '/deleteWhItems', [($player), 'deleteWhItems']);
            $r->addRoute('GET', '/itemDelete', [($player), 'itemDelete']);
            $r->addRoute('GET', '/itemEdit', [($player), 'itemEdit']);
            $r->addRoute('GET', '/jail', [($player), 'jail']);
            $r->addRoute('GET', '/linkedGear', [($player), 'linkedGear']);
            $r->addRoute('GET', '/restore', [($player), 'restore']);
            $r->addRoute('GET', '/sendGiftPlayer', [($player), 'sendGiftPlayer']);
            $r->addRoute('GET', '/sendGiftPlayers', [($player), 'sendGiftPlayers']);
            $r->addRoute('GET', '/sendGiftAll', [($player), 'sendGiftAll']);
            $r->addRoute('GET', '/unJail', [($player), 'unJail']);
            // POST
            $r->addRoute('POST', '/chatSearch', [($player), 'chatSearch']);
            $r->addRoute('POST', '/edit', [($player), 'edit']);
            $r->addRoute('POST', '/editWhItems', [($player), 'editWhItems']);
            $r->addRoute('POST', '/deleteWhItems', [($player), 'deleteWhItems']);
            $r->addRoute('POST', '/itemDelete', [($player), 'itemDelete']);
            $r->addRoute('POST', '/itemEdit', [($player), 'itemEdit']);
            $r->addRoute('POST', '/jail', [($player), 'jail']);
            $r->addRoute('POST', '/linkedGear', [($player), 'linkedGear']);
            $r->addRoute('POST', '/restore', [($player), 'restore']);
            $r->addRoute('POST', '/sendGiftPlayer', [($player), 'sgpPost']);
            $r->addRoute('POST', '/verifySendGiftPlayer', [($player), 'sgpVerifyPost']);
            $r->addRoute('POST', '/submitSendGiftPlayer', [($player), 'sgpSubmitPost']);
            $r->addRoute('POST', '/sendGiftAll', [($player), 'sgaPost']);
            $r->addRoute('POST', '/verifySendGiftAll', [($player), 'sgaVerifyPost']);
            $r->addRoute('POST', '/submitSendGiftAll', [($player), 'sgaSubmitPost']);
            $r->addRoute('POST', '/unJail', [($player), 'unJail']);
        });

        // Misc
        $r->addGroup('/misc', function (FastRoute\RouteCollector $r) {
            $session = new Classes\Utils\Session;
            $userClass = new Classes\Utils\User($session);
            $misc = new App\Controllers\Admin\Misc($userClass);
            // GET
            $r->addRoute('GET', '/actionLog', [($misc), 'actionLog']);
            $r->addRoute('GET', '/disbandGuild', [($misc), 'disbandGuild']);
            $r->addRoute('GET', '/guildLeaderChange', [($misc), 'guildLeaderChange']);
            $r->addRoute('GET', '/guildNameChange', [($misc), 'guildNameChange']);
            $r->addRoute('GET', '/guildSearch', [($misc), 'guildSearch']);
            $r->addRoute('GET', '/itemList', [($misc), 'itemList']);
            $r->addRoute('GET', '/itemSearchCat', [($misc), 'itemSearchCat']);
            $r->addRoute('GET', '/itemSearchName', [($misc), 'itemSearchName']);
            $r->addRoute('GET', '/manageGuilds', [($misc), 'manageGuilds']);
            $r->addRoute('GET', '/mobList', [($misc), 'mobList']);
            $r->addRoute('GET', '/playersOnline', [($misc), 'playersOnline']);
            $r->addRoute('GET', '/statPadders', [($misc), 'statPadders']);
            $r->addRoute('GET', '/worldChat', [($misc), 'worldChat']);
            // POST
            $r->addRoute('POST', '/actionLog', [($misc), 'actionLog']);
            $r->addRoute('POST', '/disbandGuild', [($misc), 'disbandGuild']);
            $r->addRoute('POST', '/guildLeaderChange', [($misc), 'guildLeaderChange']);
            $r->addRoute('POST', '/guildNameChange', [($misc), 'guildNameChange']);
            $r->addRoute('POST', '/guildSearch', [($misc), 'guildSearch']);
            $r->addRoute('POST', '/itemSearchCat', [($misc), 'itemSearchCat']);
            $r->addRoute('POST', '/itemSearchName', [($misc), 'itemSearchName']);
            $r->addRoute('POST', '/manageGuilds', [($misc), 'manageGuilds']);
        });

        // SExtended
        // GET
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
