<?php
/**
 * Template Name: Tải hình nền 30 năm
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

get_header();
get_template_part( 'components/microsite/a30-header' );

?>

<main class="wl-page">
    <section class="wl-workspace" aria-labelledby="wl-title">
        <div class="wl-shell wl-workspace-grid">
            <div class="wl-sidebar">
                <header class="wl-header">
                    <p class="wl-kicker">TECOTEC GROUP 1996–2026</p>
                    <h1 id="wl-title" class="wl-title">Tải hình nền nhận diện 30 năm</h1>
                    <p class="wl-lead">Chọn phong cách, màu sắc và tải ngay wallpaper phù hợp cho điện thoại hoặc máy tính của bạn.</p>
                </header>

                <div class="wl-options-grid">
                    <article class="wl-panel">
                        <h2 class="wl-panel-title">Chọn phong cách</h2>
                        <div class="wl-style-grid" role="radiogroup" aria-label="Chọn phong cách wallpaper">
                            <label class="wl-style-item">
                                <input type="radio" name="wl-style" value="calm" checked />
                                <span>Calm</span>
                            </label>
                            <label class="wl-style-item">
                                <input type="radio" name="wl-style" value="dynamic" />
                                <span>Dynamic</span>
                            </label>
                            <label class="wl-style-item">
                                <input type="radio" name="wl-style" value="bold" />
                                <span>Bold</span>
                            </label>
                        </div>
                    </article>

                    <article class="wl-panel">
                        <h2 class="wl-panel-title">Chọn màu sắc</h2>
                        <div class="wl-color-grid" role="radiogroup" aria-label="Chọn màu wallpaper">
                            <label class="wl-color-item">
                                <input type="radio" name="wl-color" value="blue" checked />
                                <span class="wl-swatch wl-swatch--blue"></span>
                                <span class="wl-color-name">Blue</span>
                            </label>
                            <label class="wl-color-item">
                                <input type="radio" name="wl-color" value="orange" />
                                <span class="wl-swatch wl-swatch--orange"></span>
                                <span class="wl-color-name">Orange</span>
                            </label>
                            <label class="wl-color-item">
                                <input type="radio" name="wl-color" value="light" />
                                <span class="wl-swatch wl-swatch--light"></span>
                                <span class="wl-color-name">Light</span>
                            </label>
                        </div>
                    </article>
                </div>

                <div class="wl-download-group">
                    <h2 class="wl-panel-title" style="margin-top: 2rem;">Tải về máy</h2>
                    <div class="wl-download-grid">
                        <a id="wl-download-iphone" class="wl-download-item" href="<?php echo esc_url( get_template_directory_uri() . '/assets/wallpapers/iphone.png' ); ?>" download>
                            <strong>iPhone</strong>
                            <span>1170×2532</span>
                        </a>
                        <a id="wl-download-android" class="wl-download-item" href="<?php echo esc_url( get_template_directory_uri() . '/assets/wallpapers/android.png' ); ?>" download>
                            <strong>Android</strong>
                            <span>1080×2400</span>
                        </a>
                        <a id="wl-download-desktop" class="wl-download-item" href="<?php echo esc_url( get_template_directory_uri() . '/assets/wallpapers/desktop.png' ); ?>" download>
                            <strong>Desktop</strong>
                            <span>1920×1080</span>
                        </a>
                    </div>
                </div>
            </div>

            <div class="wl-preview-area">
                <div class="wl-preview-header">
                    <div class="wl-tab-row" role="tablist" aria-label="Chọn loại thiết bị">
                        <button class="wl-tab is-active" type="button" data-device="phone" role="tab" aria-selected="true">Điện thoại</button>
                        <button class="wl-tab" type="button" data-device="desktop" role="tab" aria-selected="false">Máy tính</button>
                    </div>
                </div>
                
                <figure class="wl-preview-card">
                    <div class="wl-device wl-device--phone is-active" data-device-preview="phone">
                        <div class="wl-phone-buttons"></div>
                        <div class="wl-screen">
                            <div class="wl-notch"></div>
                            <img id="wl-preview-phone" src="<?php echo esc_url( get_template_directory_uri() . '/assets/wallpapers/iphone.png' ); ?>" alt="Xem trước wallpaper điện thoại" />
                        </div>
                    </div>
                    <div class="wl-device wl-device--desktop" data-device-preview="desktop">
                        <div class="wl-screen">
                            <img id="wl-preview-desktop" src="<?php echo esc_url( get_template_directory_uri() . '/assets/wallpapers/desktop.png' ); ?>" alt="Xem trước wallpaper máy tính" />
                        </div>
                        <div class="wl-desktop-base"></div>
                    </div>
                </figure>
            </div>
        </div>
    </section>
</main>

<?php
get_footer();
