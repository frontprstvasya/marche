<?php
/**
 * Class for module DM chat.
 */

/**
 * Page callback for adding arbitrage.
 *
 * @throws \Exception
 */
function dm_chat_pin_message_list() {

  $uid = $_GET['u'];
  $room = $_GET['r'];
  $explodeEvent = explode("-", $_GET['e']);
  $event = $explodeEvent[0];
  $status = $explodeEvent[1];

  $current_user = dm_chat::dmChatGetCurrentUser();
  $check_user_room = dm_chat::dmChatCheckingUserIntoRoom($room, $uid);

  /**
   * Return Json function.
   *
   * @param $event
   * @param $statusVal * set value status.
   *
   * @return bool|string
   */
  function returnJson($event, $statusVal) {
    $data = [
      'event' => $event,
      'status' => $statusVal,
      ];
    return print_r(drupal_json_encode($data));
  }

  /** Verify the params from url with value from DB.  */
  if($current_user == $uid && $check_user_room === '1') {
    $objectEvent = dm_chat::dmChatGetEventObject($room, $uid);

    /** If empty field && status: 0 */
    if(empty($objectEvent) && $status === '0') {
      if($event === 'pin'){
        dm_chat::dmChatCreateFieldEvent('dm_chat_event', $room, $uid, 1);
        returnJson($event, '1');
      }

      if($event === 'archive'){
        dm_chat::dmChatCreateFieldEvent('dm_chat_event', $room, $uid, 0, 1);
        returnJson($event, '1');
      }

      if($event === 'delete'){
        dm_chat::dmChatCreateFieldEvent('dm_chat_event', $room, $uid, 0, 0, 1, 0);
        returnJson($event, '1');
      }

      if($event === 'viewed'){
        dm_chat::dmChatCreateFieldEvent('dm_chat_event', $room, $uid, 0, 0, 0, 1);
        returnJson($event, '1');
      }
    }

    /** If field && status: 0 */
    if(!empty($objectEvent) && $status === '0') {
        dm_chat::dmChatUpdateEvent('dm_chat_event', $event, 1, 'room', $room, 'uid', $uid );
        returnJson($event, '1');
    }

    /** If field && status: 1 */
    if(!empty($objectEvent) && $status === '1') {
      dm_chat::dmChatUpdateEvent('dm_chat_event', $event, 0, 'room', $room, 'uid', $uid );
      returnJson($event, '0');
    }
  }
}
