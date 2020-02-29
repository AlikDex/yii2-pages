<?php

use Adx\Tinymce\Tinymce;
use yii\widgets\ActiveForm;

?>

<?php $form = ActiveForm::begin([
    'id' => 'page-form',
]) ?>

    <div class="row">
          <div class="col-md-6">
          <?= $form->field($pageForm, 'title')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($pageForm, 'meta_title')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <div class="row">
          <div class="col-md-6">
            <?= $form->field($pageForm, 'slug')
                ->textInput(['maxlength' => true])
                ->hint('Оставить пустым для автоматической генерации. Должен быть уникальным.') ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($pageForm, 'meta_description')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <div class="row">
          <div class="col-md-12">
              <?= $form->field($pageForm, 'content')->widget(Tinymce::class, [
                'options' => ['rows' => 16],
                'clientOptions' => [
                    'plugins' => [
                        'advlist autolink lists link charmap print preview anchor',
                        'searchreplace visualblocks code fullscreen',
                        'insertdatetime media table contextmenu paste',
                        'textpattern',
                    ],
                    'toolbar' => 'undo redo | styleselect | bold italic underline strikethrough | fontselect fontsizeselect forecolor backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media pageembed | removeformat',
                    'convert_urls' => false,
                ],
            ]) ?>
        </div>
    </div>

    <div class="row">
          <div class="col-md-3">
            <?= $form->field($pageForm, 'template')->textInput(['maxlength' => true])->hint('Шаблон страницы (название. e.g. about).') ?>
        </div>
    </div>

    <?= $form->field($pageForm, 'comment')->textInput(['maxlength' => true])->hint('Небольшая заметка по странице.') ?>

    <?= $form->field($pageForm, 'noindex')->checkbox(['label' => 'Запретить индексацию поисковыми роботами.']) ?>

    <?= $form->field($pageForm, 'nofollow')->checkbox(['label' => 'Запретить  переход по ссылкам поисковым роботам.']) ?>

    <?= $form->field($pageForm, 'enabled')->checkbox(['label' => 'Разрешить показ.']) ?>

<?php ActiveForm::end() ?>
