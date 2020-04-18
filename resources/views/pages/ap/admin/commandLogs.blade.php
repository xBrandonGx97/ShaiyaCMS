@extends('layouts.ap.app')
@section('index', 'commandLogs')
@section('title', 'GM Command Logs')
@section('zone', 'AP')
@section('content')
  @include('partials.ap.nav')
  @include('partials.ap.header')
  <div class="pcoded-main-container">
    <div class="pcoded-wrapper">
      <div class="pcoded-content">
        <div class="pcoded-inner-content">
          {{-- is logged in and is staff --}}
          @auth
            @if($data['user']->isStaff())
              {{-- is adm, gm or gma --}}
              @if($data['user']->isADM() || $data['user']->isGM() || $data['user']->isGMA())
                {{$data['logSys']->createLog('Visited Command Logs Page')}}
                <div class="main-body">
                  <div class="page-wrapper">
                    <div class="row">
                      <div class="col-sm-12">
                        <div class="card align-items-center">
                          <div class="card-header">
                            <h5>GM Commands Log</h5>
                          </div>
                          <div class="card-body table-responsive">
                            <table class="table table-striped" id="GmLogs">
                              <thead>
                                <tr>
                                  <th>#</th>
                                  <th>CharName</th>
                                  <th>Map</th>
                                  <th>PosX</th>
                                  <th>PosY</th>
                                  <th>Command</th>
                                  <th>Player Affected</th>
                                  <th>Command Result</th>
                                  <th>Usage Date</th>
                                </tr>
                              </thead>
                              <tbody>
                                @if(count($data['commandLogs']->getCommandLogs()) > 0)
                                  @foreach($data['commandLogs']->getCommandLogs() as $logs)
                                    <tr>
                                      <td>{{$data['commandLogs']->count}}</td>
                                      <td>{{$logs->CharName}}</td>
                                      <td>{{$data['user']->getMap($logs->MapID)}}</td>
                                      <td>{{$logs->PosX}}</td>
                                      <td>{{$logs->PosY}}</td>
                                      <td>{{$logs->Command}}</td>
                                      <td>{{$logs->PlayerAffected}}</td>
                                      <td>{{$logs->CommandResult}}</td>
                                      <td>{{date("m/d/y H:i A", strtotime($logs->ActionTime))}}</td>
                                    </tr>
                                    @php
                                      $data['commandLogs']->count++
                                    @endphp
                                  @endforeach
                                @else
                                  There are currently no logs listed in the database.
                                @endif
                              </tbody>
                            </table>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              @endif
            @else
              {{-- You must be logged in to access the admin dashboard. --}}
              {{-- Sorry, you do not have permission to control the admin panel. --}}
              {{-- {{redirect('/')}} --}}
              {{abort(404)}}
            @endif
          @else
            {{redirect('/admin/auth/login')}}
            {{-- You must be logged in to control the admin panel. --}}
          @endauth
        </div>
      </div>
    </div>
  </div>
  <script>
    $(document).ready(function(){
      $('#GmLogs').dataTable({
        "searching": false,
        "info": false,
        "bLengthChange": false
      });
    });
  </script>
@endsection
