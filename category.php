<?php

/**
 * Category archive
 * 
 * This is the category archive and displays a pageable
 * overview over a chosen category.
 * 
 * @package    Wordpress
 * @subpackage 28p
 */

get_header(); ?>

<section class="archive content">
    
    
    <h2 id="site-title"><?php single_cat_title('', false); ?></h2>

    <?php if (have_posts()): while(have_posts()): ?>
    
        <?php get_template_part('content', get_post_format()); ?>
    
    <?php endwhile; else: ?>

        <p>Es gibt keine Eintr&auml;ge</p>
    
    <?php endif; ?>
    
</section>

<?php get_footer(); ?>
