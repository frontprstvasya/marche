<?php

/**
 * Blog main image
 *
 */
?>

<?php foreach ($items as $delta => $item): ?>
    <div class="p-blog__article-image_main p-blog__article-image"><?php print render($item); ?></div>
<?php endforeach; ?>