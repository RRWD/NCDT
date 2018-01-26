<?php

/** Remove Genesis widgets (not accessible enough at the moment)*/
add_action( 'widgets_init', 'oogv_remove_genesis_widgets', 20 );
function oogv_remove_genesis_widgets() {
	unregister_widget( 'WP_Widget_Calendar' );
	unregister_widget( 'WP_Widget_Links' );
	unregister_widget( 'WP_Widget_Meta' );
	unregister_widget( 'WP_Widget_Tag_Cloud' );
	unregister_widget( 'WP_Widget_Recent_Comments' );
	unregister_widget( 'WP_Widget_Recent_Posts' );
}
