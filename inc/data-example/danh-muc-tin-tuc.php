<?php
if ( ! defined( 'ABSPATH' ) ) {
    // Nếu truy cập trực tiếp, load WordPress core
    $wp_load_path = dirname(__FILE__, 6) . '/wp-load.php';
    if (file_exists($wp_load_path)) {
        require_once $wp_load_path;
        
        $results = tecotec_import_sample_news_categories();
        echo '<h1>Import Danh mục Tin tức</h1>';
        echo '<pre>' . print_r($results, true) . '</pre>';
        exit;
    }
    exit;
}

/**
 * Data danh mục minh họa cho Tin tức (Taxonomy: danh_muc_tin_tuc)
 */
function tecotec_get_sample_news_categories() {
    return array(
        array(
            'name'        => 'Sự kiện nổi bật',
            'slug'        => 'su-kien-noi-bat',
            'description' => 'Các sự kiện quan trọng, nổi bật của TECOTEC Group.',
        ),
        array(
            'name'        => 'Hoạt động công ty',
            'slug'        => 'hoat-dong-cong-ty',
            'description' => 'Tin tức về các hoạt động nội bộ, văn hóa và phong trào của công ty.',
        ),
        array(
            'name'        => 'Hội thảo & Đào tạo',
            'slug'        => 'hoi-thao-dao-tao',
            'description' => 'Thông tin về các chương trình hội thảo chuyên đề, khóa đào tạo nội bộ và đối tác.',
        ),
        array(
            'name'        => 'Thành tựu & Giải thưởng',
            'slug'        => 'thanh-tuu-giai-thuong',
            'description' => 'Các chứng nhận, thành tựu và giải thưởng đạt được của TECOTEC Group.',
        ),
    );
}

/**
 * Hàm import danh mục minh họa
 */
function tecotec_import_sample_news_categories() {
    $categories = tecotec_get_sample_news_categories();
    $results = array(
        'created' => 0,
        'errors'  => array(),
    );

    foreach ( $categories as $cat ) {
        $term_exists = term_exists( $cat['slug'], 'danh_muc_tin_tuc' );
        
        if ( ! $term_exists ) {
            $inserted_term = wp_insert_term(
                $cat['name'],
                'danh_muc_tin_tuc',
                array(
                    'slug'        => $cat['slug'],
                    'description' => $cat['description'],
                )
            );

            if ( is_wp_error( $inserted_term ) ) {
                $results['errors'][] = $inserted_term->get_error_message();
            } else {
                $results['created']++;
            }
        }
    }

    return $results;
}

// Đăng ký WP-CLI command để import dễ dàng
if ( defined( 'WP_CLI' ) && WP_CLI ) {
    WP_CLI::add_command( 'tecotec import-news-categories', function() {
        $results = tecotec_import_sample_news_categories();

        foreach ( $results['errors'] as $error ) {
            WP_CLI::warning( $error );
        }

        WP_CLI::success( sprintf( 'Đã import thành công %d danh mục tin tức. Lỗi: %d.', $results['created'], count( $results['errors'] ) ) );
    } );
}
