<?php

/**
 * Theme library for custom functions
 * 
 * This is the default theme library for customising Wordpress
 * from within a theme. All functions required to bring more or
 * custom functions to the Pistole theme, will go in here.
 * 
 * @package    Wordpress
 * @subpackage Pistole
 */

// Theme setup
if (!function_exists('pistole_setup')) {

    /**
     * Pistole theme setup
     * 
     * Sets the default configuration and default actions when
     * the theme setup runs.
     * 
     * @return void
     */
    function pistole_setup()
    {

        // Remove unwanted stuff
        remove_action('wp_head', 'wp_generator');
        remove_action('wp_head', 'wlwmanifest_link');
        remove_action('wp_head', 'rsd_link');
        
        // Start custom menu usage
        register_nav_menu('primary', 'Hauptnavigation');
        register_nav_menu('standards', 'Standards');

        // Apply formats to theme
        if (function_exists('add_theme_support')) {
            add_theme_support('automatic-feed-links');
            add_theme_support('post-thumbnails', array('post'));
            add_theme_support('post-formats', array('gallery'));
        }

    }
    
    // Apply setup to theme handler
    add_action('after_setup_theme', 'pistole_setup');

}

// Custom (per post) meta description
if (!function_exists('pistole_get_meta_description')) {

    /**
     * Get meta description per post
     * 
     * This function tries to receive or find any additional or
     * custom meta description in a custom variable in each post.
     * If available, it returns the description, otherwise, it
     * returns the default.
     * 
     * @param object  $post  Wordpress post object
     * @param boolean $print Echo the string directly (default: true) or return it (false) [optional]
     * 
     * @return string Meta description of a single post or default meta
     */
    function pistole_get_meta_description($post, $print = true)
    {
        $default = '28pistole ist das private Weblog von Oliver Schwarz. Oliver schreibt &uuml;ber Usability, Web design, Games und das Internetz. Manchmal Deutsch, manchmal Englisch.';
        if (!isset($post->ID) || $post->ID < 1 || !is_single()) {
            echo $default;
            return;
        }
        $meta = get_post_meta($post->ID, 'meta-description', true);
        if ($meta == '') {
            echo $default;
            return;
        }
        
        echo $meta;
        return;
    }

}

if (!function_exists('pistole_get_full_archive')) {
    function pistole_get_full_archive()
    {
        $posts = get_posts('numberposts=0');
        // printf('<pre>%s</pre>', print_r($posts, 1));

        // Re-arrange by year and month
        $full_archive = array();
        foreach ($posts as $post) {

            $yearmonth = get_date_from_gmt($post->post_date, 'Y-m');
            if (!isset($full_archive[$yearmonth])) {
                $full_archive[$yearmonth] = array('name' => date_i18n('F Y', get_date_from_gmt($post->post_date, 'U')));
            }

            // build post
            $singlepost = new stdClass();
            $singlepost->title = $post->post_title;
            $singlepost->permalink = get_permalink($post);


            $full_archive[$yearmonth]['posts'][] = $singlepost;

        }
        //printf('<pre>%s</pre>', print_r($full_archive, 1));
        return $full_archive;
    }
}

// Calculate time since
if (!function_exists('pistole_time_since')) {

    /**
     * Calculate time since and return a string
     * 
     * Calculates the time between a given UNIX timestamp
     * and the actual date and returns the result as a
     * string.
     * 
     * @param integer $timestamp Unix timestamp
     * 
     * @return A string representing the timespan
     */
    function pistole_time_since($timestamp, $orig)
    {
        if (is_int($timestamp) === false) {
            return;
        }
        
        $diff = current_time('timestamp') - $timestamp;

        if ($diff < 300) {
            $timesince = 'Gerade eben';
        } else if ($diff < 3600) {
            $minutes = (int)floor($diff/60);
            $label = ($minutes > 1) ? 'Minuten' : 'Minute';
            $timesince = sprintf('Vor %d %s', $minutes, $label);
        } else if ($diff < 3600 * 24) {
            $hours = (int)floor($diff/60/60);
            $label = ($hours > 1) ? 'Stunden' : 'Stunde';
            $timesince = sprintf('Vor %d %s', $hours, $label);
        } else if ($diff < 3600 * 24 * 20) {
            $days = (int)floor($diff/60/60/24);
            $label = ($days > 1) ? 'Tagen' : 'Tag';
            $timesince = sprintf('Vor %d %s', $days, $label);
        } else if ($diff < 3600 * 24 * 28) {
            $weeks = (int)floor($diff/60/60/24/7);
            $label = ($weeks > 1) ? 'Wochen' : 'Woche';
            $timesince = sprintf('Vor %d %s', $weeks, $label);
        } else {
            $timesince = $orig;
        }
        echo $timesince;
        
    }
    
}

