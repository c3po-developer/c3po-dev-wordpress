jQuery(function($){

    // On form submit
    $('#ccf-form').submit( function(e){

        // Prevent submit action default
        e.preventDefault();
        
        let data_required;

        let send_flag = 0;

        var heap_error=[];
 
        $(this).find('input,textarea').each(function(i,e){
        
            $(this).removeClass('fail');

            data_required = $(this).attr('data-required');
            
            if( data_required ){ 

                // Type text
                if( $(this).attr('type') == 'text' && $(this).val().trim() == '' ){
                     
                    heap_error.push( 'data-' +  data_required );
                    $(this).addClass('fail');
                    send_flag  = 1;
                } 

                // Type email
                if( $(this).attr('type') == 'email' && $(this).val().trim() == '' ){
                 
                    heap_error.push( 'data-' +  data_required ); 
                    $(this).addClass('fail');
                    send_flag  = 1;
                }

                // Type email format
                if( $(this).attr('type') == 'email' && isEmail( $(this).val() ) == false ) {
                     
                   heap_error.push( 'data-' +  data_required );
                   $(this).addClass('fail');
                   send_flag  = 1;
                }
              
                // Type checkbox
                if( $(this).attr('type') == 'checkbox' && $(this).is(':checked') == false ){
 
                   heap_error.push( 'data-' +  data_required );
                   $(this).addClass('fail');
                   send_flag  = 1;
                }

                // Type textarea
                if( $(this).is("textarea") && $(this).val().trim() == '' ){
 
                    heap_error.push( 'data-' +  data_required );
                    $(this).addClass('fail');
                    send_flag  = 1;
                }
 
            } 
                                
        });
 
        // If exist some error, then show it
        if( heap_error.length ) {
            
            set_error_message( heap_error );
        
        }
          
        if( send_flag == 0 ){
         
            // Form data to send
            let form_data = new FormData();    

            // Url ajax file
            let ajax_url = $(this).attr('data-ajax');
            
            // Custom post ID 
            let form_id  = $(this).attr('data-form-id');
    
            if ($(".ccf-input-file").length != 0 ){
                        
                $(".ccf-input-file").each(function(e,i){
    
                    // Add file attachment
                    form_data.append( e,  $(this).prop('files')[0] );

                }); 

            }

            // Add custom post ID
            form_data.append( 'form_id', form_id );

            // Add form serialize pairs key | values
            form_data.append( 'form', $( this ).serialize() );
     
            $('#response').removeClass("form-success");

            $('#response').removeClass("form-error");
            
            $('#response').addClass("form-hide");

            // Ajax petition
            $.ajax({
                url: ajax_url, 
                dataType: 'json',  
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,                         
                type: 'post',
                success: function(php_script_response){  
                    
                    $('#response').removeClass("form-hide");

                    switch (parseInt( php_script_response )) { 

                        case 1:
                            
                            $('#response').addClass("form-success");

                            $('#response').removeClass("form-error");
                            
                            $('#ccf-form').trigger("reset");
                            
                            set_response_message ( 'data-success' );

                            break;

                        case 2:
                            
                            $('#response').removeClass("form-success");

                            $('#response').addClass("form-error");

                            set_response_message ('data-file-big' );
                            
                            break;

                        case 3:
                             
                            $('#response').removeClass("form-success");

                            $('#response').addClass("form-error");

                            set_response_message ( 'data-extension' );

                            break;

                        case 4:
                            
                            $('#response').removeClass("form-success");

                            $('#response').addClass("form-error");

                            console.log('CCF : Template file does exist'); 

                            break;
                    
                        default:

                            $('#response').removeClass("form-success");

                            $('#response').addClass("form-error");

                            set_response_message ( 'data-fail' ) ;

                            break;
                    }
                
                }

            }); 
            
        }else{
            
            $('#response').removeClass("form-success");

            $('#response').addClass("form-error");

        }

    }); 
 
    // Delete log
    $('#delete_meta_log').click(  function(e){
 
        e.preventDefault();

        let url = $(this).attr('data-ajax-url');
   
        let post_id = $(this).attr('data-post-id');

        let confirm_delete = confirm('¿Está seguro de realizar esta acción? La eliminación del registro es irreversible');
          
        if( confirm_delete == true ){

            $.ajax({
                url: url,  
                dataType: 'json',
                data: { id : post_id },                         
                type: 'post',
                success: function(php_script_response){
                    
                    location.reload();

                }

            });
        }

    });
    $('.modal-log .close').on('click', function(){
        $('.modal-log').fadeOut();
    });
    $('.view-log-msg').on('click', function(e){

        e.preventDefault();
 
        $.ajax({
            url:  $('#log_table').attr( 'data-ajax-url' ) ,  
            dataType: 'json',
            data: { id : $(this).attr( 'data-id' ) },                         
            type: 'post',
            success: function(php_script_response){
                
                console.log( php_script_response );
                $('.modal-log').fadeIn();
                $('.modal-log .msg').html ( php_script_response );
            }

        });

    });

    function set_response_message ( id_data_attr  ){
 
        $('#response').text( $('#response').attr( id_data_attr ) );
  
    }

    function set_error_message ( heap ){
   
        var uniqueNames = [];

        $('#response').text('');

        $.each(heap, function(i, el){

            if($.inArray(el, uniqueNames) === -1) uniqueNames.push(el);
        });

        uniqueNames.forEach(function( e){
 
            $('#response').append( '<p>' + $('#response').attr( e ) + '</p>' );

        });
        
    }

    function isEmail(email) {
        var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        return regex.test(email);
    }
      
}); 