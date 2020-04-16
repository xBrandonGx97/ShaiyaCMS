<div class="row">
  <div class="col-md-12 m_t_10">
    <div id="content_card" class="card custom-card">
      <div class="card-header cstm-card-head tac">New Users</div>
      <table class="table table-striped" id="NewPlayers">
        <thead>
          <tr>
            <th>Faction</th>
            <th>Username</th>
            <th>Join Date</th>
            <th>Last Online Date</th>
            <th>Account Status</th>
            <th>Donation Points</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($data['panels']->newUsers() as $user)
            <tr>
              <td>{{$data['user']->getFaction($user->Faction)}}</td>
              <td>{{$user->UserID}}</td>
              <td>{{date('F d, Y', strtotime($user->JoinDate))}}</td>
              <td>{{date('F d, Y', strtotime($user->LogOutTime))}}</td>
              <td>{{$data['user']->getStatus($user->Status)}}</td>
              <td>{{$user->Point}}</td>
              <form method="post" action="/admin/account/edit">
                <input type="hidden" name="userId" value="{{$user->UserID}}"/>
                <td>
                  <button type="submit" class="btn btn-sm btn-primary" name="submit">Edit</button>
                </td>
              </form>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
<script>
  $(document).ready(function(){
	  $('#NewPlayers').dataTable( {
		  "searching": false,
			"info": false,
			"bLengthChange": false
    });
	});
</script>
