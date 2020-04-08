@extends('layouts.ap.app')
@section('index', 'linkedGear')
@section('title', 'Linked Gear')
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
                          <h5>View Gear Links of Character</h5>
                        </div>
                        <div class="card-body">
                          @if (isset($_POST['submit']))
                            @if (!empty($data['player']->userId))
                              @if (count($data['player']->getItems()) > 0)
                                <span>Current Links In Equipped Gear Of: {{$data['player']->userId}}</span>
                                <table class="table table-striped">
                                  <thead>
                                    <tr>
                                      <th>ItemName</th>
                                      <th>ItemUID</th>
                                      <th>Lapis Slot 1</th>
                                      <th>Lapis Slot 2</th>
                                      <th>Lapis Slot 3</th>
                                      <th>Lapis Slot 4</th>
                                      <th>Lapis Slot 5</th>
                                      <th>Lapis Slot 6</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    @foreach ($data['player']->getItems() as $res)
                                      <tr>
                                        <td>{{$res->ItemName}}</td>
                                        <td>{{$res->ItemUID}}</td>
                                        <td>
                                          {{(int)$res->Gem1 !== 0 ? $data['player']->lapisIdToName($res->Gem1) : 'Empty Slot'}}
                                        </td>
                                        <td>
                                          {{(int)$res->Gem2 !== 0 ? $data['player']->lapisIdToName($res->Gem2) : 'Empty Slot'}}
                                        </td>
                                        <td>
                                          {{(int)$res->Gem3 !== 0 ? $data['player']->lapisIdToName($res->Gem3) : 'Empty Slot'}}
                                        </td>
                                        <td>
                                          {{(int)$res->Gem4 !== 0 ? $data['player']->lapisIdToName($res->Gem4) : 'Empty Slot'}}
                                        </td>
                                        <td>
                                          {{(int)$res->Gem5 !== 0 ? $data['player']->lapisIdToName($res->Gem5) : 'Empty Slot'}}
                                        </td>
                                        <td>
                                          {{(int)$res->Gem6 !== 0 ? $data['player']->lapisIdToName($res->Gem6) : 'Empty Slot'}}
                                        </td>
                                      </tr>
                                    @endforeach
                                  </tbody>
                                </table>
                                <p class="text-center">
                                  <button type="button" onclick="window.location.href='{{$_SERVER['REQUEST_URI']}}'" class="btn btn-sm btn-primary" name="return">Return back to Linked Gear</button>
                                </p>
                              @else
                                Character doesn't exist. Please try again.
                              @endif
                            @else
                              Character name can not be empty.
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
