<?php
/**
 *  Rewrite field photo gallery on Node submit ad.
 */
?>
<div class="<?php print $classes; ?>"<?php print $attributes; ?>>
  <?php if (!$label_hidden): ?>
    <div class="field-label"<?php print $title_attributes; ?>><?php print $label ?>:&nbsp;</div>
  <?php endif; ?>
  <?php if ($element['#view_mode'] == 'full'): ?>
    <?php
    $filepath= $items[0]['#item']['uri'];
    $small= image_style_url('gallery', $filepath);
    $large= image_style_url('thumbnail', $filepath);
    ?>
    <img id="zoom" class="img-main" src="<?php print $small; ?>" data-zoom-image="<?php print $large; ?>"/>
    <div class="field-gallery">
      <div id="gallery" class="field-items"<?php print $content_attributes; ?>>
        <?php foreach ($items as $delta => $item): ?>
          <?php
          $filepath= $item['#item']['uri'];
          $image= image_style_url('thumbnail', $filepath);
          $small= image_style_url('gallery', $filepath);
          $large= image_style_url('gallery', $filepath);
          ?>
          <a data-zoom-image="<?php print $large; ?>" data-image="<?php print $small; ?>" data-update="" href="#" class="field-item <?php print $delta % 2 ? 'odd' : 'even'; ?>"<?php print $item_attributes[$delta]; ?>>
            <img id="zoom" src="<?php print $image; ?>">
          </a>
        <?php endforeach; ?>
      </div>
      <div class="field-control">
        <a class="carousel-control jcarousel-prev" href="#" data-jcarouselcontrol="true"><i class="fa fa-angle-left"></i></a>
        <a class="carousel-control jcarousel-next" href="#" data-jcarouselcontrol="true"><i class="fa fa-angle-right"></i></a>
      </div>
    </div>
  <?php else: ?>
    <div class="field-items"<?php print $content_attributes; ?>>
      <?php foreach ($items as $delta => $item): ?>
        <div class="field-item <?php print $delta % 2 ? 'odd' : 'even'; ?>"<?php print $item_attributes[$delta]; ?>><?php print render($item); ?></div>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>
</div>
