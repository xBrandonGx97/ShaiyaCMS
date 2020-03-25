<div id="rankingsData"></div>
    @if(count($data) > 0)
      <div class="table-responsive">
        <table class="table table-sm table-dark table-striped tac">
          <thead>
            <tr>
              <th>#</th>
              <th>Name</th>
              <th>Faction</th>
              <th>Class</th>
              <th>Level</th>
              <th>Guild</th>
              <th>Kills</th>
              <th>Deaths</th>
              <th>Rank</th>
            </tr>
          </thead>
          <tbody>
            @foreach($data['rankings'] as $rankings)
              @php
                $data['rankNum']++;
              @endphp
              <tr>
                <td>{{$data['rankNum']}}</td>
                <td>{{$rankings->CharName}}</td>
                <td></td>
                <td class="IconHolder" width="10"></td>
                <td>{{$rankings->Level}}</td>
                <td>test</td>
                <td>{{$rankings->K1}}</td>
                <td>{{$rankings->K2}}</td>
                <td>
                  <span class="RankIcon Rank{{$getRank}}" title="Rank{{$getRank}}"></span>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    @else
        <p>No News found. Please check back later.</p>
    @endif
