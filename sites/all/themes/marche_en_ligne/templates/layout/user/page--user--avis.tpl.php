<?php
/**
 *  Template for Users pages
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
      <?php print render($page['search']); ?>
        <div class="helper-wrap <?php if($is_admin) {echo 'helper-wrap--admin';}?>">
            <div class="container">
              <?php print $messages; ?>
              <?php print render($page['highlighted']); ?>
              <?php if($is_admin) {print render($tabs); } ?>
              <?php print render($page['help']); ?>
            </div>
        </div>
        <div class="region region-easy-breadcrumb">
            <div class="block block-easy-breadcrumb contextual-links-region first last odd container" id="block-easy-breadcrumb-easy-breadcrumb">
                <div itemscope class="easy-breadcrumb" >
                    <span itemprop="title"><a href="/<?php if($language_prefix) print  $language_prefix ; ?>" class="easy-breadcrumb_segment easy-breadcrumb_segment-front"><?php print t('Home'); ?></a></span>
                    <span class="easy-breadcrumb_segment-separator">/</span>
                    <span class="easy-breadcrumb_segment easy-breadcrumb_segment-title" itemprop="title"><?php print t('View'); ?></span>
                </div>
            </div>
        </div>

</div>
<div class="user__container container">
  <?php print render($page['content']); ?>
</div>
<?php print $feed_icons; ?>
</main>
</div>

<?php print render($page['footer']); ?>
<?php print render($page['stick_mobile']); ?>
