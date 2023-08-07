@extends('layouts.app')
@section('content')

    <div class="container">
        <div class="card" style="max-width: 1200px;">
            <div class="card-header">Edit Quotation</div>
            <div class="card-body">

                <form action="{{ route('cost-estimation-update', ['id' => $cost->id]) }}" method="POST">
                    @csrf
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="company_name" style="display: inline-block; width: 120px;">Company Name:</label>
                        <input type="text" class="form-control" id="company_name" name="company_name"
                            value="{{ $cost->company_name }}" required style="display: inline-block; width: 400px;">
                        <div class="invalid-feedback">Please enter a company name.</div>
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="monthCheckbox" name="monthCheckbox" {{ $cost->is_checked ? 'checked' : '' }}>
                        <label class="form-check-label" for="monthCheckboxs">
                            Monthly Salary
                        </label>
                    </div>

                    <div class="modal-body">
                        <div class="modal-header" style="background-color: rgba(248,248,250); width: 100%">
                            <div class="row align-items-center" onclick="hideTable()" style="width: 95%">
                                <div class="col">
                                  <h5 class="modal-title" id="estimation-modal-label-role" >Role</h5>
                                </div>
                                <div class="row">
                                    <div class="col-auto d-flex align-items-center">
                                        <p class="text-right mr-2 mb-0">Subtotal:</p>
                                        <input type="hidden" class="form-control subtotal" value="{{ $cost->role_sub }}" id="subtotal" name="subtotal" readonly
                                        style="border: none;background-color: transparent;outline: none;width: 200px">
                                        <input type="text" class="form-control subtotals" value="{{ $cost->role_sub }}" id="subtotals" name="subtotals" readonly
                                        style="border: none;background-color: transparent;outline: none;width: 200px">
                                    </div>
                                </div>
                                <div class="col-auto" id="roleIcon" style="display: none;">
                                  <i class="fa fa-caret-down" style="padding-top: 1%; padding-left: 2%;"></i>
                                </div>
                                <div class="col-auto" id="roleIconup" style="display: block;">
                                    <i class="fa fa-caret-up" style="padding-top: 1%; padding-left: 2%;"></i>
                                </div>
                            </div>
                            <button type="button" id="add_row" class="btn btn-success float-right"
                                data-toggle="tooltip" data-placement="left" title="Add a new row" style="display: block;">
                                Add <i class="fa fa-plus"></i>
                            </button>
                        </div>

                        <table class="table table-bordered" id="dynamic_field" style="display: block;">
                            <thead>
                                <tr>
                                    <th style="width: 52%;">Role</th>
                                    <th>Qty</th>
                                    @if($cost->is_checked == 1)
                                        <th id="dayColumn">Month</th>
                                    @else
                                        <th id="dayColumn">Day</th>
                                    @endif
                                    <th style="width: 15%;">Total cost</th>
                                    <th style="width: 8%;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($role_cost as $key => $item)
                                    <tr>
                                        <td>
                                            <select name="role[{{ $key }}][role]" class="form-control role"
                                                id="role">
                                                @foreach ($roles as $role)
                                                    <option value="{{ $role->role }}"
                                                        {{ $item->role == $role->role ? 'selected' : '' }}
                                                        data-salary="{{ $role->salary_per_day }}">
                                                        {{ $role->role }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <input name="role[{{ $key }}][salary_per_day]" type="hidden"
                                                min="0" class="form-control salary_per_day"
                                                value="{{ $item->salary_per_day }}" readonly>
                                        </td>
                                        <td><input type="number" min="0" class="form-control qty" id="qty"
                                                name="role[{{ $key }}][qty]" value="{{ $item->qty }}">
                                        </td>
                                        <td><input type="number" min="0" class="form-control day" id="day"
                                                name="role[{{ $key }}][day]" value="{{ $item->day }}">
                                        </td>
                                        <td><input type="text" class="form-control total" value="{{ $item->total }}"
                                                id="total" name="role[{{ $key }}][total]" readonly></td>
                                        <td>
                                            <button class="btn btn-danger btn-sm" onclick="removeRow(this)">
                                                Remove <i class="fa fa-trash"></i></button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <div class="modal-header" style="background-color: rgba(248,248,250);width: 100%">
                            <div class="row align-items-center" onclick="hideTableService()" style="width: 95%">
                                <div class="col">
                                    <h5 class="modal-title" id="estimation-modal-label">Service</h5>
                                </div>
                                <div class="row">
                                    <div class="col-auto d-flex align-items-center">
                                        <p class="text-right mr-2 mb-0">Subtotal:</p>
                                        <input type="hidden" class="form-control subtotal_service" value="{{ $cost->service_sub }}" id="subtotal_service" name="subtotal_service" readonly
                                        style="border: none;background-color: transparent;outline: none;width: 200px">
                                        <input type="text" class="form-control subtotal_services" value="{{ $cost->service_sub }}" id="subtotal_services" name="subtotal_services" readonly
                                        style="border: none;background-color: transparent;outline: none;width: 200px">
                                    </div>
                                </div>
                                <div class="col-auto" id="serviceIcon" style="display: block;">
                                  <i class="fa fa-caret-down" style="padding-top: 1%; padding-left: 2%;"></i>
                                </div>
                                <div class="col-auto" id="serviceIconup" style="display: none;">
                                    <i class="fa fa-caret-up" style="padding-top: 1%; padding-left: 2%;"></i>
                                  </div>
                            </div>

                            <button type="button" id="add_row_service" class="btn btn-success float-right" style="display: none;"
                                data-toggle="tooltip" data-placement="left" title="Add a new row">
                                Add <i class="fa fa-plus"></i>
                            </button>
                        </div>

                        <table class="table table-bordered" id="dynamic_field_service" style="display: none;">
                            <thead>
                                <tr>
                                    <th style="width: 20%">Services</th>
                                    <th style="width: 25%">Remarks</th>
                                    <th>Pax</th>
                                    <th>Day</th>
                                    <th style="width: 12%">Cost</th>
                                    <th style="width: 15%">Total</th>
                                    <th style="width: 8%;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($service_cost as $key => $item)
                                <tr>
                                    <td>
                                        <select name="services[{{ $key }}][services]" class="form-control services">
                                            @foreach ($service as $services)
                                                <option value="{{ $services->service_desc }}"
                                                    {{ $item->services == $services->service_desc ? 'selected' : '' }}>
                                                    {{ $services->service_desc }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <textarea name="services[{{ $key }}][remark]" class="form-control remarks_service">{{ $item->remark }}</textarea>
                                    </td>
                                    <td><input type="number" name="services[{{ $key }}][pax]" class="form-control pax_service" value="{{ $item->pax }}"></td>
                                    <td><input type="number" name="services[{{ $key }}][day]" class="form-control day_service" value="{{ $item->day }}"></td>
                                    <td><input type="number" name="services[{{ $key }}][cost]" class="form-control cost_service" value="{{ $item->cost }}"></td>
                                    <td><input type="number" name="services[{{ $key }}][total]" class="form-control total_service" value="{{ $item->total }}" readonly></td>
                                    <td><button class="btn btn-danger btn-sm" onclick="removeRowService(this)">
                                        Remove <i class="fa fa-trash"></i></button></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <div class="modal-header" style="background-color: rgba(248,248,250);width: 100%">
                            <div class="row align-items-center" onclick="hideTableEvent()" style="width: 95%">
                                <div class="col">
                                    <h5 class="modal-title" id="estimation-modal-label">Event Hall</h5>
                                </div>
                                <div class="row">
                                    <div class="col-auto d-flex align-items-center">
                                        <p class="text-right mr-2 mb-0">Subtotal:</p>
                                        <input type="hidden" class="form-control subtotal_event" value="{{ $cost->event_sub }}" id="subtotal_event" name="subtotal_event" readonly
                                        style="border: none;background-color: transparent;outline: none;width: 200px">
                                        <input type="text" class="form-control subtotal_events" value="{{ $cost->event_sub }}" id="subtotal_events" name="subtotal_events" readonly
                                        style="border: none;background-color: transparent;outline: none;width: 200px">
                                    </div>
                                </div>
                                <div class="col-auto" id="eventIcon" style="display: block;">
                                  <i class="fa fa-caret-down" style="padding-top: 1%; padding-left: 2%;"></i>
                                </div>
                                <div class="col-auto" id="eventIconup" style="display: none;">
                                    <i class="fa fa-caret-up" style="padding-top: 1%; padding-left: 2%;"></i>
                                </div>
                            </div>

                            <button type="button" id="add_row_event" class="btn btn-success float-right" style="display: none;"
                                data-toggle="tooltip" data-placement="left" title="Add a new row">
                                Add <i class="fa fa-plus"></i>
                            </button>
                        </div>

                        <table class="table table-bordered" id="dynamic_field_event" style="display: none;">
                            <thead>
                                <tr>
                                    <th style="width: 20%">Event Hall</th>
                                    <th style="width: 25%">Remark</th>
                                    <th>Pax</th>
                                    <th>Day</th>
                                    <th style="width: 12%">Cost</th>
                                    <th style="width: 15%">Total</th>
                                    <th style="width: 8%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($event_cost as $key => $item)
                                <tr>
                                    <td>
                                        <select name="event[{{ $key }}][event]" class="form-control event_hall">
                                            @foreach ($event as $events)
                                                <option value="{{ $events->event_desc }}"
                                                    {{ $item->events == $events->service_desc ? 'selected' : '' }}>
                                                    {{ $events->event_desc }}
                                                </option>
                                            @endforeach

                                        </select>
                                    </td>
                                    <td>
                                        <textarea name="event[{{ $key }}][remark]" class="form-control remarks_event">{{ $item->remark }}</textarea>
                                    </td>
                                    <td><input type="number" name="event[{{ $key }}][pax]" class="form-control pax_event" value="{{ $item->pax }}"></td>
                                    <td><input type="number" name="event[{{ $key }}][day]" class="form-control day_event" value="{{ $item->day }}"></td>
                                    <td><input type="number" name="event[{{ $key }}][cost]" value="{{ $item->cost }}" class="form-control cost_event"></td>
                                    <td><input type="text" name="event[{{ $key }}][total]" value="{{ $item->total }}" class="form-control total_event" readonly></td>
                                    <td><button class="btn btn-danger btn-sm" onclick="removeRowEvent(this)">
                                        Remove <i class="fa fa-trash"></i></button></td></td>
                                </tr>
                                @endforeach
                            </tbody>

                        </table>


                        <div class="modal-header" style="background-color: rgba(248,248,250);width: 100%">
                            <div class="row align-items-center" onclick="hideTableHotel()" style="width: 95%">
                                <div class="col">
                                    <h5 class="modal-title" id="estimation-modal-label">Hotel</h5>
                                </div>
                                <div class="row">
                                    <div class="col-auto d-flex align-items-center">
                                        <p class="text-right mr-2 mb-0">Subtotal:</p>
                                        <input type="hidden" class="form-control subtotal_hotel" value="{{ $cost->hotel_sub }}" id="subtotal_hotel" name="subtotal_hotel" readonly
                                        style="border: none;background-color: transparent;outline: none;width: 200px">
                                        <input type="text" class="form-control subtotal_hotels" value="{{ $cost->hotel_sub }}" id="subtotal_hotels" name="subtotal_hotels" readonly
                                        style="border: none;background-color: transparent;outline: none;width: 200px">
                                    </div>
                                </div>
                                <div class="col-auto" id="hotelIcon" style="display: block;">
                                  <i class="fa fa-caret-down" style="padding-top: 1%; padding-left: 2%;"></i>
                                </div>
                                <div class="col-auto" id="hotelIconup" style="display: none;">
                                    <i class="fa fa-caret-up" style="padding-top: 1%; padding-left: 2%;"></i>
                                  </div>
                            </div>

                            <button type="button" id="add_row_hotel" class="btn btn-success float-right" style="display: none;"
                                data-toggle="tooltip" data-placement="left" title="Add a new row">
                                Add <i class="fa fa-plus"></i>
                            </button>
                        </div>

                        <table class="table table-bordered" id="dynamic_field_hotel" style="display: none;">
                            <thead>
                                <tr>
                                    <th style="width: 20%">Hotel</th>
                                    <th style="width: 24%">Remark</th>
                                    <th>Pax</th>
                                    <th>Night</th>
                                    <th style="width: 13%">Cost</th>
                                    <th style="width: 15%">Total</th>
                                    <th style="width: 8%">action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($hotel_cost as $key => $item)
                                <tr>
                                    <td>
                                        <select name="hotel[{{ $key }}][hotel]" class="form-control hotel">
                                            @foreach ($hotel as $hotels)
                                                <option value="{{ $hotels->hotel_desc }}"
                                                    {{ $item->hotels == $hotels->hotel_desc ? 'selected' : '' }}>
                                                    {{ $hotels->hotel_desc }}
                                                </option>
                                            @endforeach

                                        </select>
                                    </td>
                                    <td>
                                        <textarea name="hotel[{{ $key }}][remark]" class="form-control remarks_hotel">{{ $item->remark }}</textarea>
                                    </td>
                                    <td><input type="number" name="hotel[{{ $key }}][pax]" class="form-control pax_hotel" value="{{ $item->pax }}"></td>
                                    <td><input type="number" name="hotel[{{ $key }}][day]" class="form-control day_hotel" value="{{ $item->night }}"></td>
                                    <td><input type="number" name="hotel[{{ $key }}][cost]" value="{{ $item->cost }}" class="form-control cost_hotel"></td>
                                    <td><input type="text" name="hotel[{{ $key }}][total]" value="{{ $item->total }}" class="form-control total_hotel" readonly></td>
                                    <td><button class="btn btn-danger btn-sm" onclick="removeRowHotel(this)">
                                        Remove <i class="fa fa-trash"></i></button></td></td>
                                </tr>
                                @endforeach
                            </tbody>

                        </table>

                        <div class="modal-header" style="background-color: rgba(248,248,250);width: 100%">
                            <div class="row align-items-center" onclick="hideTableTransportation()" style="width: 95%">
                                <div class="col">
                                    <h5 class="modal-title" id="estimation-modal-label">Transportation</h5>
                                </div>
                                <div class="row">
                                    <div class="col-auto d-flex align-items-center">
                                        <p class="text-right mr-2 mb-0">Subtotal:</p>
                                        <input type="hidden" class="form-control subtotal_transportation" value="{{ $cost->trans_sub }}" id="subtotal_transportation" name="subtotal_transportation"
                                        readonly style="border: none;background-color: transparent;outline: none;width: 200px">
                                        <input type="text" class="form-control subtotal_transportations" value="{{ $cost->trans_sub }}" id="subtotal_transportations" name="subtotal_transportations"
                                        readonly style="border: none;background-color: transparent;outline: none;width: 200px">
                                    </div>
                                </div>
                                <div class="col-auto" id="transIcon" style="display: block;">
                                  <i class="fa fa-caret-down" style="padding-top: 1%; padding-left: 2%;"></i>
                                </div>
                                <div class="col-auto" id="transIconup" style="display: none;">
                                    <i class="fa fa-caret-up" style="padding-top: 1%; padding-left: 2%;"></i>
                                  </div>
                            </div>

                            <button type="button" id="add_row_transportation" class="btn btn-success float-right" style="display: none;"
                                data-toggle="tooltip" data-placement="left" title="Add a new row">
                                Add <i class="fa fa-plus"></i>
                            </button>
                        </div>

                        <table class="table table-bordered" id="dynamic_field_transportation" style="display: none;">
                            <thead>
                                <tr>
                                    <th style="width: 20%">Transportation</th>
                                    <th style="width: 25%">Remark</th>
                                    <th>Pax</th>
                                    <th>Trips</th>
                                    <th style="width: 13%">Cost</th>
                                    <th style="width: 15%">Total</th>
                                    <th style="width: 8%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($trans_cost as $key => $item)
                                <tr>
                                    <td>
                                        <select name="transportation[{{ $key }}][transportation]" class="form-control transportation">
                                            @foreach ($transportation as $transportations)
                                                <option value="{{ $transportations->transportation_desc }}"
                                                    {{ $item->transportations == $transportations->transportation_desc ? 'selected' : '' }}>
                                                    {{ $transportations->transportation_desc }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <textarea name="transportation[{{ $key }}][remark]" class="form-control remarks_transportation">{{ $item->remark }}</textarea>
                                    </td>
                                    <td><input type="number" name="transportation[{{ $key }}][pax]" class="form-control pax_transportation" value="{{ $item->pax }}"></td>
                                    <td><input type="number" name="transportation[{{ $key }}][trip]" class="form-control trip_transportation" value="{{ $item->trip }}"></td>
                                    <td><input type="number" name="transportation[{{ $key }}][cost]" value="{{ $item->cost }}" class="form-control cost_transportation"></td>
                                    <td><input type="text" name="transportation[{{ $key }}][total]" value="{{ $item->total }}" class="form-control total_transportation" readonly></td>
                                    <td><button class="btn btn-danger btn-sm" onclick="removeRowTrans(this)">
                                        Remove <i class="fa fa-trash"></i></button></td></td>
                                </tr>
                                @endforeach
                            </tbody>

                        </table>

                        <div class="modal-header" style="background-color: rgba(248,248,250);width: 100%">

                            <div class="row align-items-center" onclick="hideTableInfrastructure()" style="width: 95%">
                                <div class="col">
                                    <h5 class="modal-title" id="estimation-modal-label">Infrastructure</h5>
                                </div>
                                <div class="row">
                                    <div class="col-auto d-flex align-items-center">
                                        <p class="text-right mr-2 mb-0">Subtotal:</p>
                                        <input type="hidden" class="form-control subtotal_infrastructure" value="{{ $cost->infras_sub }}" id="subtotal_infrastructure" name="subtotal_infrastructure"
                                        readonly style="border: none;background-color: transparent;outline: none;width: 200px">
                                        <input type="text" class="form-control subtotal_infrastructures" value="{{ $cost->infras_sub }}" id="subtotal_infrastructures" name="subtotal_infrastructures"
                                        readonly style="border: none;background-color: transparent;outline: none;width: 200px">
                                    </div>
                                </div>
                                <div class="col-auto" id="infraIcon" style="display: block;">
                                  <i class="fa fa-caret-down" style="padding-top: 1%; padding-left: 2%;"></i>
                                </div>
                                <div class="col-auto" id="infraIconup" style="display: none;">
                                    <i class="fa fa-caret-up" style="padding-top: 1%; padding-left: 2%;"></i>
                                  </div>
                            </div>
                            <button type="button" id="add_row_infrastructure" class="btn btn-success float-right" style="display: none;"
                                data-toggle="tooltip" data-placement="left" title="Add a new row">
                                Add <i class="fa fa-plus"></i>
                            </button>
                        </div>

                        <table class="table table-bordered" id="dynamic_field_infrastructure" style="display: none;">
                            <thead>
                                <tr>
                                    <th style="width: 20%">Infrastructure</th>
                                    <th style="width: 25%">Remark</th>
                                    <th>Item</th>
                                    <th>Year</th>
                                    <th style="width: 13%">Cost</th>
                                    <th style="width: 15%">Total</th>
                                    <th style="width: 8%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($infras_cost as $key => $item)
                                <tr>
                                    <td>
                                        <select name="infrastructure[{{ $key }}][infrastructure]" class="form-control infrastructure">
                                            @foreach ($infrastructure as $infra)
                                                <option value="{{ $infra->infrastructure_desc }}"
                                                    {{ $item->infrastructures == $infra->infrastructure_desc ? 'selected' : '' }}>
                                                    {{ $infra->infrastructure_desc }}
                                                </option>
                                            @endforeach

                                        </select>
                                    </td>
                                    <td>
                                        <textarea name="infrastructure[{{ $key }}][remark]" class="form-control remarks_infrastructure">{{ $item->remark }}</textarea>
                                    </td>
                                    <td><input type="number" name="infrastructure[{{ $key }}][item]" class="form-control item_infrastructure" value="{{ $item->item }}"></td>
                                    <td><input type="number" name="infrastructure[{{ $key }}][year]" class="form-control year_infrastructure" value="{{ $item->year }}"></td>
                                    <td><input type="number" name="infrastructure[{{ $key }}][cost]" value="{{ $item->cost }}" class="form-control cost_infrastructure"></td>
                                    <td><input type="text" name="infrastructure[{{ $key }}][total]" value="{{ $item->total }}" class="form-control total_infrastructure" readonly></td>
                                    <td><button class="btn btn-danger btn-sm" onclick="removeRowInfras(this)">
                                        Remove <i class="fa fa-trash"></i></button></td></td>
                                </tr>
                                @endforeach
                            </tbody>

                        </table>

                        <div class="modal-header" style="background-color: rgba(248,248,250);width: 100%">
                            <div class="row align-items-center" onclick="hideTableMarketing()" style="width: 95%">
                                <div class="col">
                                    <h5 class="modal-title" id="estimation-modal-label">Marketing</h5>
                                </div>
                                <div class="row">
                                    <div class="col-auto d-flex align-items-center">
                                        <p class="text-right mr-2 mb-0">Subtotal:</p>
                                        <input type="hidden" class="form-control subtotal_marketing" value="{{ $cost->market_sub }}" id="subtotal_marketing" name="subtotal_marketing" readonly
                                        style="border: none;background-color: transparent;outline: none;width: 200px">
                                        <input type="text" class="form-control subtotal_marketings" value="{{ $cost->market_sub }}" id="subtotal_marketings" name="subtotal_marketings" readonly
                                        style="border: none;background-color: transparent;outline: none;width: 200px">
                                    </div>
                                </div>
                                <div class="col-auto" id="marketIcon" style="display: block;">
                                  <i class="fa fa-caret-down" style="padding-top: 1%; padding-left: 2%;"></i>
                                </div>
                                <div class="col-auto" id="marketIconup" style="display: none;">
                                    <i class="fa fa-caret-up" style="padding-top: 1%; padding-left: 2%;"></i>
                                  </div>
                            </div>

                            <button type="button" id="add_row_marketing" class="btn btn-success float-right" style="display: none;"
                                data-toggle="tooltip" data-placement="left" title="Add a new row">
                                Add <i class="fa fa-plus"></i>
                            </button>
                        </div>

                        <table class="table table-bordered" id="dynamic_field_marketing" style="display: none;">
                            <thead>
                                <tr>
                                    <th style="width: 20%">Marketing</th>
                                    <th style="width: 30%">Remark</th>
                                    <th>Item</th>
                                    <th style="width: 13%">Cost</th>
                                    <th style="width: 15%">Total</th>
                                    <th style="width: 8%">action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($market_cost as $key => $item)
                                <tr>
                                    <td>
                                        <select name="marketing[{{ $key }}][marketing]" class="form-control marketing">
                                            @foreach ($marketing as $markets)
                                                <option value="{{ $markets->marketing_desc }}"
                                                    {{ $item->marketings == $markets->marketing_desc ? 'selected' : '' }}>
                                                    {{ $markets->marketing_desc }}
                                                </option>
                                            @endforeach

                                        </select>
                                    </td>
                                    <td>
                                        <textarea name="marketing[{{ $key }}][remark]" class="form-control remarks_marketing">{{ $item->remark }}</textarea>
                                    </td>
                                    <td><input type="number" name="marketing[{{ $key }}][item]" class="form-control item_marketing" value="{{ $item->item }}"></td>
                                    <td><input type="number" name="marketing[{{ $key }}][cost]" value="{{ $item->cost }}" class="form-control cost_marketing"></td>
                                    <td><input type="text" name="marketing[{{ $key }}][total]" value="{{ $item->total }}" class="form-control total_marketing" readonly></td>
                                    <td><button class="btn btn-danger btn-sm" onclick="removeRowMarket(this)">
                                        Remove <i class="fa fa-trash"></i></button></td>
                                </tr>
                                @endforeach
                            </tbody>

                        </table>

                        <div class="modal-header" style="background-color: rgba(248,248,250);width: 100%">
                            <div class="row align-items-center" onclick="hideTableOtherFactor()" style="width: 95%">
                                <div class="col">
                                    <h5 class="modal-title" id="estimation-modal-label">Other Factor</h5>
                                </div>
                                <div class="row">
                                    <div class="col-auto d-flex align-items-center">
                                        <p class="text-right mr-2 mb-0">Subtotal:</p>
                                        <input type="hidden" class="form-control sub_other_factor" value="0" id="sub_other_factor" name="sub_other_factor" readonly
                                        style="border: none;background-color: transparent;outline: none;width: 200px">
                                        <input type="text" class="form-control sub_other_factors" value="0" id="sub_other_factors" name="sub_other_factors" readonly
                                        style="border: none;background-color: transparent;outline: none;width: 200px">
                                    </div>
                                </div>
                                <div class="col-auto" id="otherfactorIcon" style="display: block;">
                                    <i class="fa fa-caret-down" style="padding-top: 1%; padding-left: 2%;"></i>
                                </div>
                                <div class="col-auto" id="otherfactorIconup" style="display: none;">
                                    <i class="fa fa-caret-up" style="padding-top: 1%; padding-left: 2%;"></i>
                                </div>
                            </div>
                        </div>

                        <div id="other_factor_div" style="display: none;">
                            <div class="form-group" style="font-size: 18px;">
                                <br>
                                <label style="padding-left: 4em; padding-right: 4.2em;">Profile:</label>
                                <tr>
                                    <div class="form-check form-check-inline">
                                        <div class="radio">
                                            <input class="form-check-input" type="radio" name="Profile" id="sme"
                                                value="SME" {{ $cost->profile == 'SME' ? 'checked' : '' }}>SME
                                        </div>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <div class="radio">
                                            <input class="form-check-input" type="radio" name="Profile" id="Corporate"
                                                value="Corporate" {{ $cost->profile == 'Corporate' ? 'checked' : '' }}>Corporate
                                        </div>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <div class="radio">
                                            <input class="form-check-input" type="radio" name="Profile" id="MNC"
                                                value="MNC" {{ $cost->profile == 'MNC' ? 'checked' : '' }}>MNC
                                        </div>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <div class="radio">
                                            <input class="form-check-input" type="radio" name="Profile" id="Government"
                                                value="Government" {{ $cost->profile == 'Government' ? 'checked' : '' }}>Government
                                        </div>
                                    </div>
                                </tr>
                            </div>


                            <br>
                            <div class="form-group1" style="font-size: 18px;">
                                <label style="padding-left: 4em; padding-right: 3.5em;">Process:</label>


                                <div class="form-check form-check-inline">
                                    <div class="radio">
                                        <input class="form-check-input" type="radio" name="size" id="Small"
                                            value="Small" {{ $cost->size == 'Small' ? 'checked' : '' }}>Small
                                    </div>
                                </div>

                                <div class="form-check form-check-inline">
                                    <div class="radio">
                                        <input class="form-check-input" type="radio" name="size" id="Medium"
                                            value="Medium" {{ $cost->size == 'Medium' ? 'checked' : '' }}>Medium
                                    </div>
                                </div>

                                <div class="form-check form-check-inline">
                                    <div class="radio">
                                        <input class="form-check-input" type="radio" name="size" id="Large"
                                            value="Large" {{ $cost->size == 'Large' ? 'checked' : '' }}>Large
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                    <br>
                    <table class="table table-borderless" style="text-align: right;">
                        <input type="hidden" class="form-control factorRate" name="factorRate" id="factorRate" value="{{ $company_profit->otherFactor}}">
                        <tr>
                            <th class="text-right" style="width: 70%">Total:</th>
                            <th style="padding-right:3%"><input type="text" class="form-control subtotal_alls"
                                    value="0" name="subtotal_alls" readonly></th>
                                    <input type="hidden" class="form-control total_cost"
                                    value="0" name="totalcost" readonly>
                        </tr>

                        {{-- <tr>
                            <th class="text-right" style="width: 70%">Total Cost:</th>
                            <th style="padding-right:3%"><input type="hidden" class="form-control total_cost"
                                    value="0" name="totalcost" readonly>
                                    <input type="text" class="form-control total_costs"
                                    value="0" name="totalcosts" readonly></th>
                        </tr> --}}
                        <tr>
                            <th class="text-right" style="width: 70%">Rough Profit:</th>
                            <th style="padding-right:3%"><input type="hidden" class="form-control RProfit"
                                    value="0" name="RProfit" readonly>
                                    <input type="text" class="form-control RProfits"
                                    value="0" name="RProfits" readonly></th>
                        </tr>
                        <tr>
                            <th class="text-right" style="width: 70%">SST:</th>
                            <th style="padding-right:3%"><input type="hidden" class="form-control sst"
                                    value="0" name="sst" readonly>
                                    <input type="text" class="form-control ssts"
                                    value="0" name="ssts" readonly></th>
                        </tr>
                        <tr>
                            <th class="text-right" style="width: 70%">Total Estimation:</th>
                            <th style="padding-right:3%"><input type="hidden" class="form-control total_esti"
                                    value="0" name="total_esti" readonly>
                                    <input type="text" class="form-control total_estis"
                                    value="0" name="total_estis" readonly></th>
                        </tr>
                    </table>
                    <div class="modal-footer">
                        <a href="{{ route('costestimation') }}" class="btn btn-secondary mb-2 ml-2">Back</a>
                        <button type="submit" class="btn btn-primary mb-2 ml-2" id="save-estimation">Update</button>
                    </div>
                </form>

            </div>
        </div>
        <br>

        <h4>Quotation History Log</h4>
        @foreach ($quotation_history as $history)
            <p> {{ $loop->iteration }}. Quotation Created at {{ $history->created_at }} -- Total Cost (SST): RM<strong>
                {{ $history->previous_total_cost }}</strong> -- Total Estimation: RM<strong> {{ $history->previous_total_estimation }}</strong></p>
        @endforeach
        <br><br><br>

    </div>

@include('components.removeRow')
@include('components.onchangefunction')
@include('components.hideTable')
@include('components.addnewRow')
    <script>
        $(document).on('change', '.role', function() {
            var salaryInput = $(this).closest('tr').find('.salary_per_day');
            var salaryPerDay = $(this).find(':selected').data('salary');
            salaryInput.val(salaryPerDay);
            if ($('#monthCheckbox').is(':checked')) {
                salaryInput.val(salaryInput.val() * 20);
            }
            calculateTotal();
        });

        $(document).ready(function() {
            // add event listener to radio buttons
            $('input[name="Profile"], input[name="size"]').change(function() {
                calculateTotal();
            });
        });

        function calculateTotal() {
            var subtotal = 0;
            var totalPoints = 0;
            var total_sub = 0;
            var subtotal_service = parseFloat($('#subtotal_service').val());
            var subtotal_event = parseFloat($('#subtotal_event').val());
            var subtotal_hotel = parseFloat($('#subtotal_hotel').val());
            var subtotal_transportation = parseFloat($('#subtotal_transportation').val());
            var subtotal_infrastructure = parseFloat($('#subtotal_infrastructure').val());
            var subtotal_marketing = parseFloat($('#subtotal_marketing').val());
            var profile = $('input[name=Profile]:checked').val();
            var size = $('input[name=size]:checked').val();

            $('#dynamic_field tbody tr').each(function() {
                var salaryPerDay = parseFloat($(this).find('.salary_per_day').val());
                var qty = parseFloat($(this).find('.qty').val());
                var day = parseFloat($(this).find('.day').val());

                // Check if input values are valid numbers
                if (!isNaN(salaryPerDay) && !isNaN(qty) && !isNaN(day)) {
                    var total = salaryPerDay * qty * day;
                    $(this).find('.total').val(total);
                    subtotal += total;
                }
            });

            total_sub += subtotal;
            total_sub += subtotal_service;
            total_sub += subtotal_event;
            total_sub += subtotal_hotel;
            total_sub += subtotal_transportation;
            total_sub += subtotal_infrastructure;
            total_sub += subtotal_marketing;

            if (profile == "Government") {
                if (size == "Small") {
                    totalPoints = 5;
                } else if (size == "Medium") {
                    totalPoints = 6;
                } else if (size == "Large") {
                    totalPoints = 7;
                }
            } else if (profile == "MNC") {
                if (size == "Small") {
                    totalPoints = 4;
                } else if (size == "Medium") {
                    totalPoints = 5;
                } else if (size == "Large") {
                    totalPoints = 6;
                }
            } else if (profile == "Corporate") {
                if (size == "Small") {
                    totalPoints = 3;
                } else if (size == "Medium") {
                    totalPoints = 4;
                } else if (size == "Large") {
                    totalPoints = 5;
                }
            } else if (profile == "SME") {
                if (size == "Small") {
                    totalPoints = 2;
                } else if (size == "Medium") {
                    totalPoints = 3;
                } else if (size == "Large") {
                    totalPoints = 4;
                }
            }

            var otherFactors = {{ $cost->factorRate / 100 }};
            var profitRate = {{ $company_profit->company_profit / 100 }};
            if (totalPoints >= 6 && totalPoints <= 7) {
                otherFactor = otherFactors;
            } else if (totalPoints >= 3 && totalPoints <= 5) {
                otherFactor = otherFactors / 2;
            } else {
                otherFactor = 0;
            }

            var subtotal_all = (total_sub * (1 + otherFactor)).toFixed(2);
            var sub_other = (total_sub * otherFactor).toFixed(2);
            var totalCost = (total_sub * (1 + otherFactor) * 1.06).toFixed(2);
            var sst = (((subtotal_all * profitRate) + (total_sub * (1 + otherFactor))) * 0.06).toFixed(2);
            var RProfit = (subtotal_all * profitRate).toFixed(2);
            var total_esti = parseFloat(subtotal_all) + parseFloat(RProfit) + parseFloat(sst);
            $('.total_esti').val(total_esti.toFixed(2));
            $('.total_estis').val(parseFloat(total_esti).toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 }));
            $('.RProfit').val(RProfit);
            $('.RProfits').val(parseFloat(RProfit).toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 }));
            $('.subtotal_all').val(subtotal_all);
            $('.subtotal_alls').val(parseFloat(subtotal_all).toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 }));
            $('.sub_other_factor').val(sub_other);
            $('.sub_other_factors').val(parseFloat(sub_other).toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 }));
            $('.subtotal').val((subtotal).toFixed(2));
            $('.subtotals').val(parseFloat(subtotal).toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 }));
            $('.subtotal_service').val((subtotal_service).toFixed(2));
            $('.subtotal_services').val(parseFloat(subtotal_service).toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 }));
            $('.subtotal_event').val((subtotal_event).toFixed(2));
            $('.subtotal_events').val(parseFloat(subtotal_event).toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 }));
            $('.subtotal_hotel').val((subtotal_hotel).toFixed(2));
            $('.subtotal_hotels').val(parseFloat(subtotal_hotel).toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 }));
            $('.subtotal_transportation').val((subtotal_transportation).toFixed(2));
            $('.subtotal_transportations').val(parseFloat(subtotal_transportation).toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 }));
            $('.subtotal_infrastructure').val((subtotal_infrastructure).toFixed(2));
            $('.subtotal_infrastructures').val(parseFloat(subtotal_infrastructure).toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 }));
            $('.subtotal_marketing').val((subtotal_marketing).toFixed(2));
            $('.subtotal_marketings').val(parseFloat(subtotal_marketing).toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 }));
            $('.total_cost').val(totalCost);
            $('.total_costs').val(parseFloat(totalCost).toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 }));
            $('.sst').val(sst);
            $('.ssts').val(parseFloat(sst).toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 }));
        }
    </script>

<script>
    $(document).on('change', '#monthCheckbox', function() {
        const monthCheckbox = $('#monthCheckbox');
        const dayColumn = $('#dayColumn');
        const salaryInputs = $('.salary_per_day');

        if (monthCheckbox.is(':checked')) {
            dayColumn.text('Month');
            salaryInputs.each(function() {
                $(this).val($(this).val() * 20);
            });
        } else {
            dayColumn.text('Day');
            salaryInputs.each(function() {
                $(this).val($(this).val() / 20);
            });
        }
        calculateTotal();
    });

</script>
@stop
