<?php

/**
 * Blog paragraph description
 *
 */
?>

<?php foreach ($items as $delta => $item): ?>
    <div class="p-blog__paragraph-description"><?php print render($item); ?></div>
<?php endforeach; ?>