<?php
/**
 *  Template for USER REGISTER.
 */
?>
<header class="header" role="banner">
  <?php
  /**
   *  Adding JS & CSS only this node.
   */
  drupal_add_js('sites/all/themes/marche_en_ligne/lib/js/user.js');
  drupal_add_css('sites/all/themes/marche_en_ligne/css/new/user-pass.css');

  ?>
  <div id="header-container" class="container">
    <?php print render($page['header']); ?>
  </div>
</header>
<div class="main-content">
  <main class="main-content hide-banner" role="main">
    <?php print render($title_prefix); ?>
    <?php print render($title_suffix); ?>
    <?php print render($page['banner']); ?>
    <?php print render($page['search']); ?>
      <div class="helper-wrap <?php if($is_admin) {echo 'helper-wrap--admin';}?>">
          <div class="container">
            <?php print $messages; ?>
            <?php print render($page['highlighted']); ?>
            <?php if($is_admin) {print render($tabs); } ?>
            <?php print render($page['help']); ?>
          </div>
      </div>

    <div class="region region-easy-breadcrumb">
      <div class="block block-easy-breadcrumb contextual-links-region first last odd container" id="block-easy-breadcrumb-easy-breadcrumb">
        <div itemscope class="easy-breadcrumb">
          <span itemprop="title"><a href="/<?php if($language_prefix) print  $language_prefix ; ?>" class="easy-breadcrumb_segment easy-breadcrumb_segment-front"><?php print t('Home'); ?></a></span>
          <span class="easy-breadcrumb_segment-separator">></span>
          <span class="easy-breadcrumb_segment easy-breadcrumb_segment-title"><?php print t('Password'); ?></span>
        </div>
      </div>
    </div>

    <div class="user-login--container container">
      <div class="user-login--container--padding">
        <div class="user-login--close"><a class="icon-marche_15-close" href="javascript:history.back()"></a></div>
        <h1 class="user-login--title user-login--title-desktop"><?php print t('Password Recovery'); ?></h1>
        <div class="user-login--wrapper">
          <div class="user-benefit--title user-benefit--mobile">
            <?php print t('Log in to use all the features of Marche en Ligne'); ?>
          </div>
          <div class="user-benefit">
            <div class="list--open--wrap">
              <div class="list--open icon-marche_11-arrow-down" onclick="listOpen()"></div>
            </div>
            <h1 class="user-login--title user-login--title-mobile"> <?php print t('Forgot your password?'); ?></h1>
            <div id="UBL" class="user-benefit--list">
              <div class="user-benefit--padding">
                <div class="list--close--wrap">
                  <div class="list--close icon-marche_12-arrow-up" onclick="listClose()"></div>
                </div>
               
                <div class="user-benefit--title user-benefit--desktop">
                  <?php print t('Log in to use all the features of Marche en Ligne'); ?>
                </div>
                <?php
                $block_menu = module_invoke('menu', 'block_view', 'menu-menu-user');
                print render($block_menu['content']);
                ?>
              </div>
            </div>
          </div>
          <div class="user-login--content">
            <div class="user-login--title-2 user-login--title-desktop"> <?php print t('Forgot your password?'); ?></div>
            <?php print render($page['content']); ?>
            <div class="description--pass"><?php print t('Check your e-mail indicated during registration. Click on the link in the email to recover the password.'); ?></div>
          </div>
        </div>
      </div>
    </div>
  </main>
</div>

<?php print render($page['footer']); ?>
<?php print render($page['stick_mobile']); ?>
