<div class="nk-contacts-top">
    <div class="container">
        <div class="nk-contacts-left">
            <div class="nk-navbar">
                <ul class="nk-nav">
                	<li class="nk-drop-item">
                        <a href="/?lang=en" class="link-effect-4 ready"><span class="link-effect-inner"><span class="link-effect-l"><span>{{getLang(LANG)}}</span></span><span class="link-effect-r"><span>{{getLang(LANG)}}</span></span><span class="link-effect-shade"><span>{{getLang(LANG)}}</span></span></span></a>
                        <ul class="dropdown" style="display: none; margin-top: 17px; opacity: 0; transform: translate3d(0px, 0px, 0px);">
                            <li><a href="/?lang=en" class="link-effect-4 ready"><span class="link-effect-inner"><span class="link-effect-l"><span>English</span></span><span class="link-effect-r"><span>English</span></span><span class="link-effect-shade"><span>English</span></span></span></a></li>
                            <li><a href="/?lang=fr" class="link-effect-4 ready"><span class="link-effect-inner"><span class="link-effect-l"><span>French</span></span><span class="link-effect-r"><span>French</span></span><span class="link-effect-shade"><span>French</span></span></span></a></li>
                            <li><a href="/?lang=tr" class="link-effect-4 ready"><span class="link-effect-inner"><span class="link-effect-l"><span>Turkish</span></span><span class="link-effect-r"><span>Turkish</span></span><span class="link-effect-shade"><span>Turkish</span></span></span></a></li>
                            <li><a href="/?lang=es" class="link-effect-4 ready"><span class="link-effect-inner"><span class="link-effect-l"><span>Spanish</span></span><span class="link-effect-r"><span>Spanish</span></span><span class="link-effect-shade"><span>Spanish</span></span></span></a></li>
                            <li><a href="/?lang=pt" class="link-effect-4 ready"><span class="link-effect-inner"><span class="link-effect-l"><span>Portugese</span></span><span class="link-effect-r"><span>Portugese</span></span><span class="link-effect-shade"><span>Portugese</span></span></span></a></li>
                            <li><a href="/?lang=it" class="link-effect-4 ready"><span class="link-effect-inner"><span class="link-effect-l"><span>Italian</span></span><span class="link-effect-r"><span>Italian</span></span><span class="link-effect-shade"><span>Italian</span></span></span></a></li>
                            <li><a href="/?lang=nl" class="link-effect-4 ready"><span class="link-effect-inner"><span class="link-effect-l"><span>Dutch</span></span><span class="link-effect-r"><span>Dutch</span></span><span class="link-effect-shade"><span>Dutch</span></span></span></a></li>
                            <li><a href="/?lang=de" class="link-effect-4 ready"><span class="link-effect-inner"><span class="link-effect-l"><span>German</span></span><span class="link-effect-r"><span>German</span></span><span class="link-effect-shade"><span>German</span></span></span></a></li>
                            <li><a href="/?lang=fil" class="link-effect-4 ready"><span class="link-effect-inner"><span class="link-effect-l"><span>Filipino</span></span><span class="link-effect-r"><span>Filipino</span></span><span class="link-effect-shade"><span>Filipino</span></span></span></a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
        <div class="Servertime">
            <div class="nk-navbar">
                <div class="row">
                    <ul class="nk-nav">
                        @php
                            require('resources/themes/core/js/ServerTime.php');
                        @endphp
                        <li id="server_time_m"></li>
                        <li id="server_time_d"></li>
                        <li id="server_time_y"></li>
                        <li id="server_date"></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="nk-contacts-right">
            <div class="nk-navbar">
                <ul class="nk-nav">
                </ul>
            </div>
        </div>
    </div>
</div>