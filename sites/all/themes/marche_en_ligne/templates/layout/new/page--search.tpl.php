<?php
/**
 *  Template for FRONT page.
 */
?>
<div class="overlay"></div>
<header class="header header-container-node-ad" role="banner">

  <?php
  /**
   *  Adding JS & CSS only this page.
   */
  drupal_add_css('sites/all/themes/marche_en_ligne/lib/css/unreg.css');
  drupal_add_js('sites/all/themes/marche_en_ligne/js/marche-filter.js');
  drupal_add_js('sites/all/themes/marche_en_ligne/js/new-filter.js');
  drupal_add_js('sites/all/themes/marche_en_ligne/lib/js/communication.js');
  ?>

    <div id="header-container" class="container header-container">
      <?php print render($page['header']); ?>
    </div>
</header>

<?php
if (!$logged_in) {
  echo '<div class="unreg-window">';
  $block_window = module_invoke('block', 'block_view', '12');
  print render($block_window['content']);
}
echo '</div>';
?>

<main class="main-content " role="main">
  <?php print render($title_prefix); ?>
  <?php print render($title_suffix); ?>

  <?php print render($page['search']); ?>
    <div class="helper-wrap <?php if($is_admin) {echo 'helper-wrap--admin';}?>">
        <div class="container">
          <?php print $messages; ?>
          <?php print render($page['highlighted']); ?>
          <?php if($is_admin) {print render($tabs); } ?>
          <?php print render($page['help']); ?>
        </div>
    </div>
  <?php print render($page['content']); ?>
</main>
</div>

<?php print render($page['footer']); ?>
<?php print render($page['stick_mobile']); ?>
