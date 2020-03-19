@extends('layouts.app')
@section('title', 'Home')
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
		@include('pages.cms.home.inc.mainHeader')
		@include('pages.cms.home.inc.revSlider')
		@include('inc.cms.signForms')
		@include('pages.cms.home.inc.mainFeatures')
		@include('pages.cms.home.inc.serverInfo')
		@include('pages.cms.home.inc.countDown')
		@include('pages.cms.home.inc.updates')
    </div>
@endsection