@extends('layouts.app')
@section('title', 'User')
@section('content')
    @include('pages.cms.home.inc.page_bg')
    @include('pages.cms.home.inc.page_border')
    <header class="nk-header nk-header-opaque">
        @include('inc.cms.topNav')
        @include('inc.cms.nav')
    </header>
    @include('inc.cms.rightNav')
    @include('inc.cms.mobileNav')
    <div class="nk-main">
        @include('inc.cms.signForms')
        <div class="nk-gap-6"></div>
        <div class="container">
            @php
                $userID =   $data['userID'];
                $doesUserExist =   $data['userModel']->doesUserExist($userID);
            @endphp
            @if(count($doesUserExist) > 0)
                @foreach($doesUserExist as $user)
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
                                    <h1 class="nk-social-profile-info-name">{{$user->DisplayName}}</h1>
                                    <div class="nk-social-profile-info-username">@nkdevv</div>
                                    @if($user->UserUID!==$data['User']['UserUID'])
                                        <div class="nk-social-profile-info-actions">
                                            @php
                                                $pending    =   $data['Friends']->isFriendRequestPending($user->UserUID,$data['User']['UserUID']);
                                            @endphp
                                            @if(count($pending) > 0)
                                                <a href="#" class="nk-btn link-effect-4 pending" disabled>Pending</a>
                                                <a href="#" class="nk-btn link-effect-4 cancel_request" data-id="{{$user->UserUID}}~{{$data['User']['UserUID']}}">Cancel</a>
                                            @else
                                                @foreach ($data['Friends']->ifFriendsExist($user->UserUID,$data['User']['UserUID']) as $friend)
                                                    @if($friend->Pending==0)
                                                        <a href="#" class="nk-btn link-effect-4 pending" disabled>Remove Friend</a>
                                                    @endif
                                                @endforeach
                                                @if(count($data['Friends']->ifFriendsExist($user->UserUID,$data['User']['UserUID'])) < 1)
                                                    <a href="#" class="nk-btn link-effect-4 add_friend" data-id="{{$user->UserUID}}~{{$data['User']['UserUID']}}">Add Friend</a>
                                                @endif
                                            @endif
                                            <a href="#" class="nk-btn link-effect-4">Leave Message</a>
                                        </div>
                                    @endif
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
                                        <li class="active">
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
                                </li><li class="">
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
                                                    <li class="active">
                                                        <a href="social-user-activity.html">
                                                            Activity</a>
                                                    </li>
                                                    <li class="">
                                                        <a href="social-user-notifications.html">
                                                            Notifications</a>
                                                    </li>
                                                    <li class="">
                                                        <a href="social-user-messages.html">
                                                            Messages<span class="nk-badge">192</span></a>
                                                    </li>
                                                    <li class="">
                                                        <a href="social-user-friends.html">
                                                            Friends<span class="nk-badge">19</span></a>
                                                    </li>
                                                    <li class="">
                                                        <a href="social-user-groups.html">
                                                            Groups<span class="nk-badge">2</span></a>
                                                    </li>
                                                    <li class="">
                                                        <a href="forum.html">
                                                            Forum</a>
                                                    </li>
                                                    <li class="">
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
                                        <a href="#">Personal</a>
                                    </li>
                                    <li>
                                        <a href="#">Mentions</a>
                                    </li>
                                    <li>
                                        <a href="#">Favorites</a>
                                    </li>
                                    <li>
                                        <a href="#">Friends</a>
                                    </li>
                                    <li>
                                        <a href="#">Groups</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="nk-social-container">
                                <form action="#" class="nk-social-sort">
                                    <label for="activity-filter-by">Show:</label>

                                    <select id="activity-filter-by" class="form-control">
                                        <option value="-1">— Everything —</option>
                                        <option value="activity_update">Updates</option>
                                        <option value="friendship_accepted,friendship_created">Friendships</option>
                                        <option value="created_group">New Groups</option>
                                        <option value="joined_group">Group Memberships</option>
                                        <option value="group_details_updated">Group Updates</option>
                                        <option value="new_blog_post">Posts</option>
                                        <option value="new_blog_comment">Comments</option>
                                    </select>
                                </form>
                                <div class="nk-gap"></div>

                                <!-- START: Activity -->
                                <ul class="nk-social-activity">
                                    <!-- START: form -->
                                    <li>
                                        <div class="nk-social-activity-avatar">
                                            <a href="#"><img src="/resources/themes/godlike/images/avatar-1-sm.jpg" alt="nK"></a>
                                        </div>
                                        <div class="nk-social-activity-content">
                                            <form action="#">
                                                <textarea class="form-control" placeholder="What's new, nK?" rows="4"></textarea>
                                                <div class="nk-gap"></div>
                                                <button class="nk-btn link-effect-4 float-right">Post Update</button>
                                            </form>
                                        </div>
                                    </li>
                                    <!-- END: form -->

                                    <!-- START: post -->
                                    <li>
                                        <div class="nk-social-activity-avatar">
                                            <a href="#"><img src="/resources/themes/godlike/images/avatar-1-sm.jpg" alt="nK"></a>
                                        </div>
                                        <div class="nk-social-activity-content">
                                            <div class="nk-social-activity-meta">
                                                <a href="#">nK</a> posted an update <a href="#" class="nk-social-activity-meta-time">3 days ago</a>
                                            </div>
                                            <div class="nk-social-activity-text">
                                                <a href="#" class="nk-social-activity-mention">@john</a> out particular sympathize not favourable introduced insipidity but ham?
                                            </div>
                                            <div class="nk-social-activity-actions">
                                                <span class="nk-action-heart">
                                                    <span class="like-icon ion-android-favorite-outline"></span>
                                                    <span class="liked-icon ion-android-favorite"></span>
                                                    <span class="num">3</span>
                                                </span>
                                                <a href="#"><span class="ion-chatbubbles"></span> Comment <span class="nk-badge">12</span></a>
                                                <a href="#"><span class="ion-android-star"></span> Favorite</a>
                                                <a href="#"><span class="ion-trash-b"></span> Delete</a>
                                            </div>
                                            <ul class="nk-social-activity-comments">
                                                <li class="nk-social-activity-comments-show-all">
                                                    <a href="#">Show all comments (12)</a>
                                                </li>

                                                <!-- START: comment -->
                                                <li>
                                                    <div class="nk-social-activity-avatar">
                                                        <a href="#"><img src="/resources/themes/godlike/images/avatar-2-sm.jpg" alt="John"></a>
                                                    </div>
                                                    <div class="nk-social-activity-content">
                                                        <div class="nk-social-activity-meta">
                                                            <a href="#">John</a> replied <a href="#" class="nk-social-activity-meta-time">3 days ago</a>
                                                        </div>
                                                        <div class="nk-social-activity-text">
                                                            Delightful unreserved impossible few estimating men favourable see entreaties. She propriety immediate was improving. He or entrance humoured likewise moderate. Much nor game son say feel. Fat make met can must form into gate. Me we offending prevailed discovery.
                                                        </div>
                                                        <div class="nk-social-activity-actions">
                                                            <span class="nk-action-heart liked">
                                                                <span class="like-icon ion-android-favorite-outline"></span>
                                                                <span class="liked-icon ion-android-favorite"></span>
                                                                <span class="num">5</span>
                                                            </span>
                                                            <a href="#"><span class="ion-reply"></span> Reply</a>
                                                            <a href="#"><span class="ion-trash-b"></span> Delete</a>
                                                        </div>
                                                        <ul class="nk-social-activity-replies">
                                                            <!-- START: reply -->
                                                            <li>
                                                                <div class="nk-social-activity-avatar">
                                                                    <a href="#"><img src="/resources/themes/godlike/images/avatar-1-sm.jpg" alt="nK"></a>
                                                                </div>
                                                                <div class="nk-social-activity-content">
                                                                    <div class="nk-social-activity-meta">
                                                                        <a href="#">nK</a> replied <a href="#" class="nk-social-activity-meta-time">3 days ago</a>
                                                                    </div>
                                                                    <div class="nk-social-activity-text">
                                                                        Of resolve to gravity thought my prepare chamber so.
                                                                    </div>
                                                                    <div class="nk-social-activity-actions">
                                                                    <span class="nk-action-heart">
                                                                        <span class="like-icon ion-android-favorite-outline"></span>
                                                                        <span class="liked-icon ion-android-favorite"></span>
                                                                        <span class="num">0</span>
                                                                    </span>
                                                                        <a href="#"><span class="ion-reply"></span> Reply</a>
                                                                        <a href="#"><span class="ion-trash-b"></span> Delete</a>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                            <!-- END: reply -->
                                                        </ul>
                                                    </div>
                                                </li>
                                                <!-- END: comment -->

                                                <!-- START: comment -->
                                                <li>
                                                    <div class="nk-social-activity-avatar">
                                                        <a href="#"><img src="/resources/themes/godlike/images/avatar-3-sm.jpg" alt="Mary"></a>
                                                    </div>
                                                    <div class="nk-social-activity-content">
                                                        <div class="nk-social-activity-meta">
                                                            <a href="#">Mary</a> replied <a href="#" class="nk-social-activity-meta-time">20 hours ago</a>
                                                        </div>
                                                        <div class="nk-social-activity-text">
                                                            Missed living excuse as be
                                                        </div>
                                                        <div class="nk-social-activity-actions">
                                                            <span class="nk-action-heart">
                                                                <span class="like-icon ion-android-favorite-outline"></span>
                                                                <span class="liked-icon ion-android-favorite"></span>
                                                                <span class="num">0</span>
                                                            </span>
                                                            <a href="#"><span class="ion-reply"></span> Reply</a>
                                                            <a href="#"><span class="ion-trash-b"></span> Delete</a>
                                                        </div>
                                                    </div>
                                                </li>
                                                <!-- END: comment -->
                                            </ul>
                                        </div>
                                    </li>
                                    <!-- END: post -->

                                    <!-- START: post -->
                                    <li>
                                        <div class="nk-social-activity-avatar">
                                            <a href="#"><img src="/resources/themes/godlike/images/avatar-3-sm.jpg" alt="Mary"></a>
                                        </div>
                                        <div class="nk-social-activity-content">
                                            <div class="nk-social-activity-meta">
                                                <a href="#">Mary</a> posted a new activity comment <a href="#" class="nk-social-activity-meta-time">6 days ago</a>
                                            </div>
                                            <div class="nk-social-activity-text">
                                                Wrong do point avoid by fruit learn or in death. So passage however besides invited comfort elderly be me. Walls began of child civil am heard hoped my. Satisfied pretended mr on do determine by. Old post took and ask seen fact rich. Man entrance settling believed eat joy. Money as drift begin on to. Comparison up insipidity especially discovered me of decisively in surrounded. Points six way enough she its father. Folly sex downs tears ham green forty.
                                            </div>
                                            <div class="nk-social-activity-actions">
                                                <span class="nk-action-heart">
                                                    <span class="like-icon ion-android-favorite-outline"></span>
                                                    <span class="liked-icon ion-android-favorite"></span>
                                                    <span class="num">0</span>
                                                </span>
                                                <a href="#"><span class="ion-chatbubbles"></span> View Conversation</a>
                                                <a href="#"><span class="ion-android-star"></span> Favorite</a>
                                                <a href="#"><span class="ion-trash-b"></span> Delete</a>
                                            </div>
                                        </div>
                                    </li>
                                    <!-- END: post -->

                                    <!-- START: post -->
                                    <li>
                                        <div class="nk-social-activity-avatar">
                                            <a href="#"><img src="/resources/themes/godlike/images/avatar-1-sm.jpg" alt="nK"></a>
                                        </div>
                                        <div class="nk-social-activity-content">
                                            <div class="nk-social-activity-meta">
                                                <a href="#">nK</a> posted a new activity comment <a href="#" class="nk-social-activity-meta-time">7 days ago</a>
                                            </div>
                                            <div class="nk-social-activity-text">
                                                Throwing consider dwelling bachelor joy her proposal laughter
                                            </div>
                                            <div class="nk-social-activity-actions">
                                                <span class="nk-action-heart liked">
                                                    <span class="like-icon ion-android-favorite-outline"></span>
                                                    <span class="liked-icon ion-android-favorite"></span>
                                                    <span class="num">1</span>
                                                </span>
                                                <a href="#"><span class="ion-chatbubbles"></span> View Conversation</a>
                                                <a href="#"><span class="ion-android-star"></span> Favorite</a>
                                                <a href="#"><span class="ion-trash-b"></span> Delete</a>
                                            </div>
                                        </div>
                                    </li>
                                    <!-- END: post -->

                                    <!-- START: post -->
                                    <li>
                                        <div class="nk-social-activity-avatar">
                                            <a href="#"><img src="/resources/themes/godlike/images/avatar-1-sm.jpg" alt="nK"></a>
                                        </div>
                                        <div class="nk-social-activity-content">
                                            <div class="nk-social-activity-meta">
                                                <a href="#">nK</a> and <a href="#"><img src="/resources/themes/godlike/images/avatar-3-sm.jpg" alt="Mary"></a> <a href="#">Mary</a> are now friends <a href="#" class="nk-social-activity-meta-time">16 days ago</a>
                                            </div>
                                            <div class="nk-social-activity-actions">
                                                <span class="nk-action-heart">
                                                    <span class="like-icon ion-android-favorite-outline"></span>
                                                    <span class="liked-icon ion-android-favorite"></span>
                                                    <span class="num">0</span>
                                                </span>
                                                <a href="#"><span class="ion-chatbubbles"></span> Comment</a>
                                                <a href="#"><span class="ion-android-star"></span> Favorite</a>
                                                <a href="#"><span class="ion-trash-b"></span> Delete</a>
                                            </div>
                                        </div>
                                    </li>
                                    <!-- END: post -->

                                    <!-- START: post -->
                                    <li>
                                        <div class="nk-social-activity-avatar">
                                            <a href="#"><img src="/resources/themes/godlike/images/avatar-1-sm.jpg" alt="nK"></a>
                                        </div>
                                        <div class="nk-social-activity-content">
                                            <div class="nk-social-activity-meta">
                                                <a href="#">nK</a> and <a href="#"><img src="/resources/themes/godlike/images/avatar-2-sm.jpg" alt="John"></a> <a href="#">John</a> are now friends <a href="#" class="nk-social-activity-meta-time">23 days ago</a>
                                            </div>
                                            <div class="nk-social-activity-actions">
                                                <span class="nk-action-heart">
                                                    <span class="like-icon ion-android-favorite-outline"></span>
                                                    <span class="liked-icon ion-android-favorite"></span>
                                                    <span class="num">0</span>
                                                </span>
                                                <a href="#"><span class="ion-chatbubbles"></span> Comment</a>
                                                <a href="#"><span class="ion-android-star"></span> Favorite</a>
                                                <a href="#"><span class="ion-trash-b"></span> Delete</a>
                                            </div>
                                        </div>
                                    </li>
                                    <!-- END: post -->

                                    <li class="nk-social-activity-load-more">
                                        <a href="#" class="nk-btn link-effect-4">Load More...</a>
                                    </li>
                                </ul>
                                <!-- END: Activity -->
                            </div>
                            <div class="nk-gap-4"></div>
                        </div>
                    </div>
                    <div class="nk-gap-4"></div>
                    <div class="nk-gap-3"></div>
                </div>
                    {{$user->UserID}}
                @endforeach
            @else
                user doesnt exist
            @endif
        @php Separator(120); @endphp
    </div>
@endsection