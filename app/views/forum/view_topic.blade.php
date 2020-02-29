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
        <div class="nk-info-box bg-main-1 alert text-center" id="pin" style="display:none;font-size:24px;">
            <div class="nk-info-box-icon" style="display:inline-block !important;">
                <i class="ion-information-circled"></i>
            </div>
            <span class="alert-text">Alert</span>
        </div>
        <div class="nk-gap-4"></div>
        @php
            $isLoggedIn     =   $data['User']['LoginStatus'];
            $url = checkUrl();
            $forumID    =   $data['forum']->getForumID($url[3]);
            $forumName  =   $data['forum']->getForumName($url[3],1);
            $topicTitle =   $data['forum']->getTopicTitle($url[3]);

            $onlineStaff    =   $data['forum']->getOnlineStaff();
            $cDisplayName   =   $isLoggedIn ? $data['forum']->convertDisplayName($onlineStaff) : '';
        @endphp
        <div class="nk-breadcrumbs text-center" style="opacity:0.9 !important;">
            <ul>
                <li><a href="/">Home</a></li>
                <li><a href="/forum">Forum</a></li>
                <li><a href="/forum/topics/{{$forumID}}">{{$forumName}}</a></li>
                <li><span>{{$topicTitle}}</span></li>
            </ul>
        </div>
        <div class="nk-gap-2"></div>
        <div class="table-responsive" id="pagination_data" data-id="{{$data['topicID']}}">

        </div>
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
            </div>--}}
        </div>
    @php Separator(120); @endphp
    <script>
        $(document).ready(function(){
            let page = 1;
            load_data(page);
        });
    </script>
@endsection