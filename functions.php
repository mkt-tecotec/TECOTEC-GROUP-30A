<?php
/**
 * Tecotec Group Theme Functions
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Theme Setup
 */
function tecotec_group_setup()
{
    // Add default posts and comments RSS feed links to head.
    add_theme_support('automatic-feed-links');

    // Let WordPress manage the document title.
    add_theme_support('title-tag');

    // Enable support for Post Thumbnails on posts and pages.
    add_theme_support('post-thumbnails');

    // Switch default core markup for search form, comment form, and comments
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    ));

    // Register Navigation Menus
    register_nav_menus(array(
        'primary' => esc_html__('Primary Menu', 'tecotec-group'),
        'footer' => esc_html__('Footer Menu', 'tecotec-group'),
    ));
}
add_action('after_setup_theme', 'tecotec_group_setup');

/**
 * Helper: enqueue a theme CSS file with filemtime versioning.
 *
 * Usage trong component:
 *   tecotec_enqueue_style('news');                         // load news.css
 *   tecotec_enqueue_style('news', ['tecotec-main-css']);   // với dependency
 *
 * @param string $name      Tên file (không có .css), VD: 'news', 'gallery'
 * @param array  $deps      Handle dependencies (mặc định: ['tecotec-main-css'])
 * @param string $handle    Handle WP (mặc định: "tecotec-{$name}")
 */
function tecotec_enqueue_style(string $name, array $deps = ['tecotec-main-css'], string $handle = ''): void
{
    if (empty($handle)) {
        $handle = "tecotec-{$name}";
    }
    $path = get_template_directory() . "/assets/css/{$name}.css";
    $uri = get_template_directory_uri() . "/assets/css/{$name}.css";
    wp_enqueue_style($handle, $uri, $deps, file_exists($path) ? (string) filemtime($path) : '1.0.0');
}

/**
 * Helper: enqueue a theme JS file with filemtime versioning.
 *
 * Usage trong component:
 *   tecotec_enqueue_script('gallery', ['jquery']);         // load gallery.js
 *   tecotec_enqueue_script('gallery', ['jquery'], false);  // in <head>
 *
 * @param string $name      Tên file (không có .js), VD: 'gallery', 'overview'
 * @param array  $deps      Handle dependencies
 * @param bool   $in_footer Load ở cuối body (mặc định: true)
 * @param string $handle    Handle WP (mặc định: "tecotec-{$name}-js")
 */
function tecotec_enqueue_script(string $name, array $deps = [], bool $in_footer = true, string $handle = ''): void
{
    if (empty($handle)) {
        $handle = "tecotec-{$name}-js";
    }
    $path = get_template_directory() . "/assets/js/{$name}.js";
    $uri = get_template_directory_uri() . "/assets/js/{$name}.js";
    wp_enqueue_script($handle, $uri, $deps, file_exists($path) ? (string) filemtime($path) : '1.0.0', $in_footer);
}

/**
 * Enqueue base scripts and styles (global — mọi trang).
 * CSS riêng của từng component được enqueue ngay trong file component đó
 * bằng cách gọi tecotec_enqueue_style() / tecotec_enqueue_script().
 */
function tecotec_group_scripts()
{
    $version = '1.1.1';
    $dir_uri = get_template_directory_uri();
    $dir_path = get_template_directory();

    /* ── Fonts: chỉ dùng Inter ─────────────────────────── */
    wp_enqueue_style(
        'tecotec-fonts',
        'https://fonts.googleapis.com/css2?family=Inter:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,400;1,700&display=swap',
        array(),
        null
    );

    /* ── Base styles (always loaded) ────────────────────── */
    wp_enqueue_style('tecotec-style', get_stylesheet_uri(), array(), $version);
    wp_enqueue_style('tecotec-header-css', $dir_uri . '/assets/css/header.css', array('tecotec-style'), $version);
    wp_enqueue_style('tecotec-main-css', $dir_uri . '/assets/css/main.css', array('tecotec-style'), $version);



    /* ── Page-template-specific styles ─────────────────── */
    if (is_page_template(array('template-avatar-frame.php', 'template-wallpaper.php'))) {
        wp_enqueue_style('tecotec-microsite-a30', $dir_uri . '/assets/css/microsite-a30.css', array('tecotec-main-css'), $version);
    }

    if (is_page_template('template-avatar-frame.php')) {
        wp_enqueue_style('tecotec-avatar-frame', $dir_uri . '/assets/css/avatar-frame.css', array('tecotec-microsite-a30'), $version);
        wp_enqueue_script('tecotec-avatar-frame', $dir_uri . '/assets/js/avatar-frame.js', array(), $version, true);
        wp_localize_script('tecotec-avatar-frame', 'tecotecAvatar', array('assetsBase' => $dir_uri . '/assets'));
    }

    if (is_page_template('template-wallpaper.php')) {
        wp_enqueue_style('tecotec-wallpaper', $dir_uri . '/assets/css/wallpaper.css', array('tecotec-microsite-a30'), $version);
        wp_enqueue_script('tecotec-wallpaper', $dir_uri . '/assets/js/wallpaper.js', array(), $version, true);
        wp_localize_script('tecotec-wallpaper', 'tecotecWallpaper', array('assetsBase' => $dir_uri . '/assets'));
    }

    /* ── Scripts ─────────────────────────────────────────── */
    wp_enqueue_script('gsap', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js', array(), '3.12.2', true);
    wp_enqueue_script('gsap-scroll-trigger', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js', array('gsap'), '3.12.2', true);
    wp_enqueue_script('tecotec-custom-js', $dir_uri . '/assets/js/custom.js', array('jquery', 'gsap'), $version, true);

    // Global Image Popup
    wp_enqueue_style('tecotec-image-popup', $dir_uri . '/assets/css/image-popup.css', array('tecotec-main-css'), $version);
    wp_enqueue_script('tecotec-image-popup', $dir_uri . '/assets/js/image-popup.js', array('jquery'), $version, true);
}
add_action('wp_enqueue_scripts', 'tecotec_group_scripts');

/**
 * Disable Gutenberg Editor
 */
add_filter('use_block_editor_for_post', '__return_false', 10);
add_filter('use_block_editor_for_post_type', '__return_false', 10);

/**
 * Disable Gutenberg CSS
 */
function tecotec_remove_wp_block_library_css()
{
    wp_dequeue_style('wp-block-library');
    wp_dequeue_style('wp-block-library-theme');
    wp_dequeue_style('wc-block-style'); // Remove WooCommerce block CSS
}
add_action('wp_enqueue_scripts', 'tecotec_remove_wp_block_library_css', 100);

if (file_exists(get_template_directory() . '/inc/sample-posts.php')) {
    require_once get_template_directory() . '/inc/sample-posts.php';
}

// Temporary trigger to import dummy data
add_action('init', function () {
    if (isset($_GET['import_dummy']) && $_GET['import_dummy'] === '1') {
        if (function_exists('tecotec_a30_import_sample_posts')) {
            $results = tecotec_a30_import_sample_posts();
            echo '<h1>Import Complete!</h1>';
            echo '<pre>' . print_r($results, true) . '</pre>';
            echo '<a href="' . home_url('/') . '">Quay lại trang chủ</a>';
            exit;
        }
    }
});
