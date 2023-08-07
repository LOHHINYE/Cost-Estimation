@extends('layouts.app')

@section('content')
    <!-- Estimation modal -->
    <div class="modal fade" id="estimation-modal" tabindex="-1" role="dialog" aria-labelledby="estimation-modal-label">
        <div class="modal-dialog modal-lg xl" style="max-width: 1200px;" role="document">
            <div class="modal-content">
                <form action="{{ route('cost-estimation-save') }}" method="POST">
                    @csrf
                    {{ csrf_field() }}
                    <div class="modal-header">
                        <h4 class="modal-title" id="estimation-modal-label">Cost Estimation</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="company_name" style="display: inline-block; width: 120px;">Company Name:</label>
                            <input type="text" class="form-control" id="company_name" name="company_name" required
                                style="display: inline-block; width: 400px;">
                            <div class="invalid-feedback">Please enter a company name.</div>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="monthCheckbox" name="monthCheckbox">
                            <label class="form-check-label" for="monthCheckbox">
                                Salary by Month
                            </label>
                        </div>

                        <div class="modal-header" style="background-color: rgba(248,248,250); width: 100%">
                            <div class="row align-items-center" onclick="hideTable()" style="width: 95%">
                                <div class="col">
                                    <h5 class="modal-title" id="estimation-modal-label-role" >Role</h5>
                                </div>
                                <div class="row">
                                    <div class="col-auto d-flex align-items-center">
                                        <p class="text-right mr-2 mb-0">Subtotal:</p>
                                        <input type="hidden" class="form-control subtotal" value="0" id="subtotal" name="subtotal" readonly
                                        style="border: none;background-color: transparent;outline: none;width: 200px">
                                        <input type="text" class="form-control subtotals" value="0" id="subtotals" name="subtotals" readonly
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
                                    <th style="width: 40%">Role</th>
                                    <th>Qty</th>
                                    <th id="dayColumn">Day</th>
                                    <th style="width: 15%">Total</th>
                                    <th style="width: 8%;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($default_roles as $key => $default_roles_item)
                                    <tr>
                                        <td>
                                            <select name="role[{{ $key }}][role]" class="form-control role"
                                                id="role">
                                                @foreach ($roles as $role)
                                                    <option value="{{ $role->role }}"
                                                        {{ $default_roles_item->role == $role->role ? 'selected' : '' }}
                                                        data-salary="{{ $role->salary_per_day }}">
                                                        {{ $role->role }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <input name="role[{{ $key }}][salary_per_day]" type="hidden"
                                                min="0" class="form-control salary_per_day"
                                                value="{{ $default_roles_item->salary_per_day }}" readonly>
                                        </td>
                                        <td><input type="number" min="0" class="form-control qty" id="qty"
                                                name="role[{{ $key }}][qty]"
                                                value="{{ $default_roles_item->qty ?: 1 }}"></td>
                                        <td><input type="number" min="0" class="form-control day" id="day"
                                                name="role[{{ $key }}][day]"
                                                value="{{ $default_roles_item->day ?: 1 }}"></td>
                                        <td><input type="text" class="form-control total"
                                                value="{{ $default_roles_item->total }}" id="total"
                                                name="role[{{ $key }}][total]" readonly></td>
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
                                        <input type="hidden" class="form-control subtotal_service" value="0" id="subtotal_service" name="subtotal_service" readonly
                                        style="border: none;background-color: transparent;outline: none;width: 200px">
                                        <input type="text" class="form-control subtotal_services" value="0" id="subtotal_services" name="subtotal_services" readonly
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
                                        <input type="hidden" class="form-control subtotal_event" value="0" id="subtotal_event" name="subtotal_event" readonly
                                        style="border: none;background-color: transparent;outline: none;width: 200px">
                                        <input type="text" class="form-control subtotal_events" value="0" id="subtotal_events" name="subtotal_events" readonly
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
                                    <th style="width: 8%;">Action</th>
                                </tr>
                            </thead>
                            <tbody>

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
                                        <input type="hidden" class="form-control subtotal_hotel" value="0" id="subtotal_hotel" name="subtotal_hotel" readonly
                                        style="border: none;background-color: transparent;outline: none;width: 200px">
                                        <input type="text" class="form-control subtotal_hotels" value="0" id="subtotal_hotels" name="subtotal_hotels" readonly
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
                                    <th style="width: 25%">Remark</th>
                                    <th>Pax</th>
                                    <th>Night</th>
                                    <th style="width: 13%">Cost</th>
                                    <th style="width: 15%">Total</th>
                                    <th style="width: 8%;">Action</th>
                                </tr>
                            </thead>
                            <tbody>

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
                                        <input type="hidden" class="form-control subtotal_transportation" value="0" id="subtotal_transportation" name="subtotal_transportation" readonly
                                        style="border: none;background-color: transparent;outline: none;width: 200px">
                                        <input type="text" class="form-control subtotal_transportations" value="0" id="subtotal_transportations" name="subtotal_transportations" readonly
                                        style="border: none;background-color: transparent;outline: none;width: 200px">
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
                                    <th style="width: 8%;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
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
                                        <input type="hidden" class="form-control subtotal_infrastructure" value="0" id="subtotal_infrastructure" name="subtotal_infrastructure" readonly
                                        style="border: none;background-color: transparent;outline: none;width: 200px">
                                        <input type="text" class="form-control subtotal_infrastructures" value="0" id="subtotal_infrastructures" name="subtotal_infrastructures" readonly
                                        style="border: none;background-color: transparent;outline: none;width: 200px">
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
                                    <th style="width: 8%;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
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
                                        <input type="hidden" class="form-control subtotal_marketing" value="0" id="subtotal_marketing" name="subtotal_marketing" readonly
                                        style="border: none;background-color: transparent;outline: none;width: 200px">
                                        <input type="text" class="form-control subtotal_marketings" value="0" id="subtotal_marketings" name="subtotal_marketings" readonly
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
                                    <th style="width: 8%;">Action</th>
                                </tr>
                            </thead>
                            <tbody>

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
                                        <input type="text" class="form-control sub_other_factors" value="0" id="sub_other_factor" name="sub_other_factors" readonly
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
                                                value="SME" checked>SME
                                        </div>
                                    </div>

                                    <div class="form-check form-check-inline">
                                        <div class="radio">
                                            <input class="form-check-input" type="radio" name="Profile" id="Corporate"
                                                value="Corporate">Corporate
                                        </div>
                                    </div>

                                    <div class="form-check form-check-inline">
                                        <div class="radio">
                                            <input class="form-check-input" type="radio" name="Profile" id="MNC"
                                                value="MNC">MNC
                                        </div>
                                    </div>

                                    <div class="form-check form-check-inline">
                                        <div class="radio">
                                            <input class="form-check-input" type="radio" name="Profile" id="Government"
                                                value="Government">Government
                                        </div>
                                    </div>

                            </div>

                            <br>
                            <div class="form-group1" style="font-size: 18px;">
                                <label style="padding-left: 4em; padding-right: 3.5em;">Process:</label>

                                <div class="form-check form-check-inline">
                                    <div class="radio">
                                        <input class="form-check-input" type="radio" name="size" id="Small"
                                            value="Small" checked>Small
                                    </div>
                                </div>

                                <div class="form-check form-check-inline">
                                    <div class="radio">
                                        <input class="form-check-input" type="radio" name="size" id="Medium"
                                            value="Medium">Medium
                                    </div>
                                </div>

                                <div class="form-check form-check-inline">
                                    <div class="radio">
                                        <input class="form-check-input" type="radio" name="size" id="Large"
                                            value="Large">Large
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>

                    <br>
                    <div style="text-align: right;">
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
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" id="save-estimation">Save</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>

                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="d-inline">
            <!-- Button to trigger the Estimation modal -->
            <button type="button" class="btn btn-warning " data-toggle="modal" data-target="#estimation-modal"
                style="width: 150px;">
                Cost Estimation
            </button>

            <a href="{{ url('/roles') }}" class="btn btn-primary d-inline-block ml-2" title="maintenance"
                style="width: 150px;">
                Maintenance
            </a>
        </div>
        <br>
        <div class="row mt-4">

            <div class="card" style="width: 80%">
                <div class="card-header">Quotation</div>
                <div class="card-body">
                    <div class="form-group">
                        <input type="text" class="form-control" id="search-input" placeholder="Quick Search"
                            style="width: 50%">
                    </div>

                    <br />
                    <div class="table-responsive">
                        <table class="table" id="myTable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th style="width: 20%">Date</th>
                                    <th style="width: 40%">Company Name</th>
                                    <th style="width: 20%">Total Cost</th>
                                    <th style="width: 15%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($costs as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->created_at }}</td>
                                        <td style="padding: 5px; margin: 0">{{ $item->company_name }}</td>
                                        <td style="padding: 5px; margin: 0">{{ number_format($item->totalcost, 2, '.', '') }}
                                        </td>
                                        <td>
                                            <a href="{{ url('/cost/' . $item->id . '/edit') }}" title="Edit Quotation">
                                                <button class="btn btn-primary btn-sm mr-2 button-size">
                                                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                                </button>
                                            </a>
                                            <form method="POST" action="{{ url('/cost/' . $item->id) }}"
                                                accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}

                                                <button type="submit" class="btn btn-danger btn-sm button-size"
                                                    title="Delete Quotation"
                                                    onclick="return confirm('Are You Sure To DELETE this data?')">
                                                    <i class="fa fa-trash-o" aria-hidden="true"></i>
                                                </button>
                                            </form>
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
    @include('components.onchangefunction')
    @include('components.removeRow')
    @include('components.addnewRow')
    <!-- Add DataTables plugin -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js"></script>

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
            var total_sub = 0;
            var subtotal_service = parseFloat($('#subtotal_service').val());
            var subtotal_event = parseFloat($('#subtotal_event').val());
            var subtotal_hotel = parseFloat($('#subtotal_hotel').val());
            var subtotal_transportation = parseFloat($('#subtotal_transportation').val());
            var subtotal_infrastructure = parseFloat($('#subtotal_infrastructure').val());
            var subtotal_marketing = parseFloat($('#subtotal_marketing').val());
            var totalPoints = 0;
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

            var otherFactors = {{ $company_profit->otherFactor / 100 }};
            var profitRate = {{ $company_profit->company_profit / 100 }};
            var factor1 = {{ $company_profit->factor_1 / 100 }};
            var factor2 = {{ $company_profit->factor_2 / 100 }};
            var factor3 = {{ $company_profit->factor_3 / 100 }};
            var factor4 = {{ $company_profit->factor_4 / 100 }};
            var factor5 = {{ $company_profit->factor_5 / 100 }};
            var factor6 = {{ $company_profit->factor_6 / 100 }};
            var factor7 = {{ $company_profit->factor_7 / 100 }};
            if (totalPoints == 7) {
                otherFactor = otherFactors * factor7
            } else if (totalPoints == 6) {
                otherFactor = otherFactors * factor6
            } else if (totalPoints == 5) {
                otherFactor = otherFactors * factor5
            } else if (totalPoints == 4) {
                otherFactor = otherFactors * factor4
            } else if (totalPoints == 3) {
                otherFactor = otherFactors * factor3
            } else if (totalPoints == 2) {
                otherFactor = otherFactors * factor2
            } else if (totalPoints == 1) {
                otherFactor = otherFactors * factor1
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

        $(document).ready(function() {
            // Initialize DataTables plugin
            var table = $('#myTable').DataTable();

            // Destroy the existing DataTable instance
            table.destroy();

            // Reinitialize DataTables plugin with new options
            $('#myTable').DataTable({
                searching: false, // Disable default search functionality
                paging: true, // Enable pagination
                ordering: true, // Enable column sorting
                info: false // Disable "Showing X of Y entries" info
            });

            // Custom search functionality
            $('#search-input').on('keyup', function() {
                var value = $(this).val().toLowerCase();
                $('#myTable tbody tr').filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
                });
            });
        });
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

@endsection
