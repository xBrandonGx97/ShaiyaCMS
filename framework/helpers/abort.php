<?php
function abort($errorCode)
{
    switch ($errorCode) {
        case '301':
            redirect('/errors/301');
            break;
        case '307':
            redirect('/errors/307');
            break;
        case '400':
            redirect('/errors/400');
            break;
        case '401':
            redirect('/errors/401');
            break;
        case '403':
            redirect('/errors/403');
            break;
        case '404':
            redirect('/errors/404');
            break;
        case '405':
            redirect('/errors/405');
            break;
        case '408':
            redirect('/errors/408');
            break;
        case '500':
            redirect('/errors/500');
            break;
        case '502':
            redirect('/errors/502');
            break;
    }
}
