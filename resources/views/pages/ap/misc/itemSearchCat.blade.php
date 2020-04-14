@extends('layouts.ap.app')
@section('index', 'itemSearchCat')
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
          @if($data['user']->isAuthorized())
            {{-- is adm, gm or gma --}}
            @if($data['user']->isADM() || $data['user']->isGM() || $data['user']->isGMA())
              {{-- {{$data['logSys']->createLog('Visited World Chat Log')}} --}}
              <div class="main-body">
                <div class="page-wrapper">
                  <div class="row">
                    <div class="col-sm-12">
                      <div class="card">
                        <div class="card-header text-center m-auto">
                          <h5>Item Search By Category</h5>
                        </div>
                        <div class="card-body">
                          @if (isset($_POST['submit']))
                            @if (count($data['items']->getItems()) > 0)
                              <table class="table table-striped" id="ItmSrch">
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
                              <div class="col-md-3 m-auto">
                                <div class="form-group mx-sm-3 mb-2">
                                  <table class="table table-striped">
                                    Item Category:
                                    <select name="ItemID" class="form-control">
                                      <option value="1">1 Handed Sword</option>
                                      <option value="2">2 Handed Sword</option>
                                      <option value="3">1 Handed Axe</option>
                                      <option value="4">2 Handed Sword</option>
                                      <option value="5">Duel Swords/Axes</option>
                                      <option value="6">Spears</option>
                                      <option value="7">1 Handed Blunts</option>
                                      <option value="8">2 Handed Blunts</option>
                                      <option value="9">1 Handed Dagger</option>
                                      <option value="10">Dagger</option>
                                      <option value="11">Javelings</option>
                                      <option value="12">Staffs</option>
                                      <option value="13">Bow</option>
                                      <option value="14">Crossbows</option>
                                      <option value="15">Claws</option>
                                      <option value="16">AOL Helms</option>
                                      <option value="17">AOL Tops</option>
                                      <option value="18">AOL Pants</option>
                                      <option value="19">AOL Shields</option>
                                      <option value="20">AOL Gaunts</option>
                                      <option value="21">Aol Boots</option>
                                      <option value="22">Rings</option>
                                      <option value="23">Amulets</option>
                                      <option value="24">AOL Caps/Dashing Extream</option>
                                      <option value="25">Potions / Enchant Items</option>
                                      <option value="27">Quest Items</option>
                                      <option value="28">More Quest Items</option>
                                      <option value="29">More Quest Items</option>
                                      <option value="30">Lapis</option>
                                      <option value="31">UOF Helms</option>
                                      <option value="32">UOF Tops</option>
                                      <option value="33">UOF Pants</option>
                                      <option value="34">UOF Shields</option>
                                      <option value="35">UOF Gaunts</option>
                                      <option value="36">UOF Boots</option>
                                      <option value="38">EP5 Enchant Items</option>
                                      <option value="39">Fury Caps</option>
                                      <option value="40">Loops</option>
                                      <option value="42">Mounts</option>
                                      <option value="43">Etin</option>
                                      <option value="44">Few Enchants/Quest Items</option>
                                      <option value="94">Gold Bars</option>
                                      <option value="95">Lapisia</option>
                                      <option value="100">DP Items</option>
                                    </select>
                                  </table>
                                  <p class="text-center">
                                    <button type="submit" class="btn btn-sm btn-primary" name="submit">Submit</button>
                                  </p>
                                </div>
                              </div>
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
