<?php
/**
 * Global Image Popup Component
 */
if (!defined('ABSPATH')) {
    exit;
}

?>
<!-- Global Popup / Lightbox Modal -->
<div class="global-image-popup" id="global-image-popup">
    <button class="global-image-popup-nav prev" id="global-image-popup-prev" aria-label="Previous">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M15 18l-6-6 6-6"/></svg>
    </button>
    <div class="global-image-popup-content">
        <button class="global-image-popup-close" id="global-image-popup-close" aria-label="Close">&times;</button>
        <img src="" alt="Popup Image" class="global-image-popup-img" id="global-image-popup-img">
    </div>
    <button class="global-image-popup-nav next" id="global-image-popup-next" aria-label="Next">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 18l6-6-6-6"/></svg>
    </button>
</div>
