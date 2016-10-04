<?php

/**
 * Main index file
 * 
 * This is the main index file for the Wordpress engine.
 * Later on (according to the Wordpress template routing
 * rules) this file should never be called.
 * 
 * @package Pistole
 */

get_header();

// get posts
if (have_posts()): ?>

<section class="articles content">

<?php while (have_posts()): the_post(); ?>

<article id="<?php the_ID(); ?>" <?php post_class(); ?>>
    <h2><a href="<?php the_permalink(); ?>" title="Artikel lesen: <?php the_title(); ?>"><?php the_title(); ?></a></h2>
    <time pubdate="<?php the_time('c'); ?>"><?php echo pistole_time_since(get_the_time('U'), get_the_time('j. F Y')); ?></time>
    <div class="excerpt">
        <?php the_excerpt(); ?>
    </div>
</article>

<?php endwhile; ?>

</section>

<?php pistole_content_nav(); ?>

<?php endif;

get_footer();