<?php
/**
 * Homepage News Section
 * Layout: Header + filter tabs | Featured post (left) + 3 list items (right)
 */
tecotec_enqueue_style('news');

/* ── Category definitions ─────────────────────────────── */
$news_categories = array(
    ''                    => 'Tất cả',
    'su-kien-noi-bat'     => 'Sự kiện nổi bật',
    'hoat-dong-cong-ty'   => 'Hoạt động công ty',
    'hoi-thao-dao-tao'    => 'Hội thảo & Đào tạo',
    'thanh-tuu-giai-thuong' => 'Thành tựu & Giải thưởng',
);

/* ── Active filter from query string (JS fallback-safe) ─ */
$active_cat = isset($_GET['news_cat']) ? sanitize_text_field($_GET['news_cat']) : '';

/* ── Query: 4 posts (1 featured + 3 list) ──────────────── */
$query_args = array(
    'post_type'           => 'post',
    'posts_per_page'      => 4,
    'post_status'         => 'publish',
    'ignore_sticky_posts' => true,
    'orderby'             => 'date',
    'order'               => 'DESC',
);

if ( $active_cat && array_key_exists( $active_cat, $news_categories ) ) {
    $query_args['tax_query'] = array(
        array(
            'taxonomy' => 'category',
            'field'    => 'slug',
            'terms'    => $active_cat,
        ),
    );
}

/* Helper: calendar icon SVG */
function tecotec_news_calendar_icon() {
    return '<svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>';
}

/* Helper: arrow right */
function tecotec_news_arrow_icon() {
    return '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>';
}

/* Helper: placeholder image via dummyimage */
function tecotec_news_placeholder( $w, $h, $label = 'TECOTEC+News' ) {
    return sprintf(
        'https://dummyimage.com/%dx%d/0b2c5f/fe7c03.jpg&text=%s',
        $w, $h,
        rawurlencode( $label )
    );
}
?>

