<?php

/**
 * Rewrite field -- clone field_location.
 */
?>

<div class="field-type-taxonomy-term-reference"<?php print $attributes; ?>>
  <?php if (!$label_hidden): ?>
    <div class="field-label"<?php print $title_attributes; ?>><?php print $label ?></div>
  <?php endif; ?>
  <?php foreach ($items as $delta => $item): ?>
    <div class="field-item"><?php print render($location_clone); ?></div>
  <?php endforeach; ?>
</div>
