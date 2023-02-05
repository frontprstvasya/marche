<?php if (isset($form['step_number'])): ?>
    <?php if($form['step_number']['#value']==1): ?>
        <h2 class="messente_title_step messente-form-h2"><?php print t("Via email"); ?><span class="register--close--btn"  onclick="getLocationIndex()"></span></h2>
    <?php endif; ?>

    <?php if($form['step_number']['#value']==2): ?>
        <h2 class="messente_title_step"><?php print t("Authorisation code"); ?><span class="register--close--btn"  onclick="getLocationIndex()"></span></h2>

    <?php endif; ?>

    <?php if($form['step_number']['#value']==3): ?>
        <h2 class="messente_title_step registration-congrats"><?php print t("Congratulation! You've created the account"); ?><span class="register--close--btn"  onclick="getLocationIndex()"></span></h2>
    <?php endif; ?>

<?php endif; ?>
<?php if(isset( $form['actions']['request_code'])):
    $form['actions']['request_code']['#value']=t("Envoyer un nouveau code");
    ?>
<?php endif; ?>

<div class="parent-div">
    <div id="div_chilgren_" class="div_chilgren"><?php print drupal_render_children($form); ?>
        <?php if($form['step_number']['#value']==2): ?><a id="back-to-change-number" href="#">Pas de SMS?</a><?php endif; ?>
    </div>
</div>

<script>
    function getLocationIndex(){
        window.location.href ='/';
    }
</script>

