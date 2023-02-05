<?php
/**
 *  Template for page blog.
 */
?>
    <header class="header" role="banner">

      <?php
      /**
       *  Adding JS & CSS only this page.
       */
      drupal_add_css('sites/all/themes/marche_en_ligne/css/new/page-blog.css');
      ?>
        <div id="header-container" class="container header-container">
          <?php print render($page['header']); ?>
        </div>
    </header>
    <div class="main-content">
        <main class="main-content hide-banner" role="main">
          <?php print render($title_prefix); ?>
          <?php print render($title_suffix); ?>
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
          <?php print render($page['easy_breadcrumb']); ?>

          <?php print render($page['content']); ?>
          <?php print $feed_icons; ?>
        </main>
    </div>

<?php print render($page['footer']); ?>
<?php print render($page['stick_mobile']); ?>