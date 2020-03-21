@extends('layouts.cms.app')
@section('title', 'Downloads')
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
        @include('partials.cms.pageHeader')
		@include('partials.cms.signForms')
        <div class="container text-xs-center">
            <div class="nk-gap-4"></div>
            <p class="lead">By downloading ServerName You agree to Our <a href="">Terms of Service and Conditions</a>. If you Violate these terms you can be banned without any warnings and permenantly.</p>
                <div class="row vertical-gap align-items-center">
                    <div class="col-md-3"></div>
                    <div class="col-md-4" style="height: 707px;">
                        <div>
                            <div class="nk-pricing">
                                <h3 class="nk-pricing-title">Game Files</h3>
                                <div class="nk-pricing-price">
                                    <a href="https://mega.nz/#!JIsjVALI!Bo4rUTqhEOJuFlYPXWgwM6a0jQyDuRWgTYPeDQOE2gY" target="_blank" class="nk-btn nk-btn-lg nk-btn-rounded nk-btn-outline nk-btn-color-main-1">Mega</a>
                                    <a href="https://drive.google.com/file/d/1BLzRs-d4ILybCAVHfIX7Ehtj0AtIMHYd/edit" target="_blank" class="nk-btn nk-btn-lg nk-btn-rounded nk-btn-outline nk-btn-color-main-1" style="margin-left:5px">Google Drive</a>
                                </div>
                                <div class="nk-pricing-button">
                                    <span>Last Updated On: 3.14.19</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4" style="height: 707px;">
                        <div>
                            <div class="nk-pricing">
                                <h3 class="nk-pricing-title">Patch Files</h3>
                                <div class="nk-pricing-price">
                                    <a href="#" class="nk-btn nk-btn-lg nk-btn-rounded nk-btn-outline nk-btn-color-main-1">Game.exe</a>
                                    <a href="#" class="nk-btn nk-btn-lg nk-btn-rounded nk-btn-outline nk-btn-color-main-1" style="margin-left:5px">Updater.exe</a>
                                </div>
                                <div class="nk-pricing-button">
                                    <span>Last Updated On: 1.27.19</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <div class="nk-gap-2"></div>
            <div class="nk-gap-6"></div>
        </div>
        @include('layouts.cms.footer')
    </div>
@endsection