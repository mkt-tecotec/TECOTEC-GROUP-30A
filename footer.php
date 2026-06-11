<?php if ( ! is_page( array( 'tao-avatar-30', 'hinh-nen-30' ) ) ) : ?>
<?php
    if (function_exists('tecotec_enqueue_style')) {
        tecotec_enqueue_style('footer');
    }
    $icon_url = get_template_directory_uri() . '/assets/icons';
?>
<footer class="site-footer">
    <div class="footer-container">
        <!-- Col 1: Logo + giới thiệu -->
        <div class="footer-col footer-col-brand">
            <a href="<?php echo esc_url(home_url('/')); ?>" class="footer-logo">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/image/logo-TECOTEC-Group-white.svg" alt="TECOTEC GROUP">
            </a>
            <p class="footer-intro">
                Công ty Cổ phần TECOTEC Group hoạt động trong lĩnh vực công nghệ và giải pháp kỹ thuật tại Việt Nam. Trải qua 30 năm phát triển, chúng tôi cung cấp sản phẩm và dịch vụ kỹ thuật cho khách hàng trong và ngoài nước.
            </p>
            <div class="footer-copyright">
                &copy; <?php echo date('Y'); ?> TECOTEC Group. All rights reserved.
            </div>
        </div>

        <!-- Col 2: Liên kết nhanh -->
        <div class="footer-col footer-col-links">
            <h4 class="footer-title">LIÊN KẾT NHANH</h4>
            <ul class="footer-links">
                <li><a href="<?php echo esc_url( home_url( '/#hp-overview' ) ); ?>">Giới thiệu</a></li>
                <li><a href="#">Lĩnh vực hoạt động</a></li>
                <li><a href="#">Hệ thống năng lực</a></li>
                <li><a href="<?php echo esc_url( home_url( '/#history' ) ); ?>">Dấu mốc phát triển</a></li>
                <li><a href="<?php echo esc_url( home_url( '/#hp-achievements' ) ); ?>">Thành tựu</a></li>
                <li><a href="<?php echo esc_url( home_url( '/#hp-gallery' ) ); ?>">Thư viện ảnh</a></li>
                <li><a href="<?php echo esc_url( home_url( '/#hp-news' ) ); ?>">Tin tức</a></li>
                <li><a href="<?php echo esc_url( home_url( '/hinh-nen-30/' ) ); ?>">Tải hình nền</a></li>
                <li><a href="<?php echo esc_url( home_url( '/tao-avatar-30/' ) ); ?>">Tạo avatar 30 năm</a></li>
            </ul>
        </div>

        <!-- Col 3: Thông tin liên hệ -->
        <div class="footer-col footer-col-contact">
            <h4 class="footer-title">THÔNG TIN LIÊN HỆ</h4>
            <div class="footer-contact">
                <p>Tầng 2, Tòa nhà CT3A, KĐT Mễ Trì Thượng,</p>
                <p>Phường Từ Liêm, TP. Hà Nội</p>
                <p class="footer-contact-tel">Điện thoại: <a href="tel:+842435763500">+84-24-35763500</a></p>
                <p class="footer-contact-fax">Fax: +84-24-35763498</p>
                <p class="footer-contact-email">Email: <a href="mailto:hanoi@tecotec.com.vn">hanoi@tecotec.com.vn</a></p>
            </div>
        </div>

        <!-- Col 4: Social + Credit -->
        <div class="footer-col footer-col-social">
            <h4 class="footer-title">THEO DÕI CHÚNG TÔI</h4>
            <div class="footer-socials">
                <a href="https://www.facebook.com/TecotecGroupJsc" target="_blank" rel="noopener" aria-label="Facebook">
                    <img src="<?php echo $icon_url; ?>/icon-facebook.svg" alt="Facebook">
                </a>
                <a href="https://www.instagram.com/tecostore.vn/" target="_blank" rel="noopener" aria-label="Instagram">
                    <img src="<?php echo $icon_url; ?>/icon-instagram.svg" alt="Instagram">
                </a>
                <a href="https://www.youtube.com/tecostorevn" target="_blank" rel="noopener" aria-label="YouTube">
                    <img src="<?php echo $icon_url; ?>/icon-youtube.svg" alt="YouTube">
                </a>
                <a href="https://www.linkedin.com/company/tecotec-group/" target="_blank" rel="noopener" aria-label="LinkedIn">
                    <img src="<?php echo $icon_url; ?>/icon-linkedin.svg" alt="LinkedIn">
                </a>
                <a href="https://zalo.me/4313596141196632335" target="_blank" rel="noopener" aria-label="Zalo">
                    <img src="<?php echo $icon_url; ?>/icon-zalo.svg" alt="Zalo">
                </a>
                <a href="mailto:hanoi@tecotec.com.vn" aria-label="Email">
                    <img src="<?php echo $icon_url; ?>/mail-icon.svg" alt="Email">
                </a>
                <a href="tel:+842435763500" aria-label="Điện thoại">
                    <img src="<?php echo $icon_url; ?>/phone-icon.svg" alt="Điện thoại">
                </a>
            </div>
        </div>
    </div>
</footer>
<?php endif; ?>

<?php get_template_part('components/popup/image-popup'); ?>

<?php wp_footer(); ?>
</body>
</html>
