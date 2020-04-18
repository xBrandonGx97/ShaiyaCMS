@extends('layouts.ap.app')
@section('index', 'banUser')
@section('title', 'Ban User')
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
                {{$data['logSys']->createLog('Visited Ban User Page')}}
                <div class="main-body">
                  <div class="page-wrapper">
                    <div class="row">
                      <div class="col-sm-12">
                        <div class="card align-items-center">
                          <div class="card-header">
                            <h5>Account Ban</h5>
                          </div>
                          <div class="card-body">
                            @if (isset($_POST['submit']))
                              @if (count($data['ban']->getUserUID()) > 0)
                                @if (count($data['ban']->checkIfBanned()) < 1)
                                  @if (!empty($data['ban']->checkErrors()))
                                    Errors found. Please make sure you filled out all form inputs.
                                  @else
                                    {{$data['ban']->setUserToBanned()}}
                                  @endif
                                @else
                                  Character is already banned.
                                @endif
                              @else
                                Character not found.
                              @endif
                            @endif
                            <form method="post">
                              <div class="form-group mx-sm-3 mb-2">
                                Character:
                                <input type="text" class="form-control" name="CharName" placeholder="Character Name"/>
                                @Separator(20)
                                <textarea class="form-control" name="Reason" cols="50" rows="10" placeholder="Reason/Infraction"></textarea>
                                {{-- <textarea id="classic-editor"></textarea> --}}
                                @Separator(10)
                                Ban Length:
                                <select name="Length" class="form-control" style="width:auto;">
                                  <option value="12 hours">12 Hours</option>
                                  <option value="5 days">5 Days</option>
                                  <option value="2 weeks">2 Weeks</option>
                                  <option value="permanent">Permanent</option>
                                </select>
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
              {{-- You must be logged in to access the admin dashboard. --}}
              {{-- Sorry, you do not have permission to control the admin panel. --}}
              {{-- {{redirect('/')}} --}}
              {{abort(404)}}
            @endif
          @else
            {{redirect('/admin/auth/login')}}
            {{-- You must be logged in to control the admin panel. --}}
          @endauth
        </div>
      </div>
    </div>
  </div>
@endsection
