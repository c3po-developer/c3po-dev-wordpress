jQuery(function () {
      
    /** Tabs */
    jQuery('.tab').on('click', function(e){

        e.preventDefault();

        let actual_lang_tab =  jQuery(this).attr('data-lang');
        
        jQuery('.tabs-lang li a').each( function( index, element ){

            jQuery(this).removeClass('active-tab');

        });

        jQuery(this).addClass('active-tab');

        jQuery('.tabs-lang-content div').each( function( index, element ){
            
            if ( !jQuery(this).hasClass( actual_lang_tab ) ) {
                jQuery(this).removeClass('active-tab');
            } else {
                jQuery(this).addClass('active-tab');
            }

        });

    });

    jQuery('.expander-collapse').on('click', function(){
      
        jQuery(this).next('table').fadeToggle(0);

    });

    jQuery('#erase_cookie').on('click', function(){

        delete_cookie('c3po-cookies-advice');

        alert( 'Cookie de sesión eliminada.' );

    });

    // Open modal advice   
    if( getCookie('c3po-cookies-advice') == '' ) {
        jQuery( jQuery('.c3po-cookies-advice') ).addClass('c3po-cookies-advice-animation-in'); 
    } 
    
    // Close modal advice
    jQuery( jQuery('#c3po-cookies-accept-btn') ).on( 'click', function(e)
    {
        e.preventDefault();

        jQuery( jQuery('.c3po-cookies-advice') )
            .addClass('c3po-cookies-advice-animation-out')
            .removeClass('c3po-cookies-advice-animation-in'); 
        
        setCookie( 'c3po-cookies-advice', true, duration );
    
    });

});
 
function delete_cookie(name) {

    document.cookie = name +'=; Path=/; Expires=Thu, 01 Jan 1970 00:00:01 GMT;';

}

function setCookie(name, value, days) 
{
    var expires = "";
    
    if (days) {

        var date = new Date();

        date.setTime(date.getTime() + (days*24*60*60*1000));

        expires = "; expires=" + date.toUTCString();

    }

    document.cookie = name + "=" + (value || "")  + expires + "; path=/";

} 

function getCookie(cname) {

    var name = cname + "=",
        ca = document.cookie.split(';'),
        i,
        c,
        ca_length = ca.length;

    for (i = 0; i < ca_length; i += 1) {

        c = ca[i];

        while (c.charAt(0) === ' ') {

            c = c.substring(1);

        }

        if (c.indexOf(name) !== -1) {

            return c.substring(name.length, c.length);

        }

    }

    return "";

}