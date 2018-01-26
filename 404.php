<?php
/**
 * Genesis Framework.
 *
 * WARNING: This file is part of the core Genesis Framework. DO NOT edit this file under any circumstances.
 * Please do all modifications in the form of a child theme.
 *
 * @package Genesis\Templates
 * @author  StudioPress
 * @license GPL-2.0+
 * @link    http://my.studiopress.com/themes/genesis/
 */

// Remove default loop.
remove_action( 'genesis_loop', 'genesis_do_loop' );

add_action( 'genesis_loop', 'ncdt_404' );
/**
 * This function outputs a 404 "Not Found" error message.
 *
 */
function ncdt_404() {

	genesis_markup( array(
		'open' => '<article class="entry">',
		'context' => 'entry-404',
	) );

		?>

		<h1 class="entry-title">Pagina niet gevonden</h1>
		<div class="entry-content">

			<p>

				Helaas is de opgevraagde pagina niet gevonden.
				Misschien kun je vinden wat je zoekt via het menu of via de <a href="<?php echo home_url(); ?>">voorpagina</a> van deze website.

			</p>

		</div>

		<?php

	genesis_markup( array(
		'close' => '</article>',
		'context' => 'entry-404',
	) );

}

genesis();
