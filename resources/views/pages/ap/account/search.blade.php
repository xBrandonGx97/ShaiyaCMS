@extends('layouts.ap.app')
@section('index', 'search')
@section('title', 'Account Search')
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
              {{$data['logSys']->createLog('Visited Account Search Page')}}
              <div class="main-body">
                <div class="page-wrapper">
                  <div class="row">
                    <div class="col-sm-12">
                      <div class="card align-items-center">
                        <div class="card-header">
                          <h5>Account Search</h5>
                        </div>
                        <div class="card-body">
                          @if (isset($_POST['submit']))
                            @if (!empty($data['search']->userID))
                              @if(count($data['search']->getData()) > 0)
                                Search results: <br>Account: {{$data['search']->userID}}
                                <br>Status: ({{$data['user']->getStatus($data['search']->getUserStatus())}})
                                <table class="table table-dark">
                                  <thead>
                                    <tr>
                                      <th>UserName</th>
                                      <th>Char ID</th>
                                      <th>Char Name</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                  @foreach($data['search']->getData() as $res)
                                    <tr>
                                      <td>{{$data['search']->userID}}</td>
                                      <td>{{$res->CharID}}</td>
                                      <td>{{$res->CharName}}</td>
                                    </tr>
                                  @endforeach
                                  </tbody>
                                </table>
                                <p class="text-center">
                                  <button type="button" onclick="window.location.href='{{$_SERVER['REQUEST_URI']}}'" class="btn btn-sm btn-primary" name="return">Return back to account Search</button>
                                </p>
                              @else
                                There was no accounts found matching your criteria. Please try again.
                              @endif
                            @else
                              Account name can not be empty.
                            @endif
                          @else
                            <form method="post">
                              <div class="form-group mx-sm-3 mb-2">
                                <td><input type="text" class="form-control" name="UserID" placeholder="Account Name"/></td>
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
