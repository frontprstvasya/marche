<?php
/**
 *  Template for Error 403.
 */
?>
<header class="header" role="banner">
  <div id="header-container" class="container">
    <?php print render($page['header']); ?>
  </div>
</header>
<div class="main-content">
  <main class="main-content hide-banner" role="main">

    <?php print render($page['easy_breadcrumb']); ?>

    <?php print render($page['content']); ?>
    <?php print $feed_icons; ?>
  </main>
</div>

<?php print render($page['footer']); ?>
<?php print render($page['stick_mobile']); ?>
