<?php get_header(); ?>

<!-- Preloader -->
<div id="hp-preloader" class="hp-preloader">
    <div class="hp-preloader-wrapper">
        <div class="hp-preloader-content">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/image/logo-ky-niem-cam.webp"
                alt="TECOTEC 30 Years" class="hp-preloader-logo">
            <div class="hp-preloader-spinner"></div>
        </div>
        <div class="hp-preloader-text">
            Chào mừng kỷ niệm 30 năm thành lập TECOTEC GROUP<span
                class="hp-dots"><span>.</span><span>.</span><span>.</span></span>
        </div>
    </div>
</div>

<script>
    // Preloader Logic
    window.addEventListener('load', function () {
        var preloader = document.getElementById('hp-preloader');
        if (preloader) {
            // Thêm độ trễ 3 giây (3000ms) sau khi trang đã tải xong hoàn toàn
            setTimeout(function () {
                preloader.classList.add('is-loaded');
                setTimeout(function () {
                    preloader.style.display = 'none';
                }, 600); // Khớp với thời gian transition CSS
            }, 1000);
        }
    });
</script>

<?php get_template_part('components/homepage/hero'); ?>
<?php get_template_part('components/homepage/overview'); ?>
<?php get_template_part('components/homepage/timeline'); ?>

<!-- Section 4: Achievements -->
<?php
wp_enqueue_style('tecotec-achievements', get_template_directory_uri() . '/assets/css/achievements.css', array(), '1.0.0');
wp_enqueue_script('tecotec-achievements', get_template_directory_uri() . '/assets/js/achievements.js', array('gsap', 'gsap-scroll-trigger'), '1.0.0', true);

$achievements_data = [
    [
        'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M6 22V4a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v18Z"/><path d="M6 12H4a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h2"/><path d="M18 9h2a2 2 0 0 1 2 2v9a2 2 0 0 1-2 2h-2"/><path d="M10 6h4"/><path d="M10 10h4"/><path d="M10 14h4"/><path d="M10 18h4"/></svg>',
        'number' => '30',
        'unit' => 'NĂM',
        'inline' => false,
        'desc' => 'Hình thành và phát triển<br>(1996 &ndash; 2026)'
    ],
    [
        'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>',
        'number' => '200+',
        'unit' => 'NHÂN SỰ',
        'inline' => false,
        'desc' => 'Đội ngũ chuyên môn cao,<br>tận tâm và giàu kinh nghiệm'
    ],
    [
        'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="m11 17 2 2a1 1 0 1 0 3-3"/><path d="m14 14 2.5 2.5a1 1 0 1 0 3-3l-3.88-3.88a3 3 0 0 0-4.24 0l-.88.88a1 1 0 1 1-3-3l2.81-2.81a5.79 5.79 0 0 1 7.06-.87l.47.28a2 2 0 0 0 1.42.25L21 4"/><path d="m21 3-6.11 6.11"/><path d="m5 21 4.5-4.5a3 3 0 0 1 4.24 0"/></svg>',
        'number' => '100+',
        'unit' => 'ĐỐI TÁC',
        'inline' => false,
        'desc' => 'Thương hiệu quốc tế từ<br>Mỹ, Nhật, Đức, Pháp'
    ],
    [
        'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s-8-4.5-8-11.8A8 8 0 0 1 12 2a8 8 0 0 1 8 8.2c0 7.3-8 11.8-8 11.8z"/><circle cx="12" cy="10" r="3"/></svg>',
        'number' => '3',
        'unit' => 'MIỀN',
        'inline' => false,
        'desc' => 'Mạng lưới Bắc &ndash; Trung &ndash; Nam<br>(Hà Nội &middot; Đà Nẵng &middot; TP.HCM)'
    ],
    [
        'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22c5.523 0 10-4.477 10-10S17.523 2 12 2 2 6.477 2 12s4.477 10 10 10z"/><path d="m9 12 2 2 4-4"/></svg>',
        'number' => 'ISO',
        'unit' => '9001:2015',
        'inline' => false,
        'desc' => 'Hệ thống quản lý chất lượng<br>đạt chuẩn'
    ]
];
?>

