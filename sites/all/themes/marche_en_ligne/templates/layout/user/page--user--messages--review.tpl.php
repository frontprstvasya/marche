<?php
/**
 *  Template for Users/message/review pages
 */
?>

<header class="header" role="banner">
  <div id="header-container" class="container">
    <?php print render($page['header']); ?>
  </div>
</header>
<div class="main-content">
  <main class="main-content hide-banner" role="main">
    <div class="region region-easy-breadcrumb">
      <div class="block block-easy-breadcrumb contextual-links-region first last odd container" id="block-easy-breadcrumb-easy-breadcrumb">
        <div itemscope class="easy-breadcrumb">
          <span itemprop="title"><a href="/<?php if($language_prefix) print  $language_prefix ; ?>" class="easy-breadcrumb_segment easy-breadcrumb_segment-front"><?php print t('Home'); ?></a></span>
          <span class="easy-breadcrumb_segment-separator">></span>
          <span class="easy-breadcrumb_segment easy-breadcrumb_segment-title"><?php print t('Review'); ?></span>
        </div>
      </div>
    </div>
    <div class="container">
      <div class="p-user__review">
        <div class="p-user__review-form">
          <?php print render($page['highlighted']); ?>
          <?php print $messages; ?>
          <?php print render($tabs); ?>
          <?php print render($page['help']); ?>
          <?php print render($page['content']); ?>
        </div>
      </div>
    </div>
  </main>
</div>

<?php print render($page['footer']); ?>
<?php print render($page['stick_mobile']); ?>
