@extends('layouts.cms.app')
@section('index', 'vote')
@section('title', 'Vote for Us')
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
            @Separator(80)
            <h2 class="display-4">Vote for DP</h2>
            <p>You will {{$data['vote']->Point}}  DP per vote.</p>
            <p>You can vote every 12 hours.</p>
            @php Separator(20); @endphp
            <form name="Vote" method="post" id="Vote" target="_new">
                <input type="radio" name="site" value="nr1" checked> XtremeTop100<br>
                <input type="radio" name="site" value="nr2"> OxigenTop100<br>
                <input type="radio" name="site" value="nr3"> GamingTop100<br>
                <input type="radio" name="site" value="nr4"> Top of Games<br/>
                @php Separator(20); @endphp
                <img style="margin-left:10px;" src="/resources/themes/core/images/Vote/votenew.jpg" border="0" alt="Shaiya Servers">
                <img style="margin-left:10px;" src="/resources/themes/core/images/Vote/button_1.gif.png" border="0" alt="Shaiya Servers">
                <img style="margin-left:10px;" src="/resources/themes/core/images/Vote/vote.gif" border="0" alt="Shaiya Servers">
                <img style="margin-left:10px;" src="/resources/themes/core/images/Vote/47879_original.gif" border="0" alt="Shaiya Servers">
                @Separator(20)
                @Separator(20)
                <div class="col-md-3"></div>
                <div class="col-md-12">
                    <button type="submit" class="btn btn-sm" id="Button1" name="Vote">Vote</button>
                </div>
            </form>
        </div>
        @Separator(40)
        @Separator(80)
        @include('layouts.cms.footer')
    </div>
@endsection
