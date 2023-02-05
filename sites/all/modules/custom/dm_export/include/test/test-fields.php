<?php
/**
 * Export NODE FIELDS.
 */

/* TABLE NAME */
$name_table_price = 'field_data_field_price';
$name_table_price_revision = 'field_revision_field_price';

$name_table_categories = 'field_data_field_categories';
$name_table_categories_revision = 'field_revision_field_categories';

$name_table_sub_categories = 'field_data_field_sub_categories';
$name_table_sub_categories_revision = 'field_revision_field_sub_categories';

$name_table_type_ad = 'field_data_field_type_ad';
$name_table_type_ad_revision = 'field_revision_field_type_ad';

$name_table_views_gallery = 'field_data_field_views_gallery';
$name_table_views_gallery_revision = 'field_revision_field_views_gallery';

$name_table_btn_call = 'field_data_field_btn_call';
$name_table_btn_call_revision = 'field_revision_field_btn_call';

$name_table_btn_chat = 'field_data_field_btn_chat';
$name_table_btn_chat_revision = 'field_revision_field_btn_chat';

$name_table_btn_whatsapp = 'field_data_field_btn_whatsapp';
$name_table_btn_whatsapp_revision = 'field_revision_field_btn_whatsapp';

$name_table_location = 'field_data_field_location';
$name_table_location_revision = 'field_revision_field_location';
$name_table_location_2 = 'field_data_field_location_2';
$name_table_location_2_revision = 'field_revision_field_location_2';

$name_table_author_info = 'field_data_field_author_info';
$name_table_author_info_revision = 'field_revision_field_author_info';

$name_table_description = 'field_data_field_description';
$name_table_description_revision = 'field_revision_field_description';


/* FIELDS */
$price_fields          = [ 'entity_type', 'bundle', 'deleted', 'entity_id', 'revision_id', 'language', 'delta', 'field_price_value'];
$categories_fields     = [ 'entity_type', 'bundle', 'deleted', 'entity_id', 'revision_id', 'language', 'delta', 'field_categories_tid'];
$sub_categories_fields = [ 'entity_type', 'bundle', 'deleted', 'entity_id', 'revision_id', 'language', 'delta', 'field_sub_categories_tid'];
$type_ad_fields        = [ 'entity_type', 'bundle', 'deleted', 'entity_id', 'revision_id', 'language', 'delta', 'field_type_ad_tid'];
$views_gallery_fields  = [ 'entity_type', 'bundle', 'deleted', 'entity_id', 'revision_id', 'language', 'delta', 'field_views_gallery_view_id', 'field_views_gallery_arguments'];
$btn_call_fields       = [ 'entity_type', 'bundle', 'deleted', 'entity_id', 'revision_id', 'language', 'delta', 'field_btn_call_value', 'field_btn_call_format'];
$btn_chat_fields       = [ 'entity_type', 'bundle', 'deleted', 'entity_id', 'revision_id', 'language', 'delta', 'field_btn_chat_value', 'field_btn_chat_format'];
$btn_whatsapp_fields   = [ 'entity_type', 'bundle', 'deleted', 'entity_id', 'revision_id', 'language', 'delta', 'field_btn_whatsapp_value', 'field_btn_whatsapp_format'];
$location_fields       = [ 'entity_type', 'bundle', 'deleted', 'entity_id', 'revision_id', 'language', 'delta', 'field_location_tid'];
$location_2_fields     = [ 'entity_type', 'bundle', 'deleted', 'entity_id', 'revision_id', 'language', 'delta', 'field_location_2_value', 'field_location_2_format'];
$author_info_fields    = [ 'entity_type', 'bundle', 'deleted', 'entity_id', 'revision_id', 'language', 'delta', 'field_author_info_view_id', 'field_author_info_arguments'];
$description_fields    = [ 'entity_type', 'bundle', 'deleted', 'entity_id', 'revision_id', 'language', 'delta', 'field_description_value', 'field_description_format'];

/**
 *   nid == entity_id == revision_id.
 *
 * STATIC VALUE:
 *  field_views_gallery_view_id == 'views_slideshow_ad:block',
 *  field_views_gallery_arguments
 *  field_btn_call_value
 *  field_btn_call_format
 *  field_author_info_view_id = 'views_author_info:block'
 *  field_author_info_arguments = NULL
 */

$fields = [
  0 =>
    [
      'entity_id' => '500',
      'revision_id' => '500',
      'entity_type' => 'node',
      'bundle' => 'submit_an_ad',
      'deleted' => '0',
      'language' => 'und',
      'delta' => '0',
      'field_price_value' => '20000',
      'field_categories_tid' => '11',
      'field_sub_categories_tid' => '143',
      'field_type_ad_tid' => '19',
      'field_views_gallery_view_id' => 'views_slideshow_ad:block',
      'field_views_gallery_arguments' => 'NULL',
      'field_btn_call_value' => 'Appelez',
      'field_btn_chat_value' => 'Écrivez',
      'field_btn_whatsapp_value' => 'Whatsapp',
      'field_btn_call_format' => 'NULL',
      'field_btn_chat_format' => 'NULL',
      'field_btn_whatsapp_format' => 'NULL',
      'field_location_tid' => '65',
      'field_location_2_value' => '-',
      'field_location_2_format' => 'NULL',
      'field_author_info_view_id' => 'views_author_info:block',
      'field_author_info_arguments' => 'NULL',
      'field_description_value' => 'Greffe brésilienne water wave taille 12, 14,16,18 peignable couleur noir. Vente en ligne je répète vente en ligne je fais les livraisons ',
      'field_description_format' => 'filtered_html',
    ],
  ];
