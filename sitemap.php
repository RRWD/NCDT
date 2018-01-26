<?php
/**
 * Template Name: Sitemap
 *
 * @category Genesis
 * @package  Templates
 * @author   Rian Rietveld
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     http://www.studiopress.com/themes/genesis
 */

/** Remove standard post content output **/
remove_action( 'genesis_entry_content', 'genesis_do_post_content' );
add_action( 'genesis_entry_content', 'ncdt_sitemap' );

genesis();
