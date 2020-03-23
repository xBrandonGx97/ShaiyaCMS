<?php
        require_once '../app/bootstrap.php';
        $bootstrap = new  App\Bootstrap();
        $bootstrap->run();
        $bootstrap->dispatch();
