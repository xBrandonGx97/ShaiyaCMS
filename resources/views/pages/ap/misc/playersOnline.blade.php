@extends('layouts.ap.app')
@section('index', 'playersOnline')
@section('title', 'Players Online')
@section('zone', 'AP')
@section('content')
  @include('partials.ap.nav')
  @include('partials.ap.header')
  <div class="pcoded-main-container">
    <div class="pcoded-wrapper">
      <div class="pcoded-content">
        <div class="pcoded-inner-content">
          {{-- is logged in and is staff --}}
          @if($data['user']->isAuthorized())
            {{-- is adm, gm or gma --}}
            @if($data['user']->isADM() || $data['user']->isGM() || $data['user']->isGMA())
              {{$data['logSys']->createLog('Visited Online Players Log')}}
              <div class="main-body">
                <div class="page-wrapper">
                  <div class="row">
                    <div class="col-sm-12">
                      <div class="card align-items-center">
                        <div class="card-header">
                          <h5>Online Players</h5>
                        </div>
                        <div class="card-body">
                          @if(count($data['players']->getPlayersOnline()) > 0)
                            @if(count($data['players']->getPlayersCount()) > 0)
                              @foreach($data['players']->getPlayersCount() as $online)
                                <p class="text-center">{{$online->Light}} Light Players Online || {{$online->Fury}} Fury Players Online</p>
                              @endforeach
                            @endif
                            <table class="table table-striped">
                              <thead>
                                <tr>
                                  <th>Count</th>
                                  <th>Character</th>
                                  <th>Level</th>
                                  <th>Location</th>
                                  <th>PosX</th>
                                  <th>PosY</th>
                                  <th>Faction</th>
                                  <th>User IP</th>
                                </tr>
                              </thead>
                              <tbody>
                                @foreach($data['players']->getPlayersOnline() as $res)
                                  <tr>
                                    <td>{{$data['players']->count}}</td>
                                    <td>{{$res->CharName}}</td>
                                    <td>{{$res->Level}}</td>
                                    <td>{{$data['user']->getMap($res->Map)}}</td>
                                    <td>{{$res->PosX}}</td>
                                    <td>{{$res->PosY}}</td>
                                    <td>{{$data['user']->getFaction($res->Faction)}}</td>
                                    <td>{{$res->UserIp}}</td>
                                  </tr>
                                  @php
                                    $data['players']->count++
                                  @endphp
                                @endforeach
                              </tbody>
                            </table>
                          @else
                            There are currently no players online.
                          @endif
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            @endif
          @else
            {{redirect('/admin/auth/login')}}
          @endif
        </div>
      </div>
    </div>
  </div>
@endsection
