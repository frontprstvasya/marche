<?php
/**
 * @file
 * Returns the HTML for a node.
 *
 * Complete documentation for this file is available online.
 * @see https://drupal.org/node/1728164
 */
?>
<article class="<?php print $classes; ?> clearfix container node-<?php print $node->nid; ?>"<?php print $attributes; ?>
<?php
// We hide the comments and links now so that we can render them later.
hide($content['comments']);
hide($content['links']);
print render($content);
?>
<?php //print render($content['links']); ?>
<!---->
<?php //print render($content['comments']); ?>

</article>
