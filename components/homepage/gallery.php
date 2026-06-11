<?php
/**
 * Component: Homepage Gallery Section - 30 Years Journey
 * Coded to match the new dark theme design (Thư viện ảnh qua các thời kỳ)
 */
tecotec_enqueue_style('gallery');
tecotec_enqueue_script('gallery', ['jquery']);

// Gallery Data Periods (Matching the new timeline)
$base_gallery_data = [
    [
        'label' => '1996–2003',
        'folder' => '1996',
        'title' => 'Thành lập & Đặt nền móng đo lường',
        'caption' => 'Khởi đầu từ Công ty TNHH TDN (1996), đặt nền móng vững chắc cho hành trình 30 năm trong lĩnh vực đo lường và hiệu chuẩn.',
    ],
    [
        'label' => '2004–2007',
        'folder' => '2000',
        'title' => 'Mở rộng thị phần & Trở thành đối tác chiến lược',
        'caption' => 'Mở rộng cung cấp thiết bị đo lường chính xác và hiệu chuẩn, trở thành đối tác chiến lược của nhiều thương hiệu thiết bị công nghệ lớn trên toàn cầu.',
    ],
    [
        'label' => '2008–2011',
        'folder' => '2005',
        'title' => 'Mở rộng quy mô & Khẳng định vị thế toàn quốc',
        'caption' => 'Thiết lập mạng lưới văn phòng đại diện ba miền, khẳng định vai trò nhà cung cấp giải pháp công nghệ kỹ thuật trên quy mô toàn quốc.',
    ],
    [
        'label' => '2012–2015',
        'folder' => '2012-2015',
        'title' => 'Nền tảng thương mại số – Tái cấu trúc – Bắt đầu R&D',
        'caption' => 'Ra mắt nền tảng thương mại số, tái cấu trúc toàn diện hệ thống vận hành và đầu tư mạnh cho nghiên cứu & phát triển, làm chủ công nghệ lõi.',
    ],
    [
        'label' => '2016–2019',
        'folder' => '2016-2019',
        'title' => 'Tái cấu trúc thành TECOTEC Group',
        'caption' => 'Kỷ niệm 20 năm thành lập. Tái cấu trúc mô hình quản trị thành TECOTEC Group, định hướng phát triển đa ngành trên nền tảng kỹ thuật và tích hợp hệ thống.',
    ],
    [
        'label' => '2020–2022',
        'folder' => '2020-2022',
        'title' => 'Chuyển đổi số toàn diện & Vượt qua thách thức',
        'caption' => 'Chuyển đổi số toàn diện và nâng cấp hạ tầng công nghệ; vượt qua thách thức đại dịch, đảm bảo chuỗi cung ứng dịch vụ kỹ thuật liên tục.',
    ],
    [
        'label' => '2023–nay',
        'folder' => '2023-nay',
        'title' => 'Kỷ niệm 30 năm phát triển bền vững',
        'caption' => 'Kỷ niệm mốc son 30 năm (1996–2026). TECOTEC Group tiếp tục đổi mới không ngừng, tự hào là đối tác công nghệ đáng tin cậy.',
    ]
];



$gallery_data = [];
$upload_dir = get_template_directory() . '/assets/image/gallery/';

foreach ($base_gallery_data as $item) {
    $folder = $item['folder'];
    $year_dir = $upload_dir . $folder;
    $images = [];

    // Check if dynamic directory exists and contains images
    if (is_dir($year_dir)) {
        // Scan for common image extensions
        $files = glob($year_dir . '/*.{jpg,jpeg,png,webp,gif,svg}', GLOB_BRACE);
        if (!empty($files)) {
            sort($files);
            foreach ($files as $file) {
                $filename = basename($file);
                $images[] = get_template_directory_uri() . '/assets/image/gallery/' . $folder . '/' . $filename;
            }
        }
    }

    // Fallback to default-image directory if no images found
    if (empty($images)) {
        $default_dir = $upload_dir . 'default-image';
        if (is_dir($default_dir)) {
            $default_files = glob($default_dir . '/*.{jpg,jpeg,png,webp,gif,svg}', GLOB_BRACE);
            if (!empty($default_files)) {
                sort($default_files);
                foreach ($default_files as $file) {
                    $images[] = get_template_directory_uri() . '/assets/image/gallery/default-image/' . basename($file);
                }
            }
        }
    }

    $gallery_data[] = [
        'label' => $item['label'],
        'title' => $item['title'],
        'caption' => $item['caption'],
        'images' => $images
    ];
}
?>

