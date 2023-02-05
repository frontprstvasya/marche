<?php
/**
 * Class for module DM chat.
 */

/**
 * Page callback for adding arbitrage.
 *
 * @throws \Exception
 */
function dm_chat_adding_arbitrage() {

  $user_arbitrage = theme_get_setting('user_arbitrage');
  $params = dm_chat::dmChatGetParseUrl('r');
  $current_user = dm_chat::dmChatGetCurrentUser();

  if ($params['param'] === 'empty'){
    drupal_goto('/forbidden');
  }

  $room = $params['param']. '-'.$current_user;
  $chek_room = dm_chat::dmChatCheckingField('dm_chat_room', $room, 'room');

  /* Checking room && update field */
  if($chek_room === '1') {
    $users_room = dm_chat::dmChatReturnRoomObject($room);

    if($users_room->buyer === $current_user || $users_room->seller === $current_user) {
      if($users_room->arbitrage === null ) {
        dm_chat::dmChatUpdateField('dm_chat_room', 'arbitrage', $user_arbitrage, 'room', $room);

        drupal_add_http_header('Content-Type', 'application/javascript; utf-8');
        $data = [
          'arbitrage' => 'active',
        ];
      }else{
        drupal_add_http_header('Content-Type', 'application/javascript; utf-8');
        $data = [
          'arbitrage' => 'inactive',
        ];
      }
      print_r(drupal_json_encode($data)) ;
    }
  }
}
