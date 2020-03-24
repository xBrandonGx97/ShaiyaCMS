<?php

namespace Framework\Core;

    class Loader
    {
        // Load library classes
        public function library($lib)
        {
            //	echo 'Loading lib ('.$lib.')..<br>';
            include LIB_PATH . $lib . 'class.php';
        }

        // loader helper functions. Naming conversion is xxx.php;
        public function helper($helper)
        {
            //	echo 'Loading helper ('.$helper.')..<br>';
            include HELPER_PATH . $helper . '.php';
        }
    }
