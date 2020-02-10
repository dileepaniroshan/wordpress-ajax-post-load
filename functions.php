<?php 

function js_enqueue_scripts() {
    wp_enqueue_script ("my-ajax-handle", get_stylesheet_directory_uri() . "/js/my-script.js", array('jquery'),1,true); 
    //the_ajax_script will use to print admin-ajaxurl in custom ajax.js
    wp_localize_script('my-ajax-handle', 'the_ajax_script', array('ajaxurl' =>admin_url('admin-ajax.php')));
} 
add_action("wp_enqueue_scripts", "js_enqueue_scripts");


function more_post_ajax() {
  
    $ppp = (isset($_POST["ppp"])) ? $_POST["ppp"] : 1;
    $page = (isset($_POST['pageNumber'])) ? $_POST['pageNumber'] : 0;
  
    header("Content-Type: text/html");
  
    $args = array(
        'suppress_filters' => true,
        'post_type' => 'post',
        'posts_per_page' => $ppp,
        'paged' => $page,
    );
  
    $loop = new WP_Query($args);
  
    $out = '';
  
    if ($loop->have_posts()) : while ($loop->have_posts()) : $loop->the_post();
            $out .= '
            <div class="col-sm-12"><h1>' . get_the_title() . '</h1>' . get_the_content() . '</div>';
        endwhile;
    endif;
    wp_reset_postdata();
    die($out);
}
  
add_action('wp_ajax_nopriv_more_post_ajax', 'more_post_ajax');
add_action('wp_ajax_more_post_ajax', 'more_post_ajax');