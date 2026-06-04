<?php
/**
 * Homepage Anchor Sidebar Component
 * Programmatic vertical ruler using CSS
 */
tecotec_enqueue_style('anchor-sidebar');
tecotec_enqueue_script('anchor-sidebar', ['jquery']);
?>

<div class="hp-anchor-sidebar">
    <div class="hp-anchor-ruler">
        
        <!-- CSS-drawn ruler line & ticks -->
        <div class="hp-anchor-ticks"></div>

        <ul class="hp-anchor-list">

            <!-- Sliding indicator -->
            <li class="hp-anchor-sliding-line" aria-hidden="true"></li>

            <?php
            $milestones = [
                ['cm' => 2,  'target' => '#hp-hero', 'label' => 'Khởi đầu'],
                ['cm' => 4,  'target' => '#hp-overview', 'label' => 'Giới thiệu'],
                ['cm' => 6,  'target' => '#history', 'label' => 'Dòng thời gian'],
                ['cm' => 8,  'target' => '#hp-achievements', 'label' => 'Thành tựu'],
                ['cm' => 10, 'target' => '#hp-gallery', 'label' => 'Thư viện'],
                ['cm' => 12, 'target' => '#hp-news', 'label' => 'Tin tức'],
                ['cm' => 14, 'target' => '#hp-wallpaper', 'label' => 'Hình nền'],
                ['cm' => 16, 'target' => '#hp-avatar', 'label' => 'Avatar'],
            ];

            // 1cm = 30px
            $cm_to_px = 30;

            foreach ($milestones as $i => $milestone) {
                $tickY = $milestone['cm'] * $cm_to_px;
                $activeClass = $i === 0 ? ' active' : '';
            ?>
                <li class="hp-anchor-item<?php echo $activeClass; ?>" data-target="<?php echo $milestone['target']; ?>" style="top: <?php echo $tickY; ?>px;">
                    <span class="hp-anchor-label"><?php echo $milestone['label']; ?></span>
                    <span class="hp-anchor-mark"></span>
                </li>
            <?php } ?>

        </ul>
    </div>
</div>
