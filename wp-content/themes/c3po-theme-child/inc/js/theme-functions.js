
/**
 * C3PO Child theme base
 * 
 * Index page
 * 
 * @version 1.0.0
 * @author  web@usalafuerza.com
 * @date    2019/09/02
 */

// FUNCTION TEMPORAL A OPTIMIZAR CON UN VALIDADOR DE FORMS
// TO-DO : ERRORES MULTIIDIOMA
$('#droid-form-contact').on( 'submit', function ( event )
{
    event.preventDefault();
    var self = $(this);
    if( $("#droid-form-contact #droid-form-name").val() == undefined || $("#droid-form-contact #droid-form-name").val() == "" || $("#droid-form-contact #droid-form-mail").val() == undefined || $("#droid-form-contact #droid-form-mail").val() == "" || $("#droid-form-contact #droid-form-message").val() == undefined || $("#droid-form-contact #droid-form-message").val() == ""  || $("#droid-form-contact #droid-form-phone").val() == undefined || $("#droid-form-contact #droid-form-phone").val() == ""){
        
        $('#response').addClass("error");
        $('#response').html ( "Todos los campos marcados con arteristico son obligatorio, por favor, revíselos");
        $('#response').clearQueue();
        $('#response').fadeIn(400).delay( 8000 ).fadeOut( 400 );


    }else if( ! drIsEmail( $("#droid-form-contact #droid-form-mail").val() ) ){
        $('#response').addClass("error");
        $('#response').html ( "El correo electrónico introducido no parece correcto, por favor, revíselo.");
        $('#response').clearQueue();
        $('#response').fadeIn(400).delay( 8000 ).fadeOut( 400 );

    }else if( ! $("#droid-form-contact #droid-form-accept-privacy-advice").prop( "checked" ) ){
        $('#response').addClass("error");
        $('#response').html ( "Debe aceptar las condiciones legales para enviar el mensaje.");
        $('#response').clearQueue();
        $('#response').fadeIn(400).delay( 8000 ).fadeOut( 400 );

    }else{
        
        $('#response').fadeOut( 100 );
        $("#droid-form-contact #droid-submit-button").prop("disabled",true);
        $('#response').removeClass("error");
        $('#response').addClass("info");
        $('#response').html ( "Enviando el mensaje.");
        $('#response').clearQueue();
        $('#response').fadeIn(400).delay( 8000 ).fadeOut( 400 );

        var dataSend = {
            'form-id'       : $(this).attr('data-form-id'),
            'form-content'  : $(this).serializeArray()
        };
        
        console.log("ajax call");
        $.ajax({
            type: "POST",
            url:  $(this).attr('data-ajax'),
            data: dataSend,
            success: function(data) {
                  
                if ( JSON.parse( data ) == 1 ){
                    $('#response').fadeOut( 100 );
                    $('#response').removeClass("info");
                    $('#response').addClass("success");
                    $('#response').html ( "Su mensaje se ha enviado correctamente. Lo atenderemos lo antes posible.");
                    $('#response').clearQueue();
                    $('#response').fadeIn(400);

                } else {
                    $('#response').fadeOut( 100 );
                    $('#response').removeClass("info");
                    $('#response').addClass("error");
                    $('#response').html ( "Se ha producido un error enviando su correo, por favor, contacte con nosotros a través del teéfono o el correo electrónico que encontrará en esta página.");
                    $('#response').clearQueue();
                    $('#response').fadeIn();

                    console.warn( data );
                }
            }
        });
    }
}); 