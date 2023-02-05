<?php
/**
 *  Template for Chat list page
 */
?>
<?php
/**
 *  Adding JS & CSS only this page.
 */
    drupal_add_css('sites/all/themes/marche_en_ligne/css/new/chat-list.css');
    drupal_add_js('sites/all/modules/custom/dm_chat/js/dm-chat--menu-buttons.js');
    drupal_add_js('sites/all/themes/marche_en_ligne/lib/js/create.ad.js');
    drupal_add_css('sites/all/themes/marche_en_ligne/lib/css/unreg.css');
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
    <?php print render($page['easy_breadcrumb']); ?>
    <div class="user__container container messages-content">
      <div class="user__sidebar">
        <?php print render($page['sidebar_user']); ?>
        <?php print render($tabs); ?>
      </div>
      <div class="user__content">
        <div class="tabs-group">
            <span><?php print t('My messages'); ?></span>
            <a href="<?php if($language_prefix) print '/'.  $language_prefix; ?>/user/archive" class="tabs-group__active"><?php print t('Archive'); ?></a>
        </div>
        <?php print render($page['content']); ?>
      </div>

    </div>

    <?php print $feed_icons; ?>
  </main>
</div>


<?php print render($page['footer']); ?>
<?php print render($page['stick_mobile']); ?>
