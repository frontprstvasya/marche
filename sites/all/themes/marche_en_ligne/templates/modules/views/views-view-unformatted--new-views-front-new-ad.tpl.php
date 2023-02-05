<?php
/**
 *  Rewrite views for adding row ad.
 */
?>

<?php if (!empty($title)): ?>
  <h3><?php print $title; ?></h3>
<?php endif; ?>

<?php foreach ($rows as $id => $row): ?>

  <?php $last_int = substr($id, -1); ?>

  <?php
    /**
     * Insert row commercial to views.
     *
     */
   ?>
  <?php if($id % 16 == 0 && $id > 0  ) {

    if (!empty($commercial_nid_list)) {
      /* Every first element of the shuffle array */
      $node = node_load($commercial_nid_list[0]);
    }

    /* Main image */
    $img = $node->field_commercial_image['und'][0];
    $img_uri = $img['uri'];

    $img = theme_image(array(
        'path' => image_style_path('style_500_200', $img_uri),
        'attributes' => ['class' => ['img']],
      )
    );

    /* IMG Icon */
    $img_icon = $node->field_commercial_icon['und'][0];
    $img_uri_icon = $img_icon['uri'];

    $icon = theme_image(array(
        'path' => image_style_path('thumbnail', $img_uri_icon),
        'attributes' => ['class' => ['img-icon']],
      )
    );

    /** @SEE dm_commercial.inc  **/
    $link = dm_commercial::_buildLink($node, 'link');
    $link_bottom = dm_commercial::_buildLink($node, 'link-bottom', t('Visit website'));
    $link_after = dm_commercial::_buildLink($node, 'link-after', ' ');

    echo '<div class="views-row views-row--advertising">';
      echo '<div class="row--advertising--wrap-img">';
        print render($link_after);
        print render($img);
          echo '<div class="row--advertising--wrap-link">';
            print render($icon);
            print render($link);
          echo '</div>';
      echo '</div>';
      echo '<div class="row--advertising-bottom">';
          print render($icon);
          print '<span class="row--advertising-bottom--span">' . t('Advertising') . '</span>';
          print render($link_bottom);
      echo '</div>';
    echo '</div>';
   }
  ?>

  <div<?php if ($classes_array[$id]): ?> class="<?php print $classes_array[$id]; ?>"<?php endif; ?>>
    <?php print $row; ?>
  </div>
<?php endforeach; ?>
