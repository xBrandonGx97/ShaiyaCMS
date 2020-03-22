<?php
    class Carousel{
        function _get_carousel(){
            echo '<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">';
            echo '<ol class="carousel-indicators">';
                echo '<li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>';
                echo '<li data-target="#carouselExampleIndicators" data-slide-to="1"></li>';
                echo '<li data-target="#carouselExampleIndicators" data-slide-to="2"></li>';
            echo '</ol>';
			    echo '<div class="carousel-inner">';
                    echo '<div class="carousel-item active">';
                        echo '<img class="d-block w-100" src="assets/Themes/Standard/images/carousel/bg5.jpg" alt="First slide">';
                    echo '</div>';
                    echo '<div class="carousel-item">';
                        echo '<img class="d-block w-100" src="assets/Themes/Standard/images/carousel/background.jpg" alt="Second slide">';
                    echo '</div>';
                    echo '<div class="carousel-item">';
                        echo '<img class="d-block w-100" src="assets/Themes/Standard/images/carousel/SY-News_MonthlyJanuary_1.jpg" alt="Third slide">';
                    echo '</div>';
			    echo '</div>';
			        echo '<a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">';
                        echo '<span class="carousel-control-prev-icon" aria-hidden="true"></span>';
                        echo '<span class="sr-only">Previous</span>';
			        echo '</a>';
			    echo '<a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">';
                    echo '<span class="carousel-control-next-icon" aria-hidden="true"></span>';
                    echo '<span class="sr-only">Next</span>';
			    echo '</a>';
            echo '</div>';
        }
    }
?>