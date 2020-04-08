@extends('layouts.ap.app')
@section('index', 'edit')
@section('title', 'Edit Player')
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
                          <h5>Edit Player</h5>
                        </div>
                        <div class="card-body">
                          @if (isset($_POST['submit']))
                            @if (!empty($data['edit']->userId))
                              @if (count($data['edit']->getUser()) > 0)
                                @if ($data['edit']->getLoginStatus() === 1)
                                  Current Status of {{$data['edit']->userId}}: <span style="color: lime;">Online</span>
                                @else
                                  Current Status of {{$data['edit']->userId}}: <span style="color: red;">Offline</span>
                                @endif
                                <form method="post">
                                  <div class="table-responsive">
                                    <table class="table table-striped">
                                      <thead>
                                        <tr>
                                          <th>#</th>
                                          <th>Name</th>
                                          <th>Value</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                        @foreach ($data['edit']->getUser() as $res)
                                          @foreach ($data['edit']->getColumns() as $value)
                                            <tr>
                                              <td>{{$data['edit']->getCount()}}</td>
                                              <td>{{$value}}</td>
                                              @if (in_array($value, $data['edit']->getGreyedColumns()))
                                                <td>
                                                  <input type="text" class="form-control" name="{{$value}}" value="{{$res->$value}}" readonly/>
                                                </td>
                                              @else
                                                <td>
                                                  <input type="text" class="form-control" name="{{$value}}" value="{{$res->$value}}"/>
                                                </td>
                                              @endif
                                            </tr>
                                            {{$data['edit']->updateCount()}}
                                          @endforeach
                                        @endforeach
                                      </tbody>
                                    </table>
                                  </div>
                                  <p class="text-center">
                                    <button type="submit" class="btn btn-sm btn-primary" name="submit2">Submit</button>
                                  </p>
                                  <input type="hidden" name="userId" value="{{$data['edit']->userId}}"/>
                                </form>
                              @else
                                Character doesn't exist. Please try again.
                              @endif
                            @else
                              Character name can not be empty.
                            @endif
                          @elseif (isset($_POST['submit2']))
                            @foreach ($data['edit']->getUser() as $res)
                              @foreach ($data['edit']->getColumns() as $value)
                                @if (!in_array($value, $data['edit']->getGreyedColumns()))
                                  {{$data['edit']->updateColumns($value, $data['edit']->getNewValue($value))}}
                                  {{$value}} => {{$data['edit']->getNewValue($value)}}<br>
                                @endif
                              @endforeach
                            @endforeach
                            <p class="text-center">
                              <button type="button" onclick="window.location.href='{{$_SERVER['REQUEST_URI']}}'" class="btn btn-sm btn-primary" name="return">Return back to Edit Player</button>
                            </p>
                          @else
                            <form method="post">
                              <div class="form-group mx-sm-3 mb-2">
                                <input type="text" class="form-control" placeholder="Advanced search" name="userId">
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
