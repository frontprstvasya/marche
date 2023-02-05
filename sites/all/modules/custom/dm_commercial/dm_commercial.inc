<?php
class dm_commercial {

  /**
   *  Function get array nidList commercial page.
   *
   * @param $table // table name
   * @param $condition // Condition
   * @param $getValue // Getting value
   */

  public static function _getNidListNotSort($table, $condition, $getValue): array {
    $query = db_select($table,'n');
    $query->condition('n.type',$condition);
    $query->condition('n.status','1');
    $query->fields('n',array($getValue));
    $result=$query->execute();
    $nidList = [];

    while($list=$result->fetchAssoc()){
      array_push($nidList, $list['nid']);
    }
    return $nidList;

  }

  /**
   * Generate link (form API).
   *
   * @param $node * Object NODE getting in view template.
   * @param $class * Add className to link.
   * @param string $change_title * Fullness if change title link.
   *
   * @return array
   */
  public static function _buildLink($node, $class, string $change_title = '0'): array {
    /* Link */
    $link = $node->field_external_link['und'][0];
    if($change_title == '0'){
      $link_title = $link['title'];
    }else{
      $link_title = $change_title;
    }
    $link_url = $link['original_url'];

    $link = [
      '#type' => 'link',
      '#href' => $link_url,
      '#title' => $link_title,
    ];
    $link['#attributes'] = ['class' => [$class], 'target' => '_blank'];

    return $link;
  }
}

