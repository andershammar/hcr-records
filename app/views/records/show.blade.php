@extends('master')

@section('content')
  <div class="row">
    <div class="span12">
      <h2>{{ $stage->name }}</h2>
      <div class="nav-links">
        {{ HTML::to('records', 'Home') }}
      </div>
    </div>
  </div>
  <div class="row">
    <div class="span6">
      <table class="table table-striped table-bordered table-condensed">
        <thead>
          <tr style="margin-top: 20px">
            <th></th>
            <th>Name</th>
            <th>Vehicle</th>
            <th>Meters</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($records as $player)
          <tr>
            <td class="medal-cell">
            @if (isset($player->medal))
              {{ HTML::image($player->medal, null, ['class' => 'medal-img']) }}
            @endif
            </td>
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
