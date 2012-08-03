<?php

/**
 * Archive page
 * 
 * Template Name: Full archive
 * 
 * @package    Wordpress
 * @subpackage Pistole
 */
get_header(); ?>

<section class="archive content">

    <h2 id="page-title">Das volle Archiv</h2>
    <ul>
<?php
    $full_archive = pistole_get_full_archive();
    foreach ($full_archive as $months): ?>
        <li>
            <h3><?php echo $months['name']; ?></h3>
            <ul>
<?php foreach ($months['posts'] as $post): ?>
                <li><a href="<?php echo $post->permalink; ?>"><?php echo $post->title; ?></a></li>
<?php endforeach; ?>
            </ul>
        </li>
<?php endforeach; ?>
    
    
    </ul>


</section>

<?php get_footer(); ?>