/**
 * Customized image caption
 */
if (!function_exists('pistole_img_caption_shortcode')) {

    /**
     * Custom image element
     * 
     * This function overwrites the default Wordpress image
     * display in posts. This is required to a) use HTML5's
     * figure and figcaption elements and b) to target the
     * image better for responsive design. Most of the code
     * is taken from the Wordpress Codex example for adding
     * filters. 
     * 
     * @return string New image output using figure and figcaption
     * 
     * @link http://codex.wordpress.org/Function_Reference/add_filter
     */
    function pistole_img_caption_shortcode($var, $attr, $content = null)
    {

        // extract attributes
        extract(shortcode_atts(array(
            'id' => '',
            'align' => '',
            'width' => '',
            'caption' => ''
        ), $attr));

        // just show an image
        if (1 > (int)$width || empty($caption)) {
            return $val;
        }

        // output image with caption (append aria landmark)
        $capid = '';
        if ($id) {
            $id = esc_attr($id);
            $capid = 'id="figcaption_'. $id . '" ';
            $id = 'id="' . $id . '" aria-labelledby="figcaption_' . $id . '" ';
        }

        return sprintf('<figure %sclass="wp-caption %s">%s<figcaption %sclass="wp-caption-text">Abb: %s</figcaption></figure>',
            $id,
            esc_attr($align),
            do_shortcode($content),
            $capid,
            $caption
            );

    }

    /**
     * Append filter
     */
    add_filter('img_caption_shortcode', 'pistole_img_caption_shortcode', 10, 3);

} // pistole_img_caption_shortcode

// Custom page navigation
if (!function_exists('pistole_content_nav')) {

    /**
     * Content navigation / pager
     * 
     * This is mainly taken from the twentyeleven theme. Contains some
     * simple adjustments to work on mobile screens.
     * 
     * @return void
     * 
     * @todo I hate this 'global', need to find something better
     */
    function pistole_content_nav()
    {
        global $wp_query;
        $next = get_next_posts_link('&#9668;');
        $previous = get_previous_posts_link('&#9658;');
        if ($wp_query->max_num_pages > 1) {
            $output = <<<html
<!-- PAGE NAVIGATION -->
<section class="navbar clearfix">
    <nav class="nav-page content">
        <div class="nav-previous">{$previous}</div>
        <div class="nav-next">{$next}</div>
    </nav>
</section>

html;
            echo $output;
        }
    }
    
}

if (!function_exists('pistole_custom_header')) {
    
    /**
     * Custom header
     * 
     * Sets up custom header components to be hooked into
     * the wp_head() function.
     * 
     * @return void
     */
    function pistole_custom_header()
    {

        $output = '';
        
        if (!current_user_can('level_10')) {
            $output .= <<<html
<script type="text/javascript">
var _gaq = _gaq || [];
_gaq.push(['_setAccount', 'UA-XXXXXXXX-X']);
_gaq.push (['_gat._anonymizeIp']);
_gaq.push(['_trackPageview']);
(function() {
var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
})();
</script>
html;
        }
        
        echo $output;
        
    }
    
    // add custom header
    add_action('wp_head', 'pistole_custom_header');
    
}

// Theme footer libraries
if (!function_exists('pistole_custom_footer')) {

    /**
     * Pistole custom footer
     * 
     * Adds the prepared custom footer for the pistole theme. Hooks
     * into the wp_footer() function.
     * 
     * @return void
     */
    function pistole_custom_footer()
    {
        echo '<script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>' . "\n";
        echo "<script>window.jQuery || document.write('<script src=\"" . get_bloginfo('template_url') . "/assets/js/jquery-1.7.2.min.js\"><\/script>')</script>";
        echo '<script src="' . get_bloginfo('template_url') . '/assets/js/functions.js"></script>';
    }

    // Apply footer
    add_action('wp_footer', 'pistole_custom_footer');
}