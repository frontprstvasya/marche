<?php
/**
 * Class for module DM reviews.
 */

class dm_reviews {

  /**
   * GEt current ID.
   */
  public static function dmReviewsGetCurrentUser() {
    global $user;
    return $user->uid;
  }

  /**
   * GEt object NID.
   */
  public static function dmReviewsGetObjNid($nid) {
    if ($nid) {
      return node_load($nid);
    }
  }

  /**
   * GEt object UID.
   */
  public static function dmReviewsGetObjUid($uid) {
    if ($uid) {
      return user_load($uid);
    }
  }

  /**
   * Create field in table (dm_reviews).
   *
   * @param $nid     * NID.
   * @param $buyer   * User buyer.
   * @param $grade   * Grade review.
   * @param $review  * Text review.
   *
   * @throws \Exception
   */
  public static function dmReviewsCreateFeedback($nid, $buyer, $grade, $review) {
    db_insert('dm_reviews')
      ->fields(array(
        'nid' => $nid,
        'buyer' => $buyer,
        'grade' => $grade,
        'review' => $review,
        'timestamp' => time(),
      ))->execute();
  }

  /**
   * Checking field availability user rating.
   *
   * @param $seller * (UID seller).
   *
   * @return mixed
   */
  public static function dmReviewsSelectRatingUser($seller) {
    $rating = db_select('dm_reviews_user_rating', 'n')
      ->condition('n.uid', $seller)
      ->fields('n',array('count', 'rating'))
      ->execute()
      ->fetchObject();

    if($rating){
      return $rating;
    }else{
      return FALSE;
    }
  }

  /**
   * Checking field availability feedback.
   *
   * @param $bayer * (UID bayer).
   *
   * @return mixed
   */
  public static function dmReviewsSelectFeedback($bayer) {
    $rating = db_select('dm_reviews', 'n')
      ->condition('n.buyer', $bayer)
      ->fields('n',array('rid', 'nid', 'grade', 'review', 'timestamp'))
      ->execute()
      ->fetchObject();

    if($rating){
      return $rating;
    }else{
      return FALSE;
    }
  }

  /**
   *  Create field in table (dm_reviews_user_rating).
   *
   * @throws \Exception
   */
  public static function dmReviewsCreateRating($seller, $count, $rating) {
    db_insert('dm_reviews_user_rating')
      ->fields(array(
        'uid' => $seller,
        'count' => $count,
        'rating' => $rating,
      ))->execute();
  }

  /**
   * Update  field in table (dm_reviews_user_rating).
   *
   * @param $seller * Seller uid.
   * @param $count  * Old count from table.
   * @param $rating * General rating from table.
   * @param $grade  * Current score.
   */
  public static function dmReviewsUpdateRating($seller, $count, $rating, $grade) {
    $count_up = $count + 1;
    $rating_up =  (($rating * $count) + $grade) / $count_up;

    db_update('dm_reviews_user_rating')
      ->fields(array(
        'count' => $count_up,
        'rating' => round($rating_up, 1),
      ))
      ->condition('uid', $seller, '=')
      ->execute();
  }


  /**
   *  Get count reviews.
   *
   * @param $value  * === nid add Author.
   *
   * @return mixed
   */
  public static function dmReviewsCountReviews($value) {
    return db_select('dm_reviews', 'n')
      ->condition('n.nid', $value)
      ->countQuery()
      ->execute()
      ->fetchField();
  }
}

