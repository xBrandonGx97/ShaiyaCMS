@extends('layouts.cms.app')
@section('index', 'patchNotes')
@section('title', 'Patch Notes')
@section('zone', 'CMS')
@section('headerTitle', 'Patch Notes')
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
        <div class="container">
            <div id="patchData"></div>
        </div>
        @Separator(40)
        @Separator(80)
        @include('layouts.cms.footer')
    </div>
@endsection
