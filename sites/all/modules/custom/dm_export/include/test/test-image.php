<?php
/**
 * Export FILE_MANAGED && FIELD_DATA_FIELD_PHOTOS && FIELD_REVISION_FIELD_PHOTOS.
 */

/* TABLE NAME */
$name_table_file_managed                 = 'file_managed';
$name_table_field_data_field_photos      = 'field_data_field_photos';
$name_table_field_revision_field_photos  = 'field_revision_field_photos';

/* FIELDS */
$file_managed_fields            = [ 'fid','uid', 'filename', 'uri', 'filemime', 'filesize', 'status', 'timestamp', 'type'];
$field_data_field_photos_fields = [ 'entity_type','bundle', 'deleted', 'entity_id', 'revision_id', 'language', 'delta', 'field_photos_fid', 'field_photos_width', 'field_photos_height'];

/**
 *   fid == field_photos_fid
 *
 *  'name' => 'width', == field_photos_width
 *  'name' => 'height', == field_photos_height
 *
 *  entity_id && revision_id == NID from node.php
 *
 */
/****************************************************************************************************************************************************************/

$image =   [
  0 =>
    [
      'entity_id' => '500',
      'revision_id' => '500',
      'fid' => '300',
      'field_photos_fid' => '300',
      'uid' => '18',
      'filename' => '7.jpg',
      'uri' => 'public://img-gallery/7.jpg',

      'filemime' => 'image/jpeg',
      'status' => '1',
      'timestamp' => '1648483578',
      'type' => 'image',
      'entity_type' => 'node',
      'bundle' => 'submit_an_ad',
      'deleted' => '0',
      'language' => 'und',
      'delta' => '0',
      'field_photos_alt' => ' ',
      'field_photos_title' => 'NOT NULL',

      'filesize' => '1582097',
      'field_photos_width' => '2560',
      'field_photos_height' => '1707',
    ],
  ];
