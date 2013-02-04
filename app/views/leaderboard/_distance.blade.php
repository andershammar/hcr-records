<div class="row">
  <div class="span8">
    <table class="table table-striped table-bordered table-condensed">
      <thead>
        <tr>
          <th width="153px">Name</th>
          <th># Records</th>
          <th width="160px">Total Distance</th>
          <th width="160px">Average Distance</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($players as $player)
        <tr>
          <td>{{ $player['name'] }}</td>
          <td>{{ $player['nbrRecords'] }}</td>
          <td>{{ $player['totalDistance'] }} m</td>
          <td>{{ round($player['averageDistance']) }} m</td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>

