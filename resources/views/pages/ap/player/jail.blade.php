@extends('layouts.ap.app')
@section('index', 'jail')
@section('title', 'Jail Player')
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
                          <h5>Jail ALL toons for this account by /kicking online toon then submit the toon name here</h5>
                        </div>
                        <div class="card-body">
                          @if (isset($_POST['submit']))
                            @if (!empty($data['jail']->charName))
                              @if (count($data['jail']->getChar()) > 0)
                                @foreach ($data['jail']->getChar() as $res)
                                  {{$data['jail']->jailPlayer()}}
                                @endforeach
                              @else
                                Could not find a character matching the query.
                              @endif
                            @else
                              Character name can not be empty.
                            @endif
                          @endif
                          <form method="post">
                            <div class="form-group mx-sm-3 mb-2">
                              <input type="text" class="form-control" placeholder="Advanced Search" name="CharName">
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
