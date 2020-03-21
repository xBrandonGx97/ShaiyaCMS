@extends('layouts.cms.app')
@section('title', 'Users')
@section('zone', 'CMS')
@section('headerTitle', 'Users')
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
            <h2 class="display-4">Users</h2>
            <form method="post">
                <input type="text" class="form-control" name="search" id="searchBox" placeholder="Search for users.. (char names)"/>
            </form>
            <ul id="dataViewer">
            </ul>
            <!-- Display users without search here + paginator -->
        </div>
        <div class="nk-gap-2"></div>
        <div class="nk-gap-4"></div>
        @include('layouts.cms.footer')
    </div>
@endsection