<?php
function acpNav($PageCat, $PageTitle = null, $PageLink = null, $PageTitle1 = null, $PageLink1 = null, $PageTitle2 = null, $PageLink2 = null, $PageTitle3 = null, $PageLink3 = null, $PageTitle4 = null, $PageLink4 = null, $PageTitle5 = null, $PageLink5 = null, $PageTitle6 = null, $PageLink6 = null, $PageTitle7 = null, $PageLink7 = null, $PageTitle8 = null, $PageLink8 = null, $PageTitle9 = null, $PageLink9 = null, $PageTitle10 = null, $PageLink10 = null, $PageTitle11 = null, $PageLink11 = null, $PageTitle12 = null, $PageLink12 = null, $PageTitle13 = null, $PageLink13 = null, $PageTitle14 = null, $PageLink14 = null, $PageTitle15 = null, $PageLink15 = null, $PageShow, $ReqLogin, $LinkIcon = null)
{
    $PageSub = $PageCat.' Tools';
    echo '<li data-username="basic components Button Alert Badges breadcrumb Paggination progress Tooltip popovers Carousel Cards Collapse Tabs pills Modal Grid System Typography Extra Shadows Embeds" class="nav-item pcoded-hasmenu">';
      echo '<a href="javascript:" class="nav-link "><span class="pcoded-micon"><i class="feather icon-sidebar"></i></span><span class="pcoded-mtext">'.$PageSub.'</span></a>';
        echo '<ul class="pcoded-submenu">';
    if ($PageTitle==true) {
        echo '<li class=""><a href="/'.$PageLink.'" class="">'.$PageTitle.'</a></li>';
    }
    if ($PageTitle1==true) {
        echo '<li class=""><a href="/'.$PageLink1.'" class="">'.$PageTitle1.'</a></li>';
    }
    if ($PageTitle2==true) {
        echo '<li class=""><a href="/'.$PageLink2.'" class="">'.$PageTitle2.'</a></li>';
    }
    if ($PageTitle3==true) {
        echo '<li class=""><a href="/'.$PageLink3.'" class="">'.$PageTitle3.'</a></li>';
    }
    if ($PageTitle4==true) {
        echo '<li class=""><a href="/'.$PageLink4.'" class="">'.$PageTitle4.'</a></li>';
    }
    if ($PageTitle5==true) {
        echo '<li class=""><a href="/'.$PageLink5.'" class="">'.$PageTitle5.'</a></li>';
    }
    if ($PageTitle6==true) {
        echo '<li class=""><a href="/'.$PageLink6.'" class="">'.$PageTitle6.'</a></li>';
    }
    if ($PageTitle7==true) {
        echo '<li class=""><a href="/'.$PageLink7.'" class="">'.$PageTitle7.'</a></li>';
    }
    if ($PageTitle8==true) {
        echo '<li class=""><a href="/'.$PageLink8.'" class="">'.$PageTitle8.'</a></li>';
    }
    if ($PageTitle9==true) {
        echo '<li class=""><a href="/'.$PageLink9.'" class="">'.$PageTitle9.'</a></li>';
    }
    if ($PageTitle10==true) {
        echo '<li class=""><a href="/'.$PageLink10.'" class="">'.$PageTitle10.'</a></li>';
    }
    if ($PageTitle11==true) {
        echo '<li class=""><a href="/'.$PageLink11.'" class="">'.$PageTitle11.'</a></li>';
    }
    if ($PageTitle12==true) {
        echo '<li class=""><a href="/'.$PageLink12.'" class="">'.$PageTitle12.'</a></li>';
    }
    if ($PageTitle13==true) {
        echo '<li class=""><a href="/'.$PageLink13.'" class="">'.$PageTitle13.'</a></li>';
    }
    if ($PageTitle14==true) {
        echo '<li class=""><a href="/'.$PageLink14.'" class="">'.$PageTitle14.'</a></li>';
    }
    if ($PageTitle15==true) {
        echo '<li class=""><a href="/'.$PageLink15.'" class="">'.$PageTitle15.'</a></li>';
    }
    echo '</ul>';
    echo '</li>';
}
