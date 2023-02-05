<div class="field-field-price"<?php print $attributes; ?>>
    <?php foreach ($items as $delta => $item): ?>
      <div class="field-item"><?php print render($item); ?></div>
    <?php endforeach; ?>
</div>

