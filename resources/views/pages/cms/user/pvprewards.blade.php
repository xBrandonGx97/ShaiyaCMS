@extends('layouts.cms.app')
@section('title', 'PvP Rewards')
@section('zone', 'CMS')
@section('headerTitle', 'PvP Rewards')
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
            <h2 class="display-4">PvP Rewards</h2>
            @if (!$data['User']['LoginStatus']==true)
                <p>Please login to continue.</p>
                @else
                <div class="table-responsive">
                    <table class="table table-dark2 table-striped text-center">
                        <thead>
                            <tr>
                                <th>Prize ID</th>
                                <th>Kills Required</th>
                                <th>Icon</th>
                                <th>Reward</th>
                                <th>Redeem</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $index=1;
                            @endphp
                            @foreach ($data['rewards']->Rewards as $Reward)
                                <tr>
                                    <td>{{$index}}</td>
                                    <td>{{$data['rewards']->Kills['K'.$index]}}</td>
                                    <td align="center"><div class="RankIcon RankIcon{{$index}}"></div></td>
                                    <td>{{$Reward}}</td>
                                    @if ($data['rewards']->k1 >=$data['rewards']->Kills['K'.$index])
                                        @php
                                            $data['rewards']->validateKills($index);
                                        @endphp
                                        @if($data['rewards']->rowCount==0)
                                            <td class="text-center"><button class="nk-btn nk-btn-color-main-1 open_send_prize_modal" data-toggle="modal" data-id="{{$index}}~{{$Reward}}~{{$data['User']['UserUID']}}" data-target="#get_prize_modal">Redeem Prize</button></td>
                                            @else
                                                <td class="tac">You already redeemed this Prize!</td>
                                        @endif
                                    @else
                                        <td>You need more kills to redeem this Prize!</td>
                                    @endif
                                </tr>
                                @php $index++; @endphp
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
        @Separator(40)
        @Separator(80)
        @include('layouts.cms.footer')
        @php
            Display('get_prize_modal','<i class="fa fa-send"></i>','0','2','Redeem Prize');
        @endphp
    </div>
@endsection