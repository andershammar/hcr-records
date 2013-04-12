@extends('master')

@section('content')
  <div class="row">
    <div class="span12">
      <h2>Leaderboard</h2>
      <div class="nav-links">
        {{ Html::link('records', 'Home') }} <span style="margin: 5px"> | </span>
        @if ($view == 'score')
          Best Score <span style="margin: 5px"> | </span>
          {{ Html::link('leaderboard?view=distance', 'Longest Distance') }}
        @else
          {{ Html::link('leaderboard?view=score', 'Best Score') }} <span style="margin: 5px"> | </span>
          Longest Distance
        @endif
      </div>
    </div>
  </div>

  @if ($view == 'score')
    @include('leaderboard._score')
  @else
    @include('leaderboard._distance')
  @endif

@stop
