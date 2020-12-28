<?php 
/**
 * @var $this \app\core\View
 * @var $model \app\model\ContactForm
 */

use app\core\form\TextareaField;

$this->title = 'Contact';
?>

<h1>Contact us</h1>

<?php $form = \app\core\form\Form::begin('', 'post') ?>
<?= $form->field($model, 'subject')?>
<?= $form->field($model, 'email')?>
<?= new TextareaField($model, 'body'); ?>
<button type="submit" class="btn btn-outline-primary mt-3">Submit</button>
<?php $form = \app\core\form\Form::end() ?>
