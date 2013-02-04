<div class="row">
  <div class="span10">
    <table class="table table-striped table-bordered table-condensed">
      <thead>
        <tr>
          <th>Name</th>
          <th>Gold Medals</th>
          <th>Silver Medals</th>
          <th>Bronze Medals</th>
          <th>Score</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($players as $player)
        <tr>
          <td width="153px">{{ $player['name'] }}</td>
          <td width="23%">
            @for ($i = 0; $i < $player['gold']; $i++)
              {{ HTML::image('img/medal-gold.png', null, ['class' => 'medal-img']) }}
            @endfor
          </td>
          <td width="23%">
            @for ($i = 0; $i < $player['silver']; $i++)
              {{ HTML::image('img/medal-silver.png', null, ['class' => 'medal-img']) }}
            @endfor
          </td>
          <td width="23%">
            @for ($i = 0; $i < $player['bronze']; $i++)
              {{ HTML::image('img/medal-bronze.png', null, ['class' => 'medal-img']) }}
            @endfor
          </td>
          <td>{{ $player['score'] }}</td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
<div class="row">
  <div class="span12">
    <em>Gold medal = 3 points, Silver medal = 2 points and Bronze medal = 1 point</em>
  </div>
</div>