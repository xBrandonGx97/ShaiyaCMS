@extends('layouts.ap.app')
@section('index', 'guildLeaderChange')
@section('title', 'Guild Leader Change')
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
                          <h5>Guild Leader Change</h5>
                        </div>
                        <div class="card-body">
                          @if (isset($_POST['submit']))
                            @if (!empty($data['guild']->guildName))
                              @if (count($data['guild']->getGuildData()) > 0)
                                <form method="post">
                                  Select New Leader:
                                  <input type="hidden" name="guild" value="{{$data['guild']->guildName}}">
                                  <div class="form-group mx-sm-3 mb-2">
                                    <select name="newlead" class="form-control" width="100" style="width:100%">
                                      @foreach($data['guild']->getGuildData() as $res)
                                        <option value="{{$res->UserUID. ',' . $res->UserID. ',' . $res->CharName. ',' . $res->CharID}}">{{$res->CharName}}</option>
                                      @endforeach
                                      <input type="hidden" name="guild-id" value="{{$res->GuildID}}">
                                      <input type="hidden" name="oldlead" value="{{$res->MasterName}}">
                                    </select>
                                  </div>
                                  <p class="text-center">
                                    <button type="submit" class="btn btn-sm btn-primary" name="submit2">Submit</button>
                                  </p>
                                </form>
                              @else
                                No guild matching your criteria was found or there are no officers in your guild.
                              @endif
                            @else
                              Guild name can not be empty.
                            @endif
                          @elseif (isset($_POST['submit2']))
                            Guild = {{$data['guild']->guildName}}<br>
                            Old Leader = {{$data['guild']->oldGuildLeader}}<br>
                            New Leader = {{$data['guild']->newGuildLeader[2]}}
                            {{$data['guild']->runGuildLeaderChange()}}
                          @else
                            <form method="post">
                              <div class="form-group mx-sm-3 mb-2">
                                <input type="text" class="form-control" placeholder="Guild Name" name="guild"/>
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
@endsection
