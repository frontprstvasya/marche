<?php foreach ($items as $delta => $item): ?>
  <a href="tel:<?php print render($phone_replace); ?>" class="feedback-btn field-btn-call"><?php print render($item); ?></a>
<?php endforeach; ?>
