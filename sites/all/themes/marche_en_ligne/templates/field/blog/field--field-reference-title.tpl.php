<?php

/**
 * Blog title with H1
 */

?>

<?php foreach ($items as $delta => $item): ?>
    <h1 class="p-blog__article-title"><?php print render($item); ?></h1>
<?php endforeach; ?>
