<style>
.fail{
       border:1px solid red;
}
</style>
<!-- Formulario de contacto -->
<form id="ccf-form"
      data-form-id="<?php echo $id; ?>"
      data-ajax="<?php echo get_ajax_path(); ?>" 
      novalidate>
    
       <!-- Campos del fomulario -->
       <fieldset>

              <!--
                     
                     # Lista de elementos obligatorios

                     Los ID/name obligatorios minimos de elementos input para recoger 
                     los datos básicos desde el formulario son:

                         - ccf-name
                         - ccf-surname
                         - ccf-email

                     Los elementos file deben llevar la clase cc-input-file para su correcto funcionanmiento.

                     El atributo data-required declara el atributo que se utilizara para pintar el 
                     mensaje desde el elemento #response.

                         <input ... data-required="all-fields">

                         ...
                         ...
                         ...

                         <div id="response" ... data-all-fields="Input vacio" ...>
                     
              -->
              
              <!-- Titulo del email --> 
              <input type="hidden" name="ccf-title" value="C3PO - single-form.php">

              <!-- Logotipo -->
              <input type="hidden" name="ccf-logo" value="<?php echo get_stylesheet_directory(); ?>/inc/assets/logo-email.png">

              <!-- Alt para el logotipo -->
              <input type="hidden" name="ccf-logo-alt" value="Texto alternativo del logotipo">

              <!-- Introducción del email -->
              <input type="hidden" name="ccf-intro" value="<p>Correo enviado desde la web <?php echo site_url(); ?>.<br/>Estos son los datos de contacto:</p>" />

              <!-- Lenguaje establecido desde el formulario -->
              <input type="hidden" name="ccf-lang" value="<?php echo pll_current_language( 'name' ); ?>" />

              <!-- Input text -->
              <div class="input-block">

                     <label for="ccf-name"><?php echo C3POCore\Translate::get_term('name'); ?> <span class="mandatory-sign">*</span></label>

                     <input name="ccf-name" 
                            id="ccf-name" 
                            type="text" 
                            data-required="all-fields"
                            placeholder="<?php echo C3POCore\Translate::get_term('name_placeholder'); ?>">

              </div>

              <!-- Input checkbox -->
              <div class="input-block">

                     <label for="ccf-newsletter"><?php echo C3POCore\Translate::get_term('name'); ?> <span class="mandatory-sign">*</span></label>

                     <input name="ccf-newsletter" 
                            id="ccf-newsletter" 
                            type="checkbox">test

                     <input name="ccf-tv" 
                            id="ccf-tv" 
                            type="checkbox">test 2

              </div>

               <!-- Input radio -->
               <div class="input-block">

                     <label for="ccf-radio"><?php echo C3POCore\Translate::get_term('name'); ?> <span class="mandatory-sign">*</span></label>

                     <input name="ccf-radio" 
                            id="ccf-radio" 
                            type="radio"
                            value="radio_1">test

                     <input name="ccf-radio" 
                            id="ccf-radio" 
                            type="radio"
                            value="radio 2">test 2

              </div>

              
              <!-- Selecte -->
              <div class="input-block">

                     <label for="ccf-gender"><?php echo C3POCore\Translate::get_term('name'); ?> <span class="mandatory-sign">*</span></label>

                     <select name="ccf-gender" 
                             id="ccf-gender" 
                             type="text">
                     
                         <option value="test_value">test text</option>

                         <option value="test_value_2">test text 2</option>

                     </select>

              </div>

              <!-- Input text -->
              <div class="input-block">

                     <label for="ccf-surname"><?php echo C3POCore\Translate::get_term('surname'); ?> <span class="mandatory-sign">*</span></label>

                     <input name="ccf-surname" 
                            id="ccf-surname" 
                            type="text" 
                            data-required="all-fields"
                            placeholder="<?php echo C3POCore\Translate::get_term('surnname_placeholder'); ?>">

              </div>

              <!-- Input text -->
              <div class="input-block">

                     <label for="ccf-email"><?php echo C3POCore\Translate::get_term('email'); ?> <span class="mandatory-sign">*</span></label>

                     <input name="ccf-email" 
                            id="ccf-email" 
                            type="email" 
                            data-required="all-fields-email"
                            placeholder="<?php echo C3POCore\Translate::get_term('email_placeholder'); ?>">

              </div>

              <!-- Input text -->
              <div class="input-block">

                     <label for="ccf-phone"><?php echo C3POCore\Translate::get_term('phone'); ?> <span class="mandatory-sign">*</span></label>

                     <input name="ccf-phone" 
                            id="ccf-phone" 
                            type="text" 
                            data-required="all-fields"
                            placeholder="<?php echo C3POCore\Translate::get_term('phone_placeholder'); ?>">

              </div>

              <!-- Textarea -->
              <div class="input-block">

                     <label for="ccf-message"><?php echo C3POCore\Translate::get_term('message'); ?> <span class="mandatory-sign">*</span></label>

                     <textarea name="ccf-message" 
                               id="ccf-message" 
                               cols="5" 
                               rows="3" 
                               data-required="all-fields-message"
                               placeholder="<?php echo C3POCore\Translate::get_term('message_placeholder'); ?>"></textarea>

              </div>

              <!-- Input file -->
              <div class="input-block">

                     <label for="ccf-file"><?php echo C3POCore\Translate::get_term('file'); ?> <span class="mandatory-sign">*</span></label>

                     <input name="ccf-file" 
                            class="ccf-input-file"  
                            id="ccf-file" 
                            type="file" 
                            placeholder="<?php echo C3POCore\Translate::get_term('name_placeholder_file'); ?>">

              </div>

              <!-- Input file -->
              <div class="input-block">

                     <label for="ccf-file-2"><?php echo C3POCore\Translate::get_term('file'); ?> <span class="mandatory-sign">*</span></label>

                     <input name="ccf-file-2" 
                            class="ccf-input-file"  
                            id="ccf-file-2" 
                            type="file" 
                            placeholder="<?php echo C3POCore\Translate::get_term('name_placeholder_file'); ?>">

              </div>

       </fieldset>

       <!-- Checkbox -->
       <div class="legal_advice">
    		
              <p class="privacy-advice"><?php if ( function_exists( 'c3poLegal_getFormAdvice' ) ) { echo c3poLegal_getFormAdvice(); } else { echo 'Error: El plugin \'Legal\' no esta activado.'; } ?> </p>

              <label for="ccf-accept-privacy-advice">
              
                     <input type="checkbox" 
                            data-required="all-legal"
                            id="ccf-accept-privacy-advice"><small><?php echo C3POCore\Translate::get_term('privacy-accept-phrase'); ?></small>
              
              </label>

       </div>

       <input type="submit" id="ccf-submit" 
              value="<?php echo C3POCore\Translate::get_term('send_form'); ?>">
       
       <!-- Spinner de espera -->
       <div class="ccf-spinner"></div>

       <!-- El campo de respuesta debe usar el ID #response para su correcto funcionamiento -->
       <div id="response"
            data-success="<?php echo C3POCore\Translate::get_term('email-send-success'); ?>"
            data-fail="<?php echo C3POCore\Translate::get_term('email-send-fail'); ?>"
            data-all-fields="<?php echo C3POCore\Translate::get_term('all-mandatory-fields'); ?>"
            data-all-fields-email="<?php echo C3POCore\Translate::get_term('email-mandatory'); ?>"
            data-all-legal="<?php echo C3POCore\Translate::get_term('accept-legals'); ?>"
            data-all-fields-message="<?php echo C3POCore\Translate::get_term('textarea-empty'); ?>"
            data-file-big="<?php echo C3POCore\Translate::get_term('file-too-big'); ?>"
            data-extension="<?php echo C3POCore\Translate::get_term('filetype-not-allowed'); ?>"></div>

</form>