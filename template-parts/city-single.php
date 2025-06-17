<?php get_header(); ?>

<div class="custom-post-content">
    <?php
    if (have_posts()) :
        while (have_posts()) : the_post(); ?>
            <h1><?php the_title(); ?></h1>
            <div class="content">
                <?php the_content(); ?>
            </div>
        <?php endwhile;
    else : ?>
        <p><?php _e('No content found.'); ?></p>
    <?php endif; ?>
</div>

<?php get_footer(); ?>
