<?php
function redirect($location)
{
    header('location: ' . $GLOBALS['config']['URLROOT'] . $location);
}
