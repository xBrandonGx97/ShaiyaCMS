@extends('layouts.ap.app')
@section('index', 'login')
@section('title', 'Login')
@section('zone', 'AP')
@section('content')
  @guest
    <form method="post">
      <div class="auth-wrapper aut-bg-img" style="background: #212224;">
        <div class="auth-content">
          <div class="text-white">
            <div class="card-body text-center">
              <div class="mb-4">
                <i class="feather icon-unlock auth-icon"></i>
              </div>
              <h3 class="mb-4 text-white">Login</h3>
              @if (isset($_POST['submit']))
                @if (empty($data['login']->getUser()))
                  {{$data['login']->addMessage('error 1')}}
                @endif
                @if (empty($data['login']->getPassword()))
                  {{$data['login']->addMessage('error 2')}}
                @elseif (strlen($data['login']->getPassword()) < 3 || strlen($data['login']->getPassword()) > 16)
                  {{$data['login']->addMessage('error 3')}}
                @endif
                @if (count($data['login']->getMessages()) == 0)
                  @if ($data['login']->getUserData())
                    @foreach ($data['login']->getUserData() as $userInfo)
                      @if (password_verify($data['login']->getPassword(), $userInfo->Pw))
                        {{$data['login']->login($userInfo)}}
                      @else
                        {{$data['login']->addMessage('error 4')}}
                      @endif
                    @endforeach
                  @else
                    {{$data['login']->addMessage('error 5')}}
                  @endif
                @endif
                @if (count($data['login']->getMessages()))
                  <ul>
                    @foreach($data['login']->getMessages() as $error)
                      <li>{!!$error!!}</li>
                    @endforeach
                  </ul>
                @endif
              @endif
              <div class="input-group mb-3">
                <input type="text" class="form-control text-white" placeholder="Username or Email" name="user">
              </div>
              <div class="input-group mb-4">
                <input type="password" class="form-control text-white" placeholder="password" name="password">
              </div>
              <div class="form-group text-left">
                <div class="checkbox checkbox-fill d-inline">
                  <input type="checkbox" name="checkbox-fill-1" id="checkbox-fill-a1" checked="">
                  <label for="checkbox-fill-a1" class="cr"> Save credentials</label>
                </div>
              </div>
              <button type="submit" class="btn btn-primary shadow-2 mb-4" name="submit">Login</button>
              <p class="mb-2 text-muted" style="color: #9fabb3 !important;">Forgot password? <a class="text-white" href="#">Reset</a></p>
              <p class="mb-0 text-muted"  style="color: #9fabb3 !important;">Don’t have an account? <a class="text-white" href="/admin/auth/signup">Signup</a></p>
            </div>
          </div>
        </div>
      </div>
    </form>
  @else
    {{redirect('/admin')}}
  @endguest
@endsection
