<?php if (isset($form['step_number'])): ?>
    <?php if($form['step_number']['#value']==1): ?>
        <h2><?php print t("Via email"); ?><span class="register--close--btn"  onclick="getLocationIndex()"></span></h2>
    <?php endif; ?>

    <?php if($form['step_number']['#value']==2): ?>
        <h2><?php print t("Authorisation code"); ?><span class="register--close--btn"  onclick="getLocationIndex()"></span></h2>

    <?php endif; ?>

    <?php if($form['step_number']['#value']==3): ?>
        <h2><?php print t("Let's get acquainted"); ?><span class="register--close--btn"  onclick="getLocationIndex()"></span></h2>
    <?php endif; ?>

<?php endif; ?>


<div class="parent-div">
    <div class="div_chilgren"><?php print drupal_render_children($form); ?></div>
</div>

<script>
    function getLocationIndex(){
        window.location.href ='/';
    }
</script>

