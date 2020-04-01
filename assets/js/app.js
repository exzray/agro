$(function () {

    const saved_id = localStorage.getItem("booking_id");

    if (saved_id !== null) {
        $('#bookingReminder').css("display", "block");
        $('#bookingReminder').attr("href", "check_reservation.php?id=" + saved_id);
    }
    else {
        $('#bookingReminder').css("display", "none");
    }

    const form_reservation = $('#id_form_reservation');
    $(form_reservation).submit(function (e) {
        e.preventDefault();

        $.ajax({
            type: 'POST',
            url: $(form_reservation).attr('action'),
            data: $(form_reservation).serialize(),
            success: function (response) {
                const id = response['id'];
                const error = response['error'];

                $('#id_name_reserve').val('');
                $('#id_email_reserve').val('');
                $('#id_contact_reserve').val('');
                $('#datepicker').val('');

                if (!(error.trim().length === 0)) {
                    $('#reservationMessage').removeClass("alert-success");
                    $('#reservationMessage').addClass("alert-danger");
                    $('#reservationMessage').text(error);
                } else {
                    $('#reservationMessage').addClass("alert-success");
                    $('#reservationMessage').removeClass("alert-danger");
                    $('#reservationMessage').text('');
                    $('#reservationMessage').append("<a href='check_reservation.php?id=" + id + "' target='_blank'>Your receipt is ready  click here</a>");

                    localStorage.setItem("booking_id", id);
                    $('#bookingReminder').css("display", "block");
                    $('#bookingReminder').attr("href", "check_reservation.php?id=" + id);
                }

            },
            error: function (request, status, err) {

            }
        });
    });

    // Get the form.
    const form = $('#ajax-contact');

    // Get the messages div.
    const formMessages = $('#form-messages');

    // Set up an event listener for the contact form.
    $(form).submit(function (e) {
        // Stop the browser from submitting the form.
        e.preventDefault();

        // Serialize the form data.
        const formData = $(form).serialize();

        // Submit the form using AJAX.
        $.ajax({
            type: 'POST',
            url: $(form).attr('action'),
            data: formData,
            success: function (response) {
                // Make sure that the formMessages div has the 'success' class.
                $(formMessages).removeClass('error');
                $(formMessages).addClass('success');

                // Set the message text.
                $(formMessages).text(response["message"]);

                console.log(response);

                // Clear the form.
                $('#name').val('');
                $('#email').val('');
                $('#subject').val('');
                $('#message').val('');
            },
            error: function (request, status, err) {
                // Make sure that the formMessages div has the 'error' class.
                $(formMessages).removeClass('success');
                $(formMessages).addClass('error');

                // Set the message text.
                if (request["error"] !== '') {
                    $(formMessages).text(request.message);
                } else {
                    $(formMessages).text('Oops! An error occured and your message could not be sent.');
                }
            }
        })
    });

});
