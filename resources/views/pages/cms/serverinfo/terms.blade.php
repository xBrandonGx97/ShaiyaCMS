@extends('layouts.cms.app')
@section('title', 'Terms of Service')
@section('zone', 'CMS')
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
            <div class="nk-gap-6"></div>
            <div class="nk-gap-2"></div>
            <div class="container">
                <h2 class="display-4">About | Server Info</h2>
                <ul>
                    <li>Episode 6.4</li>
                    <li>Max Level 80</li>
                    <li>Custom Commands</li>
                    <li>PvE/PvP</li>
                    <li>EP8 Data/Custom Costumes/Wings/Pets</li>
                    <li>x2 Killrate (Double on weekends)</li>
                    <li>x20 ExpRate (Double on weekends)</li>
                </ul>
            </div>
        </div>
        @php Separator(120); @endphp
    </div>
@endsection