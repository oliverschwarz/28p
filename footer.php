<?php

/**
 * Footer
 * 
 * @package    Pistole
 * @author     Oliver Schwarz <oliver.schwarz@gmail.com>
 */

?>

<footer>
    <ul class="content">
        <?php if (is_home()): ?>
        <li>
            <h3>28pistole</h3>
            <p>
                Dieses Blog ist das pers&ouml;nliche Weblog von Oliver Schwarz, Web-Entwickler aus der N&auml;he von K&ouml;ln, Deutschland. Es l&auml;uft auf dem grandiosen Wordpress und besitzt ein eigens daf&uuml;r gebautes Theme.
            </p>
            <p>
                Kurzweiliges poste ich &uuml;brigens auf <a href="http://twitter.com/oliverschwarz">Twitter</a>.
            </p>
        </li>
        <?php endif; ?>
        <li class="clearfix">
            <h3>Archiv</h3>
            <ul>
                <?php wp_get_archives('title_li='); ?>
            </ul>
        </li>
        <li class="clearfix">
            <h3>Blogroll</h3>
            <ul>
                <?php wp_list_bookmarks('title_li=&categorize=0'); ?>
            </ul>
        </li>
        <li class="clearfix">
            <h3>Themen</h3>
            <ul>
                <?php wp_list_categories('title_li='); ?>
            </ul>
        </li>
        <li class="clearfix">
            <h3>Tags</h3>
            <ul>
            <?php $terms = get_terms('post_tag'); foreach ($terms as $term): ?>
                <li><a href="/tags/<?php echo $term->slug; ?>"><?php echo $term->name; ?></a></li>
            <?php endforeach; ?>
            </ul>
        </li>
        <li class="clearfix">
            <h3>Standards</h3>
            <?php wp_nav_menu(array('theme_location' => 'standards', 'container' => '')); ?>
        </li>
    </ul>
</footer>

<?php wp_footer(); ?>

</body>
</html>