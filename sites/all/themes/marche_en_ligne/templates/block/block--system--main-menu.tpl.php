<?php
/**
 *  Main menu.
 */
?>
<div class="block-main-menu"<?php print $attributes; ?> id="main-menu">
  <?php print render($title_prefix); ?>
  <?php print render($title_suffix); ?>
  <?php print $content; ?>
</div>
