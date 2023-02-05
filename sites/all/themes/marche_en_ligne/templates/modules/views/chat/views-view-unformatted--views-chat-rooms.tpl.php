<?php

/**
 * Rewrite views row for chat room views.
 */
?>
<?php if (!empty($title)): ?>
    <h3><?php print $title; ?></h3>
<?php endif; ?>

<?php $arb_id = theme_get_setting('user_arbitrage'); ?>

<?php foreach ($rows as $id => $row): ?>

    <?php
        /** Get id from message && assign  $class_id */
        $message_uid = $result[$id]->users_dm_chat_message_uid;
        $class_id =  $classes_array[$id];
        $arb_class = $arb_type[$id]->dm_chat_message_type;
    ?>
    <div<?php if ($class_id): ?> class="<?php print $class_id; ?> <?php if ($message_uid !== $current_id) {print 'msg-row--remote-user';} ?> <?php if ($message_uid !== $current_id && $message_uid === $arb_id) { print 'msg-row--arbitrage';} ?> "<?php endif; ?> >
      <?php print $row; ?>
    </div>
<?php endforeach; ?>



