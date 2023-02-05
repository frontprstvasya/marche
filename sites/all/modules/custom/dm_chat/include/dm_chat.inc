<?php
/**
 * Class for module DM chat.
 */

class dm_chat {

  /**
   * GEt current ID.
   */
  public static function dmChatGetCurrentUser() {
    global $user;
    return $user->uid;
  }

  /**
   * GEt arbitrage ID.
   */
  public static function dmChatGetArbitrageID() {
    return theme_get_setting('user_arbitrage');
  }

  /**
   * Get room from URL.
   *
   * @return false|mixed|string
   */
  public static function dmChatGetRoomFromUrl() {
    $current_url = url(current_path());
    $pathFragments = explode('/', $current_url);
    return end($pathFragments);
  }

  /**
   * Get params $_GET general.
   *
   * @param $key * param from URL.
   */
  public static function dmChatGetParseUrl($key): array {
    $param = NULL;
    $query = $_GET['q'];

    if (isset($_GET[$key])) {
      $param = intval($_GET[$key]);
    }
    else {
      $param = 'empty';
    }

    return [
      'param' => $param,
      'query' => $query,
    ];
  }

  /**
   * Get author nid.
   */
  public static function dmChatGetSellerNid($nid) {
    if ($nid) {
      return node_load($nid)->uid;
    }
  }

  /**
   * Checking field availability.
   * DB request.
   *
   * @param $table * table name.
   * @param $field_value * Value field for checking.
   * @param $field_name * Name field for checking.
   *
   * @return mixed
   */
  public static function dmChatCheckingField($table, $field_value, $field_name) {
    return db_select($table, 'n')
      ->condition('n.' . $field_name, $field_value)
      ->countQuery()
      ->execute()
      ->fetchField();
  }

    /**
     * Select free fields from table.
     *
     * DB request.
     *
     * @param $table      * Table name.
     * @param $room       * Chat room ID --> $nid-$buyer.
     * @param $field_name * Sample field to count.
     * @param $field1     * Buyer
     * @param $field2     * Seller
     * @param $field3     * Arbitrage
     *
     * @return array
     */
    public static function dmChatSelectTreeFields($table, $room, $field_name, $field1, $field2, $field3): array {
      $array_fields = [];

      $res = db_select($table, 'n')
        ->condition('n.'.$field_name, $room)
        ->fields('n',array($field1, $field2, $field3))
        ->execute();

      while($rec=$res->fetchAssoc()){
        $array_fields[$field1] = $rec[$field1];
        $array_fields[$field2] = $rec[$field2];
        $array_fields[$field3] = $rec[$field3];
      }
      return $array_fields;
    }

  /**
   * Return ROOM object.
   *
   * DB request.
   *
   * @param $room * Chat room ID --> $nid-$buyer.
   */
  public static function dmChatReturnRoomObject($room) {
    return db_select('dm_chat_room', 'n')
      ->condition('n.room', $room)
      ->fields('n', ['seller', 'buyer', 'arbitrage', 'nid'])
      ->execute()->fetchObject();
  }

/**
   *  Checking user into chat room.
   *
   * @param $room           * Chat room.
   * @param $user_desired   * User which needs to be checked.
   *
   * @return mixed
   */
  public static function dmChatCheckingUserIntoRoom($room, $user_desired) {
    return db_select('dm_chat_room', 'n')
      ->condition('n.room', $room)
      ->condition(
        db_or()
          ->condition('n.seller', $user_desired)
          ->condition('n.buyer', $user_desired)
      )
      ->countQuery()
      ->execute()
      ->fetchField();
  }

  /**
   * Checking value into two fields..
   *
   * @param $table       * Table name.
   * @param $field_name
   * @param $field_value
   * @param $field_name2
   * @param $field_value2
   *
   * @return mixed return 0 or 1
   */
  public static function dmChatCheckingValueTwoFields($table, $field_name, $field_value, $field_name2, $field_value2) {
    return db_select($table, 'n')
      ->condition('n.'. $field_name, $field_value)
      ->condition('n.'. $field_name2, $field_value2)
      ->countQuery()
      ->execute()
      ->fetchField();
  }

