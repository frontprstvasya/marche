<?php if ($content): ?>
<section class="section-banner">
  <div class="banner-wrap">
    <div class="banner-logo">
      <a href="/" title="<?php print t('Home'); ?>" rel="home" class="banner-logo--link">
        <img src="/sites/all/themes/marche_en_ligne/logo.svg" alt="<?php print t('Home'); ?>" />
      </a>
    </div>
    <?php print $content; ?>
  </div>
</section>
<?php endif; ?>
