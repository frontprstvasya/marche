<?php
/**
 * Node Submit AD.
 */
?>
<article class="<?php print $classes; ?> clearfix node-<?php print $node->nid; ?>"<?php print $attributes; ?>>
  <?php
  /**
   *  Adding JS & CSS only this node.
   */
  drupal_add_js('sites/all/themes/marche_en_ligne/lib/js/swiper.min.js');
  drupal_add_js('sites/all/themes/marche_en_ligne/lib/js/settings.swiper.js');
  drupal_add_css('sites/all/themes/marche_en_ligne/lib/css/swiper.min.css');

  ?>

  <?php if ($title_prefix || $title_suffix || $display_submitted || $unpublished || $preview || !$page && $title): ?>

    <div class="article-header">
      <?php print render($title_prefix); ?>
      <?php if (!$page && $title): ?>
        <h2<?php print $title_attributes; ?>><a href="<?php print $node_url; ?>"><?php print $title; ?></a></h2>
      <?php endif; ?>
      <?php print render($title_suffix); ?>

      <?php if ($display_submitted): ?>
        <p class="submitted">
          <?php print $user_picture; ?>
          <?php print $submitted; ?>
        </p>
      <?php endif; ?>

      <?php if ($unpublished): ?>
      <?php elseif ($preview): ?>
        <mark class="watermark"><?php print t('Preview'); ?></mark>
      <?php endif; ?>
    </div>
  <?php endif; ?>

  <?php
  // We hide the comments and links now so that we can render them later.
  hide($content['comments']);
  hide($content['links']);
  /* Get title node */
  $node_title = node_load($nid)->title;
  ?>
  <div class="ad-title-container">

    <?php if ($unpublished): ?>
      <?php
      $block = block_load('block', '6');
      $blocks = _block_render_blocks(array($block));
      $blocks_build = _block_get_renderable_array($blocks);
      echo drupal_render($blocks_build);
      ?>
    <?php endif; ?>
  </div>

  <?php print render($content); ?>
  <?php print render($content['comments']); ?>
</article>
