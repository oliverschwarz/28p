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
    <time pubdate="<?php the_time('c'); ?>"><?php the_time('j. F Y'); ?></time>
    <div class="post-content">
        <?php the_content(); ?>
    </div>
    <div class="taxonomy">
        <?php the_tags('&#8594; &nbsp;', ', '); ?>
    </div>
</article>

<?php endwhile; ?>

</section>
    
<section class="navbar navbar-single clearfix">
    <nav class="nav-page content">
        <div class="nav-previous"><?php previous_post_link('%link', '&#9658;'); ?></div>
        <div class="nav-next"><?php next_post_link('%link', '&#9668;'); ?></div>
    </nav>
</section>

<?php comments_template( '', true ); ?>

<?php endif;

get_footer();