<section class="hp-gallery" id="hp-gallery">
    <div class="container">
        <!-- Section Header -->
        <div class="hp-gallery-header">
            <div class="hp-gallery-tag">
                <span class="hp-gallery-tag-line"></span>
                HÀNH TRÌNH PHÁT TRIỂN
                <span class="hp-gallery-tag-line"></span>
            </div>
            <h2 class="hp-gallery-title">THƯ VIỆN ẢNH QUA CÁC THỜI KỲ</h2>
            <p class="hp-gallery-desc">
                Cùng nhìn lại những khoảnh khắc đáng nhớ, các cột mốc lịch sử và hoạt động tiêu biểu
                đánh dấu sự trưởng thành và phát triển của đại gia đình TECOTEC Group từ 1996 đến nay.
            </p>
        </div>

        <!-- Navigation Timeline Tabs with Arrows -->
        <div class="hp-gallery-nav-wrapper">
            <button class="hp-gallery-nav-arrow prev" aria-label="Previous">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                    stroke-linecap="round" stroke-linejoin="round">
                    <path d="M15 18l-6-6 6-6" />
                </svg>
            </button>
            <div class="hp-gallery-nav">
                <div class="hp-gallery-tabs-container">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/image/ngang_milestone.svg" class="hp-gallery-ruler-svg" alt="Ruler">
                    
                    <ul class="hp-gallery-tabs">
                        <li class="hp-gallery-sliding-line" aria-hidden="true"></li>
                        <?php 
                        $percentages = [
                            '8.369%',
                            '22.245%',
                            '36.121%',
                            '50.000%',
                            '63.879%',
                            '77.755%',
                            '91.631%'
                        ];
                        foreach ($gallery_data as $index => $item): 
                            $top_pct = 0; // Align to the top of the SVG milestones
                        ?>
                            <li class="hp-gallery-tab-item" style="left: <?php echo $percentages[$index]; ?>; top: <?php echo $top_pct; ?>%;">
                                <button class="hp-gallery-tab-btn <?php echo $index === 0 ? 'is-active' : ''; ?>"
                                    data-index="<?php echo $index; ?>">
                                    <span class="tab-year"><?php echo esc_html($item['label']); ?></span>
                                    <span class="tab-dot"></span>
                                </button>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
            <button class="hp-gallery-nav-arrow next" aria-label="Next">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                    stroke-linecap="round" stroke-linejoin="round">
                    <path d="M9 18l6-6-6-6" />
                </svg>
            </button>
        </div>

        <!-- Panels Container -->
        <div class="hp-gallery-panels">
            <?php foreach ($gallery_data as $index => $item): ?>
                <div class="hp-gallery-panel <?php echo $index === 0 ? 'is-active' : ''; ?>"
                    data-index="<?php echo $index; ?>"
                    style="<?php echo $index === 0 ? 'display: block;' : 'display: none;'; ?>">

                    <div class="hp-gallery-panel-inner">
                        <!-- Gallery Images (Masonry) -->

                        <div class="hp-gallery-grid">
                            <?php foreach ($item['images'] as $i => $img_src): ?>
                                <div class="hp-gallery-img-wrapper img-<?php echo $i + 1; ?>">
                                    <img src="<?php echo esc_url($img_src); ?>"
                                        alt="TECOTEC Group <?php echo esc_attr($item['label']); ?> - Ảnh <?php echo $i + 1; ?>"
                                        loading="lazy">
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>

                </div>
            <?php endforeach; ?>
        </div>

    </div>
</section>