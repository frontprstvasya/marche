<?php
/**
 *  Template for Categories Page.
 */
?>
<header class="header" role="banner">
  <div id="header-container" class="container">
    <?php print render($page['header']); ?>
  </div>
</header>
<div class="main-content">
  <?php print render($page['search']); ?>
  <?php print render($page['advertise']); ?>
  <main class="main-content hide-banner" role="main">
    <?php print render($title_prefix); ?>
    <?php print render($title_suffix); ?>

    <div class="helper-wrap">
      <div class="container">
      <?php print render($page['highlighted']); ?>
      <?php print $messages; ?>
      <?php print render($tabs); ?>
      <?php print render($page['help']); ?>
      </div>
    </div>

    <?php print render($page['easy_breadcrumb']); ?>
    <div class="container">
      <?php
      $block_copyright_links = module_invoke('menu', 'block_view', 'menu-menu-categories');
      print render($block_copyright_links['content']);
      ?>
    </div>

    <?php print $feed_icons; ?>
  </main>
</div>

<?php print render($page['footer']); ?>
<?php print render($page['stick_mobile']); ?>

