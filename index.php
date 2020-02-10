index

<?php

get_header();

if ( have_posts() )
{
    while ( have_posts() )
    {
        the_post();

        the_title();

        the_content();

        
       
    }
}


// Example argument that defines three posts per page. 
$args = array( 'posts_per_page' => 2 ); 
 
// Variable to call WP_Query. 
$the_query = new WP_Query( $args ); 
 
if ( have_posts() ) : 
    // Start the Loop 
    while ( $the_query->have_posts() ) : $the_query->the_post(); 
        the_title(); 
        the_excerpt(); 
    // End the Loop 
    endwhile; 
else: 
// If no posts match this query, output this text. 
    _e( 'Sorry, no posts matched your criteria.', 'textdomain' ); 
endif; 
 
wp_reset_postdata(); 



get_footer();
?>
