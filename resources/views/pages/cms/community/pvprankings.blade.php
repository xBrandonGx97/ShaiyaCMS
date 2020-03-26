@extends('layouts.cms.app')
@section('index', 'rankings')
@section('title', 'PvP Rankings')
@section('zone', 'CMS')
@section('headerTitle', 'PvP Rankings')
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
        @Separator(80)
        <div class="container text-xs-center">
            <div class="col-md-3 order-md-2 text-right float-right">
                <input type="search" class="form-control form-control-sm" name="search" id="searchBox" placeholder="Search..">
            </div>
            <div id="rankingsData"></div>
        </div>
        @Separator(40)
        @Separator(80)
        @include('layouts.cms.footer')
    </div>
@endsection
