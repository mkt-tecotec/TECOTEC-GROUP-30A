<?php
/**
 * Homepage Hero Banner Component
 */
tecotec_enqueue_style('hero', ['tecotec-main-css']);

?>
<!-- Section 1: Hero Banner -->
<section class="hp-hero" id="hp-hero">
    <div class="container hp-hero-container">
        <div class="hp-hero-visual">
            <video id="hero-video" autoplay loop muted playsinline>
                <source src="<?php echo get_template_directory_uri(); ?>/assets/video/herobanner3.mp4" type="video/mp4">
            </video>
        </div>
        <div class="hp-hero-content">
            <h1 class="hp-hero-title">
                <span class="hero-anim" style="display:inline-block; opacity:0; transform:translateY(30px);"><span class="hp-hero-highlight">30 NĂM</span></span> <br>
                <span class="hero-anim" style="display:inline-block; opacity:0; transform:translateY(30px);">CHÍNH XÁC ĐỂ TẠO NIỀM TIN</span> <br>
                <span class="hero-anim" style="display:inline-block; opacity:0; transform:translateY(30px);">TĂNG TRƯỞNG ĐỂ PHÁT TRIỂN BỀN VỮNG</span>
            </h1>
            <p class="hp-hero-desc hero-anim" style="opacity:0; transform:translateY(30px);">
                Hành trình 30 năm TECOTEC không ngừng chuẩn mực, đổi mới và phụng sự <br class="hp-hero-br">
                để đóng góp tích cực cho sự phát triển của doanh nghiệp và xã hội.
            </p>
        </div>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var heroVideo = document.getElementById('hero-video');
        if (heroVideo) {
            heroVideo.playbackRate = 0.9;
        }

        // GSAP Animation cho nội dung text
        if (typeof gsap !== 'undefined') {
            gsap.to('.hero-anim', {
                y: 0,
                opacity: 1,
                duration: 1,
                stagger: 0.2,
                ease: "power3.out",
                delay: 0.2
            });
        }
    });
</script>