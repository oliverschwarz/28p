<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>

<div id="comments">
    <div class="content">
<?php if ( have_comments() ) : ?>
    <h3>Kommentare</h3>
    <ol class="commentlist content">
        <?php wp_list_comments(); ?>
    </ol>
<?php endif; ?>

<?php comment_form('title_reply=Mitreden&comment_notes_after='); ?>

        
    </div>
</div>
