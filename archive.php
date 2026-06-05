<?php 
tecotec_enqueue_style('archive');
get_header(); 
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

        <?php if ( have_posts() ) : ?>
            <div class="post-archive-grid">
                <?php while ( have_posts() ) : the_post(); ?>
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
                <?php endwhile; ?>
            </div>
        <?php else : ?>
            <p class="post-archive-page__empty">Hiện chưa có bài viết nào trong chuyên mục này.</p>
        <?php endif; ?>

        <div class="post-archive-page__pagination">
            <?php
            the_posts_pagination( array(
                'mid_size'  => 2,
                'prev_text' => 'Trước',
                'next_text' => 'Tiếp',
            ) );
            ?>
        </div>
    </div>
</main>

<?php get_footer(); ?>
