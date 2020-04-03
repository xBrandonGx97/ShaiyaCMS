<?php
function __($string, $params = [])
{
    if (file_exists(RESOURCES_PATH . '/langs/' .LANG. '/messages.php')) {
        $message = MESSAGES[$string] ?? 'Unknown';
        if (count($params) > 0) {
            foreach ($params as $key => $value) {
                $message = str_replace($key, $value, $message);
            }
            return $message;
        } else {
            return $message;
        }
    } else {
        throw new \Exception;
    }
}
