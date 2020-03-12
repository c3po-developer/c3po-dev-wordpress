// selectables-checkboxs
jQuery(function(){
     
    jQuery('.c3po-index-select-all').on('click', function(e){
        
        e.preventDefault();

        jQuery('.selectables-checkboxs').each(function(r){

           jQuery(this).prop( "checked", true );
            
        });

    });

    jQuery('.c3po-index-unselect-all').on('click', function(e){

        e.preventDefault();

        jQuery('.selectables-checkboxs').each(function(r){

           jQuery(this).prop( "checked", false );
            
        });

    });
});