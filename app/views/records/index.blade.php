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
            <th colspan="4">{{ HTML::to('records/' . $record['stage']->id, $record['stage']->name, ['class' => 'stage-links']) }}</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($record['records'] as $player)
          <tr>
            <td class="medal-cell">
            @if (isset($player->medal))
              {{ HTML::image($player->medal, null, ['class' => 'medal-img']) }}
            @endif
            </td>
            <td><span class="player">{{ Text::truncate($player->name) }}</span></td>
            <td>{{ $player->vehicle }}</td>
            <td>{{ $player->meters }} m</td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  @endforeach
  </div>
  <div class="row">
    <div class="span12">
      <h4>Latest Records</h4>
      <ul>
        @foreach ($latest_records as $record)
          <li><strong>{{ $record->name }}</strong> added a new record for {{ $record->stage }} after driving {{ $record->meters }} meters in a {{ $record-> vehicle }}
          @if ($record->vehicle == 'Unknown')
            vehicle
          @endif
          </li>
        @endforeach
      </ul>
    </div>
  </div>
@stop
