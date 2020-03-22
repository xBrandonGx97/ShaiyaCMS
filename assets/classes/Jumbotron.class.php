<?php
    class Jumbotron{

        function __construct($Setting){
            $this->Setting	=	$Setting;
        }

        function get_jumbo(){
            echo '<div class="jumbotron">';
                echo '<h1 class="display-4">Welcome to '.$this->Setting->SITE_TITLE.'</h1>';
                    echo '<p class="lead">Some Information here</p>';
                echo '<hr class="my-4">';
 #                   echo '<p>Download</p>';
                    echo '<p class="lead">';
                        echo '<a class="btn btn-dark btn-lg" href="?'.$this->Setting->PAGE_PREFIX.'=DOWNLOAD" role="button">Download</a>';
                    echo '</p>';
            echo '</div>';
        }
    }
?>