<section class="hp-achievements" id="hp-achievements">
    <div class="container hp-achievements-container">
        <!-- Top Section -->
        <div class="hp-achievements-top">
            <div class="hp-achievements-content">
                <div class="hp-achievements-tag">THÀNH TỰU</div>
                <h2 class="hp-achievements-title">30 NĂM KIẾN TẠO GIÁ TRỊ &ndash;<br>NHIỀU DẤU ẤN TỰ HÀO</h2>
                <p class="hp-achievements-desc">
                    Trên hành trình 30 năm phát triển, TECOTEC Group không ngừng nỗ lực, đổi mới và kiến tạo những giá
                    trị bền vững cho đối tác và cộng đồng. Những thành tựu đạt được là minh chứng cho cam kết và uy tín
                    của chúng tôi.
                </p>
            </div>

            <div class="hp-achievements-visual">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/image/logo-ky-niem-cam.webp"
                    alt="30 Years Anniversary Logo" class="hp-achievements-logo">
            </div>
        </div>

        <!-- Cards Section -->
        <div class="hp-achievements-cards">
            <?php foreach ($achievements_data as $item): ?>
                <?php get_template_part('components/homepage/achievement-card', null, $item); ?>
            <?php endforeach; ?>
        </div>

        <!-- Future Commitments Section -->
        <div class="hp-commitments-section">
            <div class="hp-commitments-list">
                <!-- Item 1 -->
                <div class="hp-commitment-item">
                    <div class="hp-commitment-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="9" />
                            <circle cx="12" cy="12" r="5" />
                            <circle cx="12" cy="12" r="1" />
                            <path d="M22 2l-7 7" />
                            <path d="M22 2l-2 5-3-3z" />
                        </svg>
                    </div>
                    <div class="hp-commitment-content">
                        <h4 class="hp-commitment-title">CHẤT LƯỢNG CHUẨN MỰC</h4>
                        <p class="hp-commitment-desc">Duy trì và nâng cao chất lượng dịch vụ theo hệ thống ISO
                            9001:2015, đáp ứng tiêu chuẩn quốc tế.</p>
                    </div>
                </div>

                <div class="hp-commitment-divider"></div>

                <!-- Item 2 -->
                <div class="hp-commitment-item">
                    <div class="hp-commitment-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                            <path
                                d="M15 14c.2-1 .7-1.7 1.5-2.5 1-.9 1.5-2.2 1.5-3.5A6 6 0 0 0 6 8c0 1 .2 2.2 1.5 3.5.7.9 1.3 1.5 1.5 2.5" />
                            <path d="M9 18h6" />
                            <path d="M10 22h4" />
                            <path d="M12 2v2" />
                            <path d="M4.9 4.9l1.4 1.4" />
                            <path d="M19.1 4.9l-1.4 1.4" />
                            <path d="M2 10h2" />
                            <path d="M20 10h2" />
                        </svg>
                    </div>
                    <div class="hp-commitment-content">
                        <h4 class="hp-commitment-title">ĐỔI MỚI LIÊN TỤC</h4>
                        <p class="hp-commitment-desc">Ứng dụng công nghệ hiện đại, sáng tạo giải pháp tối ưu cho khách
                            hàng.</p>
                    </div>
                </div>

                <div class="hp-commitment-divider"></div>

                <!-- Item 3 -->
                <div class="hp-commitment-item">
                    <div class="hp-commitment-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                            <path
                                d="M19 14c1.49-1.46 3-3.21 3-5.5A5.5 5.5 0 0 0 16.5 3c-1.76 0-3 .5-4.5 2-1.5-1.5-2.74-2-4.5-2A5.5 5.5 0 0 0 2 8.5c0 2.3 1.5 4.05 3 5.5l7 7Z" />
                            <circle cx="12" cy="10" r="2.5" />
                            <path d="M16 16c0-2-2.5-3.5-4-3.5s-4 1.5-4 3.5" />
                        </svg>
                    </div>
                    <div class="hp-commitment-content">
                        <h4 class="hp-commitment-title">PHÁT TRIỂN BỀN VỮNG</h4>
                        <p class="hp-commitment-desc">Đồng hành cùng cộng đồng, đóng góp vào sự phát triển bền vững của
                            xã hội.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- People Section -->
        <div class="hp-people-section">
            <div class="hp-people-content">
                <div class="hp-people-tag">
                    <span class="hp-people-tag-line"></span>
                    CON NGƯỜI TECOTEC
                    <span class="hp-people-tag-line"></span>
                </div>
                <h3 class="hp-people-title">CON NGƯỜI LÀ NỀN TẢNG<br>CỦA MỌI THÀNH TỰU</h3>
                <p class="hp-people-desc">
                    Hơn 200 con người TECOTEC làm việc với tinh thần chính xác, trách nhiệm và khát vọng không ngừng
                    vươn lên. Chúng tôi tin rằng phát triển con người là chìa khóa để kiến tạo giá trị bền vững cho đối
                    tác và cộng đồng.
                </p>

                <div class="hp-people-stats">
                    <div class="hp-people-stat-item">
                        <div class="hp-people-stat-header">
                            <div class="hp-people-stat-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24"
                                    fill="none" stroke="#F36C00" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="9" cy="7" r="4"></circle>
                                    <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                                    <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                                </svg>
                            </div>
                            <h4 class="hp-people-stat-number">200+</h4>
                        </div>
                        <p class="hp-people-stat-label">CÁN BỘ NHÂN VIÊN</p>
                        <p class="hp-people-stat-desc">Đội ngũ chuyên môn cao và giàu kinh nghiệm</p>
                    </div>

                    <div class="hp-people-stat-item">
                        <div class="hp-people-stat-header">
                            <div class="hp-people-stat-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24"
                                    fill="none" stroke="#F36C00" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <path d="M22 10v6M2 10l10-5 10 5-10 5z"></path>
                                    <path d="M6 12v5c3 3 9 3 12 0v-5"></path>
                                </svg>
                            </div>
                            <h4 class="hp-people-stat-number">~90%</h4>
                        </div>
                        <p class="hp-people-stat-label">TRÌNH ĐỘ KỸ SƯ & CỬ NHÂN</p>
                        <p class="hp-people-stat-desc">Được đào tạo bài bản, cập nhật liên tục</p>
                    </div>

                    <div class="hp-people-stat-item">
                        <div class="hp-people-stat-header">
                            <div class="hp-people-stat-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24"
                                    fill="none" stroke="#F36C00" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="9" cy="7" r="4"></circle>
                                    <path d="M22 21v-2a4 4 0 0 0-3-3.87"></path>
                                    <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                                </svg>
                            </div>
                            <h4 class="hp-people-stat-number">4</h4>
                        </div>
                        <p class="hp-people-stat-label">LĨNH VỰC KỸ THUẬT CHUYÊN SÂU</p>
                        <p class="hp-people-stat-desc">Đo lường &middot; Hiệu chuẩn &middot; Vô tuyến&ndash;Tích hợp
                            &middot; Phân tích&ndash;Môi trường</p>
                    </div>

                    <div class="hp-people-stat-item">
                        <div class="hp-people-stat-header">
                            <div class="hp-people-stat-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24"
                                    fill="none" stroke="#F36C00" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <circle cx="12" cy="12" r="10"></circle>
                                    <line x1="2" y1="12" x2="22" y2="12"></line>
                                    <path
                                        d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z">
                                    </path>
                                </svg>
                            </div>
                            <h4 class="hp-people-stat-number">30+</h4>
                        </div>
                        <p class="hp-people-stat-label">NĂM KINH NGHIỆM LÃNH ĐẠO</p>
                        <p class="hp-people-stat-desc">Ban lãnh đạo gắn bó, dẫn dắt xuyên suốt hành trình</p>
                    </div>
                </div>
            </div>

            <div class="hp-people-visual">
                <div class="hp-people-img-top">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/image/con-nguoi.webp"
                        alt="Đội ngũ TECOTEC">
                </div>
                <div class="hp-people-img-bottom">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/image/su-kien-da-bong.webp"
                        alt="Kỹ sư TECOTEC">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/image/tat-nien-2026.webp"
                        alt="Làm việc nhóm">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/image/su-kien-goi-banh-chung.webp"
                        alt="Hiệu chuẩn">
                </div>
            </div>
        </div>


    </div>
