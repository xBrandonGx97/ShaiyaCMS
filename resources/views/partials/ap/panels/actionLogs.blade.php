<div class="col-md-6 m_t_10">
  <div id="content_card" class="card custom-card">
    <div class="card-header cstm-card-head tac">
      <i class="fas fa-clock"></i>
      Admin Panel Action Logs
    </div>
    <div class="card-block content_bg content pContent">
      @if(count($data['panels']['actionLogs']) > 0)
        <div class="table-responsive">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>Action</th>
                <th>Time</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($data['panels']['actionLogs'] as $action)
                <tr>
                  <td>{{$action->UserID}} - {{$action->Action}}</td>
                  <td>
                    <span class="badge badge-pill badge-secondary">
                      {{$data['data']->getDateDiff($action->ActionTime)}}
                    </span>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      @else
        <p class="text-center">There are currently no access logs.</p>
      @endif
      <div class="text-center">
        <a class="btn btn-sm btn-outline-info b_i f14" href="/admin/accessLogs">View All Activity</a>
      </div>
    </div>
  </div>
</div>
