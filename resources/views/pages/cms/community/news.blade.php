@extends('layouts.cms.app')
@section('index', 'news')
@section('title', 'News')
@section('zone', 'CMS')
@section('headerTitle', 'News')
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
            <div id="newsData"></div>
            {{-- @if(count($data['news']) > 0)
                @foreach($data['news'] as $news)
                    <div class="row">
                        <div class="col-lg-8 offset-lg-2">
                            <div class="nk-box-3 bg-dark-2">
                                <h2 class="nk-title h3 text-xs-center">{{$news->Title}}</h2>
                                <span>{{$news->Detail}}</span>
                                <span class="float-right">{{date('F d, Y', strtotime($news->Date))}}</span>
                                <span class="float-right"><strong>{{$news->UserID}}</strong> &nbsp;</span>
                            </div>
                        </div>
                    </div>
                    <div class="nk-gap-2"></div>
                @endforeach
            @else
                <p>No News found. Please check back later.</p>
            @endif --}}
        </div>
        @Separator(40)
        @Separator(80)
        @include('layouts.cms.footer')
    </div>
@endsection
