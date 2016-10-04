<?php

/**
 * Single post file
 * 
 * Shows a single post (with taxonimies, comments etc.).
 * 
 * @package    Wordpress
 * @subpackage Pistole
 */

get_header();

// get posts
if (have_posts()): ?>

<section class="article content">

<?php while (have_posts()): the_post(); ?>

<article id="<?php the_ID(); ?>" <?php post_class(); ?>>
    <h2 id="page-title"><?php the_title(); ?></h2>
    <div class="post-content">
        <?php the_content(); ?>
    </div>
    <div class="taxonomy">
        <?php the_tags('&#8594; &nbsp;', ', '); ?>
    </div>
</article>

<?php endwhile; ?>

</section>

<?php endif;

get_footer();
