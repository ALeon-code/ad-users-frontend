/**
 * Created by alian on 10/19/16.
 */


jQuery(document).ready(function($) {
    console.log("plugin loaded");

    $(".ad-user-login-form").submit(function(e){

        $(".login-message").html("");

        if ( !AD.enabledAjax ) return true;

        e.preventDefault();

        var data = {};
        $(this).find("input[name]").each(function (index, node) {
            data[node.name] = node.value;
        });

        $.ajax({
            method: "POST",
            url: AD.ajaxUrl + "?action=" + AD.endPoint,
            data: data
        })
            .done(function(data, textStatus, jqXHR ) {
                var response;

                try {
                    response = JSON.parse(data);
                }
                catch (e) {
                    console.log("Error processing the response from the server on the user-login script.");
                    return;
                }

                if ( response.status == "error")
                {
                    $(".login-error").html( response.message );
                }
                else
                {
                    //TODO. here we will check the redirect and so.
                    $(".login-success").html( response.message );
                }
            })
            .fail(function(jqXHR, textStatus, errorThrown){

            })


    })
});