<?php
tecotec_enqueue_style('archive');
get_header();

/* ─────────────────────────────────────────────────────────────
 * Determine which query to use.
 * - If WordPress already built a valid loop (category / tag / tax
 *   / date / author archive) → use it as-is.
 * - Otherwise (blog home page set as static page, plain /tin-tuc/,
 *   or any other context) → run a custom query for all posts.
 * ───────────────────────────────────────────────────────────── */
$paged         = max( 1, get_query_var( 'paged' ) ?: get_query_var( 'page' ) );
$use_custom_q  = false;
$archive_query = null;

if ( ! have_posts() ) {
    $use_custom_q  = true;
    $archive_query = new WP_Query( array(
        'post_type'      => 'post',
        'post_status'    => 'publish',
        'posts_per_page' => 12,
        'paged'          => $paged,
        'orderby'        => 'date',
        'order'          => 'DESC',
    ) );
}
?>

<main class="post-archive-page">
    <div class="post-archive-page__shell">
        <header class="post-archive-page__header">
            <?php if ( is_category() || is_tag() || is_tax() ) : ?>
                <h1><?php echo wp_kses_post( get_the_archive_title() ); ?></h1>
                <?php if ( get_the_archive_description() ) : ?>
                    <div class="post-archive-page__description">
                        <?php echo wp_kses_post( get_the_archive_description() ); ?>
                    </div>
                <?php endif; ?>
            <?php else : ?>
                <h1>Tin tức</h1>
                <p>Cập nhật những thông tin mới nhất về hoạt động công ty, công nghệ mới và sự kiện nổi bật trong ngành.</p>
            <?php endif; ?>
        </header>

        <?php
        /* ── Decide which loop to run ── */
        $has_posts = $use_custom_q ? $archive_query->have_posts() : have_posts();
        ?>

        <?php if ( $has_posts ) : ?>
            <div class="post-archive-grid">
                <?php while ( $use_custom_q ? $archive_query->have_posts() : have_posts() ) :
                    $use_custom_q ? $archive_query->the_post() : the_post(); ?>
                    <article <?php post_class( 'post-card' ); ?>>
                        <a class="post-card__media" href="<?php the_permalink(); ?>" aria-label="<?php echo esc_attr( get_the_title() ); ?>">
                            <?php if ( has_post_thumbnail() ) : ?>
                                <?php the_post_thumbnail( 'large', array( 'loading' => 'lazy' ) ); ?>
                            <?php else : ?>
                                <img src="https://dummyimage.com/800x500/f4f6f8/146eb4.jpg&amp;text=TECOTEC+A30" alt="TECOTEC A30" loading="lazy" />
                            <?php endif; ?>
                        </a>
                        <div class="post-card__body">
                            <?php
                            $categories = get_the_category();
                            if ( ! empty( $categories ) ) :
                                ?>
                                <a class="post-card__category" href="<?php echo esc_url( get_category_link( $categories[0]->term_id ) ); ?>">
                                    <?php echo esc_html( $categories[0]->name ); ?>
                                </a>
                            <?php endif; ?>
                            <h2 class="post-card__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                            <div class="post-card__excerpt"><?php the_excerpt(); ?></div>
                            <a href="<?php the_permalink(); ?>" class="post-card__link">Đọc tiếp</a>
                        </div>
                    </article>
                <?php endwhile;
                if ( $use_custom_q ) wp_reset_postdata();
                ?>
            </div>
        <?php else : ?>
            <p class="post-archive-page__empty">Hiện chưa có bài viết nào trong chuyên mục này.</p>
        <?php endif; ?>

        <div class="post-archive-page__pagination">
            <?php
            if ( $use_custom_q ) :
                /* Custom query pagination */
                echo paginate_links( array(
                    'base'      => str_replace( 999999999, '%#%', esc_url( get_pagenum_link( 999999999 ) ) ),
                    'format'    => '?paged=%#%',
                    'current'   => $paged,
                    'total'     => $archive_query->max_num_pages,
                    'prev_text' => 'Trước',
                    'next_text' => 'Tiếp',
                ) );
            else :
                the_posts_pagination( array(
                    'mid_size'  => 2,
                    'prev_text' => 'Trước',
                    'next_text' => 'Tiếp',
                ) );
            endif;
            ?>
        </div>
    </div>
</main>

<?php get_footer(); ?>

