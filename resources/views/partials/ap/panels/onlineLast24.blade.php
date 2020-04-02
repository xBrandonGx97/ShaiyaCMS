<div class="col-md-6 col-xl-3">
  <div class="card daily-sales">
    <div class="card-block">
      <h6 class="mb-4">Online (Last 24 Hours)</h6>
      <div class="row d-flex align-items-center">
        <div class="col-9">
          <h3 class="f-w-300 d-flex align-items-center m-b-0" id="onlineLast24">
            <i class="fas fa-fw fa-globe-americas text-c-green f-30 m-r-10"></i>
            {{$data['panels']['onlineLast24']}}
          </h3>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
setInterval(function(){
  $("#onlineLast24").load(window.location.href + " #onlineLast24" )
}, 60000);
</script>
