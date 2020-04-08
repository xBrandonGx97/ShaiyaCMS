@extends('layouts.ap.app')
@section('index', 'itemEdit')
@section('title', 'Item Edit')
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
                          <h5>Edit Player Items</h5>
                        </div>
                        <div class="card-body">
                          @if (isset($_POST['submit']))
                            @if (!empty($data['item']->userId))
                              @if (count($data['item']->getChar()) > 0)
                                <form method="post">
                                  <div class="table-responsive">
                                    <table class="table table-dark">
                                      <thead>
                                        <tr>
                                          <th>CharName</th>
                                          <th>Select</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                        @foreach ($data['item']->getChar() as $res)
                                          <tr>
                                            <td>{{$res->CharName}}</td>
                                            <td><input type="radio" name="CharID" value="{{$res->CharID}}"></td>
                                          </tr>
                                        @endforeach
                                      </tbody>
                                    </table>
                                  </div>
                                  <p class="text-center">
                                    <button type="submit" class="btn btn-sm btn-primary" name="submit2">Submit</button>
                                  </p>
                                </form>
                              @else
                                Character doesn't exist. Please try again.
                              @endif
                            @else
                              Character name can not be empty.
                            @endif
                          @elseif (isset($_POST['submit2']))
                            @if (!empty($data['item']->charId))
                              @if (count($data['item']->getItems()) > 0)
                                <form method="post">
                                  <div class="table-responsive">
                                    <table class="table table-striped">
                                      <thead>
                                        <tr>
                                          <th>ItemName</th>
                                          <th>Bag</th>
                                          <th>Slot</th>
                                          <th>Count</th>
                                          <th>Select</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                        @foreach ($data['item']->getItems() as $res)
                                          <tr>
                                            <td>{{$res->ItemName}}</td>
                                            <td>{{$data['item']->getBag($res->Bag)}}</td>
                                            <td>{{$res->Slot}}</td>
                                            <td>{{$res->Count}}</td>
                                            <td><input type="radio" name="ItemUID" value="{{$res->ItemUID}}"></td>
                                          </tr>
                                        @endforeach
                                      </tbody>
                                    </table>
                                  </div>
                                  <input type="hidden" name="CharID" value="{{$data['item']->charId}}">
                                  <p class="text-center">
                                    <button type="submit" class="btn btn-sm btn-primary" name="submit3">Submit</button>
                                  </p>
                                </form>
                              @else
                                Could not find any items matching your provided character information.
                              @endif
                            @else
                              You must select a character!
                            @endif
                          @elseif (isset($_POST['submit3']))
                            @if (count($data['item']->getItemInfo()) > 0)
                              <form method="post">
                                <div class="table-responsive">
                                  <table class="table table-striped">
                                    @foreach ($data['item']->getItemInfo() as $res)
                                      @foreach ($data['item']->getColumns() as $value)
                                        <tr>
                                          <th>{{$value}}</th>
                                          @if (in_array($value, $data['item']->getGreyedColumns()))
                                            <th>
                                              <input type="text" class="form-control" name="{{$value}}" value="{{$res->$value}}" readonly/>
                                            </th>
                                          @else
                                            @if ($value == 'Enchant')
                                              <td>
                                                <select class="form-control" name="{{$value}}">
                                                  <option value="00">00</option>
                                                  @if (in_array($res->Type, $data['item']->getGearTypes()))
                                                    @for ($e = 50; $e <= 70; $e++)
                                                      @if ($e == $res->$value)
                                                        <option value="{{$e}}" selected>{{$e}}</option>
                                                      @else
                                                        <option value="{{$e}}">{{$e}}</option>
                                                      @endif
                                                    @endfor
                                                  @else
                                                    @for($a=1;$a <= 20; $a++)
                                                      @if ($a == $res->$value)
                                                        <option value="{{$a}}" selected>{{$a}}</option>
                                                      @else
                                                        <option value="{{$a}}">{{$a}}</option>
                                                      @endif
                                                    @endfor
                                                  @endif
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
                                <input type="hidden" name="CharID" value="{{$data['item']->charId}}">
                                <p class="text-center">
                                  <button type="submit" class="btn btn-sm btn-primary" name="submit4">Submit</button>
                                </p>
                              </form>
                            @else
                              Failed to fetch item data.
                            @endif
                          @elseif (isset($_POST['submit4']))
                            {{$data['item']->updateItem()}}
                            <br>
                            @foreach ($data['item']->getItemInfo() as $res)
                              @foreach ($data['item']->getColumns() as $value)
                                @if (!in_array($value, $data['item']->getGreyedColumns()))
                                  {{$value}} => {{$data['item']->getNewValue($value)}}<br>
                                @endif
                              @endforeach
                            @endforeach
                            <p class="text-center">
                              <button type="button" onclick="window.location.href='{{$_SERVER['REQUEST_URI']}}'" class="btn btn-sm btn-primary" name="return">Return back to item edit</button>
                            </p>
                          @else
                            <form method="post">
                              <div class="form-group mx-sm-3 mb-2">
                                <input type="text" class="form-control" placeholder="Character name" name="userId">
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
