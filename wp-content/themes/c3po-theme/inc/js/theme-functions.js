
/**
 * C3PO Theme base
 * 
 * Index page
 * 
 * @version 1.0.0
 * @author  web@usalafuerza.com
 * @date    2019/09/02
 */

$(function(){

    "use strict";

    c3po_paginator();
  
    $('.test-slider-01').slick();
   
});

/*
* Detect correct email format - Ver si montamos una libreria externa con funciones.
*/
function drIsEmail(email){
    var regex = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return regex.test(email.toLowerCase());
};
/**
 * Get paginator ajax elements and make ajax call
 */
function c3po_paginator(){
 
    var $elementPostList = $('main.c3po-paginator-main');
 
    $(document).on("click",".no-link.ajax-link, .no-link-next-prev.ajax-link",function(e){
        
        e.preventDefault();

        $(this).addClass( 'actual-link-active' );

        let postData = {
            'page' : $(this).attr('data-num-page'), 
            'template' : js_template
        };                    
        
        $('.c3po-paginator-post-entry-list').addClass('leaving').removeClass('entering');
        console.log( _C3PO_THEME_URI_ + '/inc/ajax/ajax.php' );
        $.ajax( 
            _C3PO_THEME_URI_ + '/inc/ajax/ajax.php', 
            {
                type: 'POST',   
                data: postData,   
                success: function (data, status, xhr) {
                    console.log(JSON.parse ( data) )
                    let response = { data: JSON.parse(data), status, xhr };

                    $elementPostList.html( response.data.html );

                    $('.c3po-paginator-post-entry-list').addClass('entering').removeClass('leaving');

                },
                error: function (jqXhr, textStatus, errorMessage) {
                    
                    console.error( { jqXhr, textStatus, errorMessage } ); 

                }
            }
        );

    });

}

/**
 * Función para imprimir mensajes en la consola, solamente cuando el modo debug esta activado.
 * @param {*} value 
 */
function console_log( value ){

    if( _C3PO_DEBUG_MODE_ ){
        
        console.log( value );

    }

}