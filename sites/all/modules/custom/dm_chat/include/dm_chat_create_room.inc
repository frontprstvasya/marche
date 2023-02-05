<?php
/**
 * Class for module DM chat.
 */

/**
 * Page callback for create chat room.
 *
 * @throws \Exception
 */
function dm_chat_create_chat_room(): array {
  $content = [];

  /* Get params from url */
  $params = dm_chat::dmChatGetParseUrl('n');

  $nid = $params['param'];
  if($nid  === 'empty') {
    drupal_goto('/forbidden');
  }

  $seller = intval(dm_chat::dmChatGetSellerNid($nid));
  $current_user = intval(dm_chat::dmChatGetCurrentUser());
  $room = strval($nid) . '-' . strval($current_user);

  if ($current_user !== 0 && $seller !== $current_user) {

    /* Checking room */
    $check_room = dm_chat::dmChatCheckingField('dm_chat_room', $room, 'room');
    $path = 'user/messages/' . $room;

    if($check_room == 1) {
      drupal_goto($path);
    }

    if($check_room == 0) {
      dm_chat::dmChatCreateRoom('dm_chat_room', $room, $seller, $current_user, $nid);
      drupal_goto($path);
    }

  }else {
    drupal_goto('/forbidden');
  }

  return $content;
}
