<?php
/**
 * Rewrite block menu categories taxonomy.
 */
?>
<div class="<?php print $classes; ?>"<?php print $attributes; ?> id="<?php print $block_html_id; ?>">
  <?php print render($title_prefix); ?>
  <?php print render($title_suffix); ?>
  <div class="navbar--burger--wrap">
    <div class="navbar--burger-close icon-marche_15-close" onclick="navbarBurgerClose()"></div>
    <?php print $content; ?>
  </div>
</div>
