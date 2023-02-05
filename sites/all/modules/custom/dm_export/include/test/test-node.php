<?php
/**
 * Export NODE & NODE_REVISION.
 */

/* TABLE NAME */
$name_table_node                     = 'node';
$name_table_node_revision            = 'node_revision';
$name_table_pathauto_state           = 'pathauto_state';
$name_table_node_comment_statistics  = 'node_comment_statistics';

/* FIELDS */
$node_fields                     = [ 'nid','vid', 'type', 'language', 'title', 'uid', 'status', 'created', 'changed', 'comment', 'promote', 'sticky', 'tnid', 'translate'];
$node_revision_fields            = [ 'nid','vid', 'uid','title', 'log', 'timestamp', 'status', 'comment', 'promote', 'sticky'];
$pathauto_state_fields           = [ 'entity_type','entity_id', 'pathauto'];
$node_comment_statistics_fields  = [ 'nid', 'cid', 'last_comment_timestamp', 'last_comment_name', 'comment_count'];

/**
 *   nid == vid
 *   changed == timestamp
 */

/****************************************************************************************************************************************************************/
$node =  [
  0 =>
    [
      'nid' => '500',
      'vid' => '500',
      'entity_id' => '500',
      'uid' => '18',
      'last_comment_uid' => '18',

      'type' => 'submit_an_ad',
      'language' => 'fr',
      'title' => 'Greffes brésilienne',
      'log' => '',
      'timestamp' => '1648483690',
      'status' => '1',
      'created' => '1648483578',
      'changed' => '1648483690',
      'comment' => '0',
      'promote' => '0',
      'sticky' => '0',
      'tnid' => '0',
      'translate' => '0',

      'entity_type' => 'node',
      'pathauto' => '1',

      'cid' => '0',
      'last_comment_timestamp' => '1648559080',
      'last_comment_name' => 'NULL',
      'comment_count' => '0',
    ],
  ];
