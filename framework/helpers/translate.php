<?php
function __($translation)
{
    if (file_exists(RESOURCES_PATH . '/langs/' .LANG. '/messages.php')) {
        return MESSAGES[$translation] ?? 'Unknown';
    } else {
        throw new \Exception;
    }
}
