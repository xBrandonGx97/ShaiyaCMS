@extends('layouts.ap.app')
@section('index', 'guildSearch')
@section('title', 'Guild Search')
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
              {{-- {{$data['logSys']->createLog('Visited World Chat Log')}} --}}
              <div class="main-body">
                <div class="page-wrapper">
                  <div class="row">
                    <div class="col-sm-12">
                      <div class="card align-items-center">
                        <div class="card-header">
                          <h5>Find Players Within A Guild</h5>
                        </div>
                        <div class="card-body">
                          @if (isset($_POST['submit']))
                            @if (!empty($data['guild']->guildName))
                              @if (count($data['guild']->getGuildData()) > 0)
                                Characters Found in Guild {{$data['guild']->guildName}}:
                                <table class="table table-striped" id="guildSearch">
                                  <thead>
                                    <tr>
                                      <th>Guild Name</th>
                                      <th>Rank</th>
                                      <th>Character Name</th>
                                      <th>Join Date</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                  @foreach ($data['guild']->getGuildData() as $res)
                                    <tr>
                                      <td>{{$res->GuildName}}</td>
                                      <td>{{$res->GuildLevel}}</td>
                                      <td>{{$res->CharName}}</td>
                                      <td>{{date('m/d/Y g:i:s A', strtotime($res->JoinDate))}}</td>
                                    </tr>
                                  @endforeach
                                  </tbody>
                                </table>
                                <p class="text-center">
                                  <button type="button" onclick="window.location.href='{{$_SERVER['REQUEST_URI']}}'" class="btn btn-sm btn-primary" name="return">Return back to guild Search</button>
                                </p>
                              @else
                                No guild matching your criteria was found.
                              @endif
                            @else
                              Guild name can not be empty.
                            @endif
                          @else
                            <form method="post">
                              <div class="form-group mx-sm-3 mb-2">
                                <input type="text" name="Guild" class="form-control" placeholder="Guild Name"/>
                              </div>
                              <p class="text-center">
                                <button type="submit" class="btn btn-sm btn-primary" name="submit">Submit</button>
                              </p>
                            </form>
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
  <script>
	$(document).ready(function(){
	  $('#guildSearch').dataTable({
      "searching": false,
		  "info": false,
			"bLengthChange": false,
			"pageLength": 10,
    });
	});
</script>
@endsection
