<?php

/**
 * Tag archive
 * 
 * This is the category archive and displays all posts in a chosen category.
 * 
 * @package    Wordpress
 * @subpackage 28p
 */

get_header(); ?>

<section class="archive-full content">

    <h2 id="page-title">Tag: <?php echo single_tag_title(); ?></h2>

<?php


    $thistag = get_query_var('tag');
    $allposts = get_posts('numberposts=-1&tag=' . $thistag);
    if (count($allposts) > 0): ?>

    <ul>
<?php foreach($allposts as $post): setup_postdata($post); ?>
        <li>
            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
        </li>
<?php endforeach; ?>
    </ul>


<?php else: ?>
    
    <p>Die Kategorie hat leider noch keine Beitr&auml;ge.</p>

<?php endif; ?>
    
</section>

<?php get_footer(); ?>