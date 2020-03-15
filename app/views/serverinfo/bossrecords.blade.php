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
        <div class="container text-xs-center">
            <div class="nk-gap-6"></div>
            <div class="nk-gap-2"></div>
            <div class="container">
                <h2 class="display-4">Boss Records</h2>
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
        </div>
        @php Separator(120); @endphp
    </div>
@endsection