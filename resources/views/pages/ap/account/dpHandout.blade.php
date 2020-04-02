@extends('layouts.ap.app')
@section('index', 'dpHandout')
@section('title', 'DP Handout')
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
              {{$data['logSys']->createLog('Visited DP Handout Page')}}
              <div class="main-body">
                <div class="page-wrapper">
                  <div class="row">
                    <div class="col-sm-12">
                      <div class="card align-items-center">
                        <div class="card-header">
                          <h5>DP Handout</h5>
                        </div>
                        <div class="card-body">
                          @if (isset($_POST['submit']))
                            @if (!empty($_POST['UserID']))
                              @if (count($data['dpHandout']->getChar()) > 0)
                                @foreach ($data['dpHandout']->getChar() as $res)
                                    {{$data['dpHandout']->updateChar($res)}}
                                @endforeach
                              @else
                                No Characters found
                              @endif
                            @endif
                          @endif
                          <form method="post">
                            <div class="form-group mx-sm-3 mb-2">
                              <input type="text" name="UserID" placeholder="Char Name" class="form-control"/>
                            </div>
                            <div class="form-group mx-sm-3 mb-2">
                              <input type="text" name="DP" placeholder="DP Amount" class="form-control"/>
                            </div>
                            <p class="text-center">
                              <button type="submit" class="btn btn-sm btn-primary m_auto" name="submit">Submit</button>
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
  <script>
  $(document).ready(function(){
	  $('#AccessLogs').dataTable({
		  "searching": false,
			"info": false,
			"bLengthChange": false
    });
	});
</script>
@endsection
