<?php
if ( ! defined( 'ABSPATH' ) ) {
    // Nếu truy cập trực tiếp, load WordPress core
    $wp_load_path = dirname(__FILE__, 6) . '/wp-load.php';
    if (file_exists($wp_load_path)) {
        require_once $wp_load_path;
        
        $results = tecotec_import_sample_news_posts();
        echo '<h1>Import Bài viết Tin tức</h1>';
        echo '<pre>' . print_r($results, true) . '</pre>';
        exit;
    }
    exit;
}

function tecotec_get_sample_news_posts() {
    return array(
        array(
            'title' => 'Lễ kỷ niệm 30 năm thành lập TECOTEC Group',
            'slug' => 'le-ky-niem-30-nam-thanh-lap-tecotec-group',
            'date' => '2026-12-12 09:00:00',
            'category' => 'su-kien-noi-bat',
            'category_label' => 'Sự kiện nổi bật',
            'short_description' => 'Sự kiện đánh dấu cột mốc 30 năm phát triển với chủ đề "30 năm chính xác để kiến tạo niềm tin, tăng trưởng để phát triển bền vững".',
            'tags' => array( 'A30', 'anniversary', 'su-kien-noi-bat', 'dummy' ),
            'image_label' => 'Le ky niem 30 nam TECOTEC Group',
            'external_url' => 'https://tecotec.com.vn/tin-tuc/le-ky-niem-30-nam-thanh-lap',
        ),
        array(
            'title' => 'TECOTEC Group ra mắt chuyên trang 30nam.tecotec.com.vn',
            'slug' => 'ra-mat-chuyen-trang-30nam-tecotec',
            'date' => '2026-07-05 09:00:00',
            'category' => 'su-kien-noi-bat',
            'category_label' => 'Sự kiện nổi bật',
            'short_description' => 'Chuyên trang kỷ niệm 30 năm chính thức lên sóng, tái hiện hành trình 1996 đến 2026 qua 7 giai đoạn và 17 dấu mốc quan trọng.',
            'tags' => array( 'A30', 'microsite', 'su-kien-noi-bat', 'dummy' ),
            'image_label' => 'Ra mat microsite 30 nam TECOTEC',
            'external_url' => 'https://tecotec.com.vn/tin-tuc/ra-mat-microsite',
        ),
        array(
            'title' => 'TECOTEC Group tròn 30 tuổi - Ngày thành lập 19/7',
            'slug' => 'ky-niem-19-7-thanh-lap-tecotec-group',
            'date' => '2026-07-19 09:00:00',
            'category' => 'su-kien-noi-bat',
            'category_label' => 'Sự kiện nổi bật',
            'short_description' => 'Ngày 19/7/2026 đánh dấu tròn 30 năm kể từ khi Công ty TNHH TDN, tiền thân của TECOTEC Group, chính thức ra đời.',
            'tags' => array( 'A30', 'anniversary', 'su-kien-noi-bat', 'dummy' ),
            'image_label' => 'Ngay thanh lap TECOTEC Group 19 7',
            'external_url' => 'https://tecotec.com.vn/tin-tuc/ky-niem-30-nam',
        ),
        array(
            'title' => 'TECOTEC khai trương Showroom Tắc Kè tại Hà Nội',
            'slug' => 'khai-truong-showroom-tac-ke',
            'date' => '2026-04-18 09:00:00',
            'category' => 'hoat-dong-cong-ty',
            'category_label' => 'Hoạt động công ty',
            'short_description' => 'Showroom mới trưng bày các giải pháp đo lường, hiệu chuẩn và phân tích khoa học hiện đại nhất từ các thương hiệu đối tác quốc tế.',
            'tags' => array( 'A30', 'showroom', 'hoat-dong-cong-ty', 'dummy' ),
            'image_label' => 'Khai truong showroom Tac Ke TECOTEC',
            'external_url' => 'https://tecotec.com.vn/tin-tuc/khai-truong-showroom',
        ),
        array(
            'title' => 'TECOTEC Group dâng hoa tưởng niệm tại Lăng Chủ tịch Hồ Chí Minh',
            'slug' => 'tri-an-19-5-lang-bac',
            'date' => '2026-05-19 09:00:00',
            'category' => 'hoat-dong-cong-ty',
            'category_label' => 'Hoạt động công ty',
            'short_description' => 'Hoạt động tri ân nhân dịp 136 năm Ngày sinh Chủ tịch Hồ Chí Minh, mở đầu cho chuỗi sự kiện hướng tới 30 năm thành lập TECOTEC Group.',
            'tags' => array( 'A30', 'tri-an', 'hoat-dong-cong-ty', 'dummy' ),
            'image_label' => 'TECOTEC dang hoa Lang Bac',
            'external_url' => 'https://tecotec.com.vn/tin-tuc/tri-an-19-5',
        ),
        array(
            'title' => 'Cuộc thi vẽ tranh "Measuring Imagination" mừng 30 năm TECOTEC',
            'slug' => 'cuoc-thi-ve-tranh-thieu-nhi-1-6',
            'date' => '2026-06-01 09:00:00',
            'category' => 'hoat-dong-cong-ty',
            'category_label' => 'Hoạt động công ty',
            'short_description' => 'Cuộc thi vẽ tranh dành cho con em cán bộ nhân viên TECOTEC nhân ngày Quốc tế Thiếu nhi 1/6, các tác phẩm xuất sắc sẽ trở thành tường tranh tại trụ sở.',
            'tags' => array( 'A30', 've-tranh', 'hoat-dong-cong-ty', 'internal', 'dummy' ),
            'image_label' => 'Cuoc thi ve tranh Measuring Imagination',
            'external_url' => 'https://tecotec.com.vn/tin-tuc/ve-tranh-1-6',
        ),
        array(
            'title' => 'TECOTEC ra mắt bộ đồng phục mới nhân dịp 30 năm',
            'slug' => 'dong-phuc-tecotec-rollout',
            'date' => '2026-07-10 09:00:00',
            'category' => 'hoat-dong-cong-ty',
            'category_label' => 'Hoạt động công ty',
            'short_description' => 'Bộ đồng phục mới tích hợp badge "30 Years", áp dụng đồng loạt trên toàn hệ thống TECOTEC từ trụ sở Hà Nội đến văn phòng TP.HCM, Đà Nẵng, Buôn Ma Thuột.',
            'tags' => array( 'A30', 'dong-phuc', 'hoat-dong-cong-ty', 'dummy' ),
            'image_label' => 'Dong phuc moi TECOTEC 30 nam',
            'external_url' => 'https://tecotec.com.vn/tin-tuc/dong-phuc-30-nam',
        ),
        array(
            'title' => 'Hội thảo khoa học: Đo lường chính xác, nền tảng phát triển bền vững',
            'slug' => 'hoi-thao-do-luong-chinh-xac',
            'date' => '2026-09-15 09:00:00',
            'category' => 'hoi-thao-dao-tao',
            'category_label' => 'Hội thảo & Đào tạo',
            'short_description' => 'Hội thảo quy tụ hơn 200 chuyên gia, đối tác và khách hàng cùng chia sẻ xu hướng và giải pháp công nghệ đo lường mới nhất.',
            'tags' => array( 'A30', 'hoi-thao', 'hoi-thao-dao-tao', 'dummy' ),
            'image_label' => 'Hoi thao do luong chinh xac TECOTEC',
            'external_url' => 'https://tecotec.com.vn/tin-tuc/hoi-thao-do-luong',
        ),
        array(
            'title' => 'Workshop nội bộ "TECOTEC R&D Day 2026" về AI và IoT trong đo lường',
            'slug' => 'workshop-noi-bo-rd-day-2026',
            'date' => '2026-10-20 09:00:00',
            'category' => 'hoi-thao-dao-tao',
            'category_label' => 'Hội thảo & Đào tạo',
            'short_description' => 'Chuỗi workshop kết nối 6 nhóm R&D của TECOTEC chia sẻ tiến độ nghiên cứu và demo các nguyên mẫu thiết bị tự phát triển.',
            'tags' => array( 'A30', 'workshop', 'R-and-D', 'hoi-thao-dao-tao', 'internal', 'dummy' ),
            'image_label' => 'TECOTEC RD Day 2026',
            'external_url' => 'https://tecotec.com.vn/tin-tuc/rd-day-2026',
        ),
        array(
            'title' => 'Trung tâm Hiệu chuẩn TECOTEC đạt chuẩn ISO/IEC 17025:2017',
            'slug' => 'trung-tam-hieu-chuan-iso-17025',
            'date' => '2026-08-25 09:00:00',
            'category' => 'thanh-tuu-giai-thuong',
            'category_label' => 'Thành tựu & Giải thưởng',
            'short_description' => 'Trung tâm Hiệu chuẩn TECOTEC chính thức được công nhận đạt chuẩn quốc tế ISO/IEC 17025:2017 cho hệ thống năng lực phòng thử nghiệm và hiệu chuẩn.',
            'tags' => array( 'A30', 'iso', 'hieu-chuan', 'thanh-tuu-giai-thuong', 'dummy' ),
            'image_label' => 'Trung tam hieu chuan ISO 17025 TECOTEC',
            'external_url' => 'https://tecotec.com.vn/tin-tuc/iso-17025',
        ),
        array(
            'title' => 'TECOTEC Group vào Top 50 Doanh nghiệp Công nghệ Việt Nam 2026',
            'slug' => 'top-50-doanh-nghiep-cong-nghe-2026',
            'date' => '2026-11-08 09:00:00',
            'category' => 'thanh-tuu-giai-thuong',
            'category_label' => 'Thành tựu & Giải thưởng',
            'short_description' => 'TECOTEC Group được vinh danh trong Top 50 Doanh nghiệp Công nghệ Việt Nam năm 2026, ghi nhận đóng góp bền bỉ vào ngành đo lường và công nghệ cao.',
            'tags' => array( 'A30', 'vinh-danh', 'thanh-tuu-giai-thuong', 'dummy' ),
            'image_label' => 'Top 50 doanh nghiep cong nghe TECOTEC 2026',
            'external_url' => 'https://tecotec.com.vn/tin-tuc/top-50-doanh-nghiep',
        ),
    );
}

