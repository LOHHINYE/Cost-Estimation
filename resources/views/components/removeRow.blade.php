<script>
    function removeRow(button) {
        // Get the table row containing the button
        var row = button.closest('tr');
        // Remove the row from the table
        row.remove();
        // Recalculate the subtotal
        var subtotal = 0;
        $('.total').each(function() {
            subtotal += parseFloat($(this).val());
        });
        $('#subtotal').val(subtotal.toFixed(2));
        calculateTotal();
    }

    function removeRowService(button) {
        // Get the table row containing the button
        var row = button.closest('tr');
        // Remove the row from the table
        row.remove();
        // Recalculate the subtotal
        var subtotal = 0;
        $('.total_service').each(function() {
            subtotal += parseFloat($(this).val());
        });
        $('#subtotal_service').val(subtotal.toFixed(2));
        calculateTotal();
    }

    function removeRowEvent(button) {
        // Get the table row containing the button
        var row = button.closest('tr');
        // Remove the row from the table
        row.remove();
        // Recalculate the subtotal
        var subtotal = 0;
        $('.total_event').each(function() {
            subtotal += parseFloat($(this).val());
        });
        $('#subtotal_event').val(subtotal.toFixed(2));
        calculateTotal();
    }

    function removeRowHotel(button) {
        // Get the table row containing the button
        var row = button.closest('tr');
        // Remove the row from the table
        row.remove();
        // Recalculate the subtotal
        var subtotal = 0;
        $('.total_hotel').each(function() {
            subtotal += parseFloat($(this).val());
        });
        $('#subtotal_hotel').val(subtotal.toFixed(2));
        calculateTotal();
    }

    function removeRowTrans(button) {
        // Get the table row containing the button
        var row = button.closest('tr');
        // Remove the row from the table
        row.remove();
        // Recalculate the subtotal
        var subtotal = 0;
        $('.total_transportation').each(function() {
            subtotal += parseFloat($(this).val());
        });
        $('#subtotal_transportation').val(subtotal.toFixed(2));
        calculateTotal();
    }

    function removeRowInfras(button) {
        // Get the table row containing the button
        var row = button.closest('tr');
        // Remove the row from the table
        row.remove();
        // Recalculate the subtotal
        var subtotal = 0;
        $('.total_infrastructure').each(function() {
            subtotal += parseFloat($(this).val());
        });
        $('#subtotal_infrastructure').val(subtotal.toFixed(2));
        calculateTotal();
    }

    function removeRowMarket(button) {
        // Get the table row containing the button
        var row = button.closest('tr');
        // Remove the row from the table
        row.remove();
        // Recalculate the subtotal
        var subtotal = 0;
        $('.total_marketing').each(function() {
            subtotal += parseFloat($(this).val());
        });
        $('#subtotal_marketing').val(subtotal.toFixed(2));
        calculateTotal();
    }
</script>
