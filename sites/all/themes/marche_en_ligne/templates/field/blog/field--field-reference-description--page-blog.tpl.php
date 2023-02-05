<?php

/**
 * Blog description <p>
 *
 */
?>

<?php foreach ($items as $delta => $item): ?>
    <div class="p-blog__article-description"><?php print render($item); ?></div>
<?php endforeach; ?>