@extends('master')

@section('content')
  <div class="row">
    <div class="span12">
      <h2>Records</h2>
      <div class="nav-links">
        <a href="{{ URL::to('records/create') }}">Register a new record</a>
      </div>
    </div>
  </div>
  <div class="row">
  @foreach ($records as $record)
    <div class="span4">
      <table class="table table-striped table-bordered table-condensed">
        <thead>
          <tr>
            <th colspan="3">{{ HTML::to('records/' . $record['stage']->id, $record['stage']->name, ['class' => 'stage-links']) }}</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($record['records'] as $player)
          <tr>
            <td>{{ Text::truncate($player->name) }}</td>
            <td>{{ $player->vehicle }}</td>
            <td>{{ $player->meters }} m</td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  @endforeach
  </div>
@stop