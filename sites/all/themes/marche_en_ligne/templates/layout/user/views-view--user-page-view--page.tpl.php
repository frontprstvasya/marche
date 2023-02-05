

<div class="<?php print $classes; ?>">
  <?php print render($title_prefix); ?>
  <?php if ($title): ?>
    <?php print $title; ?>
  <?php endif; ?>
  <?php print render($title_suffix); ?>

    <div class="p-user p-user__view">
      <?php if ($header): ?>
          <div class="user__sidebar">
              <div class="view-header">
                <?php print $header; ?>
              </div>
          </div>
      <?php endif; ?>
        <div class="user__content">
            <div class="tabs">
                <ul class="menu">
                    <li class="menu__item">
                        <a href="<?php if($language_prefix) print '/'. $language_prefix?>/user/<?php if($views_arg) print $views_arg; ?>/view" class="menu__link <?php if($last_url === 'view') print 'active'; ?>"><?php print t('Advertisement'); ?></a>
                    </li>
                    <li class="menu__item">
                        <a href="<?php if($language_prefix) print '/'. $language_prefix?>/user/<?php if($views_arg) print $views_arg; ?>/avis" class="menu__link <?php if($last_url === 'avis') print 'active'; ?>"> <?php print t('Reviews'); ?></a>
                    </li>
                </ul>
            </div>
          <?php if ($exposed): ?>
              <div class="view-filters">
                <?php print $exposed; ?>
              </div>
          <?php endif; ?>

          <?php if ($attachment_before): ?>
              <div class="attachment attachment-before">
                <?php print $attachment_before; ?>
              </div>
          <?php endif; ?>

          <?php if ($rows): ?>
              <div class="view-content">
                <?php print $rows; ?>
              </div>
          <?php elseif ($empty): ?>
              <div class="view-empty">
                <?php print $empty; ?>
              </div>
          <?php endif; ?>

          <?php if ($pager): ?>
            <?php print $pager; ?>
          <?php endif; ?>

          <?php if ($attachment_after): ?>
              <div class="attachment attachment-after">
                <?php print $attachment_after; ?>
              </div>
          <?php endif; ?>

          <?php if ($more): ?>
            <?php print $more; ?>
          <?php endif; ?>
        </div>
    </div>

  <?php if ($footer): ?>
      <div class="view-footer">
        <?php print $footer; ?>
      </div>
  <?php endif; ?>

  <?php if ($feed_icon): ?>
      <div class="feed-icon">
        <?php print $feed_icon; ?>
      </div>
  <?php endif; ?>

</div><?php /* class view */ ?>