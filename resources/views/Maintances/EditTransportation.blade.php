@extends('layouts.app')
@section('content')
<div class="container">
<div class="card" style="width: 60%;">
  <div class="card-header">Edit Transportation</div>
  <div class="card-body">

      <form action="{{ route('update_transportation', ['id' => $trans->transportation_id]) }}" method="get">
      {{csrf_field()}}
        @method("PATCH")
        <input type="hidden" name="transportation_id" id="transportation_id" value="{{$trans->transportation_id}}" required/>
        <label>Transportation</label><br>
        <input type="text" name="transportation_desc" id="transportation_desc" value="{{$trans->transportation_desc}}" class="form-control" required><br>
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