function tecotec_tin_tuc_dummy_image_url( $width, $height, $label ) {
    return sprintf(
        'https://dummyimage.com/%dx%d/f4f6f8/146eb4.jpg&text=%s',
        absint( $width ),
        absint( $height ),
        rawurlencode( $label )
    );
}

function tecotec_sideload_news_image( $url, $post_id, $description ) {
    require_once ABSPATH . 'wp-admin/includes/file.php';
    require_once ABSPATH . 'wp-admin/includes/media.php';
    require_once ABSPATH . 'wp-admin/includes/image.php';

    $tmp = download_url( $url );

    if ( is_wp_error( $tmp ) ) {
        return $tmp;
    }

    $file_array = array(
        'name'     => sanitize_title( $description ) . '.jpg',
        'tmp_name' => $tmp,
    );

    $attachment_id = media_handle_sideload( $file_array, $post_id, $description );

    if ( is_wp_error( $attachment_id ) ) {
        @unlink( $tmp );
        return $attachment_id;
    }

    update_post_meta( $attachment_id, '_wp_attachment_image_alt', $description );

    return $attachment_id;
}

function tecotec_import_sample_news_posts() {
    $results = array(
        'created' => 0,
        'updated' => 0,
        'errors'  => array(),
    );

    foreach ( tecotec_get_sample_news_posts() as $post ) {
        $category = term_exists( $post['category'], 'danh_muc_tin_tuc' );

        if ( ! $category ) {
            $category = wp_insert_term( $post['category_label'], 'danh_muc_tin_tuc', array( 'slug' => $post['category'] ) );
        }

        if ( is_wp_error( $category ) ) {
            $results['errors'][] = $category->get_error_message();
            continue;
        }

        $existing = get_page_by_path( $post['slug'], OBJECT, 'tin_tuc' );
        $post_args = array(
            'post_title'    => $post['title'],
            'post_name'     => $post['slug'],
            'post_date'     => $post['date'],
            'post_status'   => 'publish',
            'post_type'     => 'tin_tuc',
            'meta_input'    => array(
                '_a30_sample_post' => '1',
                '_a30_sample_slug' => $post['slug'],
            ),
        );

        if ( $existing ) {
            $post_args['ID'] = $existing->ID;
            $post_id = wp_update_post( $post_args, true );
            $results['updated']++;
        } else {
            $post_id = wp_insert_post( $post_args, true );
            $results['created']++;
        }

        if ( is_wp_error( $post_id ) ) {
            $results['errors'][] = $post_id->get_error_message();
            continue;
        }

        global $wpdb;
        $wpdb->update( $wpdb->posts, array( 'post_status' => 'publish' ), array( 'ID' => $post_id ) );
        clean_post_cache( $post_id );

        // Set taxonomy danh_muc_tin_tuc
        wp_set_post_terms( $post_id, array( (int) $category['term_id'] ), 'danh_muc_tin_tuc', false );
        
        // Cập nhật fields cho ACF
        update_field('short_description', $post['short_description'], $post_id);
        update_field('external_url', $post['external_url'], $post_id);

        if ( ! has_post_thumbnail( $post_id ) ) {
            $attachment_id = tecotec_sideload_news_image( tecotec_tin_tuc_dummy_image_url( 1200, 630, $post['image_label'] ), $post_id, $post['image_label'] );

            if ( is_wp_error( $attachment_id ) ) {
                $results['errors'][] = $attachment_id->get_error_message();
            } else {
                set_post_thumbnail( $post_id, $attachment_id );
            }
        }
    }

    return $results;
}

if ( defined( 'WP_CLI' ) && WP_CLI ) {
    WP_CLI::add_command( 'tecotec import-news', function() {
        $results = tecotec_import_sample_news_posts();

        foreach ( $results['errors'] as $error ) {
            WP_CLI::warning( $error );
        }

        WP_CLI::success( sprintf( 'Tin tức sample imported. Created: %d. Updated: %d. Errors: %d.', $results['created'], $results['updated'], count( $results['errors'] ) ) );
    } );
}
