<?php

/**
 * Blog title with H2
 *
 */
?>

<?php foreach ($items as $delta => $item): ?>
    <h2 class="p-blog__article-subtitle"><?php print render($item); ?></h2>
<?php endforeach; ?>