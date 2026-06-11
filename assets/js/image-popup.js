(function($) {
    $(document).ready(function() {
        const $popup = $('#global-image-popup');
        const $popupImg = $('#global-image-popup-img');
        const $popupClose = $('#global-image-popup-close');
        const $prevBtn = $('#global-image-popup-prev');
        const $nextBtn = $('#global-image-popup-next');
        
        let currentGroup = [];
        let currentIndex = -1;

        if (!$popup.length) return;

        // Expose global function to open popup
        window.openGlobalImagePopup = function(imgSrc, groupImgs) {
            $popupImg.attr('src', imgSrc);
            $popup.css('display', 'flex');
            
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
            setTimeout(function() {
                $popup.css('display', 'none');
                $popupImg.attr('src', '');
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
