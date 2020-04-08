@extends('layouts.ap.app')
@section('index', 'chatSearch')
@section('title', 'Chat Search')
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
                          <h5>Character Chat Search</h5>
                        </div>
                        <div class="card-body">
                          @if (isset($_POST['submit']))
                            @if (!empty($data['chat']->charName))
                              @if (count($data['chat']->getChatData()))
                                <h4 class="text-center">{{date('l jS \of F Y h:i:s A')}}</h4>
                                <div class="fs_16 text-center" id="chat-legend">
                                  <span id="normal">Normal</span> |
                                  <span id="whisper">Whisper</span> |
                                  <span id="area">Area</span> |
                                  <span id="yelling">Yelling</span> |
                                  <span id="party">Party</span> |
                                  <span id="guild">Guild</span> |
                                  <span id="trade">Trade</span> |
                                </div>
                                @Separator(20)
                                <table class="ChatData table table-striped" id="PlayerChat">
                                  <thead>
                                    <tr>
                                      <th class="column-map">Map</th>
                                      <th class="column-char">Character</th>
                                      <th class="column-chat">Chat</th>
                                      <th class="column-char">Target</th>
                                      <th class="column-date">Date</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    @foreach($data['chat']->getChatData() as $res)
                                      @if ($res->Family == 0 || $res->Family == 1)
                                        <tr style="background-color:rgba(92,203,255,0.30)">
                                          <td>{{$data['user']->getMap((int)$res->MapID)}}</td>
                                          <td>
                                            <a href="#">{{$res->CharName}}</a>
                                          </td>
                                          <td>{{$data['data']->purify($res->ChatData)}}</td>
                                          <td class="{{$data['data']->chatColor((int)$res->ChatType)}}">
                                            @if (!empty($res->TargetName))
                                              PM => {{$data['data']->purify($res->TargetName)}}
                                            @endif
                                          </td>
                                          <td class="ChatTime">{{date("M d, y H:i:s A", strtotime($res->ChatTime))}}</td>
                                        </tr>
                                        @elseif ($res->Family == 2 || $res->Family == 3)
                                          <tr style="background-color:rgba(255,92,139,0.30)">
                                            <td>{{$data['user']->getMap((int)$res->MapID)}}</td>
                                            <td>
                                              <a href="#">{{$res->CharName}}</a>
                                            </td>
                                            <td>{{$data['data']->purify($res->ChatData)}}</td>
                                            <td class="{{$data['data']->chatColor((int)$res->ChatType)}}">
                                              @if (!empty($res->TargetName))
                                                PM => {{$data['data']->purify($res->TargetName)}}
                                              @endif
                                            </td>
                                            <td class="ChatTime">{{date("M d, y H:i:s A", strtotime($res->ChatTime))}}</td>
                                          </tr>
                                        @endif
                                      @endforeach
                                  </tbody>
                                </table>
                              @endif
                            @else
                              Character name can not be empty!
                            @endif
                          @endif
                          <form method="post">
                            <div class="form-group mx-sm-3 mb-2">
                              <input type="text" name="char" placeholder="Char Name" class="form-control"/>
                            </div>
                            <p class="text-center">
                              <button type="submit" class="btn btn-sm btn-primary" name="submit">Submit</button>
                            </p>
                          </form>
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
  <script type="text/javascript">
	  $(document).ready(function(){
      $('#PlayerChat').dataTable( {
        "searching": false,
        "info": false,
        "bLengthChange": false
      });
	  });
	</script>
@endsection
