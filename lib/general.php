<?php

/** Modify display of the title in the header */
remove_action( 'genesis_site_title', 'genesis_seo_site_title' );
add_action( 'genesis_site_title', 'wpacc_seo_site_title' );
function wpacc_seo_site_title() {

	/** Set what goes inside the wrapping tags */
	$logo   = CHILD_URL . "/images/ncdt-logo.png";
	$wrap   = '';
	$inside = '';
	
	if ( is_home() || is_front_page()) {

		$title = sprintf( '<img src="' . $logo . ' " alt="Logo %s">', 'NCDT' );

	} else {

		$title = sprintf( '<a href="%s"><img src="'.$logo.'" alt="Logo NCDT, naar home"></a>', trailingslashit( home_url() ) );

	}

	/** Echo (filtered) */
	echo apply_filters( 'genesis_seo_title', $title, $inside, $wrap );

}

remove_action( 'genesis_entry_header', 'genesis_post_info', 12 );


/** Move Breadcrumbs Below Main Nav */
remove_action('genesis_before_loop', 'genesis_do_breadcrumbs');
add_action('genesis_after_header', 'genesis_do_breadcrumbs');


// Remove read more - basicWP.com
add_filter( 'get_the_content_more_link', 'rrwd_read_more_link' );
function rrwd_read_more_link() {
return ' ... ';
}

//add_action( 'genesis_before_content', 'rrwd_add_cpt_title' );
function rrwd_add_cpt_title() {

	if ( is_post_type_archive()  ) {

	    ?><header class="archive-description"><h1 class="entry-title"><?php post_type_archive_title(); ?></h1></header><?php
	}

}

remove_action( 'genesis_after_post_content', 'genesis_post_meta' );


/** Completely remove Secondary Navigation Menu */
add_theme_support( 'genesis-menus', array( 'primary' => 'Primary Navigation Menu' ) );

/** Unregister layout setting and sidebars*/
genesis_unregister_layout( 'content-sidebar-sidebar' );
genesis_unregister_layout( 'sidebar-sidebar-content' );
genesis_unregister_layout( 'sidebar-content-sidebar' );
genesis_unregister_layout( 'sidebar-content' );
genesis_unregister_layout( 'content-sidebar' );
unregister_sidebar('sidebar');
unregister_sidebar( 'sidebar-alt' );

//* Remove Genesis Layout Settings
//remove_theme_support( 'genesis-inpost-layouts' );

/** Remove the post meta function */
remove_action( 'genesis_after_post_content', 'genesis_post_meta' );
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );

/** Customize the post info function */
remove_action( 'genesis_before_post_content', 'genesis_post_info' );

/* Add edito style (editor-style.css)  for TinyMCE*/
add_editor_style();

//* Remove the edit link
add_filter ( 'genesis_edit_post_link' , '__return_false' );

/**
 * Change default skip links
 */
remove_action ( 'genesis_before_header', 'genesis_skip_links', 5 );
add_action ( 'genesis_before_header', 'ncdt_skip_links', 5 );
/**
 * Add skiplinks for screen readers and keyboard navigation
 *
 * @since  2.2.0
 */
function ncdt_skip_links() {

	// Call function to add IDs to the markup
	genesis_skiplinks_markup();

	// Determine which skip links are needed
	$links = array();

	if ( has_nav_menu( 'primary' ) ) {
		$links['genesis-nav-primary'] =  'spring naar de hoofdnavigatie';
	}

	$links['genesis-content'] = 'spring naar de inhoud';

	if ( current_theme_supports( 'genesis-footer-widgets' ) ) {
		$footer_widgets = get_theme_support( 'genesis-footer-widgets' );
		if ( isset( $footer_widgets[0] ) && is_numeric( $footer_widgets[0] ) ) {
			if ( is_active_sidebar( 'footer-1' ) ) {
				$links['genesis-footer-widgets'] = 'spring naar de extra informatie aan de onderkant';
			}
		}
	}

	 /**
	 * Filter the skip links.
	 *
	 * @since 2.2.0
	 *
	 * @param array $links {
	 *     Default skiplinks.
	 *
	 *     @type string HTML ID attribute value to link to.
	 *     @type string Anchor text.
	 * }
	 */
	$links = apply_filters( 'genesis_skip_links_output', $links );

	// write HTML, skiplinks in a list with a heading
	$skiplinks  =  '<section>';
	$skiplinks .=  '<h2 class="screen-reader-text">Snel links</h2>';
	$skiplinks .=  '<ul class="genesis-skip-link">';

	// Add markup for each skiplink
	foreach ($links as $key => $value) {
		$skiplinks .=  '<li><a href="' . esc_url( '#' . $key ) . '" class="screen-reader-shortcut"> ' . $value . '</a></li>';
	}

	$skiplinks .=  '</ul>';
	$skiplinks .=  '</section>' . "\n";

	echo $skiplinks;
}

/**
 * Custom Footer
 */
