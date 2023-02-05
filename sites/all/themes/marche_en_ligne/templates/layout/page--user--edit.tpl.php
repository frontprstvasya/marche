<?php
/**
 *  Template for ALL Pages.
 */
?>
<header class="header" role="banner">
  <div id="header-container" class="container">
    <?php print render($page['header']); ?>
  </div>
</header>
<div class="main-content">
  <main class="main-content hide-banner" role="main">
    <?php print render($title_prefix); ?>
    <?php print render($title_suffix); ?>
    <?php print render($page['banner']); ?>
    <div class="helper-wrap">
      <?php print render($page['highlighted']); ?>
      <?php print $messages; ?>
      <?php print render($tabs); ?>
      <?php print render($page['help']); ?>
    </div>

    <?php print render($page['easy_breadcrumb']); ?>

    <?php print render($page['content']); ?>
    <?php print $feed_icons; ?>
  </main>
</div>

<?php print render($page['footer']); ?>
<?php print render($page['stick_mobile']); ?>