</section>

<?php get_template_part('components/homepage/gallery'); ?>

<?php get_template_part('components/homepage/news'); ?>

<?php
// Enqueue anniversary homepage sections CSS
tecotec_enqueue_style('hp-anniversary', ['tecotec-main-css']);
?>

<!-- ════════════════════════════════════════════════════════════
     Section: Tải hình nền nhận diện 30 năm
     ════════════════════════════════════════════════════════════ -->
<section class="hp-anniv hp-wallpaper" id="hp-wallpaper" aria-labelledby="hp-wallpaper-title">
    <div class="container hp-anniv__shell">
        <div class="hp-wallpaper__grid">

            <!-- Left: Text -->
            <div class="hp-wallpaper__text">
                <p class="hp-wallpaper__eyebrow">TECOTEC GROUP 1996 – 2026</p>
                <h2 id="hp-wallpaper-title" class="hp-wallpaper__title">
                    Hình nền <span>kỷ niệm</span><br>30 năm thành lập
                </h2>
                <p class="hp-wallpaper__desc">
                    Tải bộ hình nền nhận diện thương hiệu dành riêng cho dịp 30 năm TECOTEC Group.
                    Phù hợp màn hình máy tính, điện thoại và máy tính bảng — chất lượng cao, miễn phí.
                </p>

                <div class="hp-wallpaper__sizes">
                    <span class="hp-wallpaper__size-pill">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2">
                            <rect x="2" y="3" width="20" height="14" rx="2" />
                            <path d="M8 21h8M12 17v4" />
                        </svg>
                        Desktop 1920×1080
                    </span>
                    <span class="hp-wallpaper__size-pill">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2">
                            <rect x="5" y="2" width="14" height="20" rx="2" />
                            <circle cx="12" cy="17" r="1" />
                        </svg>
                        iPhone 1170×2532
                    </span>
                    <span class="hp-wallpaper__size-pill">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2">
                            <rect x="5" y="2" width="14" height="20" rx="2" />
                            <circle cx="12" cy="17" r="1" />
                        </svg>
                        Android 1080×2400
                    </span>
                </div>

                <a href="<?php echo home_url('/hinh-nen-30-nam/'); ?>" class="hp-wallpaper__btn" id="hp-wallpaper-cta">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4" />
                        <polyline points="7 10 12 15 17 10" />
                        <line x1="12" y1="15" x2="12" y2="3" />
                    </svg>
                    Tải hình nền ngay
                </a>
            </div>

            <!-- Right: Visual mockup -->
            <div class="hp-wallpaper__visual">
                <div class="hp-wallpaper__devices">
                    <!-- Floating badge -->
                    <div class="hp-wallpaper__badge">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2">
                            <polygon
                                points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2" />
                        </svg>
                        Chất lượng 4K · Miễn phí
                    </div>

                    <!-- Desktop frame -->
                    <div class="hp-wallpaper__desktop-frame">
                        <img class="hp-wallpaper__desktop-img"
                            src="<?php echo get_template_directory_uri(); ?>/assets/image/gallery/1920x1080.png"
                            alt="Hình nền máy tính 30 năm TECOTEC Group" loading="lazy">
                    </div>

                    <!-- Phone frame -->
                    <div class="hp-wallpaper__phone-frame">
                        <img class="hp-wallpaper__phone-img"
                            src="<?php echo get_template_directory_uri(); ?>/assets/image/gallery/600x600.png"
                            alt="Hình nền điện thoại 30 năm TECOTEC Group" loading="lazy">
                    </div>
                </div>
            </div>

        </div>

    </div>
