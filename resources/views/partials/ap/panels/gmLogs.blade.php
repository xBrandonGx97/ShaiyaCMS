<div class="col-md-6 m_t_10">
  <div id="content_card" class="card custom-card">
    <div class="card-header cstm-card-head tac">
      <i class="fas fa-clock"></i>
      GM Command Logs
    </div>
    <div id="gmLogs">
      <div class="card-block content_bg content pContent">
        <div class="table-responsive">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>CharName</th>
                <th>Command</th>
                <th>Command Result</th>
                <th>Player Affected</th>
                <th>Time</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($data['panels']->gmLogs() as $log)
                <tr>
                  <td>{{$log->CharName}}</td>
                  <td>{{$log->Command}}</td>
                  <td>{{$log->CommandResult}}</td>
                  <td>{{$log->PlayerAffected}}</td>
                  <td>
                    <span class="badge badge-pill badge-secondary">
                      {{date('F d, Y', strtotime($log->ActionTime))}}
                    </span>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        <div class="text-center">
          <a class="btn btn-sm btn-outline-info b_i f14" href="/admin/commandLogs">View All Activity</a>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
setInterval(function(){
  $("#gmLogs").load(window.location.href + " #gmLogs" )
}, 60000);
</script>
