<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<?php $form = ActiveForm::begin([
	'id' => 'page-form',
]) ?>

	<?= $form->field($pageForm, 'title')->textInput(['maxlength' => true]) ?>

	<?= $form->field($pageForm, 'slug')->textInput(['maxlength' => true]) ?>

	<?= $form->field($pageForm, 'meta_title')->textInput(['maxlength' => true]) ?>

	<?= $form->field($pageForm, 'meta_description')->textInput(['maxlength' => true]) ?>

	<?= $form->field($pageForm, 'content')->textarea(['rows' => 6]) ?>

	<?= $form->field($pageForm, 'template')->textInput(['maxlength' => true]) ?>

	<?= $form->field($pageForm, 'comment')->textInput(['maxlength' => true]) ?>

	<?= $form->field($pageForm, 'noindex')->checkbox() ?>

	<?= $form->field($pageForm, 'nofollow')->checkbox() ?>

	<?= $form->field($pageForm, 'enabled')->checkbox() ?>

<?php ActiveForm::end() ?>