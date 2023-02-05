<?php
/**
 *  Template for Users/message/room pages
 */
?>
<div class="main-content">
  <?php
  /**
   *  Adding JS & CSS only this page.
   */
  drupal_add_js('sites/all/modules/custom/dm_chat/js/dm-chat.js');
  drupal_add_js('sites/all/modules/custom/dm_chat/js/ws.js');
  drupal_add_js('sites/all/modules/custom/dm_chat/js/dm-chat--menu-buttons.js');
  //  drupal_add_js('sites/all/modules/custom/dm_chat/js/wss.js');
  drupal_add_js('sites/all/modules/custom/dm_chat/js/moment.js');
  drupal_add_js('sites/all/modules/custom/dm_chat/js/moment-timezone-with-data.js');
  drupal_add_js('sites/all/themes/marche_en_ligne/lib/js/create.ad.js');
  ?>

<div class="main-content">
  <main class="main-content hide-banner" role="main">
    <?php print render($title_prefix); ?>
    <?php print render($title_suffix); ?>
      <div class="container">
        <?php print render($page['content']); ?>
      </div>
    </div>
    <?php print $feed_icons; ?>
  </main>
</div>
