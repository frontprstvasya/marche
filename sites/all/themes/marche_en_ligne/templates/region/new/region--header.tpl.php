<?php
/**
 * Region Header.
 */
?>

<?php if ($content): ?>
  <?php
      if ($language_prefix) {
        $prefix = '/' . $language_prefix;
        $prefix_after = $language_prefix;
      }else {
        $prefix = '';
        $prefix_after = '';
      }
  ?>

  <div class="icon-nm_10-burger-vertical" onclick="burgerClick('first-header-menu')"></div>
  <?php print  render($header_locale_language); ?>

    <div id="button-header">
      <?php
      $var = menu_tree('menu-button-header');
      print render($var);
      ?>
    </div>

    <div class="header-logo">
        <a href="/<?php print $prefix_after; ?>" title="<?php print t('Home'); ?>" rel="home" class="banner-logo--link">
            <img src="/sites/all/themes/marche_en_ligne/logo.svg" alt="<?php print t('Home'); ?>"/>
        </a>
    </div>


  <?php if ($check_user_url == '0') {
    ?>
    <?php if (!$logged_in) {
      print
        '<div class="profile-enter">
         <a href="' . $prefix . '/user/login">' . t('Log in') . '</a>
      </div>';
    }
    ?>

    <?php if ($logged_in) {
      ?>
        <div class="header__user" onclick="burgerClick('second-header-menu')">
            <img class="header__user-img" src="<?php print render($file_uri); ?>">
        </div>
        <?php } ?>

        <div id="hidden-menu" class="hidden-menu header-user-menu second-header-menu">
            <div class="hidden-menu__top-blog">
                <div class="hidden-menu__label"><?php print t('My account'); ?>
                </div>
                <div class="icon-nm_2-close" onclick=" closeClick('second-header-menu')"></div>
            </div>

          <?php
          $menu = menu_tree('menu-header-user-menu');
          echo render($menu);
          ?>
        </div>
  <?php }
    elseif ($check_user_url == '1') {
      ?>
      <?php if (!$logged_in) {
        ?>
            <div class="profile-enter">
                <a href="<?php print $prefix; ?>/user/login"><?php print t('Log in'); ?></a>
            </div>
      <?php }
      else {
        ?>
          <div><a class="user-logout" href="<?php print $prefix; ?>/user/logout" title=""><?php print t('Log out'); ?></a></div>
      <?php }
    } ?>
<?php endif; ?>


<div id="hidden-menu" class="hidden-menu first-header-menu">
    <div class="hidden-menu__top-blog">
        <div class="hidden-menu__label"><?php print t('Menu'); ?></div>
        <div class="icon-nm_2-close" onclick=" closeClick('first-header-menu')"></div>
    </div>
  <?php print  render($header_menu_menu_new_navigation); ?>
  <?php print  render($header_system_user_menu); ?>
</div>
