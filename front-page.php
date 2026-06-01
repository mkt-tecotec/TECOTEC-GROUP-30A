<?php get_header(); ?>

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
        'number' => '30+',
        'unit' => 'NĂM',
        'inline' => true,
        'desc' => 'Hình thành và phát triển<br>(1996 &ndash; 2026)'
    ],
    [
        'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>',
        'number' => '1.000+',
        'unit' => 'NHÂN SỰ',
        'inline' => false,
        'desc' => 'Đội ngũ chuyên môn cao,<br>tận tâm và giàu kinh nghiệm'
    ],
    [
        'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M16 20V4a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"/><rect width="20" height="14" x="2" y="6" rx="2"/></svg>',
        'number' => '500+',
        'unit' => 'DỰ ÁN',
        'inline' => false,
        'desc' => 'Đã triển khai thành công<br>trên toàn quốc'
    ],
    [
        'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="m11 17 2 2a1 1 0 1 0 3-3"/><path d="m14 14 2.5 2.5a1 1 0 1 0 3-3l-3.88-3.88a3 3 0 0 0-4.24 0l-.88.88a1 1 0 1 1-3-3l2.81-2.81a5.79 5.79 0 0 1 7.06-.87l.47.28a2 2 0 0 0 1.42.25L21 4"/><path d="m21 3-6.11 6.11"/><path d="m5 21 4.5-4.5a3 3 0 0 1 4.24 0"/></svg>',
        'number' => '200+',
        'unit' => 'ĐỐI TÁC',
        'inline' => false,
        'desc' => 'Trong và ngoài nước<br>đồng hành lâu dài'
    ],
    [
        'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M12 2a14.5 14.5 0 0 0 0 20 14.5 14.5 0 0 0 0-20"/><path d="M2 12h20"/></svg>',
        'number' => '10+',
        'unit' => 'QUỐC GIA',
        'inline' => false,
        'desc' => 'Đối tác và khách hàng<br>quốc tế'
    ]
];
?>

<section class="hp-achievements">
    <div class="container hp-achievements-container">
        <!-- Top Section -->
        <div class="hp-achievements-top">
            <div class="hp-achievements-content">
                <div class="hp-achievements-tag">THÀNH TỰU</div>
                <h2 class="hp-achievements-title">30 NĂM KIẾN TẠO GIÁ TRỊ &ndash;<br>NHIỀU DẤU ẤN TỰ HÀO</h2>
                <p class="hp-achievements-desc">
                    Trên hành trình 30 năm phát triển, TECOTEC Group không ngừng nỗ lực,
                    đổi mới và kiến tạo những giá trị bền vững cho khách hàng, đối tác và cộng đồng.
                    Những thành tựu đạt được là minh chứng cho cam kết và uy tín của chúng tôi.
                </p>
            </div>

            <div class="hp-achievements-visual">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/image/logo-ky-niem.svg"
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
                        <h4 class="hp-commitment-title">CHẤT LƯỢNG HÀNG ĐẦU</h4>
                        <p class="hp-commitment-desc">Duy trì và nâng cao chất lượng dịch vụ, đáp ứng tiêu chuẩn quốc
                            tế.</p>
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
                    Hơn 1.000 con người TECOTEC làm việc với tinh thần chính xác, trách nhiệm và khát vọng không ngừng
                    vươn lên. Chúng tôi tin rằng phát triển con người là chìa khóa để kiến tạo giá trị bền vững cho
                    khách hàng và cộng đồng.
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
                            <h4 class="hp-people-stat-number">1.000+</h4>
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
                            <h4 class="hp-people-stat-number">40%+</h4>
                        </div>
                        <p class="hp-people-stat-label">KỸ SƯ &amp; CỬ NHÂN</p>
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
                            <h4 class="hp-people-stat-number">20+</h4>
                        </div>
                        <p class="hp-people-stat-label">ĐỘI NGŨ KỸ THUẬT</p>
                        <p class="hp-people-stat-desc">Chuyên sâu về đo lường, hiệu chuẩn &amp; tích hợp</p>
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
                            <h4 class="hp-people-stat-number">10+</h4>
                        </div>
                        <p class="hp-people-stat-label">QUỐC TỊCH</p>
                        <p class="hp-people-stat-desc">Đa dạng văn hóa, kết nối toàn cầu</p>
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


<!-- Floating Anniversary Logo -->
<div class="hp-floating-logo" id="floatingLogo">
    <a href="<?php echo home_url('/'); ?>">
        <img src="<?php echo get_template_directory_uri(); ?>/assets/image/logo-ky-niem.svg" alt="30 Years TECOTEC">
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

<?php get_footer(); ?>