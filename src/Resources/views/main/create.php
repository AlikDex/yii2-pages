<?php

use yii\helpers\Url;
use yii\helpers\Html;

$this->title = 'Pages';
$this->params['subtitle'] = 'Create';

$this->params['breadcrumbs'][] = ['label' => $this->title, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->params['subtitle'];

?>


<div class="box box-primary">
    <div class="box-header with-border">
        <i class="fa fa-plus text-green"></i><h3 class="box-title">Create</h3>
        <div class="box-tools pull-right">
            <div class="btn-group">
                <?= Html::a('<i class="fa fa-plus text-green"></i> Add', ['create'], ['class' => 'btn btn-default btn-sm', 'title' => 'Add']) ?>
            </div>
        </div>
    </div>

    <div class="box-body pad">
        <?= $this->render('_form', [
            'pageForm' => $pageForm,
        ]) ?>
    </div>

    <div class="box-footer clearfix">
        <?= Html::submitButton('Create', ['class' => 'btn btn-success', 'form' => 'page-form']) ?>
    </div>
</div>