  /**
   * Get field as object from table (dm_chat_event).
   *
   * @param $room
   * @param $uid
   *
   * @return mixed
   */
  public static function dmChatGetEventObject($room, $uid) {
    return db_select('dm_chat_event', 'n')
      ->condition('n.room', $room)
      ->condition('n.uid', $uid)
      ->fields('n',array('id', 'room', 'uid', 'pin', 'archive', 'delete', 'viewed'))
      ->execute()->fetchObject();
  }

  /**
   * Update value filed into table.
   *
   * @param $table            * Table name.
   * @param $field_name       * Field name for select.
   * @param $field_value      * Field value from table.
   * @param $condition_name   * Name field for condition.
   * @param $condition_value  * Value field for condition.
   */
  public static function dmChatUpdateField($table, $field_name, $field_value, $condition_name, $condition_value ) {
     db_update($table)
      ->fields(array( $field_name => $field_value,))
      ->condition($condition_name, $condition_value, '=')
      ->execute();
  }

  /**
   * Insert field to DB. Create chat room.
   * DB request.
   *
   * @param $table  * table name.
   * @param $room   * Chat room ID --> $nid-$buyer.
   * @param $seller * Seller ID.
   * @param $buyer  * Buyer ID.
   * @param $nid    * Node ID
   *
   * Arbitrage ID --> default.
   *
   * @throws \Exception
   */
  public static function dmChatCreateRoom($table, $room, $seller, $buyer, $nid) {
    db_insert($table)
    ->fields(array(
      'room' => $room,
      'seller' => $seller,
      'buyer' => $buyer,
      'arbitrage' => NULL,
      'nid' => $nid,
    ))
      ->execute();
  }

  /**
   * Insert field to DB. Create chat room.
   * DB request.
   *
   * @param $table       * Table name.
   * @param $message_id  * Message ID (primary)
   * @param $uid         * Message author (INT).
   * @param $message     * Message body.
   * @param $room        * Chat room ID.
   * @param $timestamp        * Unix timestamp (INT).
   *
   * @throws \Exception
   */
  public static function dmChatCreateMessage($table, $message_id,  $uid, $message, $room, $timestamp, $type) {
    db_insert($table)
      ->fields([
        'message_id' => $message_id,
        'uid' => (int) $uid,
        'message' => $message,
        'dm_chat_room' => $room,
        'timestamp' => (int) $timestamp,
        'type' => $type,
      ])
      ->execute();
  }

  /**
   * Insert field to DB. Create chat room.
   * DB request.
   *
   * @param $table
   * @param $room
   * @param $uid
   * @param int $pin
   * @param int $archive
   * @param int $delete
   * @param int $viewed
   *
   * @throws \Exception
   */
  public static function dmChatCreateFieldEvent($table, $room, $uid, int $pin = 0, int $archive = 0, int $delete = 0, int $viewed = 0 ) {
    db_insert($table)
      ->fields([
        'room' => $room,
        'uid' => $uid,
        'pin' => $pin,
        'archive' => $archive,
        'delete' => $delete,
        'viewed' => $viewed,
      ])
      ->execute();
  }


  /**
   * Update value filed into table.
   *
   * @param $table            * Table name.
   * @param $field_name       * Field name for select.
   * @param $field_value      * Field value from table.
   * @param $condition_name   * Name field for condition.
   * @param $condition_value  * Value field for condition.
   */
  public static function dmChatUpdateEvent($table, $field_name, $field_value, $condition_name, $condition_value, $condition_name2, $condition_value2) {
    db_update($table)
      ->fields(array($field_name => $field_value,))
      ->condition($condition_name, $condition_value, '=')
      ->condition($condition_name2, $condition_value2, '=')
      ->execute();
  }

}

