@extends('layouts.ap.app')
@section('index', 'statPadders')
@section('title', 'Stat Padders')
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
              {{-- {{$data['logSys']->createLog('Visited Online Players Log')}} --}}
              <div class="main-body">
                <div class="page-wrapper">
                  <div class="row">
                    <div class="col-sm-12">
                      <div class="card align-items-center">
                        <div class="card-header">
                          <h5>Possible Stat Padders</h5>
                        </div>
                        <div class="card-body">
                          @if (count($data['stat']->getStatPadders()) > 0)
                            <div class="table-responsive">
                              <table class="table table-striped">
                                <thead>
                                  <tr>
                                    <th>Killer's Toon</th>
                                    <th>Killer's IP</th>
                                    <th>Killer's ID</th>
                                    <th>Times Killed</th>
                                    <th>Dead Toon</th>
                                    <th>Dead Toon's IP</th>
                                    <th>Dead Toon's ID</th>
                                    <th>Date</th>
                                    <th>Map</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  @foreach ($data['stat']->getStatPadders() as $res)
                                    <tr>
                                      <td>{{$res->KillerToon}}</td>
                                      <td>{{$res->KillerIP}}</td>
                                      <td>{{$res->KillerID}}</td>
                                      <td>{{$res->TimesKilled}}</td>
                                      <td>{{$res->DeadToon}}</td>
                                      <td>{{$res->DeadIP}}</td>
                                      <td>{{$res->DeadID}}</td>
                                      <td>{{date("M d, Y H:i:s A", strtotime($res->Date))}}</td>
                                      <td>{{$data['user']->getMap($res->Map)}}</td>
                                    </tr>
                                  @endforeach
                                </tbody>
                              </table>
                            </div>
                          @else
                            No possible stat padders have been found.
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
