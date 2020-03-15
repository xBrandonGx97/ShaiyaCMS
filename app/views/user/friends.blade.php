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
        <div class="container text-xs-center">
            <div class="nk-gap-6"></div>
            <div class="nk-gap-2"></div>
            <div class="container">
                <h2 class="display-4">Friend Requests</h2>
                @php
                    $UserUID    =   $data['User']['UserUID'];
                    $checkFriendRequests =   $data['Friends']->checkFriendRequests($UserUID);
                    $checkFriends   =   $data['Friends']->checkFriends($UserUID);
                @endphp
                @if(count($checkFriendRequests) > 0)
                    @foreach($checkFriendRequests as $requests)
                        {{$requests->FromUser}}
                        <a href="#" class="nk-btn link-effect-4 accept_friend" data-id="{{$requests->FromUser}}~{{$requests->ToUser}}">Accept</a>
                        <a href="#" class="nk-btn link-effect-4 decline_friend" data-id="{{$requests->FromUser}}~{{$requests->ToUser}}">Decline</a>
                    @endforeach
                @endif
                @if(count($checkFriends) > 0)
                    @foreach($checkFriends as $friends)
                        {{$friends->DisplayName}}
                        <a href="#" class="nk-btn link-effect-4 remove_friend" data-id="{{$friends->FromUser}}~{{$friends->ToUser}}">Remove Friend</a>
                    @endforeach
                @endif
            </div>
        </div>
        @php Separator(120); @endphp
    </div>
@endsection