<section class="hp-news" id="hp-news">
    <div class="hp-news-inner">

        <!-- ── Header ──────────────────────────────────── -->
        <div class="hp-news-header">
            <div class="hp-news-header-left">

                <h2 class="hp-news-title">CẬP NHẬT HÀNH TRÌNH 30 NĂM</h2>
                <p class="hp-news-desc">
                    Những hoạt động, sự kiện và cột mốc đáng nhớ trên hành trình
                    30 năm kiến tạo giá trị và phát triển bền vững của TECOTEC Group.
                </p>
            </div>

            <a href="<?php echo esc_url( home_url( '/tin-tuc/' ) ); ?>"
               class="hp-news-cta" aria-label="Xem tất cả tin tức">
                XEM TẤT CẢ TIN TỨC
                <span class="hp-news-cta-arrow" aria-hidden="true">›</span>
            </a>
        </div>

        <!-- ── Filter tabs ──────────────────────────────── -->
        <div class="hp-news-filters" role="tablist" aria-label="Lọc theo chuyên mục">
            <?php foreach ( $news_categories as $slug => $label ) :
                $is_active = ( $active_cat === $slug );
            ?>
                <button
                    class="hp-news-filter-btn<?php echo $is_active ? ' is-active' : ''; ?>"
                    data-cat="<?php echo esc_attr( $slug ); ?>"
                    role="tab"
                    aria-selected="<?php echo $is_active ? 'true' : 'false'; ?>"
                    type="button"
                >
                    <?php echo esc_html( $label ); ?>
                </button>
            <?php endforeach; ?>
        </div>

        <!-- ── Main grid ────────────────────────────────── -->
        <div class="hp-news-grid" id="hp-news-grid">
        <?php
        $news_query = new WP_Query( $query_args );

        if ( $news_query->have_posts() ) :
            $post_index = 0;

            while ( $news_query->have_posts() ) :
                $news_query->the_post();

                $post_id    = get_the_ID();
                $permalink  = get_permalink();
                $title      = get_the_title();
                $excerpt    = get_the_excerpt();
                $date_raw   = get_the_date( 'd.m.Y' );
                $thumb_url  = has_post_thumbnail()
                    ? get_the_post_thumbnail_url( $post_id, 'large' )
                    : tecotec_news_placeholder( 900, 520, $title );

                /* Category label */
                $cats       = get_the_category( $post_id );
                $cat_label  = ! empty( $cats ) ? $cats[0]->name : 'Tin tức';

                if ( 0 === $post_index ) :
                    /* ── FEATURED POST ─────────────────── */
        ?>
                    <article class="hp-news-featured" id="hp-news-featured">
                        <div class="hp-news-featured-img">
                            <img src="<?php echo esc_url( $thumb_url ); ?>"
                                 alt="<?php echo esc_attr( $title ); ?>"
                                 loading="eager" decoding="async">
                            <span class="hp-news-badge"><?php echo esc_html( $cat_label ); ?></span>
                        </div>

                        <div class="hp-news-featured-body">
                            <div class="hp-news-featured-date">
                                <?php echo tecotec_news_calendar_icon(); ?>
                                <?php echo esc_html( $date_raw ); ?>
                            </div>
                            <h3 class="hp-news-featured-title">
                                <a href="<?php echo esc_url( $permalink ); ?>">
                                    <?php echo esc_html( $title ); ?>
                                </a>
                            </h3>
                            <p class="hp-news-featured-excerpt"><?php echo esc_html( $excerpt ); ?></p>
                            <a href="<?php echo esc_url( $permalink ); ?>"
                               class="hp-news-read-more"
                               aria-label="Đọc thêm về <?php echo esc_attr( $title ); ?>">
                                ĐỌC THÊM <?php echo tecotec_news_arrow_icon(); ?>
                            </a>
                        </div>
                    </article>

                    <!-- Right list starts -->
                    <div class="hp-news-list" id="hp-news-list">
        <?php
                else :
                    /* ── LIST ITEMS (posts 2-4) ─────────── */
                    $list_thumb = has_post_thumbnail()
                        ? get_the_post_thumbnail_url( $post_id, 'medium' )
                        : tecotec_news_placeholder( 360, 240, $title );
        ?>
                        <a href="<?php echo esc_url( $permalink ); ?>"
                           class="hp-news-list-item"
                           aria-label="<?php echo esc_attr( $title ); ?>">

                            <div class="hp-news-list-thumb">
                                <img src="<?php echo esc_url( $list_thumb ); ?>"
                                     alt="<?php echo esc_attr( $title ); ?>"
                                     loading="lazy" decoding="async">
                                <span class="hp-news-list-badge"><?php echo esc_html( $cat_label ); ?></span>
                            </div>

                            <div class="hp-news-list-body">
                                <div class="hp-news-list-date">
                                    <?php echo tecotec_news_calendar_icon(); ?>
                                    <?php echo esc_html( $date_raw ); ?>
                                </div>
                                <h4 class="hp-news-list-title"><?php echo esc_html( $title ); ?></h4>
                                <p class="hp-news-list-excerpt"><?php echo esc_html( $excerpt ); ?></p>
                            </div>

                            <span class="hp-news-list-arrow" aria-hidden="true">→</span>
                        </a>
        <?php
                endif;

                $post_index++;
            endwhile;

            wp_reset_postdata();
        ?>
                    </div><!-- /.hp-news-list -->
        <?php
        else :
        ?>
            <p class="hp-news-empty">Hiện chưa có bài viết nào.</p>
        <?php
        endif;
        ?>
        </div><!-- /.hp-news-grid -->

    </div><!-- /.hp-news-inner -->
</section>

<script>
(function () {
    'use strict';

    var grid      = document.getElementById('hp-news-grid');
    var filterBar = document.querySelector('.hp-news-filters');
    if (!filterBar || !grid) return;

    filterBar.addEventListener('click', function (e) {
        var btn = e.target.closest('.hp-news-filter-btn');
        if (!btn) return;

        /* Update active state */
        filterBar.querySelectorAll('.hp-news-filter-btn').forEach(function (b) {
            b.classList.remove('is-active');
            b.setAttribute('aria-selected', 'false');
        });
        btn.classList.add('is-active');
        btn.setAttribute('aria-selected', 'true');

        var cat = btn.getAttribute('data-cat');

        /* Fade out → fetch → fade in */
        grid.style.opacity = '0.35';
        grid.style.pointerEvents = 'none';

        /* Build AJAX URL */
        var url = new URL(window.location.href);
        if (cat) {
            url.searchParams.set('news_cat', cat);
        } else {
            url.searchParams.delete('news_cat');
        }

        /* Replace history state (no full reload) */
        window.history.replaceState(null, '', url.toString());

        /* Reload the section via fetch */
        fetch(url.toString(), { credentials: 'same-origin' })
            .then(function (res) { return res.text(); })
            .then(function (html) {
                var parser  = new DOMParser();
                var doc     = parser.parseFromString(html, 'text/html');
                var newGrid = doc.getElementById('hp-news-grid');
                if (newGrid) {
                    grid.innerHTML    = newGrid.innerHTML;
                }
                grid.style.opacity       = '1';
                grid.style.pointerEvents = '';
            })
            .catch(function () {
                grid.style.opacity       = '1';
                grid.style.pointerEvents = '';
            });
    });
}());
</script>
