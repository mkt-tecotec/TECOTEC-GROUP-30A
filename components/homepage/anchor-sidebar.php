<?php
/**
 * Homepage Anchor Sidebar Component
 */
tecotec_enqueue_style('anchor-sidebar');
tecotec_enqueue_script('anchor-sidebar', ['jquery']);
?>

<div class="hp-anchor-sidebar">
    <div class="hp-anchor-ruler">
        <div class="hp-anchor-ticks"></div>
        <ul class="hp-anchor-list">
            <li class="hp-anchor-item active" data-target="#hp-hero" style="top: 27.16px;">
                <span class="hp-anchor-label">Hero</span>
                <span class="hp-anchor-mark"></span>
            </li>
            <li class="hp-anchor-item" data-target="#hp-overview" style="top: 96.01px;">
                <span class="hp-anchor-label">Overview</span>
                <span class="hp-anchor-mark"></span>
            </li>
            <li class="hp-anchor-item" data-target="#history" style="top: 233.71px;">
                <span class="hp-anchor-label">Time Line</span>
                <span class="hp-anchor-mark"></span>
            </li>
            <li class="hp-anchor-item" data-target="#hp-achievements" style="top: 302.57px;">
                <span class="hp-anchor-label">Thành tựu</span>
                <span class="hp-anchor-mark"></span>
            </li>
            <li class="hp-anchor-item" data-target="#hp-gallery" style="top: 371.42px;">
                <span class="hp-anchor-label">Thư viện</span>
                <span class="hp-anchor-mark"></span>
            </li>
            <li class="hp-anchor-item" data-target="#hp-news" style="top: 509.12px;">
                <span class="hp-anchor-label">Tin tức</span>
                <span class="hp-anchor-mark"></span>
            </li>
        </ul>
    </div>
</div>
