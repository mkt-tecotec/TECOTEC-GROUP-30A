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

        <nav class="a30-nav" aria-label="Điều hướng microsite A30">
            <a href="<?php echo esc_url(home_url('/tao-avatar-30/')); ?>" <?php echo is_page_template('template-avatar-frame.php') ? ' aria-current="page"' : ''; ?>>Tạo avatar</a>
            <a href="<?php echo esc_url(home_url('/hinh-nen-30/')); ?>" <?php echo is_page_template('template-wallpaper.php') ? ' aria-current="page"' : ''; ?>>Tải hình nền</a>
            <a href="<?php echo esc_url(home_url('/')); ?>">Trang chủ</a>
        </nav>

        <a class="a30-masthead__cta" href="<?php echo esc_url(home_url('/tao-avatar-30/')); ?>">Dùng ngay</a>
    </div>
</header>