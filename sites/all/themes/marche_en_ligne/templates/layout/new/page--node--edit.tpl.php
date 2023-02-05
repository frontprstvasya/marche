<?php
/**
 * Adding Node submit ad.
 */
?>

<header class="header" role="banner">

  <?php
  /**
   *  Adding JS & CSS only this page.
   */
  drupal_add_js('sites/all/themes/marche_en_ligne/lib/js/create.ad.js');
  drupal_add_js('sites/all/themes/marche_en_ligne/js/new-filter.js');
  drupal_add_js('sites/all/themes/marche_en_ligne/lib/js/unical-filters.js');
  drupal_add_js('sites/all/themes/marche_en_ligne/js/hidePicture.js');
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
        <div class="helper-wrap">
          <?php print render($page['highlighted']); ?>
          <?php print $messages; ?>
          <?php print render($tabs); ?>
          <?php print render($page['help']); ?>
        </div>

        <div class="region region-easy-breadcrumb container">
            <div class="block block-easy-breadcrumb contextual-links-region first last odd"
                 id="block-easy-breadcrumb-easy-breadcrumb">
                <div itemscope="" class="easy-breadcrumb" itemtype="http://data-vocabulary.org/Breadcrumb">
                    <span itemprop="title"><a href="/<?php if($language_prefix) print  $language_prefix ; ?>" class="easy-breadcrumb_segment easy-breadcrumb_segment-front"><?php echo t('Home'); ?></a></span>
                    <span class="easy-breadcrumb_segment-separator">></span>
                    <span class="easy-breadcrumb_segment easy-breadcrumb_segment-title" itemprop="title"><?php echo t('Edit'); ?></span>
                </div>
            </div>
        </div>

      <?php print render($page['content']); ?>
      <?php print $feed_icons; ?>
    </main>
</div>
<?php print render($page['footer']); ?>
<?php print render($page['stick_mobile']); ?>
