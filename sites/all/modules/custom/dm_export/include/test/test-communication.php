<?php
/**
 * Export Communication.
 */

/* TABLE NAME */
$name_table_communication = 'field_data_field_communication';
$name_table_revision_communication = 'field_revision_field_communication';

/* FIELDS */
$communication_fields  = [ 'entity_type', 'bundle', 'deleted', 'entity_id', 'revision_id', 'language', 'delta', 'field_communication_tid'];

/**
 *  Entity_id && revision_id == uid.
 */
/****************************************************************************************************************************************************************/
$communication = [
  0 => [
    'entity_id' => '500',
    'revision_id' => '500',
    'entity_type' => 'node',
    'bundle' => 'submit_an_ad',
    'deleted' => '0',
    'language' => 'und',
    'delta' => '0',
    'field_communication_tid' => '25',
  ],
];
