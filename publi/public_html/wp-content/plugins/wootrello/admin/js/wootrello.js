jQuery( document ).ready( function() {
    // +++++++++++++++++++++++++++++ Wootrello Settings Page +++++++++++++++++++++++++++++++
    // Notice to Save Trello access code! Check the input field value , if there is no value show the warning message
    jQuery( " .trelloBoard, .trello_list, .trello_due_date, .trello_label_colour " ).click( function () {
        var trelloAccessCode = jQuery( "#trello_api" ).val();
        if ( ! trelloAccessCode ) {
            jQuery( "#save_settings" ).css( "border-color", "red" );
            jQuery( "#trello_api" ).css( "border-color", "red" );
            alert( " Please save Trello access code, before selecting the Trello Board or List !! " );
        }
    });
    // New Code Starts From here!
    jQuery(" .trelloBoard ").change( function (e) {
        // Getting list ID
        var listFieldsID    = "#" + e.target.id + "_trello_list";
        // Getting Trello Board ID aka Value
        var Value           = e.target.value;
        // Checking if Value. 
        if ( Value ) {
            // Disable The Trello List fields;
            jQuery( listFieldsID ).prop( 'disabled', true );
            //  Js list for sending the data to Server 
            var ajaxData = {
                'action'    : 'wootrello_ajax_response',
                'boardID'   : Value,
                'security'  : wootrello_data.security
            };
            // AJAX call 
            // Change the Code on Production Site 
            // var ajaxUrl = <? admin_url('admin-ajax.php')?>
            jQuery.post( wootrello_data.wootrelloAjaxURL, ajaxData, function ( trello_board_list ) {
                var list = JSON.parse( trello_board_list );
                // If Bool is True, Then Proceed 
                if ( list[0] ) {
                    // Enable The Trello List fields & Populate the Fields;
                    jQuery( listFieldsID ).prop('disabled', false);
                    // Emptying 
                    jQuery( listFieldsID ).empty();
                    jQuery( listFieldsID ).append('<option value=""> -- Select Trello List -- </option>');
                    // Appending to the Dropdown Select 
                    jQuery.each( list[1], function ( key, value ) {
                        jQuery( listFieldsID ).append(
                            '<option value="' + key + '">' + value + "</option>"
                        );
                    });
                } else {
                    alert( "ERROR : " + list[1] );
                }
            });
        }
    });

    // multi select init Below
    document.multiselect('.metaDropDown');

    // +++++++++++++++++++++++++++++ Single Order Page +++++++++++++++++++++++++++++++
    // Check the input field value , if there is no value show the warning message
    jQuery("#wootrelloCreateCard").click(function () {
        var wooTrelloRelSettings = jQuery("#wooTrelloRelSettings").val();
        // If wooTrelloRelSettings and Order is is not empty
        if ( wooTrelloRelSettings && wootrello_data.orderID ) {
            var ajaxDataTwo = {
                'action'            :'wootrello_ajax_single_order',
                'orderID'           : wootrello_data.orderID,
                'relatedSettings'   : wooTrelloRelSettings,
                'security'          : wootrello_data.security
            };
            // AJAX request 
            jQuery.post(wootrello_data.wootrelloAjaxURL, ajaxDataTwo, function (wootrelloResponse) {
                var wtrs = JSON.parse(wootrelloResponse);
                console.log(wtrs);
            });
            // The End
        } else {
            alert("Please select the Dropdown ! or order ID is Empty !");
        }
    });

    // Deleting Singale order Trello History
    jQuery("#wooTrelloDeleteHistory").click(function () {
        if ( wootrello_data.orderID ) {
            var deleteData = {
                'action': 'wootrello_ajax_delete_history',
                'orderID': wootrello_data.orderID,
                'security': wootrello_data.security
            };
            // AJAX request 
            jQuery.post(wootrello_data.wootrelloAjaxURL, deleteData, function (deleteResponse) {
                var drs = JSON.parse(deleteResponse);
                console.log(drs);
                jQuery('#trelloHistoryContent').hide();
            });
            // The End
        }
    });
}); 
