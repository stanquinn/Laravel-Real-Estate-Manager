/**
 * Created with JetBrains PhpStorm.
 * User: Erick
 * Date: 1/5/14
 * Time: 12:10 PM
 * To change this template use File | Settings | File Templates.
 */
$(document).ready(function() {
    tinymce.init({selector:'.richeditor'});
    $('.DTTT_button').addClass("btn btn-primary");
    $('#xdatatable').dataTable( {
        "sDom": "<'row'<'col-xs-6'T><'col-xs-6'f>r>t<'row'<'col-xs-6'i><'col-xs-6'p>>",
        "sPaginationType": "full_numbers",
        "oTableTools": {
            "aButtons": [
                {
                    "sExtends":    "text",
                    "sButtonText": "Add New",
                    "fnClick": function ( nButton, oConfig, oFlash ) {
                        window.location = jQuery('#create_location').val();
                    }
                }
            ]
        }
    } );
    $('#x2datatable').dataTable( {
        "sDom": "<'row'<'col-xs-6'T><'col-xs-6'f>r>t<'row'<'col-xs-6'i><'col-xs-6'p>>",
        "sPaginationType": "full_numbers",
        "aaSorting": [[ 1, "desc" ]],
        "oTableTools": {
            "aButtons": [
                {
                    "sExtends":    "text",
                    "sButtonText": "Add New",
                    "fnClick": function ( nButton, oConfig, oFlash ) {
                        window.location = jQuery('#create_location').val();
                    }
                }
            ]
        }
    } );
    jQuery('.btn-delete').click(function(){
       c = window.confirm("Are you sure you want to deleted this item?");
        if(c){ return true;}else{ return false;}
    });
    jQuery('.delete-photo').click(function(){
        c = window.confirm("Are you sure you want to delete this item?");
        if(c){
            var i = jQuery(this).attr('data-property');
            var p = jQuery(this).attr('data-file');
            window.location = '/admin/delete_photo?property_id='+i+'&photo='+p;
        }
    });
   jQuery('.action').change(function(){
        var action =jQuery(this).val();
        if(action == 'add')
        {
           jQuery('.prop').show();
        }
        if(action == 'deduct')
        {
           jQuery('.prop').hide();
        }
        console.log(action);
    });

   $("#properties_form").validate();

   $('.numeral').change(function(){
        var number = $(this).val();
        if(isNaN(number))
        {
            $(this).val("");
        }else{
            var decimal = numeral(number).format('0,0.00');
            $(this).val(decimal);
        }
   });

} );