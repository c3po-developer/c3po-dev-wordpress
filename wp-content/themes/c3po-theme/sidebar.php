<?php

/**
 * C3PO Theme base
 * 
 * Sidebar page
 * 
 * @version 1.0.0
 * @author  web@usalafuerza.com
 * @date    2019/09/02
 */

?>

<!-- sidebar -->
<aside class="site-sidebar" role="complementary">
 
	<div class="sidebar-widget">
    
		<?php if ( ! function_exists( 'dynamic_sidebar' ) || ! dynamic_sidebar( 'widget-area-1' ) ) ?>
        
	</div>
  
</aside>
<!-- /sidebar -->
