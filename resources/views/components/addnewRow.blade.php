<script>
    $(document).on('click', '#add_row', function() {
            var rowCount = $('#dynamic_field tbody tr').length;
            var html = '<tr>\
                <td><select name="role[' + rowCount + '][role]" id="role" class="form-control role">\
                    <option value=""></option>\
                        @foreach ($roles as $role)\
                    <option value="{{ $role->role }}" data-salary="{{ $role->salary_per_day }}">{{ $role->role }}</option>\
                        @endforeach\
                    </select>\
                <input type="hidden" min="0" class="form-control salary_per_day" name="role[' +rowCount + '][salary_per_day]" value=""></td>\
                <td><input type="number" min="0" class="form-control qty" name="role[' +rowCount + '][qty]" value="1"></td>\
                <td><input type="number" min="0" class="form-control day" name="role[' +rowCount + '][day]" value="1"></td>\
                <td><input type="text" class="form-control total" name="role[' + rowCount + '][total]" value="0" readonly></td>\
                <td><button class="btn btn-danger btn-sm" onclick="removeRow(this)">Remove <i class="fa fa-trash"></button></td>\
                </tr>';
            $('#dynamic_field tbody').append(html);
        });

        $(document).on('click', '#add_row_service', function() {
            var rowCount = $('#dynamic_field_service tbody tr').length;
            var html = '<tr>\
                <td><select name="services[' + rowCount + '][services]" class="form-control services">\
                    @foreach ($service as $services)\
                        <option value="{{ $services->service_desc }}">{{ $services->service_desc }}</option>\
                    @endforeach\
                </select></td>\
                <td><textarea name="services[' + rowCount + '][remark]" class="form-control remarks_service"></textarea></td>\
                <td><input type="number" name="services[' + rowCount + '][pax]" class="form-control pax_service" value="1"></td>\
                <td><input type="number" name="services[' + rowCount + '][day]" class="form-control day_service" value="1"></td>\
                <td><input type="number" name="services[' + rowCount + '][cost]" value="0" class="form-control cost_service"></td>\
                <td><input type="text" name="services[' + rowCount + '][total]" value="0" class="form-control total_service" readonly></td>\
                <td><button class="btn btn-danger btn-sm" onclick="removeRowService(this)">Remove <i class="fa fa-trash"></button></td>\
            </tr>';
            $('#dynamic_field_service tbody').append(html);
        });

        $(document).on('click', '#add_row_event', function() {
            var rowCount = $('#dynamic_field_event tbody tr').length;
            var html = '<tr>\
                <td><select name="event[' + rowCount + '][event]" class="form-control event_hall">\
                    @foreach ($event as $events)\
                        <option value="{{ $events->event_desc }}">\
                            {{ $events->event_desc }}\
                        </option>\
                    @endforeach\
                </select></td>\
                <td><textarea name="event[' + rowCount + '][remark]" class="form-control event_remarks"></textarea></td>\
                <td><input type="number" name="event[' + rowCount + '][pax]" class="form-control pax_event" value="1"></td>\
                <td><input type="number" name="event[' + rowCount + '][day]" class="form-control day_event" value="1"></td>\
                <td><input type="number" name="event[' + rowCount + '][cost]" value="0" class="form-control cost_event"></td>\
                <td><input type="text" name="event[' + rowCount + '][total]" value="0" class="form-control total_event" readonly></td>\
                <td><button class="btn btn-danger btn-sm" onclick="removeRowEvent(this)">Remove <i class="fa fa-trash"></button></td>\
            </tr>';
            $('#dynamic_field_event tbody').append(html);
        });

        $(document).on('click', '#add_row_hotel', function() {
            var rowCount = $('#dynamic_field_hotel tbody tr').length;
            var html = '<tr>\
                <td>\
                    <select name="hotel[' + rowCount + '][hotel]" class="form-control hotel">\
                        @foreach ($hotel as $hotels)\
                            <option value="{{ $hotels->hotel_desc }}">\
                                {{ $hotels->hotel_desc }}\
                            </option>\
                        @endforeach\
                    </select>\
                </td>\
                <td>\
                    <textarea name="hotel[' + rowCount + '][remark]" class="form-control remarks_hotel"></textarea>\
                </td>\
                <td><input type="number" name="hotel[' + rowCount + '][pax]" class="form-control pax_hotel" value="1"></td>\
                <td><input type="number" name="hotel[' + rowCount + '][day]" class="form-control day_hotel" value="1"></td>\
                <td><input type="number" name="hotel[' + rowCount + '][cost]" value="0" class="form-control cost_hotel"></td>\
                <td><input type="text" name="hotel[' + rowCount + '][total]" value="0" class="form-control total_hotel" readonly></td>\
                <td><button class="btn btn-danger btn-sm" onclick="removeRowHotel(this)">Remove <i class="fa fa-trash"></button></td>\
            </tr>';
            $('#dynamic_field_hotel tbody').append(html);
        });

        $(document).on('click', '#add_row_transportation', function() {
            var rowCount = $('#dynamic_field_transportation tbody tr').length;
            var html = '<tr>\
                <td>\
                    <select name="transportation[' + rowCount + '][transportation]" class="form-control transportation">\
                        @foreach ($transportation as $transportations)\
                            <option value="{{ $transportations->transportation_desc }}">\
                                {{ $transportations->transportation_desc }}\
                            </option>\
                        @endforeach\
                    </select>\
                </td>\
                <td><textarea name="transportation[' + rowCount + '][remark]" class="form-control remarks_transportation"></textarea></td>\
                <td><input type="number" name="transportation[' + rowCount + '][pax]" class="form-control pax_transportation" value="1"></td>\
                <td><input type="number" name="transportation[' + rowCount + '][trip]" class="form-control trip_transportation" value="1"></td>\
                <td><input type="number" name="transportation[' + rowCount + '][cost]" value="0" class="form-control cost_transportation"></td>\
                <td><input type="text" name="transportation[' + rowCount + '][total]" value="0" class="form-control total_transportation" readonly></td>\
                <td><button class="btn btn-danger btn-sm" onclick="removeRowTrans(this)">Remove <i class="fa fa-trash"></button></td>\
            </tr>';
            $('#dynamic_field_transportation tbody').append(html);
        });

        $(document).on('click', '#add_row_infrastructure', function() {
            var rowCount = $('#dynamic_field_infrastructure tbody tr').length;
            var html = '<tr>\
                <td><select name="infrastructure[' + rowCount + '][infrastructure]" id="infrastructure_' + rowCount + '" class="form-control infrastructure">\
                    @foreach ($infrastructure as $infra)\
                        <option value="{{ $infra->infrastructure_desc }}">\
                            {{ $infra->infrastructure_desc }}\
                        </option>\
                    @endforeach\
                </select></td>\
                <td><textarea name="infrastructure[' + rowCount + '][remark]" class="form-control remarks_infrastructure"></textarea></td>\
                <td><input type="number" name="infrastructure[' + rowCount + '][item]" class="form-control item_infrastructure" value="1"></td>\
                <td><input type="number" name="infrastructure[' + rowCount + '][year]" class="form-control year_infrastructure" value="1"></td>\
                <td><input type="number" name="infrastructure[' + rowCount + '][cost]" value="0" class="form-control cost_infrastructure"></td>\
                <td><input type="text" name="infrastructure[' + rowCount + '][total]" value="0" class="form-control total_infrastructure" readonly></td>\
                <td><button class="btn btn-danger btn-sm" onclick="removeRowInfras(this)">Remove <i class="fa fa-trash"></button></td>\
            </tr>';
            $('#dynamic_field_infrastructure tbody').append(html);
        });

        $(document).on('click', '#add_row_marketing', function() {
            var rowCount = $('#dynamic_field_marketing tbody tr').length;
            var html = '<tr>\
                <td><select name="marketing[' + rowCount + '][marketing]" id="marketing_' + rowCount +'" class="form-control marketing">\
                    @foreach ($marketing as $markets)\
                        <option value="{{ $markets->marketing_desc }}">\
                            {{ $markets->marketing_desc }}\
                        </option>\
                    @endforeach\
                </select></td>\
                <td><textarea name="marketing[' + rowCount + '][remark]" class="form-control remarks_marketing"></textarea></td>\
                <td><input type="number" name="marketing[' + rowCount + '][item]" class="form-control item_marketing" value="1"></td>\
                <td><input type="number" name="marketing[' + rowCount + '][cost]" value="0" class="form-control cost_marketing"></td>\
                <td><input type="text" name="marketing[' + rowCount + '][total]" value="0" class="form-control total_marketing" readonly></td>\
                <td><button class="btn btn-danger btn-sm" onclick="removeRowMarket(this)">Remove <i class="fa fa-trash"></button></td>\
            </tr>';
            $('#dynamic_field_marketing tbody').append(html);
        });

</script>
