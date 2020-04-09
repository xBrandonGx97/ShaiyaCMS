<div class="col-md-6 col-xl-3">
  <ul class="nav nav-tabs" id="myTab1" role="tablist">
    <li class="nav-item">
      <a class="nav-link" id="on-7-tab" data-toggle="tab" href="#on-7" role="tab" aria-controls="on-7" aria-selected="false">7 Days</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" id="on-14-tab" data-toggle="tab" href="#on-14" role="tab" aria-controls="on-14" aria-selected="false">14 Days</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" id="on-30-tab" data-toggle="tab" href="#on-30" role="tab" aria-controls="on-30" aria-selected="false">30 Days</a>
    </li>
    <li class="nav-item">
      <a class="nav-link active" id="on-live-tab" data-toggle="tab" href="#on-live" role="tab" aria-controls="on-live" aria-selected="true">Live</a>
    </li>
  </ul>
  <div class="card onlineUsers">
    <div class="tab-content">
      <div class="tab-pane fade" id="on-7" role="tabpanel" aria-labelledby="on-7-tab">
        <h6 class="mb-4">Online (Last 24 Hours)</h6>
        <div class="row d-flex align-items-center">
          <div class="col-9">
            <h3 class="f-w-300 d-flex align-items-center m-b-0" id="onlineLast7">
              <i class="fas fa-fw fa-globe-americas text-c-green f-30 m-r-10"></i>
              {{$data['panels']->getOnline(7)}}
            </h3>
          </div>
        </div>
      </div>
      <div class="tab-pane fade" id="on-14" role="tabpanel" aria-labelledby="on-14-tab">
        <h6 class="mb-4">Online (Last 14D)</h6>
        <div class="row d-flex align-items-center">
          <div class="col-9">
            <h3 class="f-w-300 d-flex align-items-center m-b-0" id="onlineLast14">
              <i class="fas fa-fw fa-globe-americas text-c-green f-30 m-r-10"></i>
              {{$data['panels']->getOnline(14)}}
            </h3>
          </div>
        </div>
      </div>
      <div class="tab-pane fade" id="on-30" role="tabpanel" aria-labelledby="on-30-tab">
        <h6 class="mb-4">Online (Last 30D)</h6>
        <div class="row d-flex align-items-center">
          <div class="col-9">
            <h3 class="f-w-300 d-flex align-items-center m-b-0" id="onlineLast30">
              <i class="fas fa-fw fa-globe-americas text-c-green f-30 m-r-10"></i>
              {{$data['panels']->getOnline(30)}}
            </h3>
          </div>
        </div>
      </div>
      <div class="tab-pane fade show active" id="on-live" role="tabpanel" aria-labelledby="on-live-tab">
        <h6 class="mb-4">Online (Live)</h6>
        <div class="row d-flex align-items-center">
          <div class="col-9">
            <h3 class="f-w-300 d-flex align-items-center m-b-0" id="onlineLive">
              <i class="fas fa-fw fa-globe text-c-green f-30 m-r-10"></i>
              {{$data['panels']->getOnline()}}
            </h3>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
setInterval(function(){
  $("#onlineLast7").load(window.location.href + " #onlineLast7" );
  $("#onlineLast14").load(window.location.href + " #onlineLast14" );
  $("#onlineLast30").load(window.location.href + " #onlineLast30" );
  $("#onlineLive").load(window.location.href + " #onlineLive" );
}, 60000);

</script>
