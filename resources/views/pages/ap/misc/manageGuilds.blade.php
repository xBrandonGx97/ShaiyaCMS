@extends('layouts.ap.app')
@section('index', 'manageGuilds')
@section('title', 'Manage Guilds')
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
                          <h5>Manage Guilds</h5>
                        </div>
                        <div class="card-body">
                          @if (isset($_POST['submit']))
                            {!!$data['guild']->updateGuild()!!}
                          @endif
                          @if (count($data['guild']->getGuildData()) > 0)
                            <table class="table table-striped" id="guilds">
                              <thead>
                                <tr>
                                  <th>Rank</th>
                                  <th>GuildName</th>
                                  <th>Master</th>
                                  <th>Faction</th>
                                  <th>GuildPoint</th>
                                  <th>GuildHouse</th>
                                  <th>Etin</th>
                                  <th>Remark</th>
                                  <th>CreateDate</th>
                                  <th>Action</th>
                                </tr>
                              </thead>
                              <tbody>
                                @foreach ($data['guild']->getGuildData() as $res)
                                  <form method="post">
                                    <tr>
                                      <td>{{$res->Rank}}</td>
                                      <td>
                                        <input type="text" class="form-control" name="guildName" value="{{$res->GuildName}}"/>
                                      </td>
                                      <td>
                                        <select name="guildMaster" class="form-control">
                                          @foreach ($data['guild']->getGuildCharsByGuild($res->GuildID) as $chars)
                                            <option value="{{$chars->UserID}},{{$chars->CharID}},{{$chars->CharName}}">[{{$chars->GuildLevel}}]{{$chars->CharName}}</option>
                                          @endforeach
                                        </select>
                                      </td>
                                      <td>{{$data['user']->getFaction($res->Country)}}</td>
                                      <td>{{$res->GuildPoint}}</td>
                                      <td>
                                        <input type="text" class="form-control" name="guildHouse" value="{{$res->BuyHouse}}"/>
                                      </td>
                                      <td>
                                        <input type="text" class="form-control" name="guildEtin" value="{{$res->Etin}}"/>
                                      </td>
                                      <td><textarea class="form-control" name="remark">{{$res->Remark}}</textarea></td>
                                      <td>{{date("M d, Y", strtotime($res->CreateDate))}}</td>
                                      <td>
                                        <button type="submit" class="btn btn-sm btn-primary" name="submit" value="{{$res->GuildID}}">
                                          Update
                                        </button>
                                      </td>
                                    </tr>
                                  </form>
                                @endforeach
                              </tbody>
                            </table>
                          @else
                            There are no guilds to display.
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
	  $('#guilds').dataTable({
      "searching": false,
		  "info": false,
			"bLengthChange": false,
			"pageLength": 10,
    });
	});
</script>
@endsection
