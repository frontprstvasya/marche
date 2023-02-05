<?php
/**
 * Rewrite template for chat room.
 */
?>
<div class="<?php print $classes; ?>">
  <?php print render($title_prefix); ?>
  <?php print render($title_suffix); ?>

    <?php if ($attachment_before): ?>
      <div class="attachment attachment-before">
        <?php print $attachment_before; ?>
      </div>
  <?php endif; ?>

    <div id="overlay-chat"></div>

    <div id="info-arbitrage" class="info-block">
      <?php $block = module_invoke('block', 'block_view', '13'); print render($block['content']); ?>
        <div class="info-block-close"><?php print t('Ok')?></div>
    </div>

    <div class="return-link">
      <a href="<?php if($language_prefix) {print '/'. $language_prefix;} ?>/user/<?php print $cuid;?>/my-messages"><?php print t('Back to posts'); ?></a>
    </div>

    <div class="chat-wrapper" >
        <div class="view-header view-header--room">
            <a class="view-header--img"
               href="/<?php print $chat_room_path_content; ?>">
              <?php print $chat_room_img; ?>
            </a>
            <div class="view-header--data">
                <div class="view-header--title"><?php print $chat_room_title; ?></div>
                <div class="view-header--price">
                    <span><?php print $chat_room_price; ?></span>
                    <span>FCFA</span>
                </div>
            </div>
          <!-- BTN adding arbitrage  -->
          <div id="chat-arb" class="<?php print $chat_room_arbitrage_status; ?>"><?php print t('Settle the disagreement'); ?></div>

          <div class="chat-burger">
            <span></span>
            <span></span>
            <span></span>
          </div>
          <ul class="chat-menu">
            <li class="chat-menu__pin"><?php print t('Pin'); ?></li>
            <li class="chat-menu__archive"><?php print t('Archive'); ?></li>
            <li class="chat-menu__delete"><?php print t('Delete'); ?></li>
          </ul>
        </div>
      <div class="form-wrap" id="chat-status">
        <div class="loader-wrap" >
          <div class="loader"><?php print t('loading'); ?></div>
        </div>
        <?php if ($rows): ?>
          <div id="chat-wrapper--msg">
            <?php print $rows; ?>
          </div>
      <?php elseif ($empty): ?>
          <div id="chat-wrapper--msg" class="view-empty">
            <?php print '' ?>
          </div>
      <?php endif; ?>

      <?php if ($attachment_after): ?>
          <div class="attachment attachment-after">
            <?php print $attachment_after; ?>
          </div>
      <?php endif; ?>

        <!-- Input chat -->
        <form id="form-chat">
            <div class="input-wrap">
              <textarea type="text" id="form-chat--input" rows="1" required></textarea>
              <input type="submit" class="submit-message" value="Envoyer">
              <?php
              /********************* Form load img ****************************************/
              $form = drupal_get_form('dm_chat_upload_img');
              echo render($form);
              /********************* Form load img ****************************************/
              ?>
            </div>
        </form>
      </div>
    </div>
</div>


