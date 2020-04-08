@extends('layouts.ap.app')
@section('index', 'itemList')
@section('title', 'Item List')
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
              {{$data['logSys']->createLog('Visited World Chat Log')}}
              <div class="main-body">
                <div class="page-wrapper">
                  <div class="row">
                    <div class="col-sm-12">
                      <div class="card align-items-center">
                        <div class="card-header">
                          <h5>Item List</h5>
                        </div>
                        <div class="card-body">
                          <table class="table table-sm table-striped" id="ItemList">
                            <thead>
                              <tr>
                                <th>ItemID</th>
                                <th>ItemName</th>
                                <th>Type</th>
                                <th>TypeID</th>
                                <th>Requierd Level</th>
                                <th>Country</th>
                                <th>Fight/War</th>
                                <th>Def/Guard</th>
                                <th>Ranger/Sin</th>
                                <th>Archer/Hunter</th>
                                <th>Mage/Pag</th>
                                <th>Priest/Orc</th>
                                <th>Max O.J.Stats</th>
                                <th>Count Per Stack</th>
                              </tr>
                            </thead>
                            <tbody>
                              @if (count($data['items']->getItems()) > 0)
                                @foreach ($data['items']->getItems() as $res)
                                  <tr>
                                    <td>{{$res->ItemID}}</td>
                                    <td>{{$res->ItemName}}</td>
                                    <td>{{$res->Type}}</td>
                                    <td>{{$res->TypeID}}</td>
                                    <td>{{$res->Reqlevel}}</td>
                                    <td>{{$res->Country}}</td>
                                    <td>{{$res->Attackfighter}}</td>
                                    <td>{{$res->Defensefighter}}</td>
                                    <td>{{$res->Patrolrogue}}</td>
                                    <td>{{$res->Shootrogue}}</td>
                                    <td>{{$res->Attackmage}}</td>
                                    <td>{{$res->Defensemage}}</td>
                                    <td>{{$res->ReqWis}}</td>
                                    <td>{{$res->Count}}</td>
                                  </tr>
                                @endforeach
                              @endif
                            </tbody>
                          </table>
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
  <script>
	$(document).ready(function(){
	  $('#ItemList').dataTable({
		  "info": false,
			"bLengthChange": false,
			"pageLength": 15,
    });
	});
</script>
@endsection
