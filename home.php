<?php
/**
 * Template Name: Home
 * This file handles the home page
 *
 * This file belongs to the custome theme: NCDT
 *
 * @category Genesis
 * @package  Templates
 * @author   Rian Rietveld
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     http://www.rrwd.nl
 */

// add_action( 'genesis_after_header', 'ncdt_brand_image' );

/** Remove standard post content output **/
//remove_action( 'genesis_entry_content', 'genesis_do_post_content' );
//add_action( 'genesis_entry_content', 'ncdt_home_content' );
add_action( 'genesis_after_entry_content', 'ncdt_home_content' );

/**
 * This function outputs homepage content
 *
 * @since 1.0
 */
function ncdt_home_content() {

	//the_content();
	ncdt_speakers();
	ncdt_secondary_content();
	ncdt_sponsors();

}

genesis();


function ncdt_brand_image() {

	if ( have_rows( 'ncdt_acf_banner_voorpagina' ) ) {

		$rows = get_field( 'ncdt_acf_banner_voorpagina' );

		if ( $rows ) {
			$rand_keys = array_rand($rows);
			$attachment = $rows[$rand_keys]['ncdt_acf_banner_image'];
			echo wp_get_attachment_image( $attachment['ID'], 'full', false, array( 'class' => 'ncdt-banner' ) );
		}

	}
}


function ncdt_speakers() {

	$posts = get_field('acf_ncdt_sprekers');

	if ( $posts ) {

		$row = 0;  //counter for rows, 3 at one ronw, first class has no padding left.

		$class = " first";

		?>
	    <div class="speakers first">

		    <div class="inner-speakers">

		    <h2><?php the_field('acf_ncdt_sprekers_title')?></h2><?php

			 foreach( $posts as $post_object ) {

			    if ( ( $row % 3 ) == 0 ) $class = " first";

				$page_id = $post_object->ID;

				?>

			    <div class="one-third <?php echo $class; ?>" onclick="navigate('<?php echo get_permalink( $page_id ); ?>');return(false);" onmouseover="classAct('add',this,'over');" onmouseout="classAct('remove',this,'over');">

		        <?php echo get_the_post_thumbnail( $page_id, 'large' ); ?>

			    	<h3><a href="<?php echo get_permalink( $page_id ); ?>"><?php echo get_the_title( $page_id ); ?></a></h3>

		            <?php

					$page_object = get_page( $page_id );
			    	echo apply_filters( 'the_excerpt', $page_object->post_excerpt );

					$class = "";
					$row++;

					?>
			    </div>

			<?php } ?>

		    </div> <!--.inner-speakers-->

	    </div> <!--.speakers-->
		<?php

	}

}

function ncdt_secondary_content() {

	if ( get_field('acf_ncdt_img_blok2') || get_field('acf_ncdt_blok2') ) {

		echo '<div class="home-extra-content">';

		if ( get_field('acf_ncdt_img_blok2') ) {
			echo '<div class="one-half first"><img src="' . get_field('acf_ncdt_img_blok2') . '" alt="" width=420 height=190 /></div>';
		}

		if ( get_field('acf_ncdt_blok2') ) {
			echo '<div class="one-half ">' . get_field('acf_ncdt_blok2') . '</div>';
		}

		echo "</div>";

	}

}


function ncdt_sponsors() {


 	if ( get_field( 'acf_ncdt_sponsors' ) ) {


			$size = "homepage-thumb";
			echo '	<div id="sponsors">' . "\n";
			echo '	<h2><a href="' .get_permalink( 470 ) . '">' .get_the_title( 470 ) . '</a></h2>' . "\n";
			echo '	<ul>' . "\n";


			while( has_sub_field( 'acf_ncdt_sponsors' ) ) {

				$images_obj = get_sub_field( 'acf_ncdt_logo_sponsor');
				$website = get_sub_field( 'acf_ncdt_website_sponsor');
				$name = get_sub_field( 'acf_ncdt_naam_sponsor');
				$attachment_id = $images_obj['id'];
				$image = wp_get_attachment_image_src( $attachment_id, $size );
				if ( strlen ($website ) > 2 ) echo '<li><a href="' . $website .'"><img src="'. $image[0] . '" alt="' . $name .'"></a><li>' . "\n";
			}

			echo '	</ul>' . "\n";
			echo "</div><!--#sponsors-->\n";
		} ?>
    	<div class="clear"></div>

    <?php


}
