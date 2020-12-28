<?php 
/** @var $model \app\model\User */
?>

<h1>Create An Account</h1>

<?php $form = \app\core\form\Form::begin('', "post") ?>
    <div class="row">
        <div class="col-6"><?php echo $form->field($model, 'firstname')?></div>
        <div class="col-6"><?php echo $form->field($model, 'lastname')?></div>
    </div>
    <?php echo $form->field($model, 'email')?>
    <?php echo $form->field($model, 'pwd')->passwordField() ?>
    <?php echo $form->field($model, 'confirmPwd')->passwordField() ?>

    <button type="submit" class="btn btn-outline-primary mt-3">Submit</button>
<?php \app\core\form\Form::end() ?>