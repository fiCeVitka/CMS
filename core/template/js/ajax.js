$(document).ready(function () {

    $("#post").submit(function(event){
        var $request;

        event.preventDefault();

        // Abort any pending request
        if ($request) {
            $request.abort();
        }
        // setup some local variables
        var $form = $(this);

        // Let's select and cache all the fields
        var $inputs = $form.find("input, select, button, textarea");
        // Serialize the data in the form
        var serializedData = $form.serialize();
        //console.log(serializedData);

        // Let's disable the inputs for the duration of the Ajax request.
        // Note: we disable elements AFTER the form data has been serialized.
        // Disabled form elements will not be serialized.
        $inputs.prop("disabled", true);
        $request = $.ajax({
            url: "../../core/handler/requesthandler.php",
            type: "post",
            data: serializedData
        });
        $request.done(function (response, textStatus, jqXHR){
            // Log a message to the console
            console.log("Hooray, it worked!" + response);
        });

        // Callback handler that will be called on failure
        $request.fail(function (jqXHR, textStatus, errorThrown){
            // Log the error to the console
            console.error(
                "The following error occurred: "+
                textStatus, errorThrown
            );
        });

        // Callback handler that will be called regardless
        // if the request failed or succeeded
        $request.always(function () {
            // Reenable the inputs
            $inputs.prop("disabled", false);
        });

    })

})
