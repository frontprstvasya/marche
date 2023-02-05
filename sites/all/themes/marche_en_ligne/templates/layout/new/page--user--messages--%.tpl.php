<?php
/**
 *  Template for ALL Pages.
 */
?>

  <div class="main-content">
    <main class="main-content hide-banner" role="main">
      <?php print render($title_prefix); ?>
      <?php print render($title_suffix); ?>

      <?php print render($page['easy_breadcrumb']); ?>

      <?php print render($page['content']); ?>
      <?php print $feed_icons; ?>
    </main>
  </div>

<?php print render($page['footer']); ?>
<?php print render($page['stick_mobile']); ?>