<?php
/**
 *  Template for Add page ad
 */
?>

<header class="header header-container-node-ad" role="banner">

<?php
  /**
   *  Adding JS & CSS only this page.
   */
  drupal_add_js('sites/all/themes/marche_en_ligne/lib/js/create.ad.js');
  drupal_add_js('sites/all/themes/marche_en_ligne/lib/js/unical-filters.js');
  drupal_add_js('sites/all/themes/marche_en_ligne/js/new-filter.js');
  ?>

  <div id="header-container" class="container">
    <?php print render($page['header']); ?>
  </div>
</header>
    <div class="main-content">
      <main class="hide-banner" role="main">
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
        <div itemscope class="easy-breadcrumb region-easy-breadcrumb" itemtype="http://data-vocabulary.org/Breadcrumb">
          <span itemprop="title"><a href="/" class="easy-breadcrumb_segment easy-breadcrumb_segment-front"><?php print t('Home'); ?></a></span>
          <span class="easy-breadcrumb_segment-separator">></span>
          <span class="easy-breadcrumb_segment easy-breadcrumb_segment-title" itemprop="title"><?php print t('Create an advertising'); ?></span>
        </div>
    <?php print render($page['content']); ?>
    <?php print $feed_icons; ?>
  </main>
</div>

<?php print render($page['footer']); ?>
<?php print render($page['stick_mobile']); ?>
