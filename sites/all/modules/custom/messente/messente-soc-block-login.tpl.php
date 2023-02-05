<?php if (variable_get('messente_register_facebook') && isset($variables['url_fb'])): ?>
            <div class="fbcon">
            <a class="fb_connect"  href="<?php echo($variables['url_fb']); ?>">
                <img src="<?php  echo( drupal_get_path('module', 'messente') . '/img/akar-icons_facebook-fill.png'); ?>">
            </a>
            </div><?php endif; ?>
      <?php if (variable_get('messente_register_google') && isset($variables['url_google'])): ?><div class="goo_con">
          <a class="google_connect" href="<?php echo($variables['url_google']); ?>">
              <img src="<?php  echo( drupal_get_path('module', 'messente') . '/img/google-account-mini.png'); ?>">
          </a>
          </div><?php endif; ?>
      <?php if (isset($errorText)): ?><div><?php echo $errorText ?></div><?php endif; ?>


