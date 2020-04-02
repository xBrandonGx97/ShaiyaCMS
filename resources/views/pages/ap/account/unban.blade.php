@extends('layouts.ap.app')
@section('index', 'unban')
@section('title', 'Unban Account')
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
              {{$data['logSys']->createLog('Visited Account Unban Page')}}
              <div class="main-body">
                <div class="page-wrapper">
                  <div class="row">
                    <div class="col-sm-12">
                      <div class="card align-items-center">
                        <div class="card-header">
                          <h5>Account unban</h5>
                        </div>
                        <div class="card-body">
                          @if(isset($_POST['submit']))
                            @if (count($data['unban']->getUserUID()) > 0)
                              @if(count($data['unban']->checkIfBanned()) > 0)
                                {{$data['unban']->unBanUser()}}
                              @else
                                Character is not banned.
                              @endif
                            @else
                              Character doesn't exist.
                            @endif
                          @endif
                          <form method="post">
                            <div class="form-group">
                              <input type="text" name="CharName" class="form-control" placeholder="Character Name"/>
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
@endsection
