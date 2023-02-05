<h2 class="messente-form-h2"><?php print t('Password recovery'); ?></h2>
<?php if (isset($form['step_number'])): ?>
    <div class="step_box">
        <div class="step<?php if($form['step_number']['#value']==1): ?> active <?php endif; ?><?php if($form['step_number']['#value']>1): ?> passed <?php endif; ?>">
           
        </div>
        <?php if($form['step_number']['#value']==2): ?>
        <h2><?php print t("Casser le mot de passe"); ?><span class="required-field-sign">*</span></h2>

  <?php endif; ?>

        <div class="step<?php if($form['step_number']['#value']==3): ?> active <?php endif; ?>">
       
        </div>
    </div>
<?php endif; ?>
<?php if (isset($form['phone_and_mail'])): ?>
    <div class="parent-div">
        <div class="div_chilgren"><?php print drupal_render_children($form); ?></div>
    </div>
<?php endif; ?>




