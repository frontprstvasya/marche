<?php
/**
 * @file
 * Returns HTML for a region.
 *
 * Complete documentation for this file is available online.
 * @see https://drupal.org/node/1728112
 */
?>
<?php if ($content && $logged_in): ?>
  <div class="<?php print $classes; ?> user-sidebar-content">
    <?php print $content; ?>
  </div>
<?php endif; ?>
