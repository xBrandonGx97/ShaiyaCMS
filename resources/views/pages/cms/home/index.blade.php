@extends('layouts.cms.app')
@section('title', 'Home')
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
		@include('partials.cms.mainHeader')
		@include('partials.cms.signForms')
		<div class="container">
        @Separator(80)
        <div class="row">
            <div class="col-lg-8">
              <div id="newsData"></div>
            </div>
            {{-- @include('partials.cms.news') --}}
            @include('partials.cms.widgets')
        </div>
        @Separator(80)
        @Separator(80)
		</div>
		@include('layouts.cms.footer')
</div>
@endsection