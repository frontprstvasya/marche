<?php
/**
 *  Template for ALL categories.
 */
?>
<?php
/**
 *  Adding JS & CSS only this page.
 */
    drupal_add_css('sites/all/themes/marche_en_ligne/lib/css/unreg.css');
    drupal_add_js('sites/all/themes/marche_en_ligne/js/marche-filter.js');
    drupal_add_js('sites/all/themes/marche_en_ligne/js/new-filter.js');
    drupal_add_js('sites/all/themes/marche_en_ligne/lib/js/communication.js');
?>
<div class="overlay"></div>
<header class="header" role="banner">
  <div id="header-container" class="container">
    <?php print render($page['header']); ?>
  </div>
</header>
<div class="main-content">
  <?php
  if (!$logged_in) {
    echo'<div class="unreg-window">';
    $block_window = module_invoke('block', 'block_view', '12');
    print render($block_window['content']);
  }
  echo'</div>';
  ?>
  <?php
  /**
   *  Adding JS & CSS only this page.
   */
  drupal_add_js('sites/all/themes/marche_en_ligne/lib/js/taxonomy.filter.js');
  ?>
  <main class="main-content hide-banner" role="main">
    <?php print render($title_prefix); ?>
    <?php print render($title_suffix); ?>
    <?php print render($page['banner']); ?>
      <div class="helper-wrap <?php if($is_admin) {echo 'helper-wrap--admin';}?>">
          <div class="container">
            <?php print $messages; ?>
            <?php print render($page['highlighted']); ?>
            <?php if($is_admin) {print render($tabs); } ?>
            <?php print render($page['help']); ?>
          </div>
      </div>
    <?php print render($page['easy_breadcrumb']); ?>
    <?php print render($page['navbar']); ?>
    <div class="wrapper-categories--depth <?php if($depth_term == 2){echo 'wrapper-categories--depth-2';}?>">
      <div class="wrapper-categories--content container <?php if($depth_term == 2 && $cont_result <= 0) echo 'wrapper-categories--content--empty';?>">
        <?php
        /**
         * Condition - if depth term = 1.
         *
         *  Condition - view menu if not empty views.
         */
        if($depth_term == 1 && $cont_result > 0) {
          echo '<div id="SC" class="subtitle-categories">';
          $menu = menu_tree('menu-menu-categories-taxonomy');
          echo render($menu);
          echo '</div>';
          echo '<div class="section-views">';
          $block_views = module_invoke('views', 'block_view', 'commercial_sidebar_views-block');
          print render($block_views['content']);
        }
        ?>

        <?php if ($depth_term == 2 && $cont_result > 0) {
          echo '<div class="sidebar-container views-filter-heading">';
          echo '<div class="filter-toggle-btn icon-nm_12-filter"></div>';
          echo '<div id="SFC" class="section-filter-categories filters-container">';
          echo '<div class="exit-btn icon-nm_2-close"></div>';
          echo '<h2 class="title">Filters</h2>';
          print render($page['filter_categories']);
          echo  '</div>';
          $block_views = module_invoke('views', 'block_view', 'commercial_sidebar_views-block');
          print render($block_views['content']);
          echo  '</div>';
        }
        ?>

        <?php print render($page['content']); ?>
        <?php print $feed_icons; ?>
        <?php if($depth_term == 1 && $cont_result > 0) {
          echo '</div>';
        }?>
      </div>
    </div>
  </main>
</div>

<?php print render($page['footer']); ?>
<?php print render($page['stick_mobile']); ?>
