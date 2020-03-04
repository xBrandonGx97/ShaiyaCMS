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
                    @php
                        $url = checkUrl();
                        if(isset($url[2])) {
                            $handler    =   $url[2];
                            $privacy    =   $url[2]=='privacy';
                            $signature    =   $url[2]=='signature';
                        } else {
                            $privacy    =   NULL;
                            $signature  =   NULL;
                        }
                    @endphp
                    <div class="col-lg-9">
                        <div class="nk-gap-2 d-none d-lg-block"></div>
                        <div class="nk-social-menu-inline">
                                <ul>
                                    <li>
                                        <a href="#general">General</a>
                                    </li>
                                    <li>
                                        <a href="#email">Email</a>
                                    </li>
                                    <li>
                                        <a href="#notifications">Notifications</a>
                                    </li>
                                    <li>
                                        <a href="#signature">Signature</a>
                                    </li>
                                    <li>
                                        <a href="#privacy">Privacy</a>
                                    </li>
                                </ul>

                                <div class="tab-content" id="general">
                                    <div class="nk-gap-4"></div>
                                    <div class="nk-social-container">
                                        <!-- START: Settings -->
                                        <form action="#" method="post">
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
                                            <div class="social-tab">
                                                <p id="response"></p>
                                                <h4 class="text-center">Social Information</h4>
                                                <h6 class="text-center">This information will be displayed publicly.</h6>
                                                <em>Your current user title is: <strong>You don't have a user title set.</strong></em>
                                                <input type="text" class="form-control" name="password2" id="usertitle" value="{{$data['User']['userTitle']}}" placeholder="Custom User Title">
                                                <div class="nk-gap-2"></div>
                                                <em>Enter your complete Discord handle here. Ex: Fox#0123.</em>
                                                <input type="text" class="form-control" name="discord" id="discord" value="{{$data['User']['Discord']}}" placeholder="Discord">
                                                <div class="nk-gap-2"></div>
                                                <em>Enter your Skype name.</em>
                                                <input type="text" class="form-control" name="skype" id="skype" value="{{$data['User']['Skype']}}" placeholder="Skype">
                                                <div class="nk-gap-2"></div>
                                                <em>Enter your Steam ID.</em>
                                                <input type="text" class="form-control" name="steam" id="steam" value="{{$data['User']['Steam']}}" placeholder="Steam">
                                                <div class="nk-gap-2"></div>
                                                <button class="nk-btn link-effect-4 float-right" id="save_changes_settings">Save Changes</button>
                                            </div>
                                        </form>
                                        <!-- END: Settings -->
                                    </div>
                                </div>
                                <div class="tab-content" id="privacy">
                                    <div class="nk-gap-4"></div>
                                     <div class="nk-social-container">
                                        <form action="#" method="post">
                                            <div class="table-responsive nk-social-settings-table">
                                                <table class="table table-bordered">
                                                    <thead class="thead-default">
                                                        <tr>
                                                            <th class="nk-social-settings-table-title">General</th>
                                                            <th class="nk-social-settings-table-check">Public</th>
                                                            <th class="nk-social-settings-table-check">Private</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td class="nk-social-settings-table-title">Display profile publicly</td>
                                                            <td class="nk-social-settings-table-check">
                                                                <label class="form-check-label">
                                                                    <input type="radio" class="form-check-input" name="notification1" value="public" {{$data['User']['DisplayProfile'] === 'Public' ? 'checked' : ''}}>
                                                                </label>
                                                            </td>
                                                            <td class="nk-social-settings-table-check">
                                                                <label class="form-check-label">
                                                                    <input type="radio" class="form-check-input" name="notification1" value="private" {{$data['User']['DisplayProfile'] === 'Public' ? '' : 'checked'}}>
                                                                </label>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="nk-social-settings-table-title">Display Social handles publicly</td>
                                                            <td class="nk-social-settings-table-check">
                                                                <label class="form-check-label">
                                                                    <input type="radio" class="form-check-input" name="notification2" value="public" {{$data['User']['DisplaySocials'] === 'Public' ? 'checked' : ''}}>
                                                                </label>
                                                            </td>
                                                            <td class="nk-social-settings-table-check">
                                                                <label class="form-check-label">
                                                                    <input type="radio" class="form-check-input" name="notification2" value="private" {{$data['User']['DisplaySocials'] === 'Public' ? '' : 'checked'}}>
                                                                </label>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="nk-gap"></div>
                                            <div class="table-responsive nk-social-settings-table">
                                                <table class="table table-bordered">
                                                    <thead class="thead-default">
                                                        <tr>
                                                            <th class="nk-social-settings-table-title">Email</th>
                                                            <th class="nk-social-settings-table-check">Yes</th>
                                                            <th class="nk-social-settings-table-check">No</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td class="nk-social-settings-table-title">A user sends you a new message</td>
                                                            <td class="nk-social-settings-table-check">
                                                                <label class="form-check-label">
                                                                    <input type="radio" class="form-check-input" name="notification3" value="public" checked="checked">
                                                                </label>
                                                            </td>
                                                            <td class="nk-social-settings-table-check">
                                                                <label class="form-check-label">
                                                                    <input type="radio" class="form-check-input" name="notification3" value="private">
                                                                </label>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="nk-social-settings-table-title">A user replies to a comment you posted</td>
                                                            <td class="nk-social-settings-table-check">
                                                                <label class="form-check-label">
                                                                    <input type="radio" class="form-check-input" name="notification4" value="public" checked="checked">
                                                                </label>
                                                            </td>
                                                            <td class="nk-social-settings-table-check">
                                                                <label class="form-check-label">
                                                                    <input type="radio" class="form-check-input" name="notification4" value="private">
                                                                </label>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="nk-social-settings-table-title">A user sends you a friend request</td>
                                                            <td class="nk-social-settings-table-check">
                                                                <label class="form-check-label">
                                                                    <input type="radio" class="form-check-input" name="notification5" value="public" checked="checked">
                                                                </label>
                                                            </td>
                                                            <td class="nk-social-settings-table-check">
                                                                <label class="form-check-label">
                                                                    <input type="radio" class="form-check-input" name="notification5" value="private">
                                                                </label>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="nk-social-settings-table-title">A user accepts your friend request</td>
                                                            <td class="nk-social-settings-table-check">
                                                                <label class="form-check-label">
                                                                    <input type="radio" class="form-check-input" name="notification6" value="public" checked="checked">
                                                                </label>
                                                            </td>
                                                            <td class="nk-social-settings-table-check">
                                                                <label class="form-check-label">
                                                                    <input type="radio" class="form-check-input" name="notification6" value="private">
                                                                </label>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </form>
                                     </div>
                                </div>
                                {{--<ul class="nav" role="tablist">
                                    <li class="{{($privacy) ? '' : (($signature) ? '' : 'active')}}">
                                        <a class="nav-link{{$privacy ? '' : (($signature) ? '' : ' active show')}}" href="#tabs-2-1" role="tab" data-toggle="tab" aria-selected="true">General</a>
                                    </li>
                                    <li>
                                        <a class="nav-link" href="#tabs-2-2" role="tab" data-toggle="tab" aria-selected="false">Email</a>
                                    </li>
                                    <li class="{{$signature ? 'active' : ''}}">
                                        <a class="nav-link {{$signature ? 'active show' : ''}}" href="#tabs-2-3" role="tab" data-toggle="tab">Signature</a>
                                    </li>
                                    <li class="{{$privacy ? 'active' : ''}}">
                                        <a class="nav-link {{$privacy ? 'active show' : ''}}" href="#tabs-2-4" role="tab" data-toggle="tab">Privacy</a>
                                    </li>
                                </ul>--}}
                                {{--<div class="tab-content">
                                    <div role="tabpanel" class="tab-pane fade {{$privacy ? '' : (($signature) ? '' : 'active show')}}" id="tabs-2-1">
                                        <div class="nk-gap-1"></div>
                                        <div class="nk-social-container">
                                            <!-- START: Settings -->
                                            <form action="#" method="post">
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
                                                <div class="social-tab">
                                                    <p id="response"></p>
                                                    <h4 class="text-center">Social Information</h4>
                                                    <h6 class="text-center">This information will be displayed publicly.</h6>
                                                    <em>Your current user title is: <strong>You don't have a user title set.</strong></em>
                                                    <input type="text" class="form-control" name="password2" id="usertitle" value="{{$data['User']['userTitle']}}" placeholder="Custom User Title">
                                                    <div class="nk-gap-2"></div>
                                                    <em>Enter your complete Discord handle here. Ex: Fox#0123.</em>
                                                    <input type="text" class="form-control" name="discord" id="discord" value="{{$data['User']['Discord']}}" placeholder="Discord">
                                                    <div class="nk-gap-2"></div>
                                                     <em>Enter your Skype name.</em>
                                                    <input type="text" class="form-control" name="skype" id="skype" value="{{$data['User']['Skype']}}" placeholder="Skype">
                                                    <div class="nk-gap-2"></div>
                                                     <em>Enter your Steam ID.</em>
                                                    <input type="text" class="form-control" name="steam" id="steam" placeholder="Steam">
                                                    <div class="nk-gap-2"></div>
                                                    <button class="nk-btn link-effect-4 float-right" id="save_changes_settings">Save Changes</button>
                                                </div>
                                            </form>
                                            <!-- END: Settings -->
                                        </div>
                                    </div>
                                    <div role="tabpanel" class="tab-pane fade" id="tabs-2-2">
                                        <div class="nk-gap-1"></div>
                                        test1
                                    </div>
                                    <div role="tabpanel" class="tab-pane fade {{$signature ? 'active show' : ''}}" id="tabs-2-3">
                                        <div class="nk-gap-1"></div>
                                        signature
                                    </div>
                                    <div role="tabpanel" class="tab-pane fade {{$privacy ? 'active show' : ''}}" id="tabs-2-4">
                                        <div class="nk-gap-1"></div>
                                        <div class="nk-social-container">
                                            <form action="#" method="post">
                                                <div class="table-responsive nk-social-settings-table">
                                                    <table class="table table-bordered">
                                                        <thead class="thead-default">
                                                            <tr>
                                                                <th class="nk-social-settings-table-title">General</th>
                                                                <th class="nk-social-settings-table-check">Public</th>
                                                                <th class="nk-social-settings-table-check">Private</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td class="nk-social-settings-table-title">Display profile publicly</td>
                                                                <td class="nk-social-settings-table-check">
                                                                    <label class="form-check-label">
                                                                        <input type="radio" class="form-check-input" name="notification1" value="public" checked="checked">
                                                                    </label>
                                                                </td>
                                                                <td class="nk-social-settings-table-check">
                                                                    <label class="form-check-label">
                                                                        <input type="radio" class="form-check-input" name="notification1" value="private">
                                                                    </label>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="nk-social-settings-table-title">Display Social handles publicly</td>
                                                                <td class="nk-social-settings-table-check">
                                                                    <label class="form-check-label">
                                                                        <input type="radio" class="form-check-input" name="notification1" value="public" checked="checked">
                                                                    </label>
                                                                </td>
                                                                <td class="nk-social-settings-table-check">
                                                                    <label class="form-check-label">
                                                                        <input type="radio" class="form-check-input" name="notification1" value="private">
                                                                    </label>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="nk-gap"></div>
                                                <div class="table-responsive nk-social-settings-table">
                                                    <table class="table table-bordered">
                                                        <thead class="thead-default">
                                                            <tr>
                                                                <th class="nk-social-settings-table-title">Email</th>
                                                                <th class="nk-social-settings-table-check">Yes</th>
                                                                <th class="nk-social-settings-table-check">No</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td class="nk-social-settings-table-title">A user sends you a new message</td>
                                                                <td class="nk-social-settings-table-check">
                                                                    <label class="form-check-label">
                                                                        <input type="radio" class="form-check-input" name="notification1" value="public" checked="checked">
                                                                    </label>
                                                                </td>
                                                                <td class="nk-social-settings-table-check">
                                                                    <label class="form-check-label">
                                                                        <input type="radio" class="form-check-input" name="notification1" value="private">
                                                                    </label>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="nk-social-settings-table-title">A user replies to a comment you posted</td>
                                                                <td class="nk-social-settings-table-check">
                                                                    <label class="form-check-label">
                                                                        <input type="radio" class="form-check-input" name="notification1" value="public" checked="checked">
                                                                    </label>
                                                                </td>
                                                                <td class="nk-social-settings-table-check">
                                                                    <label class="form-check-label">
                                                                        <input type="radio" class="form-check-input" name="notification1" value="private">
                                                                    </label>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="nk-social-settings-table-title">A user sends you a friend request</td>
                                                                <td class="nk-social-settings-table-check">
                                                                    <label class="form-check-label">
                                                                        <input type="radio" class="form-check-input" name="notification1" value="public" checked="checked">
                                                                    </label>
                                                                </td>
                                                                <td class="nk-social-settings-table-check">
                                                                    <label class="form-check-label">
                                                                        <input type="radio" class="form-check-input" name="notification1" value="private">
                                                                    </label>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="nk-social-settings-table-title">A user accepts your friend request</td>
                                                                <td class="nk-social-settings-table-check">
                                                                    <label class="form-check-label">
                                                                        <input type="radio" class="form-check-input" name="notification1" value="public" checked="checked">
                                                                    </label>
                                                                </td>
                                                                <td class="nk-social-settings-table-check">
                                                                    <label class="form-check-label">
                                                                        <input type="radio" class="form-check-input" name="notification1" value="private">
                                                                    </label>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                --}}{{--<em>Display profile publicly:</em>
                                                <input type="radio" id="public" name="public" value="public">
                                                <label for="public">Public</label>
                                                <input type="radio" id="private" name="private" value="private">
                                                <label for="private">Private</label>

                                                <div class="nk-gap-1"></div>

                                                <em>Display Social handles publicly:</em>
                                                <input type="radio" id="public" name="public" value="public">
                                                <label for="public">Public</label>
                                                <input type="radio" id="private" name="private" value="private">
                                                <label for="private">Private</label>--}}{{--
                                            </form>
                                        </div>
                                    </div>
                                </div>--}}
                        </div>
                        <div class="nk-gap-4"></div>
                    </div>
                </div>
                <div class="nk-gap-4"></div>
                <div class="nk-gap-3"></div>
            </div>
        </div>
@endsection