@extends('layouts.ap.app')
@section('index', 'mobList')
@section('title', 'Mob List')
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
              {{$data['logSys']->createLog('Visited World Chat Log')}}
              <div class="main-body">
                <div class="page-wrapper">
                  <div class="row">
                    <div class="col-sm-12">
                      <div class="card align-items-center">
                        <div class="card-header">
                          <h5>Mob List</h5>
                        </div>
                        <div class="card-body">
                          <table class="table table-sm table-striped" id="MobList">
                            <thead>
                              <tr>
                                <th>MobID</th>
                                <th>Mob Name</th>
                                <th>Mob Ele</th>
                                <th>Mob Lvl</th>
                                <th>Mob HP</th>
                              </tr>
                            </thead>
                            <tbody>
                              @if (count($data['mobs']->getMobs()) > 0)
                                @foreach ($data['mobs']->getMobs() as $res)
                                  <tr>
                                    <td>{{$res->MobID}}</td>
                                    <td>{{$res->MobName}}</td>
                                    <td><img src="/resources/themes/core/images/dropfinder/ele_{{$res->Attrib}}.png"></td>
                                    <td>{{$res->Level}}</td>
                                    <td>{{$res->HP}}</td>
                                  </tr>
                                @endforeach
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
            {{redirect('/admin/auth/login')}}
          @endif
        </div>
      </div>
    </div>
  </div>
  <script>
	$(document).ready(function(){
	  $('#MobList').dataTable({
		  "info": false,
			"bLengthChange": false,
			"pageLength": 10,
    });
	});
</script>
@endsection
