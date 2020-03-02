<?php  

/////////////////////////////////EVENEMENTS
echo '<h1>' . category_description(get_category_by_slug('evenement')) . '</h1>';        
/* The 2nd Query (without global var) */
$args3 = array(
    "category_name" => "evenement",
    "posts_per_page" => -1,
    "orderby" =>"date",
    "order" => "ASC"
);
$query3 = new WP_Query( $args3 );

echo '<div class ="conteneur-evenements">';
// The 2nd Loop
while ( $query3->have_posts() ) {
    echo '<div class ="posts-evenements">';
    $query3->the_post();
    $jour = get_the_date("j");
    $mois = get_the_date("m");
    echo '<h3 style = "grid-area:'. $jour . $jour . $mois . $mois .'"> <a href ="'. get_permalink($id) . '">' . get_the_title( $query3->post->ID ) . " </a>- ". get_the_date() . '</h3>';
    echo '</div>';
}
echo '</div>';
// Restore original Post Data
wp_reset_postdata();

?>
