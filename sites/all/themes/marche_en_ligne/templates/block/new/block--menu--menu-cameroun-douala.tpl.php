<?php
/**
 *  Rewrite block contacts footer (camerun-doula)
 */
?>
<div id="block-menu-menu-cameroun-douala">
  <?php print render($title_prefix); ?>
  <?php if ($title): ?>
    <h2<?php print $title_attributes; ?>><?php print $title; ?></h2>
  <?php endif; ?>
  <?php print render($title_suffix); ?>
  <ul class="menu">
    <li class="menu__item">
      <!-- <a href="tel:<?php print $phone_replace; ?>"><?php print $my_phone .'ppp' ; ?></a> -->
      <a href="tel:<?php echo '+237800800800' ; ?>"><?php echo '+237 800 800 800' ; ?></a>
    </li>
    <li class="menu__item">
      <!-- <a href="mailto:<?php print $my_email; ?>"><?php print $my_email .'ppp';  ?></a> -->
      <a href="mailto:<?php echo 'help@marcheenligne.com' ; ?>"><?php echo 'help@marcheenligne.com' ; ?></a>

    </li>
  </ul>
</div>
