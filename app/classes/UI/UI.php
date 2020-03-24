<?php

namespace Classes\UI;

class UI
{
    // PUBLIC
    public function badgeAjax($BadgeColor, $BadgeText)
    {
        echo '<div class="badge ' . $BadgeColor . ' text-center fs_18 w_100_p">' . $BadgeText . '</div>';
    }

    // MISC
    public function props()
    {
        echo '<b>Browser Class => Display Properties:</b>';
        echo '<pre>';
            print_r(get_object_vars(__CLASS__));
        echo '</pre>';
    }
}
