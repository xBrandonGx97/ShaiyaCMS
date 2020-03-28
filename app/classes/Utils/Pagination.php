<?php

namespace Classes\Utils;

class Pagination
{
    public function sp($query, $perPage, $prevPage, $nextPage, $page)
    {
        $total_records = count($query);

        // build array containing all pages
        $tmp = [];
        for ($p = 1, $i = 0; $i < $total_records; $p++, $i += $perPage) {
            if ($page == $p) {
                // assign current page to specific class
                $tmp[] = '<a class="nk-pagination-current-white pagination_link" id="' . $p . '">' . $p . '</a>';
            } else {
                $tmp[] = '<a class="pagination_link" id="' . $p . '">' . $p . '</a>';
            }
        }
        // thin out the pages
        for ($i = count($tmp) - 3; $i > 1; $i--) {
            if (abs($page - $i - 1) > 2) {
                unset($tmp[$i]);
            }
        }
        // display page navigation if data covers more than one page
        echo '<div class="nk-pagination nk-pagination-left">';
        if (count($tmp) > 1) {
            if ($page > 1) {
                // display 'Prev' page
                echo '<a class="nk-pagination-prev pagination_link pag-pn" id="' . $prevPage . '">
                    <span class="nk-icon-arrow-left" id="' . $prevPage . '"></span>
                </a>';
            } else {
                echo '<a class="nk-pagination-prev disabled">
                    <span class="nk-icon-arrow-left"></span>
                </a>';
            }
            $lastPage = 0;
            echo '<nav>';
            foreach ($tmp as $i => $link) {
                if ($i > $lastPage + 1) {
                    echo ' ... '; // where one or more page have been omitted
                }
                echo $link;
                $lastPage = $i;
            }
            echo '</nav>';

            if ($page <= $lastPage) {
                // display 'Next' page
                echo '<a class="nk-pagination-next pagination_link pag-pn" id="' . $nextPage . '">
                    <span class="nk-icon-arrow-right" id="' . $nextPage . '"></span>
                </a>';
            } else {
                echo '<a class="nk-pagination-next disabled">
                    <span class="nk-icon-arrow-right"></span>
                </a>';
            }
        }
        echo '</div>';
    }
}
