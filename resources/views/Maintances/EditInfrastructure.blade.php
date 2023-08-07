@extends('layouts.app')
@section('content')
<div class="container">
<div class="card" style="width: 60%;">
  <div class="card-header">Edit Infrastructure</div>
  <div class="card-body">

      <form action="{{ route('update_infrastructures', ['id' => $infras->infrastructure_id]) }}" method="get">
      {{csrf_field()}}
        @method("PATCH")
        <input type="hidden" name="infrastructure_id" id="infrastructure_id" value="{{$infras->infrastructure_id}}" required/>
        <label>Infrastructure</label><br>
        <input type="text" name="infrastructure_desc" id="infrastructure_desc" value="{{$infras->infrastructure_desc}}" class="form-control" required><br>
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
