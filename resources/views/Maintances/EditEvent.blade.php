@extends('layouts.app')
@section('content')
<div class="container">
<div class="card" style="width: 60%;">
  <div class="card-header">Edit Event</div>
  <div class="card-body">

      <form action="{{ route('update_event', ['id' => $events->event_id]) }}" method="get">
      {{csrf_field()}}
        @method("PATCH")
        <input type="hidden" name="event_id" id="event_id" value="{{$events->event_id}}" required/>
        <label>Event</label><br>
        <input type="text" name="event_desc" id="event_desc" value="{{$events->event_desc}}" class="form-control" required><br>
        <br><br>
        <div class="text-right mt-2">
            <!-- Wrap button and link in this div -->
            <a href="{{ url('/roles') }}" class="btn btn-secondary mb-2 ml-2">Back</a>
            <input type="submit" value="Update" class="btn btn-outline-success mb-2 ml-2">
        </div>
    </form>

  </div>
</div>
<br>

</div>
@stop
