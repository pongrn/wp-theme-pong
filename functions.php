<?php
/* Inclusão de CSS e JavaScript no tema */
function pongrn_load_styles() {
    wp_enqueue_style("foundation_min_css", get_template_directory_uri() . '/css/foundation.min.css', '', '5.5.3');
    wp_enqueue_style("normalize_min_css", get_template_directory_uri() . '/css/normalize.min.css');
    wp_enqueue_style("slick_css", get_template_directory_uri() . '/js/slick/slick.css', '', '1.8.0');
    wp_enqueue_style("slick_theme_css", get_template_directory_uri() . '/js/slick/slick-theme.css', '', '1.8.0');
    wp_enqueue_style("style_min_css", get_template_directory_uri() . '/css/style.min.css');
}
add_action('wp_enqueue_scripts', 'pongrn_load_styles');

function pongrn_load_scripts() {
    wp_enqueue_script("modernizr_js", get_template_directory_uri() . '/js/vendor/modernizr.js', '', '', false);

    wp_enqueue_script("jquery_js", get_template_directory_uri() . '/js/vendor/jquery.js', '', '', false);
    wp_enqueue_script("foundation_min_js", get_template_directory_uri() . '/js/foundation.min.js', 'jquery_js', '5.5.3', true);
    wp_enqueue_script("jquery_migrate_min_js", get_template_directory_uri() . 'js/jquery-migrate.min.js', '1.2.1', true);
    wp_enqueue_script("slick_js", get_template_directory_uri() . '/js/slick/slick.js', 'jquery_js', '1.8.0', true);
    wp_enqueue_script("init_js", get_template_directory_uri() . '/js/init.js', 'jquery_js', '', true);
}
add_action('wp_enqueue_scripts', 'pongrn_load_scripts');

/* Título do site */
add_filter( 'wp_title', 'pongrn_title_for_home' );

function pongrn_title_for_home( $title )
{
    if( empty( $title ) && ( is_home() || is_front_page() ) ) {
        return __( get_bloginfo('name'), 'theme_domain' ) . ' - ' . get_bloginfo('description');
    }
    return $title;
}

/* Logo personalizado */
function pongrn_custom_logo_setup() {
    add_theme_support( 'custom-logo', array(
        'height' => 100, // Altura do logotipo
        'width' => 300, // Largura do logotipo
        'flex-width' => true, // Largura flexível do logotipo
    ));
}
add_action( 'after_setup_theme', 'pongrn_custom_logo_setup' );

/* Menus personalizados */
function register_my_menus() {
    register_nav_menus(
        array(
            'main-menu' => __( 'Menu Principal' )
        )
    );
}
add_action( 'init', 'register_my_menus' );

/* Menu principal - adaptação para Foundation Framework */
function foundation_nav_menu_classes($classes, $item){
    if (in_array("current-menu-item", $classes)){
        array_push($classes, "active");
    }

    if (in_array("menu-item-has-children", $classes)){
        array_push($classes, "has-dropdown not-click");
    }
    
    return $classes;
}
add_filter('nav_menu_css_class', 'foundation_nav_menu_classes', 10, 2);

/* Submenus do menu principal - adaptação para Foundation Framework */
class Foundation_Walker_Nav_Menu extends Walker_Nav_Menu {
    function start_lvl(&$output, $depth = 0, $args = array()){
        $indent = str_repeat("\t", $depth);
        $output .= "\n$indent<ul class=\"dropdown sub-menu menu-lvl-$depth\">\n";
    }
}

/* Suporte a imagens destacadas */
add_theme_support( 'post-thumbnails' );
set_post_thumbnail_size( 800, 600 );
add_image_size( 'thumbnail-index', 800, 600 , array('center', 'center') );