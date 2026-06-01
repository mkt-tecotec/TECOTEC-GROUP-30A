<?php if ( ! is_page( array( 'tao-avatar-30', 'hinh-nen-30' ) ) ) : ?>
<?php 
    // Enqueue the footer CSS
    if (function_exists('tecotec_enqueue_style')) {
        tecotec_enqueue_style('footer');
    }
?>
<footer class="site-footer">
    <div class="footer-container">
        <div class="footer-col footer-col-logo">
            <a href="<?php echo esc_url(home_url('/')); ?>" class="footer-logo">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/image/logo-TECOTEC-Group-white.svg" alt="TECOTEC GROUP">
            </a>
            <div class="footer-copyright">
                &copy; <?php echo date('Y'); ?> TECOTEC Group. All rights reserved.
            </div>
        </div>

        <div class="footer-col">
            <h4 class="footer-title">VỀ CHÚNG TÔI</h4>
            <ul class="footer-links">
                <li><a href="#">Giới thiệu</a></li>
                <li><a href="#">Lĩnh vực hoạt động</a></li>
                <li><a href="#">Hệ thống năng lực</a></li>
                <li><a href="#">Tin tức</a></li>
            </ul>
        </div>

        <div class="footer-col">
            <h4 class="footer-title">HÀNH TRÌNH 30 NĂM</h4>
            <ul class="footer-links">
                <li><a href="#">Dấu mốc phát triển</a></li>
                <li><a href="#">Thành tựu</a></li>
                <li><a href="#">Con người TECOTEC</a></li>
                <li><a href="#">Giá trị cốt lõi</a></li>
            </ul>
        </div>

        <div class="footer-col">
            <h4 class="footer-title">THÔNG TIN LIÊN HỆ</h4>
            <div class="footer-contact">
                <p>Tòa nhà TECOTEC</p>
                <p>Lô A2-CN, Cụm CN Từ Liêm,</p>
                <p>P. Phương Canh, Q. Nam Từ Liêm,</p>
                <p>Hà Nội, Việt Nam</p>
                <p>(+84) 24 3756 1027</p>
                <p>info@tecotec.vn</p>
            </div>
        </div>

        <div class="footer-col">
            <h4 class="footer-title">THEO DÕI CHÚNG TÔI</h4>
            <div class="footer-socials">
                <a href="#" target="_blank" aria-label="Zalo">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/icons/icon-zalo.svg" alt="Zalo">
                </a>
                <a href="#" target="_blank" aria-label="Mail">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/icons/mail-icon.svg" alt="Mail">
                </a>
                <a href="#" target="_blank" aria-label="Messenger">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/icons/messenger-icon.svg" alt="Messenger">
                </a>
                <a href="#" target="_blank" aria-label="Phone">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/icons/phone-icon.svg" alt="Phone">
                </a>
            </div>
        </div>
    </div>
</footer>
<?php endif; ?>

<?php wp_footer(); ?>
</body>
</html>
