@extends('master')

@section('content')
  <div class="row">
    <div class="span12">
      <h2>{{ $stage->name }}</h2>
    </div>
  </div>
  <div class="row">
    <div class="span6">
      <table class="table table-striped table-bordered table-condensed stage-table">
        <thead>
          <tr style="margin-top: 20px">
            <th>Name</th>
            <th>Vehicle</th>
            <th>Meters</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($records as $player)
          <tr>
            <td>{{ $player->name }}</td>
            <td>{{ $player->vehicle }}</td>
            <td>{{ $player->meters }} m</td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    <div class="span4">
      {{ HTML::image($stage->image, null, ['class' => 'img-polaroid stage-img']) }}
    </div>
  </div>
@stop