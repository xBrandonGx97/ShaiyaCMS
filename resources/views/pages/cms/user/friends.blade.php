@extends('layouts.cms.app')
@section('title', 'Friends')
@section('zone', 'CMS')
@section('headerTitle', 'Friends')
@section('content')
    {{-- @include('pages.cms.home.inc.page_bg') --}}
    @include('partials.cms.pageBorder')
    <header class="nk-header nk-header-opaque">
        @include('partials.cms.topNav')
        @include('partials.cms.nav')
    </header>
    @include('partials.cms.rightNav')
	@include('partials.cms.mobileNav')
    <div class="nk-main">
        @include('partials.cms.pageHeader')
		@include('partials.cms.signForms')
        <div class="container text-xs-center">
            <div class="nk-gap-4"></div>
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
        <div class="nk-gap-2"></div>
        <div class="nk-gap-4"></div>
        @include('layouts.cms.footer')
    </div>
@endsection