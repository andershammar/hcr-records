@extends('master')

@section('content')
  <div class="row">
    <div class="span12">
      <h2>New Record</h2>
      {{ Form::open(array('url' => 'records', 'class' => 'form-horizontal', 'style' => 'margin-top: 30px')) }}

      {{-- Player --}}
      <div class="control-group {{ $errors->has('player') ? 'error' : '' }}">
        {{ Form::label('player', 'Player', array('class' => 'control-label', 'style' => 'color: #000')) }}
        <div class="controls">
          {{ Form::text('player', Input::old('player'), array('style' => 'color: #000', 'autofocus')) }}
          {{ $errors->first('player', '<span class="help-inline">:message</span>') }}
        </div>
      </div>

      {{-- Stage --}}
      <div class="control-group">
        {{ Form::label('stage', 'Stage', array('class' => 'control-label', 'style' => 'color: #000')) }}
        <div class="controls">
          {{ Form::select('stage', $stages, Input::old('stage')) }}
        </div>
      </div>

      {{-- Vehicle --}}
      <div class="control-group">
        {{ Form::label('vehicle', 'Vehicle', array('class' => 'control-label', 'style' => 'color: #000')) }}
        <div class="controls">
          {{ Form::select('vehicle', $vehicles, Input::old('vehicle')) }}
        </div>
      </div>

      {{-- Meters --}}
      <div class="control-group {{ $errors->has('meters') ? 'error' : '' }}">
        {{ Form::label('meters', 'Meters', array('class' => 'control-label', 'style' => 'color: #000')) }}
        <div class="controls">
          {{ Form::text('meters', Input::old('meters'), array('style' => 'color: #000')) }}
          {{ $errors->first('meters', '<span class="help-inline">:message</span>') }}
        </div>
      </div>

      <div class="form-actions">
        {{ Form::submit('Save changes', array('class' => 'btn btn-primary')) }}
        {{ Html::link('records', 'Cancel', array('class' => 'btn')) }}
      </div>

      {{ Form::close() }}
    </div>
  </div>
@stop