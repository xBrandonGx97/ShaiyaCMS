@extends('layouts.cms.app')
@section('title', 'Boss Records')
@section('zone', 'CMS')
@section('headerTitle', 'Boss Records')
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
            <div class="table-responsive">
                <table class="table table-dark2 table-striped tac">
                    <thead>
                        <tr class="boss-record">
                            <th class="boss-record">Boss</th>
                            <th class="boss-record">Killed by</th>
                            <th class="boss-record">Respawns in</th>
                        </tr>
                    </thead>
                    @php
                        $time = date("Y-m-d H:i:s.000");
                    @endphp
                    @foreach($data['bossrecords']->MobID as $value)
                        @php
                            $data['bossrecords']->getBossRecords($time,$value);
                        @endphp
                    @endforeach
                </table>
            </div>
        </div>
        @Separator(40)
        @Separator(80)
        @include('layouts.cms.footer')
    </div>
@endsection