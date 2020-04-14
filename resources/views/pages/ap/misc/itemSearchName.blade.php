@extends('layouts.ap.app')
@section('index', 'itemSearchName')
@section('title', 'Item Search')
@section('zone', 'AP')
@section('content')
    @include('partials.ap.nav')
    @include('partials.ap.header')
    <div class="pcoded-main-container">
      <div class="pcoded-wrapper">
        <div class="pcoded-content">
          <div class="pcoded-inner-content">
            {{-- is logged in and is staff --}}
            @auth
              @if($data['user']->isStaff())
                {{-- is adm, gm or gma --}}
                @if($data['user']->isADM() || $data['user']->isGM() || $data['user']->isGMA())
                  {{-- {{$data['logSys']->createLog('Visited World Chat Log')}} --}}
                  <div class="main-body">
                    <div class="page-wrapper">
                      <div class="row">
                        <div class="col-sm-12">
                          <div class="card align-items-center">
                            <div class="card-header">
                              <h5>Item Search By Name</h5>
                            </div>
                            <div class="card-body">
                              @if (isset($_POST['submit']))
                                @if (!empty($data['items']->name))
                                  <table class="table table-striped table-responsive" id="ItmSrch">
                                    <thead>
                                      <tr>
                                        <th>ItemName</th>
                                        <th>ItemID</th>
                                        <th>Type</th>
                                        <th>TypeID</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      @foreach ($data['items']->getItems() as $res)
                                        <tr>
                                          <td>{{$res->ItemName}}</td>
                                          <td>{{$res->ItemID}}</td>
                                          <td>{{$res->Type}}</td>
                                          <td>{{$res->TypeID}}</td>
                                        </tr>
                                      @endforeach
                                    </tbody>
                                  </table>
                                  <p class="text-center">
                                    <button type="button" onclick="window.location.href='{{$_SERVER['REQUEST_URI']}}'" class="btn btn-sm btn-primary" name="return">Return back to item Search</button>
                                  </p>
                                @else
                                  Could not find any results matching the criteria.
                                @endif
                              @else
                                <form method="post">
                                  <div class="form-group mx-sm-3 mb-2">
                                    <input type="text" name="search" class="form-control" placeholder="Search for an Item"/>
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
                  {{abort(404)}}
              @endif
            @else
                {{redirect('/admin/auth/login')}}
            @endauth
          </div>
        </div>
      </div>
    </div>
    {{display('getItemModal','<i class="fa fa-send"></i>', null, null, 'Item Search')}}
    <script>
    $(document).ready(function(){
      $('#ItmSrch').dataTable( {
        "info": false,
        "bLengthChange": false,
        "pageLength": 10
      });
    });
  </script>
@endsection
