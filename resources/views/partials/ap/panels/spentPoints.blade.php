<div class="col-md-6 col-xl-3">
  <ul class="nav nav-tabs" id="myTab1" role="tablist">
    <li class="nav-item">
      <a class="nav-link" id="sp-7-tab" data-toggle="tab" href="#sp-7" role="tab" aria-controls="sp-7" aria-selected="false">7 Days</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" id="sp-14-tab" data-toggle="tab" href="#sp-14" role="tab" aria-controls="sp-14" aria-selected="false">14 Days</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" id="sp-30-tab" data-toggle="tab" href="#sp-30" role="tab" aria-controls="sp-30" aria-selected="false">30 Days</a>
    </li>
    <li class="nav-item">
      <a class="nav-link active" id="sp-all-tab" data-toggle="tab" href="#sp-all" role="tab" aria-controls="sp-all" aria-selected="true">All</a>
    </li>
  </ul>
  <div class="card spendPoints">
    <div class="tab-content">
      <div class="tab-pane fade" id="sp-7" role="tabpanel" aria-labelledby="sp-7-tab">
        <h6 class="mb-4">Spent Points (Last 24 Hours)</h6>
        <div class="row d-flex align-items-center">
          <div class="col-9">
            <h3 class="f-w-300 d-flex align-items-center m-b-0" id="spentPoints">
              <i class="fas fa-fw fa-coins text-c-green f-30 m-r-10"></i>
              {{$data['panels']->getSpentPoints(7)}}
            </h3>
          </div>
        </div>
      </div>
      <div class="tab-pane fade" id="sp-14" role="tabpanel" aria-labelledby="sp-14-tab">
        <h6 class="mb-4">Spent Points (Last 14D)</h6>
        <div class="row d-flex align-items-center">
          <div class="col-9">
            <h3 class="f-w-300 d-flex align-items-center m-b-0" id="spentPoints">
              <i class="fas fa-fw fa-coins text-c-green f-30 m-r-10"></i>
              {{$data['panels']->getSpentPoints(14)}}
            </h3>
          </div>
        </div>
      </div>
      <div class="tab-pane fade" id="sp-30" role="tabpanel" aria-labelledby="sp-30-tab">
        <h6 class="mb-4">Spent Points (Last 30D)</h6>
        <div class="row d-flex align-items-center">
          <div class="col-9">
            <h3 class="f-w-300 d-flex align-items-center m-b-0" id="spentPoints">
              <i class="fas fa-fw fa-coins text-c-green f-30 m-r-10"></i>
              {{$data['panels']->getSpentPoints(30)}}
            </h3>
          </div>
        </div>
      </div>
      <div class="tab-pane fade show active" id="sp-all" role="tabpanel" aria-labelledby="sp-all-tab">
        <h6 class="mb-4">Spent Points (All Time)</h6>
        <div class="row d-flex align-items-center">
          <div class="col-9">
            <h3 class="f-w-300 d-flex align-items-center m-b-0" id="spentPoints">
              <i class="fas fa-fw fa-coins text-c-green f-30 m-r-10"></i>
              {{$data['panels']->getSpentPoints()}}
            </h3>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
setInterval(function(){
  $("#spentPoints").load(window.location.href + " #spentPoints" )
}, 60000);
</script>
