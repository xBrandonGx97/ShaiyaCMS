@extends('layouts.ap.app')
@section('index', 'edit')
@section('title', 'Account Edit')
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
              {{-- {{$data['logSys']->createLog('Visited Account Search Page')}} --}}
              <div class="main-body">
                <div class="page-wrapper">
                  <div class="row">
                    <div class="col-sm-12">
                      <div class="card align-items-center">
                        <div class="card-header">
                          <h5>Edit Account</h5>
                        </div>
                        <div class="card-body">
                          @if (isset($_POST['submit']))
                            @if (!empty($data['edit']->userId))
                              @if(count($data['edit']->getUser()) > 0)
                                Current Status of {{$data['edit']->userId}}:
                                <form method="post">
                                  <div class="table-responsive">
                                    <table class="table table-striped">
                                      @foreach ($data['edit']->getUser() as $res)
                                        @foreach ($data['edit']->getColumns() as $value)
                                        <tr>
                                          <th>{{$value}}</th>
                                          @if (in_array($value, $data['edit']->getGreyedColumns()))
                                            <th>
                                              <input type="text" class="form-control" name="{{$value}}" value="{{$res->$value}}" readonly/>
                                            </th>
                                          @else
                                            @if ($value == 'AdminLevel')
                                              <td>
                                                <select class="form-control" name="{{$value}}">
                                                  @for ($lvl = 0; $lvl <= 255; $lvl++)
                                                    @if ($lvl == $res->$value)
                                                      <option value="{{$lvl}}" selected>{{$lvl}}</option>
                                                    @else
                                                      <option value="{{$lvl}}">{{$lvl}}</option>
                                                    @endif
                                                  @endfor
                                                </select>
                                              </td>
                                            @elseif ($value == 'Status')
                                              <td>
                                                <select class="form-control" name="{{$value}}">
                                                  @foreach ($data['edit']->getStatuses() as $s)
                                                    @if ($s == $res->$value)
                                                      <option value="{{$s}}" selected>{{$s}}</option>
                                                    @else
                                                      <option value="{{$s}}">{{$s}}</option>
                                                    @endif
                                                  @endforeach
                                                </select>
                                              </td>
                                            @elseif ($value == 'UserType')
                                              <td>
                                                <select class="form-control" name="{{$value}}">
                                                  @foreach ($data['edit']->getUserTypes() as $t)
                                                    @if ($t == $res->$value)
                                                      <option value="{{$t}}" selected>{{$t}}</option>
                                                    @else
                                                      <option value="{{$t}}">{{$t}}</option>
                                                    @endif
                                                  @endforeach
                                                </select>
                                              </td>
                                            @else
                                              <td>
                                                <input type="text" class="form-control" name="{{$value}}" value="{{$res->$value}}"/>
                                              </td>
                                            @endif
                                          @endif
                                        </tr>
                                        @endforeach
                                      @endforeach
                                    </table>
                                  </div>
                                  <input type="hidden" name="userId" value="{{$data['edit']->userId}}">
                                  <p class="text-center">
                                    <button type="submit" class="btn btn-sm btn-primary" name="submit2">Submit</button>
                                  </p>
                                </form>
                              @else
                                Account not found.
                              @endif
                            @else
                              Account name can not be empty.
                            @endif
                          @elseif (isset($_POST['submit2']))
                            {{$data['edit']->updateUser()}}
                            <br>
                            @foreach ($data['edit']->getUser() as $res)
                              @foreach ($data['edit']->getColumns() as $value)
                                @if (!in_array($value, $data['edit']->getGreyedColumns()))
                                  {{$value}} => {{$data['edit']->getNewValue($value)}}<br>
                                @endif
                              @endforeach
                            @endforeach
                            <p class="text-center">
                              <button type="button" onclick="window.location.href='{{$_SERVER['REQUEST_URI']}}'" class="btn btn-sm btn-primary" name="return">Return back to account edit</button>
                            </p>
                          @else
                            <form method="post">
                              <div class="form-group mx-sm-3 mb-2">
                                <td><input type="text" class="form-control" name="userId" placeholder="Account Name"/></td>
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
