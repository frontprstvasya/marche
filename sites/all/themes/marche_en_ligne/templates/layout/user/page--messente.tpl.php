<?php
/**
 *  Adding JS & CSS only this page.
 */

//drupal_add_js('sites/all/themes/marche_en_ligne/lib/js/pincode.js');
//drupal_add_js('sites/all/themes/marche_en_ligne/lib/js/create.ad.js');
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
      <div class="helper-wrap <?php if($is_admin) {echo 'helper-wrap--admin';}?>">
          <div class="container">
            <?php print $messages; ?>
            <?php print render($page['highlighted']); ?>
            <?php if($is_admin) {print render($tabs); } ?>
            <?php print render($page['help']); ?>
          </div>
      </div>

    <?php print render($page['easy_breadcrumb']); ?>

      <h2 class="user-register-title"><?php print t('Connection')?></h2>
    <?php print render($page['content']); ?>


    <?php print $feed_icons; ?>
  </main>
</div>

<?php print render($page['footer']); ?>
<?php print render($page['stick_mobile']); ?>
