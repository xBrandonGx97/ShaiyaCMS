@extends('layouts.ap.app')
@section('index', 'bannedUsers')
@section('title', 'Banned Users')
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
              {{$data['logSys']->createLog('Visited Banned Users Page')}}
              <div class="main-body">
                <div class="page-wrapper">
                  <div class="row">
                    <div class="col-sm-12">
                      <div class="card align-items-center">
                        <div class="card-header">
                          <h5>Banned Accounts</h5>
                        </div>
                        <div class="card-body">
                          @if(count($data['banned']->getBannedUsers()) > 0)
                            <table class="table table-dark">
                              <thead>
                                <tr>
                                  <th>CharName</th>
                                  <th>Reason</th>
                                  <th>Duration</th>
                                  <th>Banned By</th>
                                  <th>Date</th>
                                  <th>Unban Date</th>
                                  <th>Ban Status</th>
                                </tr>
                              </thead>
                              <tbody>
                              @foreach($data['banned']->getBannedUsers() as $res)
                                <tr>
                                  <td>{{$data['data']->purify($res->CharName)}}</td>
                                  <td>{{$data['data']->purify($res->Reason)}}</td>
                                  <td>{{$res->Duration}}</td>
                                  <td>{{$res->BannedBy}}</td>
                                  <td>{{date("d/m/Y g:i:s A", strtotime($res->BanDate))}}</td>

                                  @if ($res->Duration === 'permanent')
                                    <td>&infin;</td>
                                    <td>&#10006;</td>
                                  @elseif (time() >= strtotime('+'.str_replace('s', '', $res->Duration), strtotime($res->BanDate)))
                                    <td>{{date("d/m/Y g:i:s A", strtotime('+'.str_replace('s', '', $res->Duration), strtotime($res->BanDate)))}}</td>
                                    <td>&#10003;</td>
                                  @else
                                    <td>{{date("d/m/Y g:i:s A", strtotime('+'.str_replace('s', '', $res->Duration), strtotime($res->BanDate)))}}</td>
                                    <td>&#10006;</td>
                                  @endif
                                </tr>
                              @endforeach
                              @else
                                There are currently no banned users.
                              </tbody>
                            </table>
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
