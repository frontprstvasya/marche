<?php
/**
 * Footer region.
 */
?>
<?php
  /**
   *  Adding JS & CSS only this page.
   */
  drupal_add_css('sites/all/themes/marche_en_ligne/css/zlata/classes.css');
  drupal_add_css('sites/all/themes/marche_en_ligne/css/zlata/body.css');
  drupal_add_css('sites/all/themes/marche_en_ligne/css/zlata/header.css');
  drupal_add_css('sites/all/themes/marche_en_ligne/css/zlata/hidden-menu.css');
  drupal_add_css('sites/all/themes/marche_en_ligne/css/zlata/footer.css');
  drupal_add_css('sites/all/themes/marche_en_ligne/css/zlata/main-content.css');
  ?>

<?php if ($content): ?>
  <footer id="footer" class="footer" role="contentinfo">
    <div class="container">
      <div class="footer__inner">
        <div class="footer__top">
          <div class="footer__top-item">
            <div class="footer__logo">
              <a href="/" title="<?php print t('Home'); ?>" rel="home" class="footer-logo--link">
                <img src="/sites/all/themes/marche_en_ligne/logo-footer.svg" alt="<?php print t('Home'); ?>" />
              </a>
            </div>
            <?php print render($footer_text_block)?>
            <div class="footer__dynamic">
              <?php print render($footer_contacts)?>
            </div>
          </div>
          <div class="footer__top-item">
            <div class="footer__social">
              <?php print render($footer_block_social)?>
            </div>
            <?php print render($footer_contacts)?>
          </div>
          <div class="footer__top-item">
            <div class="footer__dynamic">
              <div class="footer__social">
                <?php print render($footer_block_social)?>
              </div>
            </div>
            <?php print render($footer_categories_menu)?>
          </div>
        </div>
        <div class="footer__copyright">
            <span><?php print t('Copyright 2022 © Marche en Ligne'); ?></span>
            <?php
            $block_copyright_links = module_invoke('menu', 'block_view', 'menu-copyright-links');
            print render($block_copyright_links['content']);
            ?>
          </div>
      </div>
    </div>
  </footer>
<?php endif; ?>
