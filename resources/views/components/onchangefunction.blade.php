<script>
    $(document).ready(function() {
            // When the cost, pax, or day input changes, update the total for that row and recalculate the subtotal
            $('#dynamic_field_service tbody').on('change', '.cost_service, .pax_service, .day_service', function () {
                var row = $(this).closest('tr');
                var pax = row.find('.pax_service').val();
                var day = row.find('.day_service').val();
                var cost = row.find('.cost_service').val();
                var total = pax * day * cost;
                $(this).closest('tr').find('input.total_service').val(total.toFixed(2));

                var subtotal = 0;
                $('input.total_service').each(function() {
                subtotal += parseFloat($(this).val()) || 0;
                });
                $('input.subtotal_service').val(subtotal.toFixed(2));
                calculateTotal();

                });
        });

        $(document).ready(function() {
            // When the cost, pax, or day input changes, update the total for that row and recalculate the subtotal
            $('#dynamic_field_event tbody').on('change', '.cost_event, .pax_event, .day_event', function () {
                var row = $(this).closest('tr');
                var pax = row.find('.pax_event').val();
                var day = row.find('.day_event').val();
                var cost = row.find('.cost_event').val();
                var total = pax * day * cost;
                $(this).closest('tr').find('input.total_event').val(total.toFixed(2));

                var subtotal = 0;
                $('input.total_event').each(function() {
                subtotal += parseFloat($(this).val()) || 0;
                });
                $('input.subtotal_event').val(subtotal.toFixed(2));
                calculateTotal();

                });
        });

        $(document).ready(function() {
        // Update total_hotel when pax_hotel, day_hotel, or cost_hotel change
        $('#dynamic_field_hotel').on('input', 'input.pax_hotel, input.day_hotel, input.cost_hotel', function() {
            var pax = parseInt($(this).closest('tr').find('input.pax_hotel').val()) || 0;
            var day = parseInt($(this).closest('tr').find('input.day_hotel').val()) || 0;
            var cost = parseInt($(this).closest('tr').find('input.cost_hotel').val()) || 0;
            var total = pax * day * cost;
            $(this).closest('tr').find('input.total_hotel').val(total.toFixed(2));

            // Update subtotal_hotel
            var subtotal = 0;
            $('input.total_hotel').each(function() {
            subtotal += parseFloat($(this).val()) || 0;
            });
            $('input.subtotal_hotel').val(subtotal.toFixed(2));
            calculateTotal();
        });
        });

        $(document).ready(function() {
        // Update total_transportation when pax_transportation, trip_transportation, or cost_transportation change
        $('#dynamic_field_transportation').on('input', 'input.pax_transportation, input.trip_transportation, input.cost_transportation', function() {
            var pax = parseInt($(this).closest('tr').find('input.pax_transportation').val()) || 0;
            var trip = parseInt($(this).closest('tr').find('input.trip_transportation').val()) || 0;
            var cost = parseInt($(this).closest('tr').find('input.cost_transportation').val()) || 0;
            var total = pax * trip * cost;
            $(this).closest('tr').find('input.total_transportation').val(total.toFixed(2));

            // Update subtotal_hotel
            var subtotal = 0;
            $('input.total_transportation').each(function() {
            subtotal += parseFloat($(this).val()) || 0;
            });
            $('input.subtotal_transportation').val(subtotal.toFixed(2));
            calculateTotal();
        });
        });

        $(document).ready(function() {
        // Update total_infrastructure when item_infrastructure, year_infrastructure, or cost_infrastructure change
        $('#dynamic_field_infrastructure').on('input', 'input.item_infrastructure, input.year_infrastructure, input.cost_infrastructure', function() {
            var item = parseInt($(this).closest('tr').find('input.item_infrastructure').val()) || 0;
            var year = parseInt($(this).closest('tr').find('input.year_infrastructure').val()) || 0;
            var cost = parseInt($(this).closest('tr').find('input.cost_infrastructure').val()) || 0;
            var total = item * year * cost;
            $(this).closest('tr').find('input.total_infrastructure').val(total.toFixed(2));

            // Update subtotal_hotel
            var subtotal = 0;
            $('input.total_infrastructure').each(function() {
            subtotal += parseFloat($(this).val()) || 0;
            });
            $('input.subtotal_infrastructure').val(subtotal.toFixed(2));
            calculateTotal();
        });
        });

        $(document).ready(function() {
        // Update total_marketing when item_marketing, year_infrastructure, or cost_infrastructure change
        $('#dynamic_field_marketing').on('input', 'input.item_marketing, input.cost_marketing', function() {
            var item = parseInt($(this).closest('tr').find('input.item_marketing').val()) || 0;
            var cost = parseInt($(this).closest('tr').find('input.cost_marketing').val()) || 0;
            var total = item * cost;
            $(this).closest('tr').find('input.total_marketing').val(total.toFixed(2));

            // Update subtotal_hotel
            var subtotal = 0;
            $('input.total_marketing').each(function() {
            subtotal += parseFloat($(this).val()) || 0;
            });
            $('input.subtotal_marketing').val(subtotal.toFixed(2));
            calculateTotal();
        });
        });

        $(document).on('change', '.role', function() {
            var selectedSalary = $(this).find(':selected').data('salary');
            $(this).siblings('.salary_per_day').val(selectedSalary);
            calculateTotal(); // calculate total when role changes
        });

        $(document).on('change', '.qty, .day', function() {
            calculateTotal();
        });

        $(document).ready(function() {
            calculateTotal();
        });

        $('input[name=Profile], input[name=size]').change(function() {
            calculateTotal();
        });
</script>
