@extends('layouts.app')

@section('content')
    <div class="container">
        <div style="width: 75%;">
            <form action="{{ route('company.update') }}" method="POST">
                {{ csrf_field() }}
                <div class="form-row align-items-center">
                    <div class="col-auto">
                        <label for="profit" class="sr-only">Company Profit:</label>
                        <div class="input-group mb-2 mr-sm-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text">Company Profit</div>
                            </div>
                            <input type="number" class="form-control form-control-sm" id="profit" name="profit"
                                placeholder="Enter value" min="0" max="150" step="0.1"
                                value="{{ $company->company_profit }}">
                            <div class="input-group-append">
                                <span class="input-group-text">%</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-auto">
                        <label for="factor" class="sr-only">Other Factor:</label>
                        <div class="input-group mb-2 mr-sm-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text">Other Factor</div>
                            </div>
                            <input type="number" class="form-control form-control-sm" id="factor" name="factor"
                                placeholder="Enter value" min="0" max="150" step="0.1"
                                value="{{ $company->otherFactor }}">
                            <div class="input-group-append">
                                <span class="input-group-text">%</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-auto">
                        <label class="sr-only">Factor Points:</label>
                        <div class="input-group mb-2 mr-sm-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text">Other Factor Points</div>
                            </div>
                            <span class="input-group-text"> 1</span>
                            <input type="number" class="form-control form-control-sm" name="factor_1" placeholder="Point 1"
                                min="0" max="100" step="0.1" value="{{ $company->factor_1 }}">
                            <span class="input-group-text"> 2</span>
                            <input type="number" class="form-control form-control-sm" name="factor_2" placeholder="Point 2"
                                min="0" max="100" step="0.1" value="{{ $company->factor_2 }}">
                            <span class="input-group-text"> 3</span>
                            <input type="number" class="form-control form-control-sm" name="factor_3" placeholder="Point 3"
                                min="0" max="100" step="0.1" value="{{ $company->factor_3 }}">
                            <span class="input-group-text"> 4</span>
                            <input type="number" class="form-control form-control-sm" name="factor_4" placeholder="Point 4"
                                min="0" max="100" step="0.1" value="{{ $company->factor_4 }}">
                            <span class="input-group-text"> 5</span>
                            <input type="number" class="form-control form-control-sm" name="factor_5" placeholder="Point 5"
                                min="0" max="100" step="0.1" value="{{ $company->factor_5 }}">
                            <span class="input-group-text"> 6</span>
                            <input type="number" class="form-control form-control-sm" name="factor_6" placeholder="Point 6"
                                min="0" max="100" step="0.1" value="{{ $company->factor_6 }}">
                            <span class="input-group-text"> 7</span>
                            <input type="number" class="form-control form-control-sm" name="factor_7"
                                placeholder="Point 7" min="0" max="100" step="0.1"
                                value="{{ $company->factor_7 }}">
                        </div>
                    </div>
                </div>
                <div class="text-right mt-2">
                    <!-- Wrap button and link in this div -->
                    <a href="{{ url('/costestimation') }}" class="btn btn-secondary mb-2 ml-2">Back</a>
                    <button type="submit" class="btn btn-primary mb-2 ml-2">Save</button>
                </div>

            </form>
        </div>
        <div class="modal fade" id="role-modal" tabindex="-1" role="dialog" aria-labelledby="role-modal-label">
            <div class="modal-dialog modal-lg xl" role="document">
                <div class="modal-content">
                    <div class="card">
                        <div class="card-header">Add Roles</div>
                        <div class="card-body">
                            <form action="{{ url('roles') }}" method="POST">
                                {{ csrf_field() }}
                                <label>Roles Name</label>
                                <input type="text" name="role" id="role" class="form-control" required>
                                <label>Role Salary</label>
                                <input type="number" name="salary" id="salary" class="form-control"
                                    oninput="calculateSalaryPerDay()" required></br>
                                <input type="hidden" name="salary_per_day" id="salary_per_day" value=""
                                    required />

                                <div class="text-right mt-2">
                                    <input type="submit" value="Add Role" class="btn btn-outline-success mb-2 ml-2">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="service-modal" tabindex="-1" role="dialog" aria-labelledby="service-modal-label">
            <div class="modal-dialog modal-lg xl" role="document">
                <div class="modal-content">
                    <div class="card">
                        <div class="card-header">Add Services</div>
                        <div class="card-body">
                            <form action="{{ route('service_store') }}" method="GET">
                            {{csrf_field()}}
                              <label>Service Name</label></br>
                              <input type="text" name="service" id="service" class="form-control" required></br>

                              <div class="text-right mt-2">

                                  <input type="submit" value="Add Service" class="btn btn-outline-success mb-2 ml-2">
                              </div>
                          </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="event-modal" tabindex="-1" role="dialog" aria-labelledby="event-modal-label">
            <div class="modal-dialog modal-lg xl" role="document">
                <div class="modal-content">
                    <div class="card" >
                        <div class="card-header">Add Event</div>
                        <div class="card-body">

                            <form action="{{ route('event_store') }}" method="GET">
                            {{csrf_field()}}
                              <label>Event Name</label></br>
                              <input type="text" name="event" id="event" class="form-control" required></br>

                              <div class="text-right mt-2">
                                  <input type="submit" value="Add Event" class="btn btn-outline-success mb-2 ml-2">
                              </div>

                          </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="hotel-modal" tabindex="-1" role="dialog" aria-labelledby="hotel-modal-label">
            <div class="modal-dialog modal-lg xl" role="document">
                <div class="modal-content">
                    <div class="card">
                        <div class="card-header">Add Hotel</div>
                        <div class="card-body">

                            <form action="{{ route('hotel_store') }}" method="GET">
                            {{csrf_field()}}
                              <label>Hotel Name</label>
                              <input type="text" name="hotel" id="hotel" class="form-control" required>

                              <div class="text-right mt-2">
                                  <!-- Wrap button and link in this div -->
                                  <input type="submit" value="Add Hotel" class="btn btn-outline-success mb-2 ml-2">
                              </div>

                          </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="transportations-modal" tabindex="-1" role="dialog" aria-labelledby="transportations-modal-label">
            <div class="modal-dialog modal-lg xl" role="document">
                <div class="modal-content">
                    <div class="card">
                        <div class="card-header">Add Transportation</div>
                        <div class="card-body">

                            <form action="{{ route('transportation_store') }}" method="GET">
                            {{csrf_field()}}
                              <label>Transportation Name</label></br>
                              <input type="text" name="transportation" id="transportation" class="form-control" required></br>

                              <div class="text-right mt-2">
                                  <!-- Wrap button and link in this div -->
                                  <input type="submit" value="Add Transportation" class="btn btn-outline-success mb-2 ml-2">
                              </div>

                          </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="infrastructure-modal" tabindex="-1" role="dialog" aria-labelledby="infrastructure-modal-label">
            <div class="modal-dialog modal-lg xl" role="document">
                <div class="modal-content">
                    <div class="card">
                        <div class="card-header">Add Infrastructure</div>
                        <div class="card-body">

                            <form action="{{ route('infrastructure_store') }}" method="GET">
                            {{csrf_field()}}
                              <label>Infrastructure Name</label></br>
                              <input type="text" name="infrastructure" id="infrastructure" class="form-control" required></br>

                              <div class="text-right mt-2">
                                  <!-- Wrap button and link in this div -->
                                  <input type="submit" value="Add Infrastructure" class="btn btn-outline-success mb-2 ml-2">
                              </div>

                          </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="marketing-modal" tabindex="-1" role="dialog" aria-labelledby="marketing-modal-label">
            <div class="modal-dialog modal-lg xl" role="document">
                <div class="modal-content">
                    <div class="card">
                        <div class="card-header">Add Marketing</div>
                        <div class="card-body">

                            <form action="{{ route('marketing_store') }}" method="GET">
                            {{csrf_field()}}
                              <label>Marketing Name</label></br>
                              <input type="text" name="marketing" id="marketing" class="form-control" required></br>

                              <div class="text-right mt-2">
                                  <!-- Wrap button and link in this div -->
                                  <input type="submit" value="Add Marketing" class="btn btn-outline-success mb-2 ml-2">
                              </div>

                          </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <br><br>
        <div class="row">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header" style="width:100%">
                        <div class="row align-items-center" onclick="hideTable()" style="width: 95%">
                            <div class="col">
                                <h5 class="modal-title" id="estimation-modal-label-role">Role</h5>
                            </div>
                            <div class="col-auto" id="roleIcon" style="display: block;">
                                <i class="fa fa-caret-down" style="padding-top: 1%; padding-left: 2%;"></i>
                            </div>
                            <div class="col-auto" id="roleIconup" style="display: none;">
                                <i class="fa fa-caret-up" style="padding-top: 1%; padding-left: 2%;"></i>
                            </div>
                        </div>
                    </div>

                    <div class="card-body" id="dynamic_field" style="display: none;">
                        <button type="button" class="btn btn-success mb-2 ml-2 " data-toggle="modal"
                            data-target="#role-modal">
                            <i class="fa fa-plus" aria-hidden="true"></i> Add New Role
                        </button>

                        <br><br>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Role</th>
                                        <th>Salary</th>
                                        <th style="width: 15%;">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($roles as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->role }}</td>
                                            <td>{{ $item->salary }}</td>
                                            <td>
                                                <div class="d-inline-block">
                                                    <a href="{{ url('/roles/' . $item->roles_id . '/edit') }}"
                                                        title="Edit Roles" class="btn btn-primary btn-sm  btn-block mb-2">
                                                        <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                                    </a>
                                                </div>
                                                <div class="d-inline-block ml-2">
                                                    <form method="POST" action="{{ url('/roles/' . $item->roles_id) }}"
                                                        accept-charset="UTF-8">
                                                        {{ method_field('DELETE') }}
                                                        {{ csrf_field() }}
                                                        <button type="submit"
                                                            class="btn btn-danger btn-sm btn-block mb-2"
                                                            title="Delete Role"
                                                            onclick="return confirm('Are You Sure To DELETE this data?')">
                                                            <i class="fa fa-trash-o" aria-hidden="true"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header" style="width:100%">
                        <div class="row align-items-center" onclick="hideTableService()" style="width: 95%">
                            <div class="col">
                                <h5 class="modal-title" id="estimation-modal-label-role">Services</h5>
                            </div>
                            <div class="col-auto" id="serviceIcon" style="display: block;">
                                <i class="fa fa-caret-down" style="padding-top: 1%; padding-left: 2%;"></i>
                            </div>
                            <div class="col-auto" id="serviceIconup" style="display: none;">
                                <i class="fa fa-caret-up" style="padding-top: 1%; padding-left: 2%;"></i>
                            </div>
                        </div>
                    </div>

                    <div class="card-body" id="dynamic_field_service" style="display: none;">

                        <button type="button" class="btn btn-success mb-2 ml-2 " data-toggle="modal"
                            data-target="#service-modal">
                            <i class="fa fa-plus" aria-hidden="true"></i> Add New Services
                        </button>
                        <br><br>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Service</th>
                                        <th style="width: 15%;">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($service as $services)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $services->service_desc }}</td>
                                            <td>
                                                <div class="d-inline-block">
                                                    <a href="{{ url('/services/' . $services->service_id . '/edit') }}"
                                                        title="Edit service"
                                                        class="btn btn-primary btn-sm  btn-block mb-2">
                                                        <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                                    </a>
                                                </div>
                                                <div class="d-inline-block ml-2">
                                                    <form method="POST"
                                                        action="{{ route('service_destroy', $services->service_id) }}"
                                                        accept-charset="UTF-8">
                                                        {{ method_field('DELETE') }}
                                                        {{ csrf_field() }}
                                                        <button type="submit"
                                                            class="btn btn-danger btn-sm btn-block mb-2"
                                                            title="Delete Services"
                                                            onclick="return confirm('Are You Sure To DELETE this data?')">
                                                            <i class="fa fa-trash-o" aria-hidden="true"></i>
                                                        </button>
                                                    </form>

                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header" style="width:100%">
                        <div class="row align-items-center" onclick="hideTableEvent()" style="width: 95%">
                            <div class="col">
                                <h5 class="modal-title" id="estimation-modal-label-role">Event Hall</h5>
                            </div>
                            <div class="col-auto" id="eventIcon" style="display: block;">
                                <i class="fa fa-caret-down" style="padding-top: 1%; padding-left: 2%;"></i>
                            </div>
                            <div class="col-auto" id="eventIconup" style="display: none;">
                                <i class="fa fa-caret-up" style="padding-top: 1%; padding-left: 2%;"></i>
                            </div>
                        </div>
                    </div>
                    <div class="card-body" id="dynamic_field_event" style="display: none;">
                        <button type="button" class="btn btn-success mb-2 ml-2 " data-toggle="modal"
                            data-target="#event-modal">
                            <i class="fa fa-plus" aria-hidden="true"></i> Add New Event
                        </button>

                        <br><br>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Event</th>
                                        <th style="width: 15%;">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($events as $event)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $event->event_desc }}</td>
                                            <td>
                                                <div class="d-inline-block">
                                                    <a href="{{ url('/events/' . $event->event_id . '/edit') }}"
                                                        title="Edit Events"
                                                        class="btn btn-primary btn-sm  btn-block mb-2">
                                                        <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                                    </a>
                                                </div>
                                                <div class="d-inline-block ml-2">
                                                    <form method="POST"
                                                        action="{{ route('event_destroy', $event->event_id) }}"
                                                        accept-charset="UTF-8">
                                                        {{ method_field('DELETE') }}
                                                        {{ csrf_field() }}
                                                        <button type="submit"
                                                            class="btn btn-danger btn-sm btn-block mb-2"
                                                            title="Delete Events"
                                                            onclick="return confirm('Are You Sure To DELETE this data?')">
                                                            <i class="fa fa-trash-o" aria-hidden="true"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <br>
        <div class="row">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header" style="width:100%">
                        <div class="row align-items-center" onclick="hideTableHotel()" style="width: 95%">
                            <div class="col">
                                <h5 class="modal-title" id="estimation-modal-label-role">Hotel</h5>
                            </div>
                            <div class="col-auto" id="hotelIcon" style="display: block;">
                                <i class="fa fa-caret-down" style="padding-top: 1%; padding-left: 2%;"></i>
                            </div>
                            <div class="col-auto" id="hotelIconup" style="display: none;">
                                <i class="fa fa-caret-up" style="padding-top: 1%; padding-left: 2%;"></i>
                            </div>
                        </div>
                    </div>

                    <div class="card-body" id="dynamic_field_hotel" style="display: none;">
                        <button type="button" class="btn btn-success mb-2 ml-2 " data-toggle="modal"
                            data-target="#hotel-modal">
                            <i class="fa fa-plus" aria-hidden="true"></i> Add New Hotel
                        </button>
                        <br><br>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Hotel</th>
                                        <th style="width: 15%;">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($hotel as $hotels)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $hotels->hotel_desc }}</td>
                                            <td>
                                                <div class="d-inline-block">
                                                    <a href="{{ url('/hotels/' . $hotels->hotel_id . '/edit') }}"
                                                        title="Edit Hotels"
                                                        class="btn btn-primary btn-sm  btn-block mb-2">
                                                        <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                                    </a>
                                                </div>
                                                <div class="d-inline-block ml-2">
                                                    <form method="POST"
                                                        action="{{ route('hotel_destroy', $hotels->hotel_id) }}"
                                                        accept-charset="UTF-8">
                                                        {{ method_field('DELETE') }}
                                                        {{ csrf_field() }}
                                                        <button type="submit"
                                                            class="btn btn-danger btn-sm btn-block mb-2"
                                                            title="Delete hotels"
                                                            onclick="return confirm('Are You Sure To DELETE this data?')">
                                                            <i class="fa fa-trash-o" aria-hidden="true"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <br>
        <div class="row">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header" style="width:100%">
                        <div class="row align-items-center" onclick="hideTableTransportation()" style="width: 95%">
                            <div class="col">
                                <h5 class="modal-title" id="estimation-modal-label-role">Transportation</h5>
                            </div>
                            <div class="col-auto" id="transIcon" style="display: block;">
                                <i class="fa fa-caret-down" style="padding-top: 1%; padding-left: 2%;"></i>
                            </div>
                            <div class="col-auto" id="transIconup" style="display: none;">
                                <i class="fa fa-caret-up" style="padding-top: 1%; padding-left: 2%;"></i>
                            </div>
                        </div>
                    </div>

                    <div class="card-body" id="dynamic_field_transportation" style="display: none;">
                        <button type="button" class="btn btn-success mb-2 ml-2 " data-toggle="modal"
                            data-target="#transportations-modal">
                            <i class="fa fa-plus" aria-hidden="true"></i> Add New Transportations
                        </button>

                        <br><br>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Transport</th>
                                        <th style="width: 15%;">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($transportation as $transportations)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $transportations->transportation_desc }}</td>
                                            <td>
                                                <div class="d-inline-block">
                                                    <a href="{{ url('/transportations/' . $transportations->transportation_id . '/edit') }}"
                                                        title="Edit transportations"
                                                        class="btn btn-primary btn-sm  btn-block mb-2">
                                                        <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                                    </a>
                                                </div>
                                                <div class="d-inline-block ml-2">
                                                    <form method="POST"
                                                        action="{{ route('transportation_destroy', $transportations->transportation_id) }}"
                                                        accept-charset="UTF-8">
                                                        {{ method_field('DELETE') }}
                                                        {{ csrf_field() }}
                                                        <button type="submit"
                                                            class="btn btn-danger btn-sm btn-block mb-2"
                                                            title="Delete Events"
                                                            onclick="return confirm('Are You Sure To DELETE this data?')">
                                                            <i class="fa fa-trash-o" aria-hidden="true"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <br>
        <div class="row">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header" style="width:100%">
                        <div class="row align-items-center" onclick="hideTableInfrastructure()" style="width: 95%">
                            <div class="col">
                                <h5 class="modal-title" id="estimation-modal-label-role">Infrastructure</h5>
                            </div>
                            <div class="col-auto" id="infraIcon" style="display: block;">
                                <i class="fa fa-caret-down" style="padding-top: 1%; padding-left: 2%;"></i>
                            </div>
                            <div class="col-auto" id="infraIconup" style="display: none;">
                                <i class="fa fa-caret-up" style="padding-top: 1%; padding-left: 2%;"></i>
                            </div>
                        </div>
                    </div>

                    <div class="card-body" id="dynamic_field_infrastructure" style="display: none;">
                        <button type="button" class="btn btn-success mb-2 ml-2 " data-toggle="modal"
                            data-target="#infrastructure-modal">
                            <i class="fa fa-plus" aria-hidden="true"></i> Add New Infrastructure
                        </button>

                        <br><br>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Infrastructure</th>
                                        <th style="width: 15%;">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($infras as $infrastructure)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $infrastructure->infrastructure_desc }}</td>
                                            <td>
                                                <div class="d-inline-block">
                                                    <a href="{{ url('/infrastructures/' . $infrastructure->infrastructure_id . '/edit') }}"
                                                        title="Edit infrastructure"
                                                        class="btn btn-primary btn-sm  btn-block mb-2">
                                                        <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                                    </a>
                                                </div>
                                                <div class="d-inline-block ml-2">
                                                    <form method="POST"
                                                        action="{{ route('infrastructure_destroy', $infrastructure->infrastructure_id) }}"
                                                        accept-charset="UTF-8">
                                                        {{ method_field('DELETE') }}
                                                        {{ csrf_field() }}
                                                        <button type="submit"
                                                            class="btn btn-danger btn-sm btn-block mb-2"
                                                            title="Delete infrastructure"
                                                            onclick="return confirm('Are You Sure To DELETE this data?')">
                                                            <i class="fa fa-trash-o" aria-hidden="true"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <br>
        <div class="row">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header" style="width:100%">
                        <div class="row align-items-center" onclick="hideTableMarketing()" style="width: 95%">
                            <div class="col">
                                <h5 class="modal-title" id="estimation-modal-label-role">Marketing</h5>
                            </div>
                            <div class="col-auto" id="marketIcon" style="display: block;">
                                <i class="fa fa-caret-down" style="padding-top: 1%; padding-left: 2%;"></i>
                            </div>
                            <div class="col-auto" id="marketIconup" style="display: none;">
                                <i class="fa fa-caret-up" style="padding-top: 1%; padding-left: 2%;"></i>
                            </div>
                        </div>
                    </div>

                    <div class="card-body" id="dynamic_field_marketing" style="display: none;">
                        <button type="button" class="btn btn-success mb-2 ml-2 " data-toggle="modal"
                            data-target="#marketing-modal">
                            <i class="fa fa-plus" aria-hidden="true"></i> Add New Marketing
                        </button>

                        <br><br>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Marketing</th>
                                        <th style="width: 15%;">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($market as $markets)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $markets->marketing_desc }}</td>
                                            <td>
                                                <div class="d-inline-block">
                                                    <a href="{{ url('/marketings/' . $markets->marketing_id . '/edit') }}"
                                                        title="Edit Events"
                                                        class="btn btn-primary btn-sm  btn-block mb-2">
                                                        <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                                    </a>
                                                </div>
                                                <div class="d-inline-block ml-2">
                                                    <form method="POST"
                                                        action="{{ route('marketing_destroy', $markets->marketing_id) }}"
                                                        accept-charset="UTF-8">
                                                        {{ method_field('DELETE') }}
                                                        {{ csrf_field() }}
                                                        <button type="submit"
                                                            class="btn btn-danger btn-sm btn-block mb-2"
                                                            title="Delete Marketing"
                                                            onclick="return confirm('Are You Sure To DELETE this data?')">
                                                            <i class="fa fa-trash-o" aria-hidden="true"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    </div>

    @include('components.hideTable')
    <script>
        function calculateSalaryPerDay() {
            const salary = document.getElementById('salary').value;
            const salaryPerDay = salary / 4 / 5;
            document.getElementById('salary_per_day').value = salaryPerDay;
        }
    </script>
@endsection
