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
		@include('home.inc.mainHeader')
		@include('home.inc.revSlider')
		@include('inc.cms.signForms')
		@include('home.inc.mainFeatures')
		@include('home.inc.serverInfo')
		@include('home.inc.countDown')
		@include('home.inc.updates')
    </div>
@endsection