<?php

use yii\helpers\Url;
use yii\helpers\Html;

$this->title = 'Pages';
$this->params['subtitle'] = 'Update';

$this->params['breadcrumbs'][] = ['label' => $this->title, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->params['subtitle'];

?>


<div class="box box-primary">
    <div class="box-header with-border">
        <i class="fa fa-edit text-blue"></i><h3 class="box-title">Update</h3>
        <div class="box-tools pull-right">
            <div class="btn-group">
                <?= Html::a('<i class="fa fa-plus text-green"></i> Add', ['create'], ['class' => 'btn btn-default btn-sm', 'title' => 'Add']) ?>
                <?= Html::a('<i class="fa fa-info-circle" style="color:#337ab7;"></i> Info', ['view', 'id' => $page->getId()], ['class' => 'btn btn-default btn-sm', 'title' => 'Информация о странице']) ?>
                <?= Html::a('<i class="fa fa-trash-o text-red"></i> Delete', ['delete', 'id' => $page->getId()], [
                    'class' => 'btn btn-default btn-sm',
                    'title' => 'Удалить страницу',
                    'data' => [
                        'confirm' => 'Действительно хотите удалить эту страницу?',
                        'method' => 'post',
                    ],
                ]) ?>
            </div>
        </div>
    </div>

    <div class="box-body pad">
        <?= $this->render('_form', [
            'pageForm' => $pageForm,
        ]) ?>
    </div>

    <div class="box-footer clearfix">
        <?= Html::submitButton('Update', ['class' => 'btn btn-primary', 'form' => 'page-form']) ?>
    </div>
</div>
