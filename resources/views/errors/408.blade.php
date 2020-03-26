@php header('HTTP/1.1 408 Request Time-out'); @endphp
@extends('layouts.cms.app')
@section('index', 'error')
@section('title', 'ERROR 408')
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
        <div class="nk-header-title nk-header-title-full nk-header-title-parallax nk-header-title-parallax-opacity">
            <div class="bg-image op-8">
                <img src="/resources/themes/godlike/images/image-2.jpg" alt="" class="jarallax-img">
            </div>
            <div class="nk-header-table">
                <div class="nk-header-table-cell">
                    <div class="container">
                        <div class="nk-header-text">
                            <div class="nk-gap-4"></div>
                            <div class="container">
                                <div class="text-center">
                                    <h2 class="nk-title display-4">Page Not Found</h2>
                                    <div class="nk-gap-2"></div>
                                    <div class="row">
                                        <div class="col-md-8 offset-md-2">
                                            <p class="lead">The page you are looking for no longer exists. Perhaps you can return back to the site’s homepage and see if you can find what you are looking for.</p>
                                            <div class="nk-gap-2"></div>
                                            <a href="/" class="nk-btn nk-btn-lg link-effect-4">Go to Homepage</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="nk-gap-4"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
