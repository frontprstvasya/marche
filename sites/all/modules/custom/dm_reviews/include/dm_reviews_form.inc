<?php

/**
 * Form review.
 */
function dm_reviews_form(): array {

  /**
   * Build header for form.
   */
  //  $POST = ['nid' => '11033']; // admin
  //  $POST = ['nid' => '11041'];   // abubakar
  $POST = ['nid' => '11003'];   // some user

  $current_user = dm_reviews::dmReviewsGetCurrentUser();
  $nid = $POST['nid'];
  $nidObj = dm_reviews::dmReviewsGetObjNid($nid);
  $seller = $nidObj->uid;
  $uidObjSeller = dm_reviews::dmReviewsGetObjUid($seller);

  /* Name seller */
  $uidObjSeller->realname ? $nameSeller = $uidObjSeller->realname : $nameSeller = $uidObjSeller->name;

  /**
   * build FORM
   */
  $form = [
    '#prefix' => '<div id="review---wrapper">',
    '#suffix' => '</div>',
  ];

  $form['#attached']['css'][] = [
    'data' => drupal_get_path('module', 'dm_reviews') . '/css/dm-reviews.css',
    'type' => 'file',
  ];

  $form['#attached']['js'][] = [
    'data' => drupal_get_path('module', 'dm_reviews') . '/js/dm-reviews.js',
    'type' => 'file',
  ];

  $form['header'] = [
    '#markup' => '
      <div class="form-review-header">
        <div class="reviews-header--title">' . t('Écrire avis'). '</div>
        <div class="reviews-header--name-seller">' . t('Évaluez la coopération avec '). $nameSeller. '</div>
      </div>',
  ];
  $form['widget-rating'] = [
    '#markup' => '
      <div class="rating">
      <div class="rating-item icon-nm_17-star" data-rate="1"></div>
      <div class="rating-item icon-nm_17-star" data-rate="2"></div>
      <div class="rating-item icon-nm_17-star" data-rate="3"></div>
      <div class="rating-item icon-nm_17-star" data-rate="4"></div>
      <div class="rating-item icon-nm_17-star" data-rate="5"></div>
      </div>',
  ];

  $form['rating'] = [
    '#type' => 'hidden',
    '#attributes' => ['id' => ['input--rating']],
    '#required' => TRUE,
  ];

  $form['review']= [
    '#type' => 'textarea',
    '#maxlength' => 800,
    '#attributes' => ['placeholder' => t('Ajoutez un commentaire')],
    '#description' => t('Longueur maximale 800 caractères'),
    '#required' => TRUE,
  ];

  /** Assign to variable for transfer to validate or submit */
  $form['nid']['#value'] = $nid;
  $form['current_id']['#value'] = $current_user;
  $form['seller']['#value'] = $seller;

  $form['submit'] = [
    '#type' => 'submit',
    '#value' => t('Envoyer'),
    '#name' => 'submit',
  ];

  return $form;
}

/**
 * Form validate callback.
 */
function dm_reviews_form_validate($form, &$form_state) {

  $current_id = $form['current_id']['#value'];
  $seller = $form['seller']['#value'];

  /* Validation cannot leave feedback to yourself */
  if($current_id === $seller){
    form_set_error('error', t('Vous ne pouvez pas vous laisser de commentaires!'));
  }

  /* Validation hidden field on not empty */
  foreach ($form_state['values'] as $name => $value){
      if(empty($value)){
        drupal_set_message($name . t(' nécessaire pour remplir'), 'error');
      }
  }

  /* Validation hidden field on numeric true */
  $rating_valid = $form_state['values']['rating'];
  if(!is_numeric($rating_valid)){
    drupal_set_message(t('La note doit être un nombre'),'error');
  }
}

/**
 * Form submit callback.
 *
 * @throws \Exception
 */
function dm_reviews_form_submit(&$form, &$form_state): array {

  $nid = $form['nid']['#value'];
  $current_id = $form['current_id']['#value'];
  $seller = $form['seller']['#value'];

  $grade = $form_state['input']['rating'];
  $review = $form_state['input']['review'];

  $select_rating = dm_reviews::dmReviewsSelectRatingUser($seller);

  /* Create review */
  dm_reviews::dmReviewsCreateFeedback($nid, $current_id, $grade, $review);

  if($select_rating == FALSE) {
      dm_reviews::dmReviewsCreateRating($seller, 1, $grade);
  }else{
    dm_reviews::dmReviewsUpdateRating($seller, intval($select_rating->count), $select_rating->rating, $grade);
  }

  drupal_set_message(t('Merci pour vos commentaires'));
  return $form;
}


