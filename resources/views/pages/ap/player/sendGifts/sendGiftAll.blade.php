@extends('layouts.ap.app')
@section('index', 'sendGiftAll')
@section('title', 'Send Gift All')
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
                              <h5>Send Gift to All Players</h5>
                            </div>
                            <div class="card-body">
                              <div id="fetch"></div>
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
    {{display('getItemModal','<i class="fa fa-send"></i>', null, null, 'Item Search')}}
    <script>
      const curTrgt = document.querySelector(".card-body");
      const content = document.getElementById("fetch");
      console.log(content);

        fetch('/admin/player/sendGiftAll', {
          method: 'post',
          mode: "same-origin",
          credentials: "same-origin",
          headers: {
            "Content-Type": "application/json"
          },
          body: JSON.stringify({
            id: 1
          })
        })
        .then(r => r.text())
        .then(data => {
          content.innerHTML = data;
        })
        .catch(err => {
            console.log(err);
        })
    document.body.addEventListener("click", e => {
      if(e.target.closest(".submit_c")) {
        e.preventDefault();
        const curTrgt = document.querySelector(".submit_c");
        const content = document.getElementById("fetch");

        const form = document.getElementById("send_gift");
        const formData = new FormData(form);
        formData.append('submit', 1);

        fetch('/admin/player/sendGiftAll', {
          method: 'post',
          body: formData
        })
        .then(r => r.text())
        .then(data => {
          content.innerHTML = data;
        })
        .catch(err => {
            console.log(err);
        })
      }
      if(e.target.closest(".submit_d")) {
        e.preventDefault();
        const curTrgt = document.querySelector(".submit_d");
        const content = document.getElementById("fetch");

        const form = document.getElementById("send_gift_verify");
        const formData = new FormData(form);
        /* formData.append('userId', 123) */

        fetch('/admin/player/submitSendGiftAll', {
          method: 'post',
          body: formData
        })
        .then(r => r.text())
        .then(data => {
          content.innerHTML = data;
        })
        .catch(err => {
            console.log(err);
        })
      }
    });
  </script>
@endsection
