<?php

/**
 * Main header
 * 
 * @package Pistole
 * @author  Oliver Schwarz <oliver.schwarz@gmail.com>
 */

?><!DOCTYPE html>
<!--[if lt IE 7]> <html class="no-js ie6 oldie" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta charset="<?php bloginfo('charset'); ?>">
<title><?php

    wp_title('&laquo;', true, 'right');
    bloginfo('name');
    echo ' &raquo; ';
    bloginfo('description');

?></title>
<meta name="description" content="<?php pistole_get_meta_description($post); ?>">
<meta name="author" content="">
<meta name="DC.title" content="<?php bloginfo('name'); ?>">
<meta name="viewport" content="width=device-width,initial-scale=1">
<meta name="robots" content="all, index, follow">
<link rel="author" href="/humans.txt" />
<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>">

<!-- Touch icons Android / Apple -->
<link rel="apple-touch-icon-precomposed" sizes="144x144" href="/apple-touch-icon-144x144-precomposed.png">
<link rel="apple-touch-icon-precomposed" sizes="114x114" href="/apple-touch-icon-114x114-precomposed.png">
<link rel="apple-touch-icon-precomposed" sizes="72x72" href="/apple-touch-icon-72x72-precomposed.png">
<link rel="apple-touch-icon-precomposed" href="/apple-touch-icon-precomposed.png">

<?php wp_head(); ?>

</head>
<body <?php body_class(); ?>>

<header role="banner" class="clearfix">

    <hgroup>
        <h1><a href="<?php bloginfo('url'); ?>">28pistole</a></h1>
        <h2><?php bloginfo('description'); ?></h2>
        <a href="#nav-mobile" id="mobile-menu-anchor">&#9660;</a>
    </hgroup>

</header>

<section id="toolbar" class="clearfix" style="display:none;">

    <div class="content">
        
        <div class="nav-main">
            <?php wp_nav_menu(array('theme_location' => 'primary', 'container' => 'nav')); ?>
        </div>

        <?php get_search_form(); ?>
        
    </div>

</section>
