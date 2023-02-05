<?php
/**
 *  Template for Premium page
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
    <?php print render($page['banner']); ?>
    <div class="helper-wrap">
      <?php print render($page['highlighted']); ?>
      <?php print $messages; ?>

      <?php print render($page['help']); ?>
    </div>
    <?php print render($page['easy_breadcrumb']); ?>
    <div class="user__container">
      <?php if($logged_in){?>
        <div class="user__sidebar">
          <?php print render($page['sidebar_user']); ?>
          <?php print render($tabs); ?>

        </div>
      <?php } ?>
      <div class="user__content">
        <?php print render($page['content']); ?>
      </div>

    </div>

    <?php print $feed_icons; ?>
  </main>
</div>

<?php print render($page['footer']); ?>
<?php print render($page['stick_mobile']); ?>