add_filter('genesis_footer_output', 'ncdt_footer_output_filter', 10, 3);
function ncdt_footer_output_filter( $output, $backtotop_text, $creds_text ) {
    $output = '<a href="https://www.theinternetacademy.nl">Het NCDT is een initiatief van:<br />The Internet Academy<br /><img src="' . CHILD_URL . '/images/logoTheInternetAcademy.png" alt="" /></a>';
     return $output;
}


/**
* Register with hook 'wp_enqueue_scripts', which can be used for front end CSS and JavaScript
*/
add_action( 'wp_enqueue_scripts', 'ncdt_enqueue_scripts' );
function ncdt_enqueue_scripts() {

    wp_enqueue_script( 'responsive-menu', CHILD_URL . '/js/responsive-menu.js', array( 'jquery' ), '1.0.0', true );
	wp_enqueue_script( 'top', CHILD_URL . '/js/top.js', array('jquery'), '1.0.0', true );

    if ( is_home() || is_front_page() ) {
 		wp_enqueue_script( 'ncdt', CHILD_URL . '/js/ncdt-mouse-attention.js', array('jquery'), '1.0.0', true	);
    }


}

/** adds an excerpt (ACF) to the top of the content */
add_filter( 'the_content', 'ncdt_excerpts', 20 );
function ncdt_excerpts( $content ) {

	if ( !function_exists('get_field') ) {
		return $content;
	}

	if ( is_front_page() || is_home() || is_archive() || is_search() ) {
		return $content;
	}

	if  ( !get_field( 'acf_ncdt_custom_excerpt' ) ) {
		return $content;
	}

	$summary = get_field( 'acf_ncdt_custom_excerpt' );

	$content = '<div class="summary">' . $summary . '</div>' . $content;

	return $content;

}


/**
 * Filter archive excerpts created with ACF, remove all HTML.
 *
 * @param   $excerpt
 *
 * @return  string  Filtered archive excerpt.
 */
function ncdt_archive_excerpt( $excerpt ) {

	global $post;

	if  ( ! get_field( 'acf_ncdt_custom_excerpt', $post->id ) ) {
		return $excerpt;
	} else {
		$text = get_field( 'acf_ncdt_custom_excerpt', $post->id );
		$excerpt = wp_strip_all_tags ( $text, false );
	}

  	return $excerpt;
}
add_filter( 'get_the_excerpt', 'ncdt_archive_excerpt' );


//* Register after post widget area
genesis_register_sidebar( array(
	'id'            => 'ncdt-bottom',
	'name'          => 'Helemaal onderaan',
	'description'   => 'Widget helemaal onderaan',
) );

remove_action( 'genesis_footer', 'genesis_do_footer' );
add_action( 'genesis_footer', 'ncdt_custom_footer' );
function ncdt_custom_footer() {
	genesis_widget_area( 'ncdt-bottom', array( 'before' => '<div class="ncdt-bottom widget-area">', 'after' => '</div>' ) );
}


/**
 * Disable the emoji's
 */
add_action( 'init', 'ncdt_disable_emojis' );
function ncdt_disable_emojis() {
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_action( 'admin_print_styles', 'print_emoji_styles' );
	remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
	remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
	remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
}

// Move Yoast to bottom
add_filter( 'wpseo_metabox_prio', 'ncdt_yoasttobottom');
function ncdt_yoasttobottom() {
	return 'low';
}

function ncdt_sitemap() {

	?>

    <div class="entry-content">

		<h2>Pagina's</h2>
		<ul>
		<?php
		wp_list_pages( 'title_li=' );
		?>
		</ul>

		<?php

		$args = array(
			'posts_per_page' => -1,
			'post_type' => 'ncdt_speakers',
			'orderby' => 'menu_order name',
			'post_status' => 'publish',
			);

		$posts_array = get_posts( $args );

		if ( ! empty ( $posts_array ) ) {

			?>
			<h2>Sprekers</h2>
			<ul>

			<?php
			foreach ( $posts_array as $this_post ) {

				?>
				<li><a href="<?php echo get_permalink( $this_post->ID ) ?>"><?php echo get_the_title( $this_post->ID ); ?></a></li>
				<?php
			}

			?>
			</ul>
			<?php

		}

		$args = array(
			'posts_per_page' => -1,
			'post_type' => 'ncdt_talks',
			'orderby' => 'menu_order name',
			'post_status' => 'publish',
			);

		$posts_array = get_posts( $args );

		if ( ! empty ( $posts_array ) ) {

			?>
			<h2>Presentaties</h2>
			<ul>

			<?php
			foreach ( $posts_array as $this_post ) {
				?>
				<li><a href="<?php echo get_permalink( $this_post->ID ) ?>"><?php get_the_title( $this_post->ID ); ?></a></li>
				<?php
			}
			?>

			</ul>
			<?php

		}
		?>

   	</div>

	<?php


}

	/**
	 * Insert a top link before the footer widgets
	 *
	 */
	function ncdt_before_footer_widgets() {

		?>
		<a href="#top" id="toplink">top</a>
		<?php

	}

	add_action( 'genesis_before_footer', 'ncdt_before_footer_widgets', 5 );