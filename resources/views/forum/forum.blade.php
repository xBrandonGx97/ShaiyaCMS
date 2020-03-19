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
        @include('inc.cms.signForms')
        <div class="nk-gap-4"></div>
        <div class="nk-breadcrumbs text-center" style="opacity:0.9 !important;">
            <ul>
                <li><a href="/">Home</a></li>
                <li><span>Forum</span></li>
            </ul>
        </div>
        <div class="nk-gap-2"></div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-9">
                    <!-- START: Forums List -->
                        @php
                            $data['forum']->getUserRoles($data['User']['UserUID']);
                            $data['forum']->ifCanCreateForum();
                            Display('create_forum_modal','<i class="fas fa-folder-plus"></i>','0','2','Create Forum');

                            $isLoggedIn     =   $data['User']['LoginStatus'];

                            $isMod          =   $isLoggedIn ? $data['forum']->isMod($data['User']['UserUID']) : '';
                            $data['forum']->getOnlineStaff();
                            $cDisplayName   =   $isLoggedIn ? $data['forum']->convertDisplayName($data['forum']->getOnlineStaff()) : '';
                        @endphp

                        @if ($isLoggedIn==true)
                            @if($isMod)
                                <button class="nk-btn nk-btn-lg link-effect-4 float-right open_create_forum_modal" data-target="#create_forum_modal" data-toggle="modal" id="reply_submit">Create New Forum</button>
                            @endif
                        @endif

                        {{--@php
                            if (in_array('true', $data['forum']->ifCanCreateTopic($data['User']['UserUID']))) {
                                echo 'can create topic..';
                            }
                        @endphp--}}

                        {{--@foreach($data['forum']->ifCanCreateTopic($data['User']['UserUID']) as $action)
                            @if($action->Name=='CRT_TPC')
                                yer
                            @endif
                        @endforeach--}}

                        {{--@if($data['forum']->ifCanCreateForum())
                            <button class="nk-btn nk-btn-lg link-effect-4 float-right" id="reply_submit">Create New Forum</button>
                        @endif--}}

                        <div class="nk-gap-4"></div>
                        @if(count($data['forum']->fet) > 0)
                            <ul class="nk-forum">
                            @foreach($data['forum']->fet as $forum)
                                @php
                                    //$data['forum']->getOnlineStaff();
                                    $ForumID        =   $forum->ForumID;
                                    $ForumName      =   $forum->ForumName;
                                    $SubText        =   $forum->SubText;
                                    $Locked         =   $forum->Locked;
                                    $topicCount     =   $data['forum']->getTopicCount($forum->ForumID);
                                    $topicTitle     =   $data['forum']->getTopicTitle($forum->ForumID);
                                    $topicDate      =   $data['forum']->getTopicDate($forum->ForumID);

                                    $checkTopicCount =  $topicCount==1 ? $topicCount.' topic' : $topicCount.' topics';
                                    $checkTopicTitle =  $topicTitle ? '<a href="forum-single-topic.html">'.$topicTitle.'</a>' : '—';
                                    $checkTopicDate  =  $topicDate ? date("M d, Y", strtotime($topicDate)) : '';
                                @endphp
                                @if($Locked == 0)
                                    <li>
                                        <div class="nk-forum-icon">
                                            <span class="ion-ios-game-controller-b"></span>
                                        </div>
                                        <div class="nk-forum-title">
                                            <h3><a href="/forum/topics/{{$ForumID}}">{{$ForumName}}</a></h3>
                                            <div class="nk-forum-title-sub">{{$SubText}}</div>
                                        </div>
                                        <div class="nk-forum-count">
                                            {{$checkTopicCount}}
                                         </div>
                                        <div class="nk-forum-activity-avatar">
                                            <img src="/resources/themes/godlike/images/avatar-1-sm.jpg" alt="Lesa Cruz">
                                        </div>
                                        <div class="nk-forum-activity">
                                            <div class="nk-forum-activity-title" title="GodLike the only game that I want to play!">
                                                {!!$checkTopicTitle!!}
                                            </div>
                                            <div class="nk-forum-activity-date">
                                                {{$checkTopicDate}}
                                            </div>
                                        </div>
                                    </li>
                                @else
                                    <li class="nk-forum-locked">
                                        <div class="nk-forum-icon">
                                            <span class="ion-help-buoy"></span>
                                        </div>
                                        <div class="nk-forum-title">
                                             <h3><a href="/forum/topics/{{$ForumID}}">{{$ForumName}}</a></h3>
                                            <div class="nk-forum-title-sub">{{$SubText}}</div>
                                        </div>
                                        <div class="nk-forum-count">
                                            {{$checkTopicCount}}
                                        </div>
                                        <div class="nk-forum-activity-avatar">
                                            <img src="/resources/themes/godlike/images/avatar-2-sm.jpg" alt="Kurt Tucker">
                                        </div>
                                        <div class="nk-forum-activity">
                                            <div class="nk-forum-activity-title" title="Install on Windows 95">
                                                {!!$checkTopicTitle!!}
                                            </div>
                                            <div class="nk-forum-activity-date">
                                                {{$checkTopicDate}}
                                            </div>
                                        </div>
                                    </li>
                                @endif
                            @endforeach
                            </ul>
                        @else
                            <p>No Forums found. Please check back later.</p>
                        @endif
                        <div class="nk-gap-2"></div>
                        {{--<div class="online-staff text-center">
                            <h6>Current online staff: </h6>
                            @if($onlineStaff!==false)
                                @if ($cDisplayName)
                                    <span>{!!$cDisplayName!!}</span>
                                @else
                                    <span>{!!$onlineStaff!!}</span>
                                @endif
                            @else
                                <span>There are currently no online staff.</span>
                            @endif
                            --}}{{--@if(count($data['forum']->onlineStaff) > 0)
                                @foreach ($onlineStaff as $staff)
                                    @if ($data['forum']->convertDisplayName($staff->DisplayName))
                                        <span>{!!$data['forum']->convertDisplayName($staff->DisplayName)!!}</span>
                                    @else
                                        <span>{!!$staff->DisplayName!!}</span>
                                    @endif
                                @endforeach
                            @else
                                <span>There are currently no online staff.</span>
                            @endif--}}{{--
                        </div>--}}
                        {{--<ul class="nk-forum">
                            <li>
                                <div class="nk-forum-icon">
                                    <span class="ion-ios-game-controller-b"></span>
                                </div>
                                <div class="nk-forum-title">
                                    <h3><a href="forum-topics.html">Main Game Discussions</a></h3>
                                    <div class="nk-forum-title-sub">Be seed is air female greater was multiply saying great</div>
                                </div>
                                 <div class="nk-forum-count">
                                     1267 threads
                                 </div>
                                <div class="nk-forum-activity-avatar">
                                    <img src="/resources/themes/godlike/images/avatar-1-sm.jpg" alt="Lesa Cruz">
                                </div>
                                <div class="nk-forum-activity">
                                    <div class="nk-forum-activity-title" title="GodLike the only game that I want to play!">
                                        <a href="forum-single-topic.html">GodLike the only game that I want to play!</a>
                                    </div>
                                    <div class="nk-forum-activity-date">
                                        September 11, 2017
                                    </div>
                                </div>
                            </li>
                            <li class="nk-forum-locked">
                                <div class="nk-forum-icon">
                                    <span class="ion-help-buoy"></span>
                                </div>
                                <div class="nk-forum-title">
                                    <h3><a href="forum-topics.html">Guides and Tips</a></h3>
                                    <div class="nk-forum-title-sub">Lesser saying shall place fifth very winged own made midst</div>
                                </div>
                                <div class="nk-forum-count">
                                    78 threads
                                </div>
                                <div class="nk-forum-activity-avatar">
                                    <img src="/resources/themes/godlike/images/avatar-2-sm.jpg" alt="Kurt Tucker">
                                </div>
                                <div class="nk-forum-activity">
                                    <div class="nk-forum-activity-title" title="Install on Windows 95">
                                        <a href="forum-single-topic.html">Install on Windows 95</a>
                                    </div>
                                    <div class="nk-forum-activity-date">
                                        March 2, 2017
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="nk-forum-icon">
                                    <span class="ion-playstation"></span>
                                </div>
                                <div class="nk-forum-title">
                                    <h3><a href="forum-topics.html">GodLike on PS4</a></h3>
                                    <div class="nk-forum-title-sub">Heaven had gathering a seed his won't light firmament of</div>
                                </div>
                                <div class="nk-forum-count">
                                    433 threads
                                </div>
                                <div class="nk-forum-activity-avatar">
                                    <img src="/resources/themes/godlike/images/avatar-3-sm.jpg" alt="Katie Anderson">
                                </div>
                                <div class="nk-forum-activity">
                                    <div class="nk-forum-activity-title" title="How to solve error with PS Network?">
                                        <a href="forum-single-topic.html">How to solve error with PS Network?</a>
                                    </div>
                                    <div class="nk-forum-activity-date">
                                        May 19, 2017
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="nk-forum-icon">
                                    <span class="ion-xbox"></span>
                                </div>
                                <div class="nk-forum-title">
                                    <h3><a href="forum-topics.html">GodLike on Xbox One</a></h3>
                                    <div class="nk-forum-title-sub">Made replenish set man appear seed moveth let above in</div>
                                </div>
                                <div class="nk-forum-count">
                                    321 threads
                                </div>
                                <div class="nk-forum-activity-avatar">
                                    <img src="/resources/themes/godlike/images/avatar-2-sm.jpg" alt="Kurt Tucker">
                                </div>
                                <div class="nk-forum-activity">
                                    <div class="nk-forum-activity-title" title="I want game quality like on PC!!!">
                                        <a href="forum-single-topic.html">I want game quality like on PC!!!</a>
                                    </div>
                                    <div class="nk-forum-activity-date">
                                        Jule 28, 2017
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="nk-forum-icon">
                                    <span class="ion-steam"></span>
                                </div>
                                <div class="nk-forum-title">
                                    <h3><a href="forum-topics.html">GodLike on PC (Steam)</a></h3>
                                    <div class="nk-forum-title-sub">Make beginning creeping fly divided</div>
                                </div>
                                <div class="nk-forum-count">
                                    156 threads
                                </div>
                                <div class="nk-forum-activity-avatar">
                                    <img src="/resources/themes/godlike/images/avatar-4-sm.jpg" alt="Luke Fuller">
                                </div>
                                <div class="nk-forum-activity">
                                    <div class="nk-forum-activity-title" title="60fps - easy">
                                        <a href="forum-single-topic.html">60fps - easy</a>
                                    </div>
                                    <div class="nk-forum-activity-date">
                                        August 18, 2017
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="nk-forum-icon">
                                    <span class="ion-fireball"></span>
                                </div>
                                <div class="nk-forum-title">
                                    <h3><a href="forum-topics.html">Flame</a></h3>
                                    <div class="nk-forum-title-sub">Dominion. Our seasons creepeth so seed which forth gathering second</div>
                                </div>
                                <div class="nk-forum-count">
                                    1872 threads
                                </div>
                                <div class="nk-forum-activity-avatar">
                                    <img src="/resources/themes/godlike/images/avatar-1-sm.jpg" alt="Lesa Cruz">
                                </div>
                                <div class="nk-forum-activity">
                                    <div class="nk-forum-activity-title" title="Download game for free?">
                                        <a href="forum-single-topic.html">Download game for free?</a>
                                    </div>
                                    <div class="nk-forum-activity-date">
                                        September 5, 2017
                                    </div>
                                </div>
                            </li>
                        </ul>--}}
                        <!-- END: Forums List -->
                    </div>
                    <div class="col-lg-3">
                        <!--
                            START: Sidebar

                            Additional Classes:
                                .nk-sidebar-left
                                .nk-sidebar-right
                                .nk-sidebar-sticky
                        -->
                        <aside class="nk-sidebar nk-sidebar-right nk-sidebar-sticky">
                            <div class="nk-gap-4"></div>
                            <div class="nk-widget nk-box-1 bg-dark-1">
                                <h4 class="nk-widget-title">Staff Online</h4>
                                <div>
                                    <!-- content -->
                                    @if(count($data['forum']->onlineStaff) > 0)
                                        @foreach ($data['forum']->onlineStaff as $staff)
                                            @if ($data['forum']->convertDisplayName($staff->DisplayName))
                                                <span>{!!$data['forum']->convertDisplayName($staff->DisplayName)!!}</span><br>
                                            @else
                                                <span>{!!$staff->DisplayName!!}</span><br>
                                            @endif
                                        @endforeach
                                    @else
                                        <span>There are currently no online staff.</span>
                                    @endif
                                    {{--if($onlineStaff!==false)
                                        @if ($cDisplayName)
                                            <p>{!!$cDisplayName!!}</p>
                                        @else
                                            <p>{!!$onlineStaff!!}</p>
                                        @endif
                                    @else
                                        <p>There are currently no online staff.</p>
                                    @endif--}}
                                </div>
                            </div>
                            <div class="nk-widget nk-box-1 bg-dark-1">
                                <h4 class="nk-widget-title">Members Online</h4>
                                <div>
                                    <!-- content -->
                                </div>
                            </div>
                            <div class="nk-widget nk-box-1 bg-dark-1">
                                <h4 class="nk-widget-title">Latest Posts</h4>
                                <div>
                                    <!-- content -->
                                </div>
                            </div>
                            <div class="nk-widget nk-box-1 bg-dark-1">
                                <h4 class="nk-widget-title">Forum Statistics</h4>
                                <div>
                                    <!-- content -->
                                </div>
                            </div>
                        </aside>
                    </div>
                </div>
            </div>
    @php Separator(120); @endphp
    </div>
    <script>
        $(document).ready(function(){
          $(document).on('click', '.open_create_forum_modal', function (e) {
                e.preventDefault();

                $('#create_forum_modal #dynamic-content').html('');
                $('#create_forum_modal #modal-loader').show();
                $.ajax({
                    url: "/resources/jquery/addons/ajax/blade/init.forum_create.php",
                    type: 'POST',
                    dataType: 'html'
                })
                .done(function (data) {
                    $('#move_topic_modal #dynamic-content').html('');
                    $('#create_forum_modal #dynamic-content').html(data);
                    $('#create_forum_modal #modal-loader').hide();
                })
                .fail(function () {
                    $('#create_forum_modal #dynamic-content').html('<i class="fa fa-exclamation-triangle"></i> Something went wrong, Please try again...');
                    $('#create_forum_modal #modal-loader').hide();
                });
            });
        })
    </script>
@endsection