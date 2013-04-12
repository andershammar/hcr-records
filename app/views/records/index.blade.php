@extends('master')

@section('content')
  <div class="row">
    <div class="span12">
      @if (isset($new_record))
        <div class="alert alert-block alert-success">
          <button type="button" class="close" data-dismiss="alert">&times;</button>
          <strong>Success!</strong> You have added a new record.<br/>
          <small>Click {{ Html::link('records/' . $new_record, 'here', ['data-method' => 'delete']) }} to undo the last change.</small><br/>
        </div>
      @endif
      <h2>Records</h2>
      <div class="nav-links">
        {{ Html::link('records/create', 'Register a New Record') }} <span style="margin: 5px"> | </span>
        {{ Html::link('leaderboard?view=score', 'Show the Leaderboard') }}
      </div>
    </div>
  </div>
  <div class="row">
  @for ($i = 1; $i <= count($records); $i++)
    @if (($i - 1) % 3 == 0)
      </div><div class="row">
    @endif

    <div class="span4">
      <table class="table table-striped table-bordered table-condensed">
        <thead>
          <tr>
            <th colspan="4">{{ Html::link('records/' . $records[$i]['stage']->id, $records[$i]['stage']->name, ['class' => 'stage-links']) }}</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($records[$i]['records'] as $player)
          <tr>
            <td class="medal-cell">
            @if (isset($player->medal))
              {{ Html::image($player->medal, null, ['class' => 'medal-img']) }}
            @endif
            </td>
            <td><span class="player">{{ Text::truncate($player->name) }}</span></td>
            <td>{{ $player->vehicle }}</td>
            <td>{{ $player->meters }} m</td>
          </tr>
          @endforeach
          @for ($j = 0; $j < (5 - count($records[$i]['records'])); $j++)
          <tr>
            <td class="medal-cell"></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          @endfor
        </tbody>
      </table>
    </div>
  @endfor
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
