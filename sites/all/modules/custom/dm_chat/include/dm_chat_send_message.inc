<?php
/**
 * Create field intro table (dm_chat_message) DB.
 *
 * @throws \Exception
 */
function dm_chat_send_message_to_db() {

  /* Set variables from  $_GET */
  $headers = get_headers('http://localhost:5000');
  $MSG = [
    'message_id' => $_GET['message_id'],
    'uid' => intval($_GET['uid']),
    'message' => $_GET['message'],
    'dm_chat_room' => $_GET['dm_chat_room'],
    'timestamp' => intval($_GET['timestamp']),
    'type' => $_GET['type'],
  ];

  $check_message_id = dm_chat::dmChatCheckingField('dm_chat_message', $MSG['message_id'], 'message_id');

  if ($check_message_id === '0') {
    /* Create message into DB on site */
    dm_chat::dmChatCreateMessage('dm_chat_message', $MSG['message_id'], $MSG['uid'], $MSG['message'], $MSG['dm_chat_room'], $MSG['timestamp'], $MSG['type']);

    $data = [
      'status' => 'success',
      'headers' => $headers,
    ];
  }
  else {
    $data = [
      'status' => 'Message_id is not unique',
    ];
  }
  print_r(drupal_json_encode($data));

}

// drupal_add_http_header('Content-Type', 'application/javascript; utf-8');
