<?php
/**
 * Template Name: Tạo khung Avatar 30 năm
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

get_header();
get_template_part( 'components/microsite/a30-header' );

?>

<main class="af-page">
    <div class="af-shell af-layout">
        <!-- Cột trái: Nội dung và công cụ -->
        <article class="af-left">
            <header class="af-hero" aria-labelledby="af-title">
                <p class="af-kicker">TECOTEC GROUP 1996–2026</p>
                <h1 id="af-title" class="af-title">Tạo avatar kỷ niệm</h1>
                <p class="af-lead">Tải ảnh, chọn kiểu khung nhận diện và xuất avatar 1080×1080 đồng bộ để dùng trên mạng xã hội hoặc hồ sơ nội bộ.</p>
            </header>

            <div class="af-tool-steps">
                <!-- Chọn khung -->
                <section class="af-step">
                    <h2 class="af-step-title">Chọn kiểu khung</h2>
                    <div class="af-frame-selector" style="display: flex; gap: 16px; margin-bottom: 24px;">
                        <label class="af-frame-option" style="cursor: pointer; border: 2px solid var(--color-primary-500, #f90); border-radius: 8px; overflow: hidden; width: 80px; height: 80px; display: block; transition: all 0.2s; flex-shrink: 0;">
                            <input type="radio" name="af_frame" value="Frame1.png" checked style="display: none;">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/frames/Frame1.png" alt="Khung 1" style="width: 100%; height: 100%; object-fit: cover;">
                        </label>
                        <label class="af-frame-option" style="cursor: pointer; border: 2px solid transparent; border-radius: 8px; overflow: hidden; width: 80px; height: 80px; display: block; transition: all 0.2s; flex-shrink: 0;">
                            <input type="radio" name="af_frame" value="Frame2.png" style="display: none;">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/frames/Frame2.png" alt="Khung 2" style="width: 100%; height: 100%; object-fit: cover;">
                        </label>
                    </div>
                </section>

                <!-- Tải ảnh -->
                <section class="af-step">
                    <h2 class="af-step-title">Tải ảnh của bạn</h2>
                    <label class="af-upload" for="af-upload-input" aria-label="Khu vực tải ảnh lên">
                        <input id="af-upload-input" class="af-upload-input" type="file" accept="image/jpeg,image/png" />
                        <div class="af-upload-icon">
                            <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                <polyline points="17 8 12 3 7 8"></polyline>
                                <line x1="12" y1="3" x2="12" y2="15"></line>
                            </svg>
                        </div>
                        <span class="af-upload-title">Chọn ảnh JPG hoặc PNG</span>
                        <span class="af-upload-meta">Kéo thả ảnh vào đây (tối đa 5MB)</span>
                    </label>
                </section>
            </div>
        </article>

        <!-- Cột phải: Xem trước và tải xuống -->
        <article class="af-right">
            <div class="af-preview-panel">
                <figure class="af-preview">
                    <canvas id="af-canvas" width="1080" height="1080" aria-label="Khung xem trước avatar"></canvas>
                </figure>
                <div id="af-controls" class="af-controls" style="display: none; padding-top: 16px; width: 100%;">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px;">
                        <label for="af-zoom" style="font-size: 14px; color: var(--color-gray-600); font-weight: 500;">Thu phóng ảnh</label>
                        <span id="af-zoom-val" style="font-size: 12px; color: var(--color-gray-500);">100%</span>
                    </div>
                    <div style="display: flex; align-items: center; gap: 12px;">
                        <button type="button" id="af-zoom-out" style="width: 32px; height: 32px; border-radius: 50%; border: 1px solid var(--color-gray-300); background: #fff; display: flex; align-items: center; justify-content: center; cursor: pointer; color: var(--color-gray-600);">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                        </button>
                        <input type="range" id="af-zoom" min="0.1" max="3" step="0.01" value="1" style="flex: 1; accent-color: var(--color-primary-500, #f90); cursor: pointer;">
                        <button type="button" id="af-zoom-in" style="width: 32px; height: 32px; border-radius: 50%; border: 1px solid var(--color-gray-300); background: #fff; display: flex; align-items: center; justify-content: center; cursor: pointer; color: var(--color-gray-600);">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                        </button>
                    </div>
                    <p style="font-size: 13px; color: var(--color-gray-500); margin-top: 12px; text-align: center;">Kéo thả trực tiếp trên ảnh để di chuyển, hoặc cuộn chuột để thu phóng.</p>
                </div>
                <div class="af-preview-actions">
                    <p id="af-status" class="af-status" aria-live="polite">Chưa có ảnh nào được tải lên.</p>
                    <div class="af-cta-row">
                        <button id="af-download" class="af-btn af-btn--primary" type="button">Tải về ảnh PNG</button>
                        <button id="af-share" class="af-btn af-btn--secondary" type="button">Chia sẻ nhanh</button>
                    </div>
                </div>
            </div>
        </article>
    </div>
</main>

<?php
get_footer();
