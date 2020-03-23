<?php

use Jenssegers\Blade\Blade;
use \Classes\Utils\Auth;

class BladeController
{
    public $blade;

    public function __construct($type, $view = false)
    {
        if ($type === 'view') {
            $this->blade = new Blade('../resources/views', config['PUBROOT'] . 'cache');
        } elseif ($type === 'widget') {
            $this->blade = new Blade(config['WIDGETDIR'] . '/' . $view . '/php', 'cache');
        }
    }

    public function loadDirectives()
    {
        $this->blade->if('auth', function () {
            return Auth::check();
        });

        $this->blade->if('guest', function () {
            return Auth::guest();
        });

        $this->blade->directive('endauth', function ($expression) {
            return '<?php endif; ?>';
        });

        $this->blade->directive('endguest', function ($expression) {
            return '<?php endif; ?>';
        });

        $this->blade->directive('require', function ($path) {
            return "<?php require($path) ?>";
        });

        $this->blade->directive('Separator', function ($height) {
            return "<?php Separator($height) ?>";
        });

        $this->blade->directive('hellox', function ($expression) {
            return "<?php echo 'Hello x ' . {$expression}; ?>";
        });
    }

    public function loadView($view, $data)
    {
        // Check for view file
        if (file_exists('../resources/views/' . $view . '.blade.php')) {
            echo $this->blade->make($view, ['data' => $data])->render();
        //require_once '../app/views/' . $view . '.php';
        } else {
            // View does not exist
            die('View doesn\'t exist');
        }
    }

    public function loadWidget($view, $data = false)
    {
        // Check for view file
        if (file_exists('../app/widgets/' . $view . '/php/script.blade.php')) {
            echo $this->blade->make('script', ['data' => $data])->render();
        } else {
            echo 'no';
        }
    }
}
