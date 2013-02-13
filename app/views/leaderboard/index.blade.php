@extends('master')

@section('content')
  <div class="row">
    <div class="span12">
      <h2>Leaderboard</h2>
      <div class="nav-links">
        {{{ HTML::to('records', 'Home') }}} <span style="margin: 5px"> | </span>
        @if ($view == 'score')
          Best Score <span style="margin: 5px"> | </span>
          {{{ HTML::to('leaderboard?view=distance', 'Longest Distance') }}}
        @else
          {{{ HTML::to('leaderboard?view=score', 'Best Score') }}} <span style="margin: 5px"> | </span>
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
