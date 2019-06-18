<?php

use yii\helpers\Url;
use yii\helpers\Html;
use Adx\Tinymce\Tinymce;
use yii\widgets\ActiveForm;

?>

<?php $form = ActiveForm::begin([
	'id' => 'page-form',
]) ?>

	<?= $form->field($pageForm, 'title')->textInput(['maxlength' => true]) ?>

	<?= $form->field($pageForm, 'slug')->textInput(['maxlength' => true]) ?>

	<?= $form->field($pageForm, 'meta_title')->textInput(['maxlength' => true]) ?>

	<?= $form->field($pageForm, 'meta_description')->textInput(['maxlength' => true]) ?>

	<?= $form->field($pageForm, 'content')->widget(Tinymce::class, [
		'options' => ['rows' => 16],
		'clientOptions' => [
			'plugins' => [
				'advlist autolink lists link charmap print preview anchor',
				'searchreplace visualblocks code fullscreen',
				'insertdatetime media table contextmenu paste',
				'textpattern'
			],
			'toolbar' => 'undo redo | styleselect | bold italic underline strikethrough | fontselect fontsizeselect forecolor backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media pageembed | removeformat',
		]
	]);?>

	<?= $form->field($pageForm, 'template')->textInput(['maxlength' => true]) ?>

	<?= $form->field($pageForm, 'comment')->textInput(['maxlength' => true]) ?>

	<?= $form->field($pageForm, 'noindex')->checkbox() ?>

	<?= $form->field($pageForm, 'nofollow')->checkbox() ?>

	<?= $form->field($pageForm, 'enabled')->checkbox() ?>

<?php ActiveForm::end() ?>