(function($) {
    $(document).ready(function() {
        const $popup = $('#global-image-popup');
        const $popupImg = $('#global-image-popup-img');
        const $popupClose = $('#global-image-popup-close');
        const $prevBtn = $('#global-image-popup-prev');
        const $nextBtn = $('#global-image-popup-next');
        
        let currentGroup = [];
        let currentIndex = -1;
        let currentZoom = 1;
        const ZOOM_SPEED = 0.1;
        let isDragging = false;
        let startX = 0, startY = 0;
        let currentX = 0, currentY = 0;

        if (!$popup.length) return;

        function resetZoom() {
            currentZoom = 1;
            currentX = 0;
            currentY = 0;
            $popupImg.css({
                'transform': 'translate(0px, 0px) scale(1)',
                'transition': 'none',
                'cursor': 'default'
            });
        }

        // Expose global function to open popup
        window.openGlobalImagePopup = function(imgSrc, groupImgs) {
            resetZoom();
            $popupImg.attr('src', imgSrc);
            $popup.css('display', 'flex');
            $('body').css('overflow', 'hidden');
            
            if (groupImgs && groupImgs.length > 1) {
                currentGroup = groupImgs;
                // Try to find exact match
                currentIndex = currentGroup.findIndex(img => $(img).attr('src') === imgSrc);
                if (currentIndex === -1) currentIndex = 0; // fallback
                $prevBtn.show();
                $nextBtn.show();
            } else {
                currentGroup = [];
                currentIndex = -1;
                $prevBtn.hide();
                $nextBtn.hide();
            }
            
            // Allow display block to apply before opacity transition
            setTimeout(function() {
                $popup.addClass('is-visible');
            }, 10);
        };

        function closePopup() {
            $popup.removeClass('is-visible');
            $('body').css('overflow', '');
            setTimeout(function() {
                $popup.css('display', 'none');
                $popupImg.attr('src', '');
                resetZoom();
            }, 300); // Wait for transition
        }
        
        function navigatePopup(direction) {
            if (currentGroup.length <= 1) return;
            
            currentIndex += direction;
            if (currentIndex >= currentGroup.length) currentIndex = 0;
            if (currentIndex < 0) currentIndex = currentGroup.length - 1;
            
            const nextSrc = $(currentGroup[currentIndex]).attr('src');
            
            // Optional: simple fade effect
            $popupImg.css('opacity', '0.5');
            setTimeout(() => {
                resetZoom();
                $popupImg.attr('src', nextSrc);
                $popupImg.css('opacity', '1');
            }, 100);
        }

        $popupClose.on('click', closePopup);
        
        $popup.on('click', function(e) {
            if (e.target === this || e.target === document.querySelector('.global-image-popup-content')) {
                closePopup();
            }
        });
        
        $prevBtn.on('click', function(e) {
            e.stopPropagation();
            navigatePopup(-1);
        });
        
        $nextBtn.on('click', function(e) {
            e.stopPropagation();
            navigatePopup(1);
        });
        
        $(document).on('keyup', function(e) {
            if ($popup.hasClass('is-visible')) {
                if (e.key === "Escape") {
                    closePopup();
                } else if (e.key === "ArrowLeft") {
                    navigatePopup(-1);
                } else if (e.key === "ArrowRight") {
                    navigatePopup(1);
                }
            }
        });

        $popupImg.on('wheel', function(e) {
            e.preventDefault();
            
            if (e.originalEvent.deltaY < 0) {
                // Scroll up -> Zoom in
                currentZoom += ZOOM_SPEED;
            } else {
                // Scroll down -> Zoom out
                currentZoom -= ZOOM_SPEED;
            }
            
            // Limit zoom scale
            if (currentZoom > 5) currentZoom = 5;
            if (currentZoom < 0.2) currentZoom = 0.2;
            
            // Fix floating point issues
            currentZoom = Math.round(currentZoom * 10) / 10;

            // Reset position if zoomed out
            if (currentZoom <= 1) {
                currentX = 0;
                currentY = 0;
            }
            
            $popupImg.css({
                'transform': `translate(${currentX}px, ${currentY}px) scale(${currentZoom})`,
                'transition': 'transform 0.1s ease',
                'cursor': currentZoom > 1 ? 'grab' : 'default'
            });
        });

        $popupImg.on('mousedown', function(e) {
            if (currentZoom > 1) {
                e.preventDefault();
                isDragging = true;
                startX = e.clientX - currentX;
                startY = e.clientY - currentY;
                $popupImg.css({
                    'cursor': 'grabbing',
                    'transition': 'none'
                });
            }
        });

        $(window).on('mousemove', function(e) {
            if (!isDragging) return;
            e.preventDefault();
            currentX = e.clientX - startX;
            currentY = e.clientY - startY;
            
            $popupImg.css({
                'transform': `translate(${currentX}px, ${currentY}px) scale(${currentZoom})`
            });
        });

        $(window).on('mouseup', function() {
            if (isDragging) {
                isDragging = false;
                $popupImg.css({
                    'cursor': 'grab',
                    'transition': 'transform 0.1s ease'
                });
            }
        });
        
        // Listeners for triggers
        // 1. Gallery
        $(document).on('click', '.hp-gallery-img-wrapper', function() {
            const $img = $(this).find('img');
            const imgSrc = $img.attr('src');
            // Find all images in the same panel
            const $panel = $(this).closest('.hp-gallery-panel');
            const groupImgs = $panel.find('.hp-gallery-img-wrapper img').toArray();
            
            if(imgSrc) window.openGlobalImagePopup(imgSrc, groupImgs);
        });

        // 2. Timeline
        $(document).on('click', '.year-image img', function() {
            const imgSrc = $(this).attr('src');
            const groupImgs = $('.timeline-images .year-image img').toArray();
            if(imgSrc) window.openGlobalImagePopup(imgSrc, groupImgs);
        });
    });
})(jQuery);