</section>

<!-- ════════════════════════════════════════════════════════════
     Section: Tạo khung ảnh Avatar kỷ niệm 30 năm
     ════════════════════════════════════════════════════════════ -->
<section class="hp-anniv hp-avatar" id="hp-avatar" aria-labelledby="hp-avatar-title">
    <div class="container hp-anniv__shell">
        <div class="hp-avatar__grid">

            <!-- Left: Visual mockup carousel -->
            <div class="hp-avatar__visual">
                <div class="hp-avatar__carousel" aria-hidden="true">

                    <!-- Top card -->
                    <div class="hp-avatar__card hp-avatar__card--top">
                        <div class="hp-avatar__card-inner">
                            <div class="hp-avatar__card-photo">
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/image/gallery/tat-nien-2026.webp"
                                    alt="" aria-hidden="true">
                            </div>
                            <img class="hp-avatar__card-logo"
                                src="<?php echo get_template_directory_uri(); ?>/assets/image/logo-ky-niem.svg" alt=""
                                aria-hidden="true">
                        </div>
                    </div>

                    <!-- Left card -->
                    <div class="hp-avatar__card hp-avatar__card--left">
                        <div class="hp-avatar__card-inner">
                            <div class="hp-avatar__card-photo">
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/image/gallery/su-kien-goi-banh-chung.webp"
                                    alt="" aria-hidden="true">
                            </div>
                            <img class="hp-avatar__card-logo"
                                src="<?php echo get_template_directory_uri(); ?>/assets/image/logo-ky-niem.svg" alt=""
                                aria-hidden="true">
                        </div>
                    </div>

                    <!-- Center card — main -->
                    <div class="hp-avatar__card hp-avatar__card--center">
                        <div class="hp-avatar__card-inner">
                            <div class="hp-avatar__card-photo">
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/image/gallery/con-nguoi.webp"
                                    alt="" aria-hidden="true">
                            </div>
                            <img class="hp-avatar__card-logo"
                                src="<?php echo get_template_directory_uri(); ?>/assets/image/logo-ky-niem.svg" alt=""
                                aria-hidden="true">
                        </div>
                    </div>

                    <!-- Right card -->
                    <div class="hp-avatar__card hp-avatar__card--right">
                        <div class="hp-avatar__card-inner">
                            <div class="hp-avatar__card-photo">
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/image/gallery/su-kien-da-bong.webp"
                                    alt="" aria-hidden="true">
                            </div>
                            <img class="hp-avatar__card-logo"
                                src="<?php echo get_template_directory_uri(); ?>/assets/image/logo-ky-niem.svg" alt=""
                                aria-hidden="true">
                        </div>
                    </div>

                    <!-- Bottom card -->
                    <div class="hp-avatar__card hp-avatar__card--bottom">
                        <div class="hp-avatar__card-inner">
                            <div class="hp-avatar__card-photo">
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/image/gallery/su-kien-goi-banh-chung.webp"
                                    alt="" aria-hidden="true">
                            </div>
                            <img class="hp-avatar__card-logo"
                                src="<?php echo get_template_directory_uri(); ?>/assets/image/logo-ky-niem.svg" alt=""
                                aria-hidden="true">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right: Text -->
            <div class="hp-avatar__content">
                <p class="hp-avatar__eyebrow">TẠO AVATAR KỶ NIỆM</p>
                <h2 id="hp-avatar-title" class="hp-avatar__title">
                    Khung ảnh đại diện<br><span>30 năm TECOTEC</span>
                </h2>
                <p class="hp-avatar__desc">
                    Cùng nhau lan tỏa tinh thần kỷ niệm — tải ảnh cá nhân, chọn khung nhận diện
                    30 năm và xuất avatar 1080×1080 để đăng lên Facebook, Zalo hoặc hồ sơ nội bộ.
                </p>

                <div class="hp-avatar__steps">
                    <div class="hp-avatar__step">
                        <span class="hp-avatar__step-num">01</span>
                        <span class="hp-avatar__step-text">Tải ảnh cá nhân (JPG hoặc PNG)</span>
                    </div>
                    <div class="hp-avatar__step">
                        <span class="hp-avatar__step-num">02</span>
                        <span class="hp-avatar__step-text">Chọn kiểu khung kỷ niệm 30 năm</span>
                    </div>
                    <div class="hp-avatar__step">
                        <span class="hp-avatar__step-num">03</span>
                        <span class="hp-avatar__step-text">Xuất & chia sẻ ngay lập tức</span>
                    </div>
                </div>

                <a href="<?php echo home_url('/tao-khung-30-nam/'); ?>" class="hp-avatar__btn" id="hp-avatar-cta">
                    Tạo avatar ngay
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"
                        stroke-linecap="round" stroke-linejoin="round">
                        <line x1="5" y1="12" x2="19" y2="12" />
                        <polyline points="12 5 19 12 12 19" />
                    </svg>
                </a>
            </div>

        </div>

        <!-- Hashtag row -->
        <div class="hp-anniv-hashtag">
            <span class="hp-anniv-hashtag__text">Hãy đăng ảnh avatar cùng hashtag:</span>
            <div class="hp-anniv-hashtag__tags">
                <a href="#" class="hp-anniv-hashtag__tag">#TECOTEC30Nam</a>
                <a href="#" class="hp-anniv-hashtag__tag">#TECOTEC1996_2026</a>
                <a href="#" class="hp-anniv-hashtag__tag">#KienTaoGiaTri</a>
                <a href="#" class="hp-anniv-hashtag__tag">#TECOTECGroup</a>
            </div>
        </div>
    </div>
