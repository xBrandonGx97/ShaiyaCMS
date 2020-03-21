<?php

use Jenssegers\Blade\Blade;
use \Classes\Utils\Auth;

class BladeController
{
    public $blade;

    public function __construct()
    {
        $this->blade = new Blade('../resources/views', 'cache');
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

        $this->blade->directive('endguest2', function ($expression) {
            return '<?php endif; ?>';
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
}
