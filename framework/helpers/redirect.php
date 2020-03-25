<?php
function redirect($location, $delay = null)
{
    if (substr($location, 0, 1) == '/') {
        if ($delay) {
            header('refresh:'.$delay.';url= ' . CONFIG['URLROOT'] . $location);
        } else {
            header('location: ' . $location);
        }
    } elseif (substr($location, 0, 4) == 'http') {
        if ($delay) {
            header('refresh:'.$delay.';url= ' . $location);
        } else {
            header('location: ' . $location);
        }
    }
}
