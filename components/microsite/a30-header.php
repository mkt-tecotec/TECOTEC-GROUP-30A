<?php
if (!defined('ABSPATH')) {
    exit;
}
?>
<header class="a30-masthead">
    <div class="a30-shell a30-masthead__inner">
        <a class="a30-brand" href="<?php echo esc_url(home_url('/')); ?>">
            <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/image/logo-TECOTEC-Group.svg'); ?>"
                alt="TECOTEC Group" />
            <img class="a30-brand__mark"
                src="<?php echo esc_url(get_template_directory_uri() . '/assets/image/logo-ky-niem-cam.webp'); ?>"
                alt="Kỷ niệm 30 năm TECOTEC Group" />
            <span class="a30-brand__meta">
                <span class="a30-brand__kicker">1996–2026</span>
                <span class="a30-brand__title">Hành trình tiếp nối</span>
            </span>
        </a>

        <button class="menu-toggle a30-menu-toggle" id="a30-menu-toggle" aria-expanded="false" aria-label="Mở menu">
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

        <nav class="a30-nav" id="a30-navigation" aria-label="Điều hướng microsite A30">
            <a href="<?php echo esc_url(home_url('/tao-avatar-30/')); ?>" <?php echo is_page_template('template-avatar-frame.php') ? ' aria-current="page"' : ''; ?>>Tạo avatar</a>
            <a href="<?php echo esc_url(home_url('/hinh-nen-30/')); ?>" <?php echo is_page_template('template-wallpaper.php') ? ' aria-current="page"' : ''; ?>>Tải hình nền</a>
            <a href="<?php echo esc_url(home_url('/')); ?>">Trang chủ</a>
        </nav>
    </div>
</header>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var menuToggle = document.getElementById('a30-menu-toggle');
        var mainNav = document.getElementById('a30-navigation');

        if (menuToggle && mainNav) {
            menuToggle.addEventListener('click', function (e) {
                e.stopPropagation();
                menuToggle.classList.toggle('is-active');
                mainNav.classList.toggle('is-active');
                menuToggle.setAttribute('aria-expanded', menuToggle.classList.contains('is-active'));
            });

            document.addEventListener('click', function (e) {
                if (!mainNav.contains(e.target) && !menuToggle.contains(e.target)) {
                    menuToggle.classList.remove('is-active');
                    mainNav.classList.remove('is-active');
                    menuToggle.setAttribute('aria-expanded', 'false');
                }
            });

            var navLinks = mainNav.querySelectorAll('a');
            navLinks.forEach(function (link) {
                link.addEventListener('click', function () {
                    menuToggle.classList.remove('is-active');
                    mainNav.classList.remove('is-active');
                    menuToggle.setAttribute('aria-expanded', 'false');
                });
            });
        }
    });
</script>