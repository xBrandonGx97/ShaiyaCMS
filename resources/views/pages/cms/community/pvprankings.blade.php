@extends('layouts.app')
@section('title', 'PvP Rankings')
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
        <div class="nk-box bg-dark-1">
            <div class="container text-xs-center">
                <div class="nk-gap-6"></div>
                <div class="nk-gap-2"></div>
                <h2 class="nk-title h1 text-center">PvP Rankings</h2>
                <div class="container">
                    <div class="table-responsive" id="pagination_data">
                        <div class="container">
                            <div class="row paginationData">
                                <div class="col-md-3 order-md-2 text-right">
                                    <input type="search" class="form-control form-control-sm" name="search" id="searchBox" placeholder="Search..">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @php Separator(120); @endphp
        </div>
    </div>
@endsection