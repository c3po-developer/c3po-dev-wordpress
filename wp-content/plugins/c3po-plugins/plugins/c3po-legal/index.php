<?php

/**
 *  C3PO Legals :: Backend page options
 * 
 * @package   c3po-plugins-legals
 * @author    web@usalafuerza.com
 * @link      http://usalafuerza.com
 */
  
// Recoge el idioma establecido de POLYLANG para establecer el texto en el idioma correspondiente.
$plugin_options_subfix_lang = ( function_exists( 'pll_current_language' ) ? pll_current_language() : 'es' );
 
// Obtiene todos los lenguajes establecidos con Polylang
$plugin_option_langs = get_terms( 'term_language', [ 'hide_empty' => false ] ); ;

// Convierte en objeto para extraer el primer lenguaje establecido
$plugin_option_langs_object = json_decode( json_encode ( $plugin_option_langs, true ) );
 
// Obtiene si viene con algún idioma por defecto  
$tab_lang = ( function_exists( 'pll_current_language' ) ? $plugin_option_langs_object[0]->{'slug'}  : 'pll_es' ); 
 
// Prefijo del plugin
$plugin_subfix = 'c3po_legal';

// Prefijo del campo de opciones
$plugin_option_subfix =  '_' . $plugin_subfix . '_';

// Registra los campos de configuración 
settings_fields( '__c3po_plugins_options_' . $plugin_subfix ); 
   
// Enqueue JS and Css files 
getAdminScriptEnqueue( $plugin_option_subfix . 'js_script', plugin_dir_url( __FILE__ ) . '/inc/js/c3po-legal.js' );

// Valor de las opciones recogidas
$_options_values = get_option( $plugin_option_subfix ); 
 
$_meta_value_textarea_json_content = $_options_values['c3po_contents_json_value'];

$_meta_value_textarea_json_content = ( $_meta_value_textarea_json_content !== '' ) ? $_meta_value_textarea_json_content : '{
	"{{WEB_EMPRESA}}"		:"http:\/\/192.168.1.254",
	"{{NOM_EMPRESA}}"		:"C3PO Usa la fuerza, S.L.",	
	"{{CIF_EMPRESA}}"		:"12345678B",	
	"{{DIR_EMPRESA}}"		:"C\\Carmen, 15 - Palma (07001) - Illes Balears",
	"{{TEL_LEGAL_EMPRESA}}"		:"971971971",
	"{{LEGAL_MAIL_EMPRESA}}"	:"contacto@usalafuerza.com"
}          ';

// Bloquea la pantalla de opciones sino está ningún idioma selecionado desde el menú de herramientas en WP
if( $plugin_options_subfix_lang == '' ) {

    ?>
    
        <style>
          
            .deactive {
                position: relative;
            }

            .deactive:before {
                content   : '';
                position  : absolute;
                width     : 100%;
                height    : 100%;
                top       : 0;
                left      : 0;
                background: rgba(247, 247, 247, 0.9);
            }

            .deactive:after {
                content    : 'Seleccione un idioma para el contenido desde el selector de polylang';
                text-align : center;
                position   : absolute;
                font-size  : 2rem;
                font-weight: 600;
                top        : 50%;
                left       : 50%;
                transform  : translate(-50%, -50%);
                line-height: 2rem;
            }

            #_c3po_legal_id {
                display         : block;
                width           : 100%;
                min-height      : 350px;
                resize          : none;
                font-family     : "Lucida Console", Monaco, monospace;
                font-size       : 0.8rem;
                background-color: #040404;
                color           : #c7c7c7;
                padding         : 5px;
                box-sizing      : border-box;
            } 

        </style>

    <?php

} 

// Enqueue JS and Css files 
getPublicScriptEnqueue( $plugin_option_subfix . 'js_script', plugin_dir_url( __FILE__ ) . '/inc/js/c3po-legal.js' );


// Obtiene las librerias del editor Jodit
getJodit();

?>  

