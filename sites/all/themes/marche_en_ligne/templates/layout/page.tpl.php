<?php
/**
 *  Template for ALL Pages.
 */
?>
<header class="header" role="banner">
    <div id="header-container" class="container header-container">
      <?php print render($page['header']); ?>
    </div>
</header>
<div class="main-content">
  <?php print render($page['search']); ?>
  <?php print render($page['advertise']); ?>
    <main class="main-content hide-banner" role="main">
      <?php print render($title_prefix); ?>
      <?php print render($title_suffix); ?>

      <?php
      $help = $page['help'];
      ?>

        <div class="<?php if ($help || $messages || $tabs) {
          echo 'helper-wrap';
        } ?>; <?php if ($is_admin) {
          echo 'helper-wrap--admin';
        } ?>">
            <div class="container">
              <?php print $messages; ?>
              <?php if ($is_admin) {
                print render($tabs);
              } ?>
              <?php print render($help); ?>
            </div>
        </div>
      <?php print render($page['easy_breadcrumb']); ?>

      <?php print render($page['content']); ?>
      <?php print $feed_icons; ?>
    </main>
</div>

<?php print render($page['footer']); ?>
<?php print render($page['stick_mobile']); ?>

