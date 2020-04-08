@extends('layouts.ap.app')
@section('index', 'restore')
@section('title', 'Restore Character')
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
                          <h5>Resurrect A Character</h5>
                        </div>
                        <div class="card-body">
                          @if (isset($_POST['submit']))
                            @if (!empty($data['restore']->userID))
                              @if (count($data['restore']->getDeadChars()) > 0)
                                <form method="post">
                                  <span>Select Character To Resurrect :</span>
                                  <input type="hidden" name="username" value="{{$data['restore']->userID}}">
                                  <table class="table table-striped">
                                    <thead>
                                      <tr>
                                        <th>Select</th>
                                        <th>CharName</th>
                                        <th>Class</th>
                                        <th>Level</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      @foreach ($data['restore']->getDeadChars() as $res)
                                        @if ($res->Country == 0)
                                          @if ($res->Family == 0 || $res->Family == 1)
                                            <tr>
                                              <td>
                                                <input type="radio" name ="char" value="{{$res->CharName}},{{$res->CharID}}">
                                              </td>
                                              <td>{{$res->CharName}}</td>
                                              <td>{{$data['user']->getClass($res->Country,$res->Job)}}</td>
                                              <td>{{$res->Level}}</td>
                                            </tr>
                                          @endif
                                        @elseif ($res->Country == 1)
                                          @if ($res->Family == 2 || $res->Family == 3)
                                            <tr>
                                              <td>
                                                <input type="radio" name ="char" value="{{$res->CharName}},{{$res->CharID}}">
                                              </td>
                                              <td>{{$res->CharName}}</td>
                                              <td>{{$data['user']->getClass($res->Country,$res->Job)}}</td>
                                              <td>{{$res->Level}}</td>
                                            </tr>
                                          @endif
                                        @endif
                                      @endforeach
                                    </tbody>
                                  </table>
                                  <p class="text-center">
                                    <button type="submit" class="btn btn-sm btn-primary" name="submit2">Submit</button>
                                  </p>
                                </form>
                              @else
                                Account does not contain any dead chars.
                              @endif
                            @endif
                          @elseif (isset($_POST['submit2']))
                            @if ($data['restore']->getSlot()[0]->OpenSlot > -1 && $data['restore']->getSlot()[0]->OpenSlot < 5)
                              {{$data['restore']->updateRestore()}}
                            @else
                              No slots available.
                            @endif
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
