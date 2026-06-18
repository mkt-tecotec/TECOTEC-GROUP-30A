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

            <!-- ═══ LEFT: Config column ═══ -->
            <div class="wl-config-col">
                <header class="wl-hero">
                    <p class="wl-kicker">TECOTEC GROUP 1996–2026</p>
                    <h1 id="wl-title" class="wl-title">Tải hình nền nhận diện <br> 30 năm</h1>
                    <p class="wl-lead">Chọn thiết bị, chọn kích thước và tải ngay hình nền phù hợp cho điện thoại hoặc máy tính của bạn.</p>
                </header>

                <div class="wl-panel">
                    <!-- Device tabs -->
                    <div class="wl-device-tabs" role="tablist" aria-label="Nhóm thiết bị">
                        <button id="wl-tab-phone" class="wl-device-tab is-active" data-device="phone" role="tab" aria-selected="true">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="7" y="2" width="10" height="20" rx="2"/><path d="M11 18h2"/></svg>
                            Điện thoại
                        </button>
                        <button id="wl-tab-tablet" class="wl-device-tab" data-device="tablet" role="tab" aria-selected="false">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="4" y="2" width="16" height="20" rx="2"/><path d="M11 18h2"/></svg>
                            Máy tính bảng
                        </button>
                        <button id="wl-tab-desktop" class="wl-device-tab" data-device="desktop" role="tab" aria-selected="false">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="2" y="3" width="20" height="14" rx="2"/><path d="M8 21h8M12 17v4"/></svg>
                            Máy tính
                        </button>
                    </div>

                    <!-- Recommended size -->
                    <div class="wl-section-label">
                        <h2 class="wl-section-heading">Kích thước phù hợp</h2>
                        <span class="wl-section-sub" id="wl-detected-label">Đề xuất theo nhóm thiết bị</span>
                    </div>

                    <div class="wl-recommend" id="wl-recommend-card" role="button" tabindex="0" aria-label="Chọn kích thước được đề xuất">
                        <div class="wl-recommend-icon" id="wl-recommend-icon" aria-hidden="true">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="7" y="2" width="10" height="20" rx="2"/><path d="M11 18h2"/></svg>
                        </div>
                        <div class="wl-recommend-info">
                            <strong id="wl-recommend-size">1290 × 2796 px</strong>
                            <small id="wl-recommend-meta">Dọc · 19.5:9 · Điện thoại màn hình lớn</small>
                        </div>
                        <div class="wl-recommend-check" aria-hidden="true">✓</div>
                    </div>

                    <!-- Other size options -->
                    <ul class="wl-option-list" id="wl-option-list" role="listbox" aria-label="Các kích thước khác"></ul>

                    <!-- Download actions -->
                    <div class="wl-download-row">
                        <a id="wl-download-btn"
                           href="<?php echo esc_url( get_template_directory_uri() . '/assets/wallpapers/iphone.png' ); ?>"
                           download
                           class="wl-btn-primary">
                            <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
                            Tải hình nền
                        </a>
                    </div>
                    <p class="wl-microcopy">PNG chất lượng cao · Nội dung quan trọng được giữ trong vùng an toàn để hạn chế bị che bởi đồng hồ, thanh trạng thái hoặc dock.</p>
                </div>

                <!-- Timeline -->
                <div class="wl-timeline" aria-label="Mốc thời gian 30 năm">
                    <div class="wl-timeline-line" aria-hidden="true"></div>
                    <div class="wl-timeline-point">
                        <span class="wl-timeline-dot"></span>
                        <span class="wl-timeline-year">1996</span>
                    </div>
                    <div class="wl-timeline-point">
                        <span class="wl-timeline-dot"></span>
                        <span class="wl-timeline-year">2006</span>
                    </div>
                    <div class="wl-timeline-point">
                        <span class="wl-timeline-dot"></span>
                        <span class="wl-timeline-year">2016</span>
                    </div>
                    <div class="wl-timeline-point is-active">
                        <span class="wl-timeline-dot"></span>
                        <span class="wl-timeline-year">2026</span>
                    </div>
                </div>
            </div>

            <!-- ═══ RIGHT: Preview column ═══ -->
            <div class="wl-preview-col">
                <div class="wl-preview-toolbar">
                    <strong class="wl-preview-label">Xem trước</strong>
                    <span class="wl-preview-meta" id="wl-preview-meta">Điện thoại · 1290 × 2796 px</span>
                </div>

                <figure class="wl-preview-card" id="wl-preview-card" aria-label="Xem trước hình nền">
                    <!-- Phone mockup -->
                    <div class="wl-device wl-device--phone is-active" id="wl-frame-phone" data-device-preview="phone">
                        <div class="wl-phone-buttons" aria-hidden="true"></div>
                        <div class="wl-screen">
                            <div class="wl-notch" aria-hidden="true"></div>
                            <img id="wl-preview-phone"
                                 src="<?php echo esc_url( get_template_directory_uri() . '/assets/wallpapers/iphone.png' ); ?>"
                                 alt="Xem trước wallpaper điện thoại"
                                 loading="lazy" />
                        </div>
                    </div>

                    <!-- Tablet mockup -->
                    <div class="wl-device wl-device--tablet" id="wl-frame-tablet" data-device-preview="tablet">
                        <div class="wl-screen">
                            <div class="wl-notch wl-notch--tablet" aria-hidden="true"></div>
                            <img id="wl-preview-tablet"
                                 src="<?php echo esc_url( get_template_directory_uri() . '/assets/wallpapers/iphone.png' ); ?>"
                                 alt="Xem trước wallpaper máy tính bảng"
                                 loading="lazy" />
                        </div>
                    </div>

                    <!-- Desktop mockup -->
                    <div class="wl-device wl-device--desktop" id="wl-frame-desktop" data-device-preview="desktop">
                        <div class="wl-screen">
                            <img id="wl-preview-desktop"
                                 src="<?php echo esc_url( get_template_directory_uri() . '/assets/wallpapers/desktop.png' ); ?>"
                                 alt="Xem trước wallpaper máy tính"
                                 loading="lazy" />
                        </div>
                        <div class="wl-desktop-stand" aria-hidden="true">
                            <div class="wl-desktop-neck"></div>
                            <div class="wl-desktop-base"></div>
                        </div>
                    </div>
                </figure>

                <div class="wl-preview-foot">
                    <span class="wl-ratio-text" id="wl-ratio-text">Tỷ lệ 19.5:9 · dọc</span>
                </div>
            </div>

        </div>
    </section>
