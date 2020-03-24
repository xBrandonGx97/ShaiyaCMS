<?php

namespace App;

use Compiler\Compiler;
use Dotenv\Dotenv;
use Framework\Core\Loader;
use Classes\Utils as Utils;

class Bootstrap
{
    protected $debug = false;

    public function __construct()
    {
        // Load Vendor autoloader for Vendor resources
        require_once dirname(__DIR__) . '/vendor/autoload.php';

        $this->init();
    }

    private function init()
    {
        // Define misc helpers
        define('DS', DIRECTORY_SEPARATOR);
        define('SEPARATOR', '\\');
        // Define path constants
        if (defined('AJAX_CALL')) {
            define('ROOT_PATH', $_SERVER['DOCUMENT_ROOT']);
        } else {
            define('ROOT_PATH', getcwd() . DS);
        }
        define('APP_PATH', ROOT_PATH . '/../app' . DS);
        define('CLASSES_PATH', APP_PATH . 'classes' . DS);
        define('FRAMEWORK_PATH', ROOT_PATH . '../framework' . DS);
        define('PUBLIC_PATH', 'Public' . DS);
        define('CONFIG_PATH', APP_PATH . '../config' . DS);
        define('CONTROLLER_PATH', APP_PATH . 'controllers' . DS);
        define('MODELS_PATH', APP_PATH . 'models' . DS);
        define('VIEWS_PATH', APP_PATH . 'views' . DS);
        define('BLADE_PATH', FRAMEWORK_PATH . 'Blade' . DS);
        define('CORE_PATH', FRAMEWORK_PATH . 'Core' . DS);
        define('DB_PATH', FRAMEWORK_PATH . 'database' . DS);
        define('LIB_PATH', FRAMEWORK_PATH . 'libraries' . DS);
        define('ROUTES_PATH', FRAMEWORK_PATH . 'routes' . DS);
        define('HELPER_PATH', FRAMEWORK_PATH . 'Helpers' . DS);
        define('UPLOAD_PATH', PUBLIC_PATH . 'uploads' . DS);
        if (!defined('AJAX_CALL')) {
            // Load core classes
            require_once CORE_PATH . 'loader.php';
            // Load Dotenv
            $this->initDotEnv();

            // Load configuration file
            define('config', require_once CONFIG_PATH . 'config.php');
            // Load HTMLPurifier
            require_once LIB_PATH . 'HTMLPurifier/HTMLPurifier.auto.php';
        }
        // Start session
        //	session_start();
    }

    public function dispatch()
    {
        $modal = new \Classes\Utils\Modal();
        $helpers = new \Classes\Utils\Helpers($modal);
        // Init Capsule
        \Classes\DB\MSSQL::initCapsule();
        // Init Session
        \Classes\Utils\Session::init('Default');
        // Load Helpers
        $this->load_helpers();
        // Init DotEnv
        //self::initDotEnv();
        // Init
        require_once 'init.php';
        // Load Langs
        $this->getLang();
        $this->load_langs();
        // Load Routes
        $this->dispatchFastRoute();
        $this->load_defaults();
    }

    public function _is_ajax()
    {
        if (defined('AJAX_CALL')) {
            //$this->run();

            // Load Config
            define('config', require_once CONFIG_PATH . 'config.php');

            // Load HTMLPurifier
            require_once LIB_PATH . 'HTMLPurifier/HTMLPurifier.auto.php';
            // Load Purifier Method
            \Classes\Utils\Data::_do('load_purifier');

            // Load Helpers
            foreach (scandir(config['FWROOT'] . '/Helpers/') as $filename) {
                $path = config['FWROOT'] . '/Helpers/' . $filename;
                if (is_file($path)) {
                    require_once $path;
                }
            }
        }
    }

    public function getLang()
    {
        // Defaut language English
        $getLang = (isset($_GET['lang'])) ? $_SESSION['lang'] = $_GET['lang'] : '';
        $lang = (isset($_SERVER['HTTP_ACCEPT_LANGUAGE'])) ? substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2) : '';

        if ($getLang) {
            if (!defined('LANG')) {
                define('LANG', $getLang);
            }
        } elseif (isset($_SESSION['lang'])) {
            if (!defined('LANG')) {
                define('LANG', $_SESSION['lang']);
            }
        } elseif ($lang) {
            if (!defined('LANG')) {
                define('LANG', $lang);
            }
        } else {
            $lang = 'en';
            if (!defined('LANG')) {
                define('LANG', $lang);
            }
        }
    }

    public function load_langs()
    {
        $compiler = new Compiler;
        $compiler->compile(dirname(__DIR__) . '/resources/locale/' . LANG . '/LC_MESSAGES/messages.po');
        require_once LIB_PATH . 'translate.php';
    }

    public function load_defaults()
    {
        $user = new Utils\User();
        $user->initPrivacy();
        $user->initSocials();
    }

    public function load_helpers()
    {
        $loader = new Loader;
        $loader->helper('modal');
        $loader->helper('template');
        $loader->helper('url');
        $loader->helper('abort');
        $loader->helper('redirect');
        $loader->helper('table');
        $loader->helper('lang');
    }

    public function initDotEnv()
    {
        $rootDir = dirname(dirname(__FILE__));
        //echo 'dirname: ' . $rootDir;
        $dotenv = \Dotenv\Dotenv::createImmutable($rootDir);
        $dotenv->load();
    }

    public function dispatchFastRoute()
    {
        require_once ROUTES_PATH . 'routes.php';
        // Fetch method and URI from somewhere
        $httpMethod = $_SERVER['REQUEST_METHOD'];
        $uri = $_SERVER['REQUEST_URI'];

        // Strip query string (?foo=bar) and decode URI
        if (false !== $pos = strpos($uri, '?')) {
            $uri = substr($uri, 0, $pos);
        }
        $uri = rawurldecode($uri);

        $routeInfo = $dispatcher->dispatch($httpMethod, $uri);

        switch ($routeInfo[0]) {
            case \FastRoute\Dispatcher::NOT_FOUND:
                return abort(404);
                break;
            case \FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
                $allowedMethods = $routeInfo[1];
                return abort(405);
                break;
            case \FastRoute\Dispatcher::FOUND:
                $handler = $routeInfo[1];
                $vars = $routeInfo[2];
                return $routeInfo[1]($httpMethod);
                break;
        }
    }
}
