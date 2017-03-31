(function () {

    // Submitting form when submit button is clicked
    $('form').on('submit', event => {
        event.preventDefault();

        const form = event.target;

        submitForm(form);
    });

    /**
     * Submits a form to the database
     * @param {Object} form - Form with the data to submit
     */
    function submitForm(form) {
        // Disabling the submit button on form
        $('form button').prop('disabled', true);
        $('form button').text('Working...');

        // Getting all the form data from the form and setting it to a variable
        const formData = new FormData(form);

        // Submitting the form
        $.ajax({
            url        : '../inc/addPosition.php',
            method     : 'POST',
            data       : formData,
            processData: false,
            contentType: false,
            dataType   : 'json',
            encode     : true,
            success    : function(data, status, jqXHR) {
                if (data.success) {

                    // Inserting the success message and position details to the page
                    $('#confirmation').html(`
                        <h2>${data.message}</h2>
                        <h3>${data.title}</h3>
                        <p>
                            <strong>Number:</strong> ${data.number}BR<br>
                            <strong>Department:</strong> ${data.department}<br>
                            <strong>Search Chair:</strong> ${data.chair}<br>
                        </p>`);

                    // Resetting the form
                    form.reset();

                } else {

                    // Inserting the failure message to the page
                    $('#confirmation').html(`
                        <h2>${data.message}</h2>
                        <p>This failed with this status: ${data.status}. Please try again.</p>`);

                }

            },
        error: function(jqXHR, status, error) {
            console.log(status);
            console.log(error);
        }

        }).done( () => {
            // Enabling the submit button on form
            $('form button').prop('disabled', false);
            $('form button').text('Submit');
        });
    }

})();
