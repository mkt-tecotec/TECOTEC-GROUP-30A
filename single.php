<?php 
tecotec_enqueue_style('single');
get_header(); 
?>

<main class="single-post-page">
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
        
        <article <?php post_class( 'sg-article' ); ?>>
            <!-- Header Section -->
            <header class="sg-header">
                <div class="container sg-text-wrapper">
                    <div class="sg-meta">
                        <?php
                        $categories = get_the_category();
                        if ( ! empty( $categories ) ) :
                            $primary_category = $categories[0];
                            ?>
                            <a class="sg-cat" href="<?php echo esc_url( get_category_link( $primary_category->term_id ) ); ?>">
                                <?php echo esc_html( $primary_category->name ); ?>
                            </a>
                            <span class="sg-meta-sep">•</span>
                        <?php endif; ?>
                        
                        <span class="sg-date"><?php echo esc_html( get_the_date() ); ?></span>
                        <span class="sg-meta-sep">•</span>
                        <span class="sg-author">Bởi <?php the_author(); ?></span>
                    </div>

                    <h1 class="sg-title"><?php the_title(); ?></h1>
                    
                    <?php if ( has_excerpt() ) : ?>
                        <div class="sg-excerpt">
                            <?php the_excerpt(); ?>
                        </div>
                    <?php endif; ?>
                </div>
            </header>

            <!-- Body Section -->
            <div class="sg-body">
                <div class="container sg-text-wrapper sg-content">
                    <?php if ( has_post_thumbnail() ) : ?>
                        <figure class="sg-hero-image">
                            <?php the_post_thumbnail( 'full', array( 'loading' => 'eager' ) ); ?>
                            <?php if ( get_the_post_thumbnail_caption() ) : ?>
                                <figcaption><?php the_post_thumbnail_caption(); ?></figcaption>
                            <?php endif; ?>
                        </figure>
                    <?php endif; ?>
                    
                    <?php the_content(); ?>
                </div>
            </div>
        </article>

        <!-- Related News Section -->
        <?php
        $related_args = array(
            'post_type'      => 'post',
            'posts_per_page' => 3,
            'post__not_in'   => array( get_the_ID() ),
            'category__in'   => wp_get_post_categories( get_the_ID() ),
            'orderby'        => 'date',
            'order'          => 'DESC',
        );
        $related_query = new WP_Query( $related_args );

        if ( $related_query->have_posts() ) :
        ?>
            <section class="sg-related">
                <div class="container">
                    <h2 class="sg-related-title">Bài viết liên quan</h2>
                    <div class="sg-related-grid">
                        <?php while ( $related_query->have_posts() ) : $related_query->the_post(); ?>
                            <div class="sg-card">
                                <a href="<?php the_permalink(); ?>" class="sg-card-thumb">
                                    <?php if ( has_post_thumbnail() ) : ?>
                                        <?php the_post_thumbnail( 'medium_large' ); ?>
                                    <?php else : ?>
                                        <div class="sg-card-thumb-placeholder"></div>
                                    <?php endif; ?>
                                </a>
                                <div class="sg-card-content">
                                    <?php
                                    $rel_cats = get_the_category();
                                    if ( ! empty( $rel_cats ) ) :
                                    ?>
                                        <div class="sg-card-cat"><?php echo esc_html( $rel_cats[0]->name ); ?></div>
                                    <?php endif; ?>
                                    <h3 class="sg-card-title">
                                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                    </h3>
                                    <div class="sg-card-excerpt">
                                        <?php echo wp_trim_words( get_the_excerpt(), 20, '...' ); ?>
                                    </div>
                                    <div class="sg-card-footer">
                                        <span class="sg-card-date"><?php echo get_the_date('d/m/Y'); ?></span>
                                        <a href="<?php the_permalink(); ?>" class="sg-card-btn">Chi tiết</a>
                                    </div>
                                </div>
                            </div>
                        <?php endwhile; wp_reset_postdata(); ?>
                    </div>
                </div>
            </section>
        <?php endif; ?>

    <?php endwhile; endif; ?>
</main>

<?php get_footer(); ?>