</main>

<script>
(function () {
    const deviceData = {
        phone: {
            label: 'Điện thoại',
            recommend: { w: 1290, h: 2796, ratio: '19.5:9', desc: 'Điện thoại màn hình lớn' },
            options: [
                { w: 1179, h: 2556, ratio: '19.5:9', desc: 'iPhone Pro tiêu chuẩn' },
                { w: 1080, h: 2400, ratio: '20:9',   desc: 'Nhiều thiết bị Android' },
                { w: 1440, h: 3200, ratio: '20:9',   desc: 'Android độ phân giải cao' },
            ],
            icon: '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="7" y="2" width="10" height="20" rx="2"/><path d="M11 18h2"/></svg>',
            downloadHref: '<?php echo esc_js( get_template_directory_uri() . '/assets/wallpapers/iphone.png' ); ?>',
        },
        tablet: {
            label: 'Máy tính bảng',
            recommend: { w: 2048, h: 2732, ratio: '4:3',   desc: 'iPad Pro dọc' },
            options: [
                { w: 1668, h: 2388, ratio: '10:7',  desc: 'Tablet 11 inch' },
                { w: 1600, h: 2560, ratio: '16:10', desc: 'Android tablet dọc' },
                { w: 2732, h: 2048, ratio: '4:3',   desc: 'Tablet ngang' },
            ],
            icon: '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="4" y="2" width="16" height="20" rx="2"/><path d="M11 18h2"/></svg>',
            downloadHref: '<?php echo esc_js( get_template_directory_uri() . '/assets/wallpapers/iphone.png' ); ?>',
        },
        desktop: {
            label: 'Máy tính',
            recommend: { w: 2560, h: 1600, ratio: '16:10', desc: 'Laptop và màn hình 16:10' },
            options: [
                { w: 1920, h: 1080, ratio: '16:9',  desc: 'Full HD phổ biến' },
                { w: 2560, h: 1440, ratio: '16:9',  desc: 'Màn hình QHD' },
                { w: 3840, h: 2160, ratio: '16:9',  desc: 'Màn hình 4K' },
                { w: 3440, h: 1440, ratio: '21:9',  desc: 'Màn hình ultrawide' },
            ],
            icon: '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="3" width="20" height="14" rx="2"/><path d="M8 21h8M12 17v4"/></svg>',
            downloadHref: '<?php echo esc_js( get_template_directory_uri() . '/assets/wallpapers/desktop.png' ); ?>',
        },
    };

    let currentDevice = 'phone';
    let selectedSize  = { ...deviceData.phone.recommend };

    const tabs          = document.querySelectorAll('.wl-device-tab');
    const optionList    = document.getElementById('wl-option-list');
    const recommendCard = document.getElementById('wl-recommend-card');
    const recommendIcon = document.getElementById('wl-recommend-icon');
    const recommendSize = document.getElementById('wl-recommend-size');
    const recommendMeta = document.getElementById('wl-recommend-meta');
    const downloadBtn   = document.getElementById('wl-download-btn');
    const previewMeta   = document.getElementById('wl-preview-meta');
    const ratioText     = document.getElementById('wl-ratio-text');

    function getOrientation(w, h) { return h >= w ? 'dọc' : 'ngang'; }

    function updateUI() {
        const d   = deviceData[currentDevice];
        const rec = d.recommend;

        // Recommend card
        recommendIcon.innerHTML = d.icon;
        recommendSize.textContent = `${rec.w} × ${rec.h} px`;
        recommendMeta.textContent = `${getOrientation(rec.w, rec.h) === 'dọc' ? 'Dọc' : 'Ngang'} · ${rec.ratio} · ${rec.desc}`;

        // Options
        optionList.innerHTML = '';
        d.options.forEach(function (opt) {
            const li = document.createElement('li');
            li.className = 'wl-size-option';
            li.setAttribute('role', 'option');
            li.setAttribute('tabindex', '0');
            li.setAttribute('aria-selected', 'false');
            li.innerHTML =
                '<span class="wl-radio" aria-hidden="true"></span>' +
                '<span class="wl-size-main"><strong>' + opt.w + ' × ' + opt.h + ' px</strong><span>' + opt.desc + '</span></span>' +
                '<span class="wl-ratio-pill">' + opt.ratio + '</span>';
            li.addEventListener('click', function () { selectSize(opt, li); });
            li.addEventListener('keydown', function (e) { if (e.key === 'Enter' || e.key === ' ') selectSize(opt, li); });
            optionList.appendChild(li);
        });

        // Reset to recommend
        selectedSize = { ...rec };
        recommendCard.classList.add('is-selected');
        downloadBtn.href = d.downloadHref;
        refreshMeta();

        // Switch visible device frame
        document.querySelectorAll('.wl-device').forEach(function (el) {
            el.classList.remove('is-active');
        });
        const frame = document.getElementById('wl-frame-' + currentDevice);
        if (frame) frame.classList.add('is-active');
    }

    function selectSize(opt, el) {
        selectedSize = { ...opt };
        document.querySelectorAll('.wl-size-option').forEach(function (x) {
            x.classList.remove('is-selected');
            x.setAttribute('aria-selected', 'false');
        });
        if (el) { el.classList.add('is-selected'); el.setAttribute('aria-selected', 'true'); }
        recommendCard.classList.remove('is-selected');
        refreshMeta();
    }

    function refreshMeta() {
        const orient = getOrientation(selectedSize.w, selectedSize.h);
        previewMeta.textContent = deviceData[currentDevice].label + ' · ' + selectedSize.w + ' × ' + selectedSize.h + ' px';
        ratioText.textContent   = 'Tỷ lệ ' + (selectedSize.ratio || '—') + ' · ' + orient;
        downloadBtn.textContent = '';   // Re‑render inside — keep icon
        downloadBtn.innerHTML =
            '<svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>' +
            'Tải ' + selectedSize.w + ' × ' + selectedSize.h;
    }

    tabs.forEach(function (tab) {
        tab.addEventListener('click', function () {
            tabs.forEach(function (t) {
                t.classList.remove('is-active');
                t.setAttribute('aria-selected', 'false');
            });
            tab.classList.add('is-active');
            tab.setAttribute('aria-selected', 'true');
            currentDevice = tab.dataset.device;
            updateUI();
        });
    });

    recommendCard.addEventListener('click', function () {
        selectedSize = { ...deviceData[currentDevice].recommend };
        document.querySelectorAll('.wl-size-option').forEach(function (x) {
            x.classList.remove('is-selected');
            x.setAttribute('aria-selected', 'false');
        });
        recommendCard.classList.add('is-selected');
        downloadBtn.href = deviceData[currentDevice].downloadHref;
        refreshMeta();
    });

    recommendCard.addEventListener('keydown', function (e) {
        if (e.key === 'Enter' || e.key === ' ') recommendCard.click();
    });

    updateUI();
})();
</script>

<?php
get_footer();
