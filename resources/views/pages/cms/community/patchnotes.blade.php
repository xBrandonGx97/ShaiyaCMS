@extends('layouts.cms.app')
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
        <div class="nk-gap-4"></div>
        <div class="container">
            @if(count($data['patchnotes']) > 0)
                @foreach($data['patchnotes'] as $patchnotes)
                    <div class="row">
                        <div class="col-lg-8 offset-lg-2">
                            <div class="nk-box-3 bg-dark-2">
                                <h2 class="nk-title h3 text-xs-center">{{$patchnotes->Title}}</h2>
                                @php echo $patchnotes->Detail; @endphp
                                <span class="float-right">{{date('F d, Y', strtotime($patchnotes->Date))}}</span>
                            </div>
                        </div>
                    </div>
                    <div class="nk-gap-2"></div>
                @endforeach
            @else
                <p>No Patch Notes found. Please check back later.</p>
            @endif
        </div>
        <div class="nk-gap-2"></div>
        <div class="nk-gap-4"></div>
        @include('layouts.cms.footer')
    </div>
@endsection