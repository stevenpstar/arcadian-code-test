<?php 

if ( ! function_exists('wptheme_setup')) :

    function wptheme_setup() {

        add_theme_support('title~tag');



    }

endif;

add_action('after_setup_theme', 'wptheme_setup');


function register_wptheme_menu() {
    register_nav_menus(
        array(
            'primary' => __('Primary Menu'),
            'footer' => __('Footer Menu')
        )
    );
}

add_action('init', 'register_wptheme_menu');


function wptheme_scripts() {
    wp_enqueue_style('wptheme_styles', get_stylesheet_uri());
    wp_enqueue_style('wptheme_google_font_one', 'https://fonts.googleapis.com/css?family=Quicksand&display=swap');
    wp_enqueue_script('wptheme_custom_js', get_template_directory_uri()."/script.js", false);
}

add_action('wp_enqueue_scripts', 'wptheme_scripts');


function wptheme_query_vars($vars) {
    $vars[] .= 'movieid';
    return $vars;
}

add_filter('query_vars', 'wptheme_query_vars');