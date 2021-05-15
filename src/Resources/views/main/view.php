<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\DetailView;

$this->title = 'Pages';
$this->params['subtitle'] = 'Information';

$this->params['breadcrumbs'][] = ['label' => $this->title, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->params['subtitle'];

?>


<div class="box box-primary">
	<div class="box-header with-border">
		<i class="fa fa-info-circle" style="color:#337ab7;"></i><h3 class="box-title">Information</h3>
		<div class="box-tools pull-right">
			<div class="btn-group">
				<?= Html::a('<i class="fa fa-plus text-green"></i> Add', ['create'], ['class' => 'btn btn-default btn-sm', 'title' => 'Add']) ?>
				<?= Html::a('<i class="fa fa-edit text-blue"></i> Update', ['update', 'id' => $page->getId()], ['class' => 'btn btn-default btn-sm', 'title' => 'Update']) ?>
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
	    <?= DetailView::widget([
	        'model' => $page,
	        'attributes' => [
				'page_id',
				'title:ntext',
				'slug:ntext',
				'meta_title:ntext',
				'meta_description:ntext',
				'content:raw',
	            'template:ntext',
				'comment:ntext',
				'noindex',
				'nofollow',
				'enabled',
				'updated_at:datetime',
	            'created_at:datetime',
	        ],
	    ]) ?>
	</div>
</div>
