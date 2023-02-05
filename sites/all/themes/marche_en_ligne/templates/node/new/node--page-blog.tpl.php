<?php
/**
 * Rewrite node blog.
 */
?>
<div class="container">
    <article class="<?php print $classes; ?> clearfix node-<?php print $node->nid; ?>"<?php print $attributes; ?>>

    <?php if ($title_prefix || $title_suffix || $display_submitted || $unpublished || $preview || !$page && $title): ?>
        <header>
        <?php print render($title_prefix); ?>
        <?php if (!$page && $title): ?>
            <h2<?php print $title_attributes; ?>><a href="<?php print $node_url; ?>"><?php print $title; ?></a></h2>
        <?php endif; ?>
        <?php print render($title_suffix); ?>

        </header>
    <?php endif; ?>

    <div class="p-blog">
        <div class="p-blog__article">
            <?php
                // We hide the comments and links now so that we can render them later.
                hide($content['comments']);
                hide($content['links']);
                print render($content);
            ?>
        </div>
    </div>

    </article>
</div>
