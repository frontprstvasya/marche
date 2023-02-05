<?php
/**
 * Rewrite block Easy breadcrumb.
 *
 * Adding class container.
 */
?>
<div class="<?php print $classes; ?>"<?php print $attributes; ?> id="<?php print $block_html_id; ?>">
  <?php print render($title_prefix); ?>
  <?php print render($title_suffix); ?>
  <?php print $content; ?>
</div>
