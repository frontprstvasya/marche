<?php
/**
 *  Template for Users pages  MY COMMENTS.
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
        <div class="region region-easy-breadcrumb">
            <div class="block block-easy-breadcrumb contextual-links-region first last odd container" id="block-easy-breadcrumb-easy-breadcrumb">
                <div itemscope class="easy-breadcrumb">
                    <span itemprop="title"><a href="/<?php if($language_prefix) print  $language_prefix ; ?>" class="easy-breadcrumb_segment easy-breadcrumb_segment-front"><?php print t('Home'); ?></a></span>
                    <span class="easy-breadcrumb_segment-separator">/</span>
                    <span class="easy-breadcrumb_segment easy-breadcrumb_segment-title" itemprop="title"><?php print t('Comments'); ?></span>
                </div>
            </div>
        </div>
        <div class="user__container container messages-content">
            <div class="user__sidebar">
              <?php print render($page['sidebar_user']); ?>
            </div>
            <div class="user__content">
              <?php print render($page['content']); ?>
            </div>
        </div>
    </main>
</div>