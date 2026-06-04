/**
 * Section Gallery JS - tecotec-group theme
 */
(function ($) {
    'use strict';

    $(document).ready(function () {
        const $gallerySection = $('.hp-gallery');
        if (!$gallerySection.length) return;

        const $tabBtns = $('.hp-gallery-tab-btn');
        const $panels = $('.hp-gallery-panel');
        const $prevBtn = $('.hp-gallery-nav-arrow.prev');
        const $nextBtn = $('.hp-gallery-nav-arrow.next');
        const $slidingLine = $('.hp-gallery-sliding-line');

        function updateSlidingLine() {
            const $activeBtn = $tabBtns.filter('.is-active');
            if (!$activeBtn.length || !$slidingLine.length) return;

            const $dot = $activeBtn.find('.tab-dot');
            const dotOffsetLeft = $dot.offset().left;
            const tabsOffsetLeft = $('.hp-gallery-tabs').offset().left;

            const positionLeft = dotOffsetLeft - tabsOffsetLeft + ($dot.outerWidth() / 2);

            $slidingLine.css({
                'left': positionLeft + 'px'
            });
        }

        // Initialize position after a short delay to ensure fonts/layout are ready
        setTimeout(updateSlidingLine, 100);
        $(window).on('resize', function () {
            updateSlidingLine();
        });

        function switchTab(targetIndex) {
            const $this = $tabBtns.filter(`[data-index="${targetIndex}"]`);
            if ($this.hasClass('is-active')) return;

            const $targetPanel = $panels.filter(`[data-index="${targetIndex}"]`);
            if (!$targetPanel.length) return;

            $tabBtns.removeClass('is-active');
            $this.addClass('is-active');

            updateSlidingLine();

            const $activePanel = $panels.filter('.is-active');

            if ($activePanel.length && typeof gsap !== 'undefined') {
                // Kill any ongoing animations on the active panel and its images
                gsap.killTweensOf($activePanel);
                gsap.killTweensOf($activePanel.find('.hp-gallery-img-wrapper'));
                
                // Fade out the current panel
                gsap.to($activePanel, {
                    opacity: 0,
                    duration: 0.3,
                    ease: "power2.inOut",
                    onComplete: function() {
                        $activePanel.removeClass('is-active').css('display', 'none');
                        // Reset properties for future
                        gsap.set($activePanel, { opacity: 1 });
                        gsap.set($activePanel.find('.hp-gallery-img-wrapper'), { opacity: 1, y: 0 });
                        
                        // Show and animate new panel
                        $targetPanel.css('display', 'block').addClass('is-active');
                        const $targetImages = $targetPanel.find('.hp-gallery-img-wrapper');
                        
                        gsap.killTweensOf($targetPanel);
                        gsap.killTweensOf($targetImages);
                        
                        gsap.fromTo($targetImages, 
                            { opacity: 0, y: 30, scale: 0.95 },
                            { opacity: 1, y: 0, scale: 1, duration: 0.6, stagger: { each: 0.08, from: "random" }, ease: "power2.out" }
                        );
                    }
                });
            } else if (typeof gsap !== 'undefined') {
                $targetPanel.css('display', 'block').addClass('is-active');
                const $targetImages = $targetPanel.find('.hp-gallery-img-wrapper');
                
                gsap.killTweensOf($targetPanel);
                gsap.killTweensOf($targetImages);
                
                gsap.fromTo($targetImages, 
                    { opacity: 0, y: 30, scale: 0.95 },
                    { opacity: 1, y: 0, scale: 1, duration: 0.6, stagger: { each: 0.08, from: "random" }, ease: "power2.out" }
                );
            } else {
                if ($activePanel.length) $activePanel.removeClass('is-active').css('display', 'none');
                $targetPanel.css('display', 'block').addClass('is-active');
            }

            // Scroll nav if needed
            const $nav = $('.hp-gallery-nav');
            const navWidth = $nav.width();
            
            // Calculate relative to the scrolling container
            const $tabItem = $this.closest('.hp-gallery-tab-item');
            const itemLeft = $tabItem.position().left; 
            
            const targetScroll = itemLeft - (navWidth / 2);
            $nav.animate({ scrollLeft: targetScroll }, 300);
        }

        $tabBtns.on('click', function (e) {
            e.preventDefault();
            switchTab($(this).data('index'));
        });

        $prevBtn.on('click', function (e) {
            e.preventDefault();
            const currentIndex = $tabBtns.filter('.is-active').data('index');
            let prevIndex = parseInt(currentIndex) - 1;
            if (prevIndex < 0) prevIndex = $tabBtns.length - 1;
            switchTab(prevIndex);
        });

        $nextBtn.on('click', function (e) {
            e.preventDefault();
            const currentIndex = $tabBtns.filter('.is-active').data('index');
            let nextIndex = parseInt(currentIndex) + 1;
            if (nextIndex >= $tabBtns.length) nextIndex = 0;
            switchTab(nextIndex);
        });

        // Initialize
        const $initialActivePanel = $panels.filter('.is-active');
        if ($initialActivePanel.length) {
            $initialActivePanel.css({ 'display': 'block', 'opacity': 1 });
            if (typeof gsap !== 'undefined') {
                const $initialImages = $initialActivePanel.find('.hp-gallery-img-wrapper');
                gsap.fromTo($initialImages, 
                    { opacity: 0, y: 30, scale: 0.95 },
                    { 
                        opacity: 1, 
                        y: 0, 
                        scale: 1,
                        duration: 0.6, 
                        stagger: { each: 0.08, from: "random" }, 
                        ease: "power2.out",
                        scrollTrigger: {
                            trigger: $gallerySection,
                            start: "top 75%"
                        }
                    }
                );
            }
        }

        // Popup Lightbox Logic
        const $popup = $('#hp-gallery-popup');
        const $popupImg = $('#hp-gallery-popup-img');
        const $popupClose = $('#hp-gallery-popup-close');
        
        $('.hp-gallery-img-wrapper').on('click', function() {
            const imgSrc = $(this).find('img').attr('src');
            $popupImg.attr('src', imgSrc);
            $popup.css('display', 'flex');
            
            // Allow display block to apply before opacity transition
            setTimeout(function() {
                $popup.addClass('is-visible');
            }, 10);
        });

        function closePopup() {
            $popup.removeClass('is-visible');
            setTimeout(function() {
                $popup.css('display', 'none');
                $popupImg.attr('src', '');
            }, 300); // Wait for transition
        }

        $popupClose.on('click', function(e) {
            e.preventDefault();
            closePopup();
        });

        // Close on clicking outside the image
        $popup.on('click', function(e) {
            if ($(e.target).is($popup) || $(e.target).is('.hp-gallery-popup-content')) {
                closePopup();
            }
        });
        
        // Close on escape key
        $(document).keyup(function(e) {
            if (e.key === "Escape") {
                closePopup();
            }
        });
    });

})(jQuery);
