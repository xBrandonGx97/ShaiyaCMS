@extends('layouts.ap.app')
@section('index', 'guildNameChange')
@section('title', 'Guild Name Change')
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
                          <h5>Guild Name Change</h5>
                        </div>
                        <div class="card-body">
                          @if (isset($_POST['submit']))
                            @if (!empty($data['guild']->guildName))
                              @if (count($data['guild']->getGuildData()) > 0)
                                <form method="post">
                                  <input type="hidden" name="guild" value="{{$data['guild']->guildName}}">
                                  @foreach($data['guild']->getGuildData() as $res)
                                    <input type="hidden" name="guild-id" value="{{$res->GuildID}}">
                                  @endforeach
                                  <div class="form-group mx-sm-3 mb-2">
                                    <input type="text" name="newname" placeholder="New Guild Name" class="form-control"/>
                                  </div>
                                  <p class="text-center">
                                    <button type="submit" class="btn btn-sm btn-primary" name="submit2">Submit</button>
                                  </p>
                                </form>
                              @else
                                No guild matching your criteria was found.
                              @endif
                            @else
                              Guild name can not be empty.
                            @endif
                          @elseif (isset($_POST['submit2']))
                            @if (!empty($data['guild']->newGuildName) || $data['guild']->newGuildName !== '')
                              Guild = {{$data['guild']->guildName}}<br />
                              New Guild Name = {{$data['guild']->newGuildName}}
                              {{$data['guild']->updateGuildName()}}
                            @else
                              New guild name can not be empty.
                            @endif
                          @else
                            <form method="post">
                              <div class="form-group mx-sm-3 mb-2">
                                <input type="text" class="form-control" placeholder="Guild Name" name="guild"/>
                              </div>
                              <p class="text-center">
                                <button type="submit" class="btn btn-sm btn-primary" name="submit">Submit</button>
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