<div class="deactive">

    <h1> <img class="c3po-title-icon" src="http://www.c3po-dev-wordpress.local/wp-content/plugins/c3po-plugins/assets/005-droid.png" width="16px" alt=""> C3PO Legals - <small>Configuración y creación para aviso de cookies, avisos legales y política de privacidad</small></h1>

    <hr>

    <!-- Secction : Constantes de la sección-->
    <h2 class="expander-collapse">Aviso de cookies</h2>
    
    <table style="width:100%">
     
        <tr>
                    
            <td style="width:200px;vertical-align:top">
                
                <b>Duración de la cookie</b>
                
            </td>

            <td>

                <input type="number" 
                       min="1"  
                       name="<?php echo $plugin_option_subfix; ?>[c3po_legal_cookies_content_duration]"
                       id="c3po_legal_cookies_content_duration_id" 
                       value="<?php echo $_options_values['c3po_legal_cookies_content_duration']; ?>"> Días

                <small style="display:block">Tiempo expresado en días completos (24h) para la duración de la cookie.</small>

            </td>

        </tr>

        <tr>

            <td style="width:200px;vertical-align:top">
                
                <b>Tema</b>
                
            </td>

            <td>
                
                <?php 
                    
                    $themes = scanDirs( plugin_dir_path( __FILE__ ) . 'themes/' ); 
                
                    $theme_selected = $_options_values['c3po_legal_cookies_content_theme'];
                    
                ?>

                <select name="<?php echo $plugin_option_subfix; ?>[c3po_legal_cookies_content_theme]" 
                        id="c3po_legal_cookies_content_theme_id">
                    
                    <?php foreach( $themes as $theme ) { ?>
                    
                        <option value="<?php echo $theme; ?>" <?php echo ( $theme_selected == $theme ) ? 'selected' : ''; ?>><?php echo str_replace('-',' ', $theme ); ?></option>
                    
                    <?php } ?>
                    
                </select>

                <small style="display:block">Selecciona un tema visual para la representación en el sitio web.</small>

            </td>

        </tr>

        <tr>

            <td style="width:200px;vertical-align:top">
                
                <b>Eliminar cookie</b>
                
            </td>

            <td>
                
                <input type="button" value="Borrar" id="erase_cookie">

                <small style="display:block">Esta acción eliminara la cookie de sesión y forzara el mostrar de nuevo el aviso.</small>

            </td>

        </tr>


    </table>

    <hr>

    <h2 class="expander-collapse">Páginas legales</h2>
 
    <table>

        <tr style="width:100%">

            <td style="width:200px;vertical-align:top">
                            
                <b>JSON</b>
                
                <br>
                
                <small>Define aquí los terminos que se utilizan para sustituirse a lo largo de todos los textos legales</small>  

            </td>

            <td style="width:80%;">

            <textarea name="<?php echo $plugin_option_subfix; ?>[c3po_contents_json_value]" 
                    class="c3po_plugins_json_contents_textarea"
                    autocorrect="off" 
                    autocapitalize="off" 
                    spellcheck="false"
                    id="<?php echo $plugin_option_subfix; ?>id" 
                    cols="30" 
                    rows="10"><?php echo $_meta_value_textarea_json_content; ?></textarea>
                            
            </td>

        </tr>

    </table>
    
    <!-- Tabs superiores -->
    <div class="tabs-lang">
        
        <ol>

            <?php  
                
                foreach( $plugin_option_langs as $plugin_option_lang ) { 
                    
                    $flag = ( $plugin_option_lang->{'slug'} === 'pll_ca' ) ? 'https://upload.wikimedia.org/wikipedia/commons/thumb/c/ce/Flag_of_Catalonia.svg/200px-Flag_of_Catalonia.svg.png' : 'https://www.countryflags.io/'.str_replace( 'pll_','', $plugin_option_lang->{'slug'} ).'/flat/64.png';
                     
                    ?>  

                <li>

                    <a data-lang="<?php echo $plugin_option_lang->{'slug'}; ?>" 
                       class="tab<?php echo ( $plugin_option_lang->{'slug'} == $tab_lang ) ? ' active-tab' : '' ; ?>">
                       <img width="16" src="<?php echo $flag; ?>"><?php echo $plugin_option_lang->{'name'}; ?></a>
                       
                </li>

            <?php } ?>

        </ol>

    </div>

    <!-- Tabs Contenido -->
    <div class="tabs-lang-content">
        
        <?php foreach( $plugin_option_langs as $plugin_option_lang ) {  ?>

            <div data-lang="<?php echo $plugin_option_lang->{'slug'}; ?>" 
                 class="tab-content <?php echo $plugin_option_lang->{'slug'}; ?> <?php echo ( $plugin_option_lang->{'slug'} == $tab_lang ) ? 'active-tab' : '' ; ?>">
                
                <!-- Secction : Aviso de cookies-->
                <p class="expander-collapse" style="font-size:1rem;"><b>Aviso de cookies</b></p>

                <table class="collapse collapsed">

                    <tr>
                        
                        <td style="width:200px;vertical-align:top">
                            
                            <b>Título</b>
                            
                        </td>

                        <td>
                        
                            <input type="text" 
                                    name="<?php echo $plugin_option_subfix; ?>[c3po_legal_cookies_content_title_<?php echo $plugin_option_lang->{'slug'};?>]" 
                                    id="c3po_legal_cookies_content_title_id" 
                                    value="<?php echo $_options_values['c3po_legal_cookies_content_title_' . $plugin_option_lang->{'slug'} ]; ?>">

                            <small style="display:block">Titulo del aviso.</small>

                        </td>

                    </tr>

                    <tr>
        
                        <td style="width:200px;vertical-align: top;">
                            
                            <b>Contenido del aviso</b>
                            
                        </td>

                        <td>

                            <?php 
                
                                getJoditEditor( $plugin_option_subfix . "[c3po_legal_cookies_content_advice_" . $plugin_option_lang->{'slug'}."]", 
                                                'c3po_legal_cookies_content_advice_id_' . $plugin_option_lang->{'slug'},  
                                                ( $_options_values[ 'c3po_legal_cookies_content_advice_' . $plugin_option_lang->{'slug'} ] != '' ) ? 
                                                    $_options_values[ 'c3po_legal_cookies_content_advice_' . $plugin_option_lang->{'slug'} ] : 
                                                    getFile( dirname (__FILE__) . '/docs/cookies_advice.html' ) 
                                ); 
                            
                            ?>

                            <small style="display:block">Este texto será el mostrado en el aviso.</small>

                        </td>

                    </tr>

                    <tr>
        
                        <td style="width:200px;vertical-align: top;">
                            
                            <b>Texto <i>POLÌTICA DE COOKIES</i></b>
                                
                        </td>

                        <td> 

                            <?php 
                            
                                getJoditEditor( $plugin_option_subfix . "[c3po_legal_cookies_content_page_" . $plugin_option_lang->{'slug'}."]", 
                                                'c3po_legal_cookies_content_page_id_' . $plugin_option_lang->{'slug'},    
                                                ( $_options_values['c3po_legal_cookies_content_page_' . $plugin_option_lang->{'slug'} ] != '' ) ? 
                                                    $_options_values['c3po_legal_cookies_content_page_' . $plugin_option_lang->{'slug'} ] : 
                                                    getFile( dirname (__FILE__) . '/docs/cookies_text.html' ) 
                                ); 
                            
                            ?>

                            <small style="display:block">Textos legales</small>

                        </td>

                    </tr>

                    <tr>
                        
                        <td style="width:200px;">
                            
                            <b>Texto del botón ACEPTAR</b>
                            
                        </td>

                        <td>

                            <input type="text" 
                                    name="<?php echo $plugin_option_subfix; ?>[c3po_legal_cookies_content_accept_<?php echo $plugin_option_lang->{'slug'};?>]"
                                    id="c3po_legal_cookies_content_accept_id" 
                                    value="<?php echo $_options_values['c3po_legal_cookies_content_accept_' . $plugin_option_lang->{'slug'} ]; ?>">

                            <small style="display:block">Este texto se mostrara en el botón de cerrar el aviso.</small>

                        </td>

                    </tr>

                    

                </table> 

                <hr> 

                <!-- Secction : Avisos legales y política de privacidad --> 
                <p class="expander-collapse" style="font-size:1rem;"><b>Avisos legales y política de privacidad</b></p>
                
                <table class="collapse collapsed">

                    <tr>
                
                        <td style="width:200px;vertical-align: top;">
                            
                            <b>Texto <i>AVISOS LEGALES</i></b>
                            
                        </td>

                        <td>

                            <?php 
                                
                                getJoditEditor( $plugin_option_subfix . "[c3po_legal_legal_condition_content_page_" . $plugin_option_lang->{'slug'}."]",  
                                                'c3po_legal_legal_condition_content_page_id_' . $plugin_option_lang->{'slug'},  
                                                ( $_options_values['c3po_legal_legal_condition_content_page_' . $plugin_option_lang->{'slug'} ] != '' ) ? 
                                                    $_options_values['c3po_legal_legal_condition_content_page_' . $plugin_option_lang->{'slug'} ] : 
                                                    getFile( dirname (__FILE__) . '/docs/legal_text.html' )
                                                
                                ); 
                                
                            ?> 

                            <small style="display:block">Textos legales</small>

                        </td>

                    </tr>

                    <tr>
                
                        <td style="width:200px;vertical-align: top;">
                            
                            <b>Texto <i>POLÍTICA PRIVACIDAD</i></b>
                            
                        </td>

                        <td>

                            <?php 
                                
                                getJoditEditor( $plugin_option_subfix . "[c3po_legal_privaticy_policy_content_page_" . $plugin_option_lang->{'slug'}."]",  
                                                'c3po_legal_privaticy_policy_content_page_id_' . $plugin_option_lang->{'slug'},  
                                                ( $_options_values['c3po_legal_privaticy_policy_content_page_' . $plugin_option_lang->{'slug'} ] != '' ) ? 
                                                    $_options_values['c3po_legal_privaticy_policy_content_page_' . $plugin_option_lang->{'slug'} ] : 
                                                    getFile( dirname (__FILE__) . '/docs/policy_text.html' )
                                ); 
                                
                            ?> 

                            <small style="display:block">Textos legales</small>

                        </td>

                    </tr>
                             
                </table> 

                <hr> 

                <!-- Secction : Avisos en formularios -->
                <p class="expander-collapse" style="font-size:1rem;"><b>Avisos para formularios</b></p> 

                <table class="collapse collapsed">

                    <tr>
                
                        <td style="width:200px;    vertical-align: top;">
                            
                            <b>Texto</b>
                            
                        </td>

                        <td>

                            <?php 
                            
                                getJoditEditor( $plugin_option_subfix . "[c3po_legal_cookies_content_forms_" . $plugin_option_lang->{'slug'}."]",  
                                                'c3po_legal_cookies_content_forms_id_' . $plugin_option_lang->{'slug'}, 
                                                ( $_options_values['c3po_legal_cookies_content_forms_' . $plugin_option_lang->{'slug'} ] != '' ) ? 
                                                    $_options_values['c3po_legal_cookies_content_forms_' . $plugin_option_lang->{'slug'} ] : 
                                                    getFile( dirname (__FILE__) . '/docs/form_advice.html' )
                                ); 
                            
                            ?>

                            <small style="display:block">Textos legales para debajo del formulario</small>

                        </td>

                    </tr>

                </table> 

                <hr> 

            </div>

        <?php } ?>

    </div> 
                     
    <p class="expander-collapse" style="font-size:1rem;"><b>Manual</b></p>

    <table  class="collapse collapsed">

        <tr style="width:100%">

            <td style="width:100%;vertical-align:top">
                            
                <p>Para mayor información, puedes consultar el manual descargable en PDF.</p>
   
                <span class="pdf-manual"><a href="<?php echo plugins_url( 'c3po-plugins/plugins/c3po-legal/assets/' );?>c3po-legal.pdf" target="_blank" ><span class="pdf-link"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAB4AAAAeCAMAAAAM7l6QAAAAvVBMVEVHcEzHQ0P/2dn7z8/JSkrQWVn////KS0vQXFzJSUnswMD+/f302dnOW1v//v724eH9+vrRZWX89vbUbm713d3PXl7VcXHZfn7z2NjJSkrSaGj67u7QYmLlp6fUbW3ahITmqanQY2PMUlLZf3/OWlr45+f24ODptbX24uLKTU356urRZGTekJDJSUnPX1/QYGDy0tLrvb3KTEzIRUX029vdjY3MVVXosrLrurrXenrinp7gl5fLUFD239/89fWWtdquAAAACnRSTlMA////yv7/zf7MlnrKUQAAAJZJREFUKM9jYKAcMKIATgxpNiTAyMqCV5qZgx2fNBO6PJo0ujy6NJo8qjQE4JKGKiJdmktUBJ+0vKICPmkdXXV80haMPPikTRi18ElbGVnjkebmNTCzxS1taGlnqs3FJcGNVVpD38ZYU4VRSlwYi7S0MqOeuRofn6wkoyAWaTleJVWwIUL8AlikxWR4KIwS2khjAVTIXQDfcRBGt9SuiAAAAABJRU5ErkJggg=="></span>PDF</a></span>

            </td>
 
        </tr>

    </table>

    
</div>