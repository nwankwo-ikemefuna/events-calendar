jQuery(document).ready(function ($) {
    "use strict";


    //bootstrap timepicker
    $('#timepicker').timepicker({
        minuteStep: 1,
    });

   //bootstrap datepicker
    $('.datepicker_ymd').datepicker({
        format: 'yyyy/mm/dd',
    });


    //load calendar date events
    $(document).on( "click", ".tm_calendar_events", function() {
        //get data value params
        var date_int = $(this).data('date_int');
        var date = $(this).data('date'); 
        $('#modal_calendar_events .event_date').text(date); 
        $('#modal_calendar_events').modal('show'); //show the modal
        render_date_events(date_int);
    });


    function render_date_events(date_int) {
        $.ajax({
            url: base_url + c_controller + '/same_day_events_ajax/'+date_int, 
            type: 'GET',
            beforeSend: function() {
                //a little spinner won't hurt...
                $('#modal_calendar_events .modal-body .event_loader i').addClass('fa-spin');
            },
            success: function(res) {
                var json_res = JSON.parse(res);
                var events = json_res.events;
                //render events in modal body
                $('#modal_calendar_events .modal-body').html(events);
            }
        });
    }


    //Create new event
    $('#new_event_form').submit(function(e) {
        e.preventDefault();
        //serialize the form fields
        var form_data = $(this).serialize();
        $.ajax({
            url: base_url + c_controller + '/create_new_event_ajax', 
            type: 'POST',
            data: form_data, 
            success: function(msg) {
                if (msg == 1) {
                    $( '.status_msg' ).html('<div class="alert alert-success text-center">New event added successfully.</div>').fadeIn( 'fast' );
                    setTimeout(function() { 
                        location.reload(); //reload page
                    }, 3000);
                } else {
                    $('.status_msg').html('<div class="alert alert-danger text-center">' + msg + '</div>').fadeIn( 'fast' ).delay( 30000 ).fadeOut( 'slow' );
                }
            }
        });
    });


});