@extends('layouts.app')
@section('content')
    @include('home.inc.page_bg')
    @include('home.inc.page_border')
    <header class="nk-header nk-header-opaque">
        @include('inc.cms.topNav')
        @include('inc.cms.nav')
    </header>
    @include('inc.cms.rightNav')
    @include('inc.cms.mobileNav')
    <div class="nk-main">
        <div class="nk-gap-6"></div>
        <div class="container">
                <div class="nk-social-profile nk-social-profile-container-offset">
                    <div class="row">
                        <div class="col-md-5 col-lg-3">
                            <div class="nk-social-profile-avatar">
                                <a href="#">
                                    <img src="/resources/themes/godlike/images/avatar-1.jpg" alt="nK">
                                </a>
                            </div>
                        </div>
                        <div class="col-md-7 col-lg-9">
                            <div class="nk-social-profile-info">
                                <div class="nk-gap-2"></div>
                                <div class="nk-social-profile-info-last-seen">last seen 2 hours ago</div>
                                <h1 class="nk-social-profile-info-name">nK</h1>
                                <div class="nk-social-profile-info-username">@nkdevv</div>
                                <div class="nk-social-profile-info-actions">
                                    <a href="#" class="nk-btn link-effect-4">Add Friend</a>
                                    <a href="#" class="nk-btn link-effect-4">Leave Message</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row vertical-gap">
                    <div class="col-lg-3">
                        <!--
                            START: Sidebar

                            Additional Classes:
                                .nk-sidebar-left
                                .nk-sidebar-right
                                .nk-sidebar-sticky
                        -->
                        <aside class="nk-sidebar nk-sidebar-left nk-sidebar-sticky">
                            <div class="nk-gap-2"></div>
                            <div class="nk-social-menu d-none d-lg-block">
                                <ul>
                                    <li class="">
                                        <a href="social-user-activity.html">
                                            Activity</a>
                                    </li><li class="">
                                        <a href="social-user-notifications.html">
                                            Notifications</a>
                                    </li><li class="">
                                        <a href="social-user-messages.html">
                                            Messages<span class="nk-badge">192</span></a>
                                    </li><li class="">
                                        <a href="social-user-friends.html">
                                            Friends<span class="nk-badge">19</span></a>
                                    </li><li class="">
                                        <a href="social-user-groups.html">
                                            Groups<span class="nk-badge">2</span></a>
                                    </li><li class="">
                                        <a href="forum.html">
                                            Forum</a>
                                    </li><li class="active">
                                        <a href="social-user-settings.html">
                                            Settings</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="nk-accordion d-lg-none" id="nk-social-menu-mobile" role="tablist" aria-multiselectable="true">
                                <div class="panel panel-default">
                                    <div class="panel-heading" role="tab" id="nk-social-menu-mobile-1-heading">
                                        <a data-toggle="collapse" data-parent="#nk-social-menu-mobile" href="#nk-social-menu-mobile-1" aria-expanded="true" aria-controls="nk-social-menu-mobile-1" class="collapsed">
                                         Menu
                                        </a>
                                    </div>
                                    <div id="nk-social-menu-mobile-1" class="panel-collapse collapse" role="tabpanel" aria-labelledby="nk-social-menu-mobile-1-heading">
                                        <div class="nk-social-menu">
                                            <ul>
                                                <li class="">
                                                    <a href="social-user-activity.html">
                                                        Activity</a>
                                                </li><li class="">
                                                    <a href="social-user-notifications.html">
                                                        Notifications</a>
                                                </li><li class="">
                                                    <a href="social-user-messages.html">
                                                        Messages<span class="nk-badge">192</span></a>
                                                </li><li class="">
                                                    <a href="social-user-friends.html">
                                                        Friends<span class="nk-badge">19</span></a>
                                                </li><li class="">
                                                    <a href="social-user-groups.html">
                                                        Groups<span class="nk-badge">2</span></a>
                                                </li><li class="">
                                                    <a href="forum.html">
                                                        Forum</a>
                                                </li><li class="active">
                                                    <a href="social-user-settings.html">
                                                        Settings</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="nk-gap-4 d-none d-lg-block"></div>
                        </aside>
                        <!-- END: Sidebar -->
                    </div>
                    <div class="col-lg-9">
                        <div class="nk-gap-2 d-none d-lg-block"></div>
                        <div class="nk-social-menu-inline">
                            <ul>
                                <li class="active">
                                    <a href="social-user-settings.html">General</a>
                                </li>
                                <li>
                                    <a href="social-user-settings-email.html">Email</a>
                                </li>
                                <li>
                                    <a href="#">Profile Visibility</a>
                                </li>
                                <li>
                                    <a href="#">Signature</a>
                                </li>
                            </ul>
                        </div>
                        <div class="nk-social-container">

                            <!-- START: Settings -->
                            <form action="#">
                                <input type="email" class="form-control" name="email" placeholder="Account Email" value="mymail@gmail.com">
                                <div class="nk-gap-2"></div>
                                <input type="password" class="form-control" name="password" placeholder="Change Password">
                                <div class="nk-gap-2"></div>
                                <input type="password" class="form-control" name="password2" placeholder="New Password">
                                <div class="mt-10">
                                    <em>Repeat New Password</em>
                                </div>
                                <div class="nk-gap-2"></div>
                                <div style="border-bottom: 1px solid white;"></div>
                                <div class="nk-gap-2"></div>
                                <h4 class="text-center">Social Information</h4>
                                <h6 class="text-center">This information will be displayed publicly.</h6>
                                <em>Your current user title is: <strong>You don't have a user title set.</strong></em>
                                <input type="password" class="form-control" name="password2" placeholder="Custom User Title">
                                <div class="nk-gap-2"></div>
                                <em>Enter your complete Discord handle here. Ex: Fox#0123.</em>
                                <input type="text" class="form-control" name="discord" placeholder="Discord">
                                <div class="nk-gap-2"></div>
                                 <em>Enter your Skype name.</em>
                                <input type="text" class="form-control" name="skype" placeholder="Skype">
                                <div class="nk-gap-2"></div>
                                 <em>Enter your Steam ID.</em>
                                <input type="text" class="form-control" name="steam" placeholder="Steam">
                                <div class="nk-gap-2"></div>
                                <button class="nk-btn link-effect-4 float-right">Save Changes</button>
                            </form>
                            <!-- END: Settings -->
                        </div>
                        <div class="nk-gap-4"></div>
                    </div>
                </div>
                <div class="nk-gap-4"></div>
                <div class="nk-gap-3"></div>
            </div>
        </div>
@endsection