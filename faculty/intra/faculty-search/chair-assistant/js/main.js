(function () {

    // Submitting form when submit button is clicked
    $('form').on('submit', event => {
        event.preventDefault();
        alert("You want to submit the form.");
        // const form = event.target;
        // const positionId = $('form select').find(':selected').data('position-id');

        //submitForm(form, positionId);
    });

})();
