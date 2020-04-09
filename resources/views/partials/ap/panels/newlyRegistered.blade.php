<div class="col-md-6 col-xl-3">
  <ul class="nav nav-tabs" id="myTab1" role="tablist">
    <li class="nav-item">
      <a class="nav-link" id="nr-7-tab" data-toggle="tab" href="#nr-7" role="tab" aria-controls="nr-7" aria-selected="false">7 Days</a>
    </li>
    <li class="nav-item">
      <a class="nav-link active" id="nr-14-tab" data-toggle="tab" href="#nr-14" role="tab" aria-controls="nr-14" aria-selected="true">14 Days</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" id="nr-30-tab" data-toggle="tab" href="#nr-30" role="tab" aria-controls="nr-30" aria-selected="false">30 Days</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" id="nr-all-tab" data-toggle="tab" href="#nr-all" role="tab" aria-controls="nr-all" aria-selected="false">All</a>
    </li>
  </ul>
  <div class="card newRegistered">
    <div class="tab-content">
      <div class="tab-pane fade" id="nr-7" role="tabpanel" aria-labelledby="nr-7-tab">
        <h6 class="mb-4">Newly Registered (Last 7D)</h6>
        <div class="row d-flex align-items-center">
          <div class="col-9">
            <h3 class="f-w-300 d-flex align-items-center m-b-0" id="newlyRegistered7">
              <i class="fas fa-fw fa-user-plus text-c-green f-30 m-r-10"></i>
              {{$data['panels']->getNewlyRegistered(7)}}
            </h3>
          </div>
        </div>
      </div>
      <div class="tab-pane fade show active" id="nr-14" role="tabpanel" aria-labelledby="nr-14-tab">
        <h6 class="mb-4">Newly Registered (Last 14D)</h6>
        <div class="row d-flex align-items-center">
          <div class="col-9">
            <h3 class="f-w-300 d-flex align-items-center m-b-0" id="newlyRegistered14">
              <i class="fas fa-fw fa-user-plus text-c-green f-30 m-r-10"></i>
              {{$data['panels']->getNewlyRegistered(14)}}
            </h3>
          </div>
        </div>
      </div>
      <div class="tab-pane fade" id="nr-30" role="tabpanel" aria-labelledby="nr-30-tab">
        <h6 class="mb-4">Newly Registered (Last 30D)</h6>
        <div class="row d-flex align-items-center">
          <div class="col-9">
            <h3 class="f-w-300 d-flex align-items-center m-b-0" id="newlyRegistered30">
              <i class="fas fa-fw fa-user-plus text-c-green f-30 m-r-10"></i>
              {{$data['panels']->getNewlyRegistered(30)}}
            </h3>
          </div>
        </div>
      </div>
      <div class="tab-pane fade" id="nr-all" role="tabpanel" aria-labelledby="nr-all-tab">
        <h6 class="mb-4">Newly Registered (All Time)</h6>
        <div class="row d-flex align-items-center">
          <div class="col-9">
            <h3 class="f-w-300 d-flex align-items-center m-b-0" id="newlyRegistered">
              <i class="fas fa-fw fa-user-plus text-c-green f-30 m-r-10"></i>
              {{$data['panels']->getNewlyRegistered()}}
            </h3>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
setInterval(function(){
  $("#newlyRegistered7").load(window.location.href + " #newlyRegistered7" )
  $("#newlyRegistered14").load(window.location.href + " #newlyRegistered14" )
  $("#newlyRegistered30").load(window.location.href + " #newlyRegistered30" )
  $("#newlyRegistered").load(window.location.href + " #newlyRegistered" )
}, 60000);
</script>
