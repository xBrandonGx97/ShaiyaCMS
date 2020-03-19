@extends('layouts.app')
@section('title', 'PvP Rewards')
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
        <div class="container text-xs-center">
            <div class="nk-gap-6"></div>
            <div class="nk-gap-2"></div>
            <div class="container">
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
        </div>
        @php Separator(120); @endphp
        @php
            Display('get_prize_modal','<i class="fa fa-send"></i>','0','2','Redeem Prize');
        @endphp
    </div>
@endsection