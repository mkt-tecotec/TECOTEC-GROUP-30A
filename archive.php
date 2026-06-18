<?php
/**
 * The template for displaying archive pages
 */

get_header();

// Enqueue stylesheet cho trang archive
wp_enqueue_style('archive-css', get_template_directory_uri() . '/assets/css/archive.css', array(), filemtime(get_template_directory() . '/assets/css/archive.css'));
?>

<section class="archive-hero">
    <div class="archive-hero__bg">
        <div class="archive-hero__map"></div>
        <div class="archive-hero__circles archive-hero__circles--left">
            <span></span><span></span><span></span><span></span>
        </div>
        <div class="archive-hero__circles archive-hero__circles--right">
            <span></span><span></span><span></span><span></span>
        </div>
        <div class="archive-hero__circles archive-hero__circles--center">
            <span></span><span></span><span></span><span></span>
        </div>
    </div>
    <div class="archive-hero__inner">
        <h1 class="archive-hero__title">Tin tức & Sự kiện</h1>
    </div>
</section>

<div class="post-archive-page">
    <div class="post-archive-page__shell">


        <?php if (have_posts()) : ?>
            <div class="post-archive-grid">
                <?php
                while (have_posts()) :
                    the_post();
                    
                    // Lấy danh mục của bài viết (hỗ trợ taxonomy danh-muc-tin-tuc cho CPT tin-tuc hoặc category mặc định)
                    $categories = get_the_terms(get_the_ID(), 'danh-muc-tin-tuc');
                    if (!$categories || is_wp_error($categories)) {
                        $categories = get_the_category();
                    }
                    $first_category = (!empty($categories) && !is_wp_error($categories)) ? $categories[0] : null;
                    ?>
                    
                    <?php 
                    $external_url = get_field('external_url');
                    $post_link = $external_url ? esc_url($external_url) : get_permalink();
                    $target = $external_url ? ' target="_blank" rel="noopener noreferrer"' : '';
                    ?>
                    
                    <article class="post-card">
                        <a href="<?php echo $post_link; ?>"<?php echo $target; ?> class="post-card__media">
                            <?php 
                            if (has_post_thumbnail()) {
                                the_post_thumbnail('large', ['loading' => 'lazy']);
                            } else {
                                echo '<img src="' . esc_url(get_template_directory_uri() . '/assets/images/default-thumbnail.jpg') . '" alt="' . esc_attr(get_the_title()) . '" loading="lazy">';
                            }
                            ?>
                        </a>
                        
                        <div class="post-card__body">
                            <?php if ($first_category) : ?>
                                <a href="<?php echo esc_url(get_term_link($first_category)); ?>" class="post-card__category">
                                    <?php echo esc_html($first_category->name); ?>
                                </a>
                            <?php endif; ?>
                            
                            <h2 class="post-card__title">
                                <a href="<?php echo $post_link; ?>"<?php echo $target; ?>><?php the_title(); ?></a>
                            </h2>
                            
                            <div class="post-card__excerpt">
                                <?php 
                                $short_desc = get_field('short_description');
                                if ($short_desc) {
                                    echo wp_trim_words($short_desc, 25, '...');
                                } else {
                                    echo wp_trim_words(get_the_excerpt(), 25, '...');
                                }
                                ?>
                            </div>
                            
                            <div class="post-card__footer">
                                <span class="post-card__date"><?php echo get_the_date('l, d/m/Y'); ?></span>
                                <a href="<?php echo $post_link; ?>"<?php echo $target; ?> class="post-card__link">XEM THÊM</a>
                            </div>
                        </div>
                    </article>
                    
                <?php endwhile; ?>
            </div>

            <div class="post-archive-page__pagination">
                <?php
                the_posts_pagination(array(
                    'mid_size'  => 2,
                    'prev_text' => __('&laquo; Trước', 'tecotec-group'),
                    'next_text' => __('Sau &raquo;', 'tecotec-group'),
                ));
                ?>
            </div>

        <?php else : ?>
            <div class="post-archive-page__empty">
                <p><?php _e('Hiện tại chưa có bài viết nào.', 'tecotec-group'); ?></p>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php
get_footer();
