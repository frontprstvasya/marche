<?php
/**
 *  Template for USER LOGIN.
 */
?>
<header class="header" role="banner">
  <?php
  /**
   *  Adding JS & CSS only this node.
   */
  drupal_add_js('sites/all/themes/marche_en_ligne/lib/js/user.js');
  drupal_add_js('sites/all/themes/marche_en_ligne/lib/js/ulogin.js');
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
        <div class="helper-wrap <?php if ($is_admin) {
          echo 'helper-wrap--admin';
        } ?>">
            <div class="container">
              <?php print $messages; ?>
              <?php print render($page['highlighted']); ?>
              <?php if ($is_admin) {
                print render($tabs);
              } ?>
              <?php print render($page['help']); ?>
            </div>
        </div>
      <div class="region region-easy-breadcrumb">
        <div class="block block-easy-breadcrumb contextual-links-region first last odd container" id="block-easy-breadcrumb-easy-breadcrumb">
          <div itemscope class="easy-breadcrumb">
            <span itemprop="title"><a href="/<?php if($language_prefix) print  $language_prefix ; ?>" class="easy-breadcrumb_segment easy-breadcrumb_segment-front"><?php print t('Home'); ?></a></span>
            <span class="easy-breadcrumb_segment-separator">></span>
            <span class="easy-breadcrumb_segment easy-breadcrumb_segment-title"><?php print t('Log in'); ?></span>
          </div>
        </div>
      </div>

        <div class="user-login--container container">
            <div class="box-shadow">
                <div class="user-login--title">
                    <span><?php print t('Log in') ?></span>
                    <a href="<?php if($language_prefix) print '/'.  $language_prefix; ?>/user/register"><?php print t('No account?') ?></a>
                </div>
              <?php print render($page['content']); ?>
            </div>
          <?php
          global $base_url;
          $parse_url = parse_url($base_url);
          $path = $parse_url['scheme'] . '%3A%2F%2F' . $parse_url['host'] . '%2Fulogin%3Fdestination%3Duser%2Flogin';
          ?>
            <a class="forgot-pass"
               href="<?php if($language_prefix) print '/'.  $language_prefix; ?>/user/password"><?php print t('Forgot Password') ?></a>
            <div class="widget--container">
                <h2 class="widget--title"><?php print t('Log in via') ?></h2>
                <div class="widget--content" id="uLogin" data-ulogin="display=buttons;fields=first_name,last_name;
        providers=google,facebook;hidden=other;
                    redirect_uri=<?php echo $path ?>">
                    <img class="google-img"
                         src="/sites/default/files/u-login/google.svg"
                         data-uloginbutton="google"/>
                    <div class="fb-container">
                        <img class="fb-img" src="/sites/default/files/u-login/facebook.svg" data-uloginbutton="facebook"/>
                    </div>
                </div>
            </div>
        </div>
</div>
</main>
</div>

<?php print render($page['footer']); ?>
<?php print render($page['stick_mobile']); ?>
