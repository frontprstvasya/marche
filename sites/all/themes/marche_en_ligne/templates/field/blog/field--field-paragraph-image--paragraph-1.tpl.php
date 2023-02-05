<?php

/**
 * Blog paragraph image
 *
 */
?>

<?php foreach ($items as $delta => $item): ?>
    <div class="p-blog__article-image_paragraph p-blog__article-image"><?php print render($item); ?></div>
<?php endforeach; ?>