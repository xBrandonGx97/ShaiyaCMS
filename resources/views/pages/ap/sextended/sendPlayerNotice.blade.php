@extends('layouts.ap.app')
@section('index', 'dashboard')
@section('title', 'Dashboard')
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
                          <h5>Send Player Notice</h5>
                        </div>
                        <div class="card-body">
                          @if (isset($_POST['submit']))
                            @if($data['sE']->sendPlayerNotice($data['sE']->noticeChar, $data['sE']->notice))
                              {{$data['logSys']->createLog('Sent a player notice: '.$data['sE']->noticeChar . ' - ' . $data['sE']->notice)}}
                              <p class="fs_18">
                                Player notice sent to: {{$data['sE']->noticeChar . ' - ' . $data['sE']->notice}}
                              </p>
                            @else
                              Could not send notice to player: Character doesn't exist.
                            @endif
                          @else
                            <form class="form-inline" method="post">
                              <div class="form-group mx-sm-3 mb-2">
                                <input type="text" name="noticeChar" placeholder="Character Name" class="form-control text-center">
                                <input type="text" name="notice" placeholder="Notice Message" class="form-control text-center m_l_5">
                              </div>
                              <button type="submit" class="btn btn-sm btn-primary text-center" name="submit">Submit</button>
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
