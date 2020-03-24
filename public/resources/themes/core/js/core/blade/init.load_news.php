<?php
// Autoloader
require_once $_SERVER['DOCUMENT_ROOT'] . '/../app/bootstrap.php';

$coreController = new \Framework\Core\CoreController;
$coreController->fetchView('news/loadNews');
