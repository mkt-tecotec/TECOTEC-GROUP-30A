<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>

    <?php if (!is_page_template(array('template-avatar-frame.php', 'template-wallpaper.php'))): ?>
        <header class="site-header">
            <div class="container">
                <div class="site-branding-logos">
                    <a href="https://tecotec.com.vn/" class="logo-main">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/image/logo-TECOTEC-Group-white.svg"
                            alt="TECOTEC Group">
                    </a>
                    <div class="logo-divider"></div>
                    <a href="<?php echo home_url('/'); ?>" class="logo-anniversary">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/image/logo-ky-niem-cam.webp"
                            alt="30 Years TECOTEC">
                    </a>
                </div>
                <div class="header-right">
                    <button class="menu-toggle" id="menu-toggle" aria-expanded="false">
                        <div class="hamburger-icon">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"
                                xmlns="http://www.w3.org/2000/svg">
                                <circle cx="4" cy="4" r="2.5" />
                                <circle cx="12" cy="4" r="2.5" />
                                <circle cx="20" cy="4" r="2.5" />
                                <circle cx="4" cy="12" r="2.5" />
                                <circle cx="12" cy="12" r="2.5" />
                                <circle cx="20" cy="12" r="2.5" />
                                <circle cx="4" cy="20" r="2.5" />
                                <circle cx="12" cy="20" r="2.5" />
                                <circle cx="20" cy="20" r="2.5" />
                            </svg>
                        </div>
                    </button>
                    <nav class="main-navigation" id="main-navigation">
                        <a href="<?php echo esc_url(home_url('/tin-tuc/')); ?>">TIN TỨC & SỰ KIỆN</a>
                        <a href="<?php echo esc_url(home_url('/tao-avatar-30/')); ?>">DẤU ẤN CÁ NHÂN</a>
                        <a href="<?php echo esc_url(home_url('/hinh-nen-30/')); ?>">HÌNH NỀN 30 NĂM</a>
                    </nav>
                </div>
            </div>
        </header>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                var menuToggle = document.getElementById('menu-toggle');
                var mainNav = document.getElementById('main-navigation');
                var headerRight = document.querySelector('.header-right');

                if (menuToggle && mainNav) {
                    menuToggle.addEventListener('click', function (e) {
                        e.stopPropagation();
                        menuToggle.classList.toggle('is-active');
                        mainNav.classList.toggle('is-active');
                    });

                    document.addEventListener('click', function (e) {
                        if (!mainNav.contains(e.target) && !menuToggle.contains(e.target)) {
                            menuToggle.classList.remove('is-active');
                            mainNav.classList.remove('is-active');
                        }
                    });

                    // Close menu when a link is clicked
                    var navLinks = mainNav.querySelectorAll('a');
                    navLinks.forEach(function (link) {
                        link.addEventListener('click', function () {
                            menuToggle.classList.remove('is-active');
                            mainNav.classList.remove('is-active');
                        });
                    });
                }

                if (headerRight) {
                    var updateScrollProgress = function () {
                        var scrollY = window.scrollY || window.pageYOffset;
                        var progress = Math.min(scrollY / window.innerHeight, 1);
                        headerRight.style.setProperty('--scroll-progress', progress);
                    };
                    window.addEventListener('scroll', updateScrollProgress, { passive: true });
                    updateScrollProgress(); // Initial call
                }
            });
        </script>
    <?php endif; ?>