</section>


<!-- Floating Anniversary Logo -->
<div class="hp-floating-logo" id="floatingLogo">
    <a href="<?php echo home_url('/'); ?>">
        <img src="<?php echo get_template_directory_uri(); ?>/assets/image/logo-ky-niem-cam.webp"
            alt="30 Years TECOTEC">
    </a>
</div>

<style>
    .hp-floating-logo {
        position: fixed;
        top: 30px;
        left: 30px;
        z-index: 999;
        width: 120px;
        opacity: 0;
        visibility: hidden;
        transform: translateY(-20px);
        transition: all 0.4s ease;
    }

    .hp-floating-logo.is-visible {
        opacity: 1;
        visibility: visible;
        transform: translateY(0);
    }

    .hp-floating-logo img {
        width: 100%;
        height: auto;
        filter: drop-shadow(0 4px 10px rgba(0, 0, 0, 0.15));
        transition: transform 0.3s ease;
    }

    .hp-floating-logo:hover img {
        transform: scale(1.05);
    }

    @media (max-width: 768px) {
        .hp-floating-logo {
            top: 20px;
            left: 20px;
            width: 90px;
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var floatingLogo = document.getElementById('floatingLogo');

        if (floatingLogo) {
            window.addEventListener('scroll', function () {
                // Hiển thị logo khi cuộn qua 100vh
                if (window.scrollY > window.innerHeight) {
                    floatingLogo.classList.add('is-visible');
                } else {
                    floatingLogo.classList.remove('is-visible');
                }
            });
        }
    });
</script>

<?php get_template_part('components/homepage/anchor-sidebar'); ?>

<?php get_footer(); ?>