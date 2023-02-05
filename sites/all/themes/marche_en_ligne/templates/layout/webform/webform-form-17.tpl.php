<?php
/**
 * Contacts form 17(Number of node)
 */
?>

<div class="container-wrapper">
  <div class="text-container" id="text-container">
    <?php
     $block = block_load('block', 4);
     $blocks = _block_render_blocks(array($block));
     $blocks_build = _block_get_renderable_array($blocks);
     echo drupal_render($blocks_build);
   ?>
  </div>

  <div class="inputs-container">
    <?php
     print drupal_render($form['progressbar']);

    if (isset($form['preview_message'])) {
     print '<div class="messages warning">';
     print drupal_render($form['preview_message']);
     print '</div>';
   }

    print drupal_render($form['submitted']);

   print drupal_render_children($form);
    ?>
  </div>
</div>


