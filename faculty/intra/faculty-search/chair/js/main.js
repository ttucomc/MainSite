(function () {

    // Submitting form when submit button is clicked
    $('form').on('submit', event => {
        event.preventDefault();

        const form = event.target;
        const positionId = $('form select').find(':selected').data('position-id');

        submitForm(form, positionId);
    });

    /**
     * Submits a form to the database
     * @param {Object} form       - Form with the data to submit
     * @param {int}    positionId - ID of the position for the candidate
     */
    function submitForm(form, positionId) {
        // Disabling the submit button on form
        $('form button').prop('disabled', true);
        $('form button').text('Working...');
        $('form button').css('opacity', .8);

        // Getting all the data from the form and setting it to a variable
        const formData = new FormData(form);
        // Getting the names of the files
        const photoName = $('#photo').val().replace(/.*[\/\\]/, '');
        const cvName = $('#cv').val().replace(/.*[\/\\]/, '');

        // Adding the position ID and file names to the form data
        formData.append('positionId', positionId);
        formData.append('photoName', photoName);
        formData.append('cvName', cvName);

        // Submitting the form
        $.ajax({
            url        : '../inc/addCandidate.php',
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
                        <p>
                            <strong>Affiliation:</strong> ${data.affiliation}<br>
                            <strong>Degree:</strong> ${data.degree}<br>
                            <strong>School:</strong> ${data.school}
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
        error      : function(jqXHR, status, error) {
            console.log(status);
            console.log(error);
        }

        }).done( () => {
            // Enabling the submit button on form
            $('form button').prop('disabled', false);
            $('form button').text('Submit');
            $('form button').css('opacity', 1);
        });
    }

})();
