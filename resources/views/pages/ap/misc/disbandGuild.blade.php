@extends('layouts.ap.app')
@section('index', 'disbandGuild')
@section('title', 'Disband Guild')
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
                          <h5>Disband Guild</h5>
                        </div>
                        <div class="card-body">
                          @if (isset($_POST['submit']))
                            @if (!empty($data['guild']->guildName))
                              @if (count($data['guild']->checkGuild()) > 0)
                                  <form method="post">
                                    <table class="table table-striped">
                                      <thead>
                                        <tr>
                                          <th>GuildName</th>
                                          <th>Select</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                        @foreach ($data['guild']->checkGuild() as $res)
                                          <tr>
                                            <td>{{$res->GuildName}}</td>
                                            <td><input type="radio" name="GuildID" value="{{$res->GuildID}}"></td>
                                          </tr>
                                        @endforeach
                                      </tbody>
                                    </table>
                                    <p class="text-center">
                                      <button type="submit" class="btn btn-sm btn-primary" name="submit2">Submit</button>
                                    </p>
                                  </form>
                              @else
                                Could not find a guild matching your search query.
                                <br>
                                Make sure the guild is not already deleted.
                              @endif
                            @else
                              Guild name can not be empty.
                            @endif
                          @elseif (isset($_POST['submit2']))
                            @if (!empty($data['guild']->guildId))
                              @if (count($data['guild']->getGuildData()) > 0)
                                <form method="post">
                                  <table class="table table-striped">
                                    <thead>
                                      <tr>
                                        <th>GuildID</th>
                                        <th>GuildName</th>
                                        <th>MasterUserID</th>
                                        <th>MasterName</th>
                                        <th>Country</th>
                                        <th>Select</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      @foreach ($data['guild']->getGuildData() as $res)
                                        <tr>
                                          <td>{{$res->GuildID}}</td>
                                          <td>{{$res->GuildName}}</td>
                                          <td>{{$res->MasterUserID}}</td>
                                          <td>{{$res->MasterName}}</td>
                                          <td>{{$res->Country}}</td>
                                          <td><input type="radio" name="GuildID" value="{{$res->GuildID}}"></td>
                                        </tr>
                                      @endforeach
                                    </tbody>
                                  </table>
                                  <p class="text-center">
                                    <button type="submit" class="btn btn-sm btn-primary" name="submit3">Submit</button>
                                  </p>
                                </form>
                              @else
                                Search returned no results.
                              @endif
                            @else
                              You didn't select a guild!
                            @endif
                          @elseif (isset($_POST['submit3']))
                            <form method="post">
                              <div class="table-responsive">
                                <table class="table table-striped">
                                  @foreach ($data['guild']->getGuildData() as $res)
                                    @foreach ($data['guild']->getColumns() as $value)
                                      <tr>
                                        <th>{{$value}}</th>
                                        <th>
                                          <input type="text" class="form-control" name="{{$value}}" value="{{$res->$value}}" readonly/>
                                        </th>
                                      </tr>
                                    @endforeach
                                  @endforeach
                                </table>
                              </div>
                              <p class="text-center">
                                <button type="submit" class="btn btn-sm btn-primary" name="submit4">Disband Guild</button>
                              </p>
                            </form>
                          @elseif (isset($_POST['submit4']))
                            {{$data['guild']->disbandGuild()}}
                            <p class="text-center">
                              <button type="button" onclick="window.location.href='{{$_SERVER['REQUEST_URI']}}'" class="btn btn-sm btn-primary" name="return">Return back to disband guild</button>
                            </p>
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
