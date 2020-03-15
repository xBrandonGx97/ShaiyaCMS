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
        <div class="nk-box bg-dark-1">
            <div class="container text-xs-center">
                <div class="nk-gap-6"></div>
                <div class="nk-gap-2"></div>
                <h2 class="nk-title h1 text-center">PvP Rankings</h2>
                <div class="container">
                    <div class="table-responsive" id="pagination_data">
                    </div>
                </div>
            </div>
        @php Separator(120); @endphp
        </div>
    </div>
@endsection