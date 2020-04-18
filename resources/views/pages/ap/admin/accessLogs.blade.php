@extends('layouts.ap.app')
@section('index', 'accessLogs')
@section('title', 'Access Logs')
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
                {{-- {{$data['logSys']->createLog('Visited Access Logs Page')}} --}}
                <div class="main-body">
                  <div class="page-wrapper">
                    <div class="row">
                      <div class="col-sm-12">
                        <div class="card align-items-center">
                          <div class="card-header">
                            <h5>Admin Panel Access Logs</h5>
                          </div>
                          <div class="card-body table-responsive">
                            @if(count($data['accessLogs']->getAccessLogs()) > 0)
                              <table class="table table-striped" id="AccessLogs">
                                <thead>
                                  <tr>
                                    <th>#</th>
                                    <th>UserID</th>
                                    <th>UserIP</th>
                                    <th>Action</th>
                                    <th>Action Time</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  @foreach($data['accessLogs']->getAccessLogs() as $logs)
                                    <tr>
                                      <td>{{$data['accessLogs']->count}}</td>
                                      <td>{{$logs->UserID}}</td>
                                      <td>{{$logs->UserIP}}</td>
                                      <td>{{$logs->Action}}</td>
                                      <td>{{date("m/d/y H:i A", strtotime($logs->ActionTime))}}</td>
                                    </tr>
                                    @php
                                      $data['accessLogs']->count++
                                    @endphp
                                  @endforeach
                                </tbody>
                              </table>
                            @else
                              <p class="text-center">There are currently no access logs.</p>
                            @endif
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
	  $('#AccessLogs').dataTable({
		  "searching": false,
			"info": false,
			"bLengthChange": false
    });
	});
</script>
@endsection
