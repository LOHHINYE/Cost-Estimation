@extends('layouts.app')
@section('content')
<div class="container">
<div class="card" style="width: 60%;">
  <div class="card-header">Edit Role</div>
  <div class="card-body">

      <form action="{{ url('roles/' .$roles->roles_id) }}" method="post">
      {{csrf_field()}}
        @method("PATCH")
        <input type="hidden" name="roles_id" id="roles_id" value="{{$roles->roles_ID}}" id="roles_ID" required/>
        <label>Roles</label></br>
        <input type="text" name="role" id="role" value="{{$roles->role}}" class="form-control" required></br>
        <label>Salary</label></br>
        <input type="number" name="salary" id="salary" value="{{$roles->salary}}" class="form-control" oninput="calculateSalaryPerDay()" required></br>
        <input type="hidden" name="salary_per_day" id="salary_per_day" value="" required/>
        <br><br>
        </br>

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

<script>
function calculateSalaryPerDay() {
    const salary = document.getElementById('salary').value;
    const salaryPerDay = salary / 4 / 5;
    document.getElementById('salary_per_day').value = salaryPerDay;
}

</script>
@stop
