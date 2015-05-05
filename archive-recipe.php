<?php

/**
 * Template Name: Recipe Archives
 * Description: Used as a page template to show page contents, followed by a loop through a CPT archive  
 */

remove_action ('genesis_loop', 'genesis_do_loop'); // Remove the standard loop
add_action( 'genesis_loop', 'custom_do_grid_loop' ); // Add custom loop

function custom_do_grid_loop() {  
  	
	// Intro Text (from page content)
	echo '<div class="page hentry entry">';
	echo '<h1 class="recipe-title">'. get_the_title() .'</h1>';
	echo '<div class="entry-content">' . get_the_excerpt() ;

	$args = array(
		'post_type' => 'recipe', // enter your custom post type
		'orderby' => 'menu_order',
		'order' => 'ASC',
		'posts_per_page'=> '12',  // overrides posts per page in theme settings
	);
	$loop = new WP_Query( $args );
	if( $loop->have_posts() ):
				
		while( $loop->have_posts() ): $loop->the_post(); global $post;

            echo '<div id="recipe-entry">';
            echo '<h1 class="recipe-title"><a href="' . get_permalink() . '">' . get_the_title() . '</a>' . '</h1>';
            echo '<div><div class="recipeImage">' . get_the_post_thumbnail( $id, array(720,405) ) . '</div></div>';
			echo '<div class="recipe">'. genesis_get_custom_field( '_cd_client_name' ).'<br />'.genesis_get_custom_field( '_cd_client_title' ).'</div>';
			echo '</div>';	
			echo '<div class="recipeExcerpt">';
			echo '<p>' . get_the_excerpt() . '</p>';
            echo '<p class="recipeLink"><a href="' . get_permalink() . '">Get Recipe</a></p>';
		echo '</div>';
		
		endwhile;
		
	endif;
	
	// Outro Text (hard coded)
	echo '</div><!-- end .entry-content -->';
	echo '</div><!-- end .page .hentry .entry -->';
}
	
/** Remove Post Info */
remove_action('genesis_before_post_content','genesis_post_info');
remove_action('genesis_after_post_content','genesis_post_meta');
 
genesis();