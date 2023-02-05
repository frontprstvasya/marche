<?php
/**
 *  Template for single announcement page.
 */
?>

<?php
/**
 *  Adding JS & CSS only this page.
 */
drupal_add_css('sites/all/themes/marche_en_ligne/lib/css/unreg.css');
drupal_add_js('sites/all/themes/marche_en_ligne/lib/js/communication.js');
drupal_add_js('sites/all/themes/marche_en_ligne/lib/js/submit-ad-custom.js');
drupal_add_js('sites/all/themes/marche_en_ligne/js/new-filter.js');
?>
<div class="overlay"></div>
<header class="header" role="banner">
    <div id="header-container" class="container header-container">
      <?php print render($page['header']); ?>
    </div>
</header>
<div class="main-content">

  <?php
  if (!$logged_in) {
    echo '<div class="unreg-window">';
    $block_window = module_invoke('block', 'block_view', '12');
    print render($block_window['content']);
  }
  echo '</div>';
  ?>

    <main class="main-content hide-banner" role="main">
      <?php print render($title_prefix); ?>
      <?php print render($title_suffix); ?>

        <div class="helper-wrap <?php if($is_admin) {echo 'helper-wrap--admin';}?>">
            <div class="container">
              <?php print $messages; ?>
              <?php print render($page['highlighted']); ?>
              <?php print render($tabs); ?>
              <?php print render($page['help']); ?>
            </div>
        </div>
        <div class="wrap--breadcrumb-navbar">
          <?php print render($page['easy_breadcrumb']); ?>
        </div>
      <?php print render($page['content']); ?>
      <?php print $feed_icons; ?>
    </main>
</div>

<?php print render($page['footer']); ?>
<?php print render($page['stick_mobile']); ?>




