<?php

/**
 * C3PO Theme base
 * 
 * Footer page
 * 
 * @version 1.0.0
 * @author  web@usalafuerza.com
 * @date    2019/09/02
 */

?>

    </div>
    <!-- /site-wrapper -->

    <!-- footer -->
    <footer role="contentinfo" class="site-footer viewport">

        <!-- copyright -->
        <p class="copyright">

            &copy; <?php echo esc_html( date( 'Y' ) ); ?> Copyright <?php bloginfo( 'name' ); ?>. <?php esc_html_e( 'Powered by', 'html5blank' ); ?>

            <a href="//wordpress.org" target="_blank">WordPress</a> &amp; <a href="https://usalafuerza.com" target="_blank" rel="noopener noreferrer">C3PO Usalafuerza</a>.

        </p>
        <!-- /copyright -->

    </footer>
    <!-- /footer -->
   
<?php wp_footer(); ?> 

</body>

</html>