$(function() {

	// Get the form.
	const form = $('#ajax-contact');

	// Get the messages div.
	const formMessages = $('#form-messages');

	// Set up an event listener for the contact form.
	$(form).submit(function(e) {
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
				$(formMessages).text(response.message);

				if (response['mail_error'] !== '') window.alert(response['mail_error']);

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
				if (request.message !== '') {
					$(formMessages).text(request.message);
				} else {
					$(formMessages).text('Oops! An error occured and your message could not be sent.');
				}
			}
		})
	});

});
