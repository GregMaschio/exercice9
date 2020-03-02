<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package underscores
 */

get_header();
?>
	<div id="primary" class="content-area">
		<main id="main" class="site-main">
         
		<?php

		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content', 'page' );

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

        endwhile; // End of the loop.
        /////////////////////////////////CONFERENCES
        echo '<h1>' . category_description(get_category_by_slug('conference')) . '</h1>';
        // The Query
        $args = array(
            "category_name" => "conference",
            "posts_per_page" => 6,
            "orderby" => "date",
            "order" => "ASC"
        );
        $query1 = new WP_Query( $args );
        
        // The Loop
        while ( $query1->have_posts() ) {
            $query1->the_post();
            echo '<div class ="posts-conferences">';
            the_post_thumbnail('thumbnail');
            echo '<div class ="texte-conferences">';
            echo '<h3> <a href ="' . get_permalink($id) . '">' . get_the_title() ." - ". get_the_date() . '</a></h3>';
            echo '<p>' . substr(get_the_excerpt(),0,200) . '</p>'; 
            echo '</div>';
            echo '</div>';
        }
        
        /* Restore original Post Data 
        * NB: Because we are using new WP_Query we aren't stomping on the 
        * original $wp_query and it does not need to be reset with 
        * wp_reset_query(). We just need to set the post data back up with
        * wp_reset_postdata().
        */
        wp_reset_postdata();
        
        /////////////////////////////////NOUVELLES
        echo '<h1>' . category_description(get_category_by_slug('nouvelle')) . '</h1>';        
        /* The 2nd Query (without global var) */
        $args2 = array(
            "category_name" => "nouvelle",
            "posts_per_page" => 4
        );
        $query2 = new WP_Query( $args2 );
        
        echo '<div class ="conteneur-nouvelles">';
        // The 2nd Loop
        while ( $query2->have_posts() ) {
            echo '<div class ="posts-nouvelles">';
            $query2->the_post();
            echo '<h3> <a href ="'. get_permalink($id) . '">' . substr(get_the_title( $query2->post->ID ),0,15) . '</a></h3>';
            the_post_thumbnail('thumbnail');
            echo '</div>';
        }
        echo '</div>';
        // Restore original Post Data
        wp_reset_postdata();
        ?>
        

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_template_part('template-parts/content', 'evenement');
get_sidebar();
get_footer();
