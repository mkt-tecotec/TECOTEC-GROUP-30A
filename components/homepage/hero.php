<?php
/**
 * Homepage Hero Banner Component
 */
tecotec_enqueue_style('hero', ['tecotec-main-css']);

// Enqueue particle effect script
add_action('wp_footer', function () {
    echo '<script src="' . get_template_directory_uri() . '/assets/js/hero-particle.js?v=' . time() . '"></script>';
}, 20);

?>
<!-- Section 1: Hero Banner -->
<section class="hp-hero" id="hp-hero">
    <div class="hp-hero-inner">
        <!-- Logo SVG -->
        <div class="hp-hero-visual">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/image/hero.svg" alt="30 Years TECOTEC 1996-2026" class="hp-hero-logo" crossorigin="anonymous">
        </div>

        <!-- Text content -->
        <div class="hp-hero-content">
            <div class="hp-hero-eyebrow hero-anim" style="opacity:0; transform:translateY(30px); font-weight: 600; letter-spacing: 2px; margin-bottom: 15px; color: var(--tc-primary-main);">MEASURING EVERYTHING — 30 YEARS</div>
            <h1 class="hp-hero-title">
                <span class="hero-anim" style="display:inline-block; opacity:0; transform:translateY(30px);"><span
                        class="hp-hero-highlight">30 NĂM</span></span> <br>
                <span class="hero-anim" style="display:inline-block; opacity:0; transform:translateY(30px);">CHÍNH XÁC
                    ĐỂ KIẾN TẠO NIỀM TIN</span> <br>
                <span class="hero-anim" style="display:inline-block; opacity:0; transform:translateY(30px);">TĂNG TRƯỞNG
                    ĐỂ PHÁT TRIỂN BỀN VỮNG</span>
            </h1>
            <p class="hp-hero-desc hero-anim" style="opacity:0; transform:translateY(30px);">
                Hành trình 30 năm TECOTEC Group không ngừng chuẩn mực, đổi mới và phụng sự — đóng góp tích cực cho sự phát triển của doanh nghiệp và xã hội.
            </p>

        </div>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // GSAP Animation cho nội dung text
        if (typeof gsap !== 'undefined') {
            gsap.to('.hero-anim', {
                y: 0,
                opacity: 1,
                duration: 1,
                stagger: 0.2,
                ease: "power3.out",
                delay: 0.3
            });
        }
    });
</script>