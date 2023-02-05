<?php
/**
 *  BTN on banner.
*/
?>
<div class="banner-btn"<?php print $attributes; ?> id="<?php print $block_html_id; ?>">

  <?php print render($title_prefix); ?>
  <?php if ($title): ?>
    <div class="banner-btn--title"><?php print $title; ?></div>
  <?php endif; ?>
  <?php print render($title_suffix); ?>
  <?php print $content; ?>

</div>
