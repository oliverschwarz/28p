<?php

/**
 * Archive page
 * 
 * @package    Wordpress
 * @subpackage Pistole
 */
get_header(); ?>

<section class="archive-full content">

<?php

if (is_month()):
    $args = sprintf('numberposts=-1&year=%d&monthnum=%d',
        get_query_var('year'),
        get_query_var('monthnum'));
    $title_part = get_the_date('F Y');
    $posts = get_posts($args);
elseif(is_year()):
    $args = sprintf('numberposts=-1&year=%d',
        get_query_var('year'));
    $title_part = get_the_date('Y');
    $posts = get_posts($args);
endif; ?>
    <h2 id="page-title">Archiv <?php echo $title_part; ?></h2>

<?php if (count($posts) > 0): ?>

    <ul>
<?php foreach($posts as $post): setup_postdata($post); ?>
        <li>
            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
        </li>
<?php endforeach; ?>
    </ul>
<?php else: ?>
    <p>Keine Beitr&auml;ge gefunden.</p>
<?php endif; ?>
    
</section>

<?php get_footer(); ?>