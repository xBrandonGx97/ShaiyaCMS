@extends('layouts.ap.app')
@section('index', 'ipSearch')
@section('title', 'IP Search')
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
              {{$data['logSys']->createLog('Visited Account IP Search Page')}}
              <div class="main-body">
                <div class="page-wrapper">
                  <div class="row">
                    <div class="col-sm-12">
                      <div class="card align-items-center">
                        <div class="card-header">
                          <h5>Account IP Search</h5>
                        </div>
                        <div class="card-body">
                          @if (isset($_POST['submit']))
                            @if (!empty($data['search']->charName))
                              @if(count($data['search']->getCharIp()) > 0)
                                <form method="post">
                                  <div class="table-responsive">
                                    <table class="table table-dark" id="dataTable" width="100%" cellspacing="0">
                                      <thead>
                                        <tr>
                                          <th>Account Name</th>
                                          <th>UserUID</th>
                                          <th>Select</th>
                                          <th>IP</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                        @if(count($data['search']->getUsersByIp()) > 0)
                                          @foreach($data['search']->getUsersByIp() as $fet)
                                            <tr>
                                              <td>{{$fet->UserID}}</td>
                                              <td>{{$fet->UserUID}}</td>
                                              <td>
                                                <input type="radio" name="CharID" value="{{$fet->UserUID}}">
                                              </td>
                                              <td>{{$fet->UserIp}}</td>
                                            </tr>
                                          @endforeach
                                        @endif
                                      </tbody>
                                    </table>
                                  </div>
                                  <p class="text-center">
                                    <button type="submit" class="btn btn-sm btn-primary" name="submit2">Submit</button>
                                    <button type="button" onclick="window.location.href='{{$_SERVER['REQUEST_URI']}}'" class="btn btn-sm btn-primary" name="return">Return back to account IP Search</button>
                                  </p>
                                </form>
                              @else
                                No accounts found.
                              @endif
                            @else
                              Character name can not be empty.
                            @endif
                          @elseif (isset($_POST['submit2']))
                            @if (!empty($data['search']->charID))
                              @if(count($data['search']->getCharFromIpSearch()) > 0)
                                <form method="post">
                                  <div class="table-responsive">
                                    <table class="table table-dark">
                                      <thead>
                                        <tr>
                                          <th>CharName</th>
                                          <th>Slot</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                      @foreach($data['search']->getCharFromIpSearch() as $data)
                                        <tr>
                                          <td>{{$data->CharName}}</td>
                                          <td>{{$data->Slot}}</td>
                                        </tr>
                                      @endforeach
                                      </tbody>
                                    </table>
                                  </div>
                                </form>
                                <p class="text-center">
                                  <button type="button" onclick="window.location.href='{{$_SERVER['REQUEST_URI']}}'" class="btn btn-sm btn-primary" name="return">Return back to account IP Search</button>
                                </p>
                              @else
                                No characters found.
                              @endif
                            @else
                              Character id can not be empty.
                            @endif
                          @else
                            <form method="post">
                              <div class="form-group mx-sm-3 mb-2">
                                <input type="text" name="CharName" placeholder="Character Name" class="form-control">
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
