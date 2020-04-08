@extends('layouts.ap.app')
@section('index', 'sendNotice')
@section('title', 'Send Notice')
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
              <div class="main-body">
                <div class="page-wrapper">
                  <div class="row">
                    <div class="col-sm-12">
                      <div class="card align-items-center">
                        <div class="card-header">
                          <h5>Send Notice</h5>
                        </div>
                        <div class="card-body">
                          @if (isset($_POST['submit']))
                            {{$data['sE']->sendNotice($data['sE']->notice)}}
                            {{$data['logSys']->createLog('Sent a notice: '.$data['sE']->notice)}}
                            <p class="fs_18">
                              Notice sent: {{$data['sE']->notice}}
                            </p>
                          @else
                            <form method="post">
                              <div class="form-group mx-sm-3 mb-2">
                                <input type="text" name="notice" placeholder="Notice Message" class="form-control text-center">
                              </div>
                              <p class="text-center">
                                <button type="submit" class="btn btn-sm btn-primary text-center" name="submit">Submit</button>
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
