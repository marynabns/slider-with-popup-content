<?php

add_action('after_setup_theme', 'mytheme_theme_setup');

if ( ! function_exists( 'mytheme_theme_setup' ) ){
    function mytheme_theme_setup(){
        add_action( 'wp_enqueue_scripts', 'mytheme_scripts');
    }
}

if ( ! function_exists( 'mytheme_scripts' ) ){
    function mytheme_scripts() {
        global $theme_version, $random_number;

        // CSS
        wp_enqueue_style( 'theme_css', get_template_directory_uri().'/css/main.css' );
        wp_enqueue_style( 'custom_css', get_template_directory_uri().'/css/custom.css' );
        wp_enqueue_style( 'swiper_css', '//cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css' );

        // Scripts
        wp_enqueue_script( 'theme_js', get_template_directory_uri().'/js/libs/jquery-3.6.0.min.js', array( 'jquery'), '1.0.0', true );
        wp_enqueue_script( 'theme_js_2', get_template_directory_uri().'/js/libs/jquery.scrollbar.min.js', array( 'jquery'), '1.0.0', true );
        wp_enqueue_script( 'theme_js_3', get_template_directory_uri().'/js/libs/ion.rangeSlider.min.js', array( 'jquery'), '1.0.0', true );
        wp_enqueue_script( 'theme_js_4', get_template_directory_uri().'/js/libs/jquery.magnific-popup.min.js', array( 'jquery'), '1.0.0', true );
        wp_enqueue_script( 'theme_js_5', get_template_directory_uri().'/js/libs/swiper-bundle.min.js', array( 'jquery'), '1.0.0', true );
        wp_enqueue_script( 'theme_js_6', get_template_directory_uri().'/js/main.js', array( 'jquery'), $theme_version . $random_number, true );

        wp_localize_script( 'custom_js', 'ajax_object', array(
            'ajaxurl' => admin_url( 'admin-ajax.php' ),
            'directory_uri' => get_template_directory_uri(),
            'bloginfo_url' => get_bloginfo('url'),
        ));
    }
}

//Slider custom post
add_theme_support( 'post-thumbnails' );

function slider_custom_post_type() {
    register_post_type('slider',
        array(
            'labels' => array(
                'name' => __('Slides'),
                'singular_name' => __('Slide')
            ),
            'public' => true,
            'has_archive' => true,
            'supports' => array('title', 'editor', 'thumbnail'),
            'show_in_rest' => true,
        )
    );
}

add_action('init', 'slider_custom_post_type');

add_action('wp_ajax_get_popup_content', 'get_popup_content_callback');
add_action('wp_ajax_nopriv_get_popup_content', 'get_popup_content_callback');

function get_popup_content_callback() {
    $post_id = $_POST['post_id'];
    $post = get_post($post_id);
    if ($post) {
        echo apply_filters('the_content', $post->post_content);
    }
    wp_die();
}

wp_localize_script( 'ajax-content', 'ajaxcontent', array(
    'ajaxurl' => admin_url( 'admin-ajax.php' )
));
