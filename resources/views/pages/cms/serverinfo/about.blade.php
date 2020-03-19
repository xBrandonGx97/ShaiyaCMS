@extends('layouts.app')
@section('title', 'About')
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