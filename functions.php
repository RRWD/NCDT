<?php
//* Start the engine
include_once( get_template_directory() . '/lib/init.php' );

//* Child theme (do not remove)
define( 'CHILD_THEME_NAME', 'NCDT child theme' );
define( 'CHILD_THEME_URL', 'http://www.ncdt.nl/' );
define( 'CHILD_THEME_VERSION', '3.0' );

//* Include child theme lib
require_once( CHILD_DIR . '/lib/init.php' );

//* Add HTML5 markup structure
add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list' ) );

//* Add Accessibility support
add_theme_support( 'genesis-accessibility', array( 'headings',  'search-form', 'skip-links' ) );

//* Add viewport meta tag for mobile browsers
add_theme_support( 'genesis-responsive-viewport' );

//* Add support for 2-column footer widgets
add_theme_support( 'genesis-footer-widgets', 2 );
