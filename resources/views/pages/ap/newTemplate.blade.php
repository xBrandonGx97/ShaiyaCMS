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
                              <h5>Item Search By nAME</h5>
                            </div>
                            <div class="card-body">
                              WE LITT
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
@endsection
