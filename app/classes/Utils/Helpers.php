<?php

namespace Classes\Utils;

class Helpers
{
    public function __construct(Modal $modal)
    {
        $this->modal = $modal;

        //echo 'helpers construct loaded';
        //echo 'var:' . $modal->var;
    }
}
