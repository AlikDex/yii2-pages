<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\grid\ActionColumn;
use yii\widgets\LinkPager;

$pageTitleSuffix = ($page > 1) ? Yii::t('app', 'page_suffix', ['page' => $page]) : '';

$this->title = 'Custom pages';
$this->params['subtitle'] = 'List';

$this->params['breadcrumbs'][] = $this->title;

?>

<div class="box box-default">
	<div class="box-header with-border">
		<i class="fa fa-list"></i><h3 class="box-title">List</h3>
		<div class="box-tools pull-right">
			<div class="btn-group">
				<?= Html::a('<i class="fa fa-plus text-green"></i> Add', ['create'], ['class' => 'btn btn-default btn-sm', 'title' => 'Add']) ?>
			</div>
		</div>
    </div>

    <div class="box-body pad">

		<div class="table-actions-bar">
			<div class="btn-group" style="margin: 5px 0;"></div>

			<?= LinkPager::widget([
			    'pagination' => $dataProvider->pagination,
		    	'lastPageLabel' => '>>',
		    	'firstPageLabel' => '<<',
		    	'maxButtonCount' => 7,
			    'options' => [
			    	'class' => 'pagination pagination-sm no-margin pull-right',
			    ],
			]) ?>
		</div>

	    <?= GridView::widget([
	        'dataProvider' => $dataProvider,
	        'layout'=>"{summary}\n{items}",
	        'id' => 'list-pages',
	        'options' => [
	        	'class' => 'grid-view table-responsive',
	        ],
	        'columns' => [
	            [
	            	'attribute' => 'page_id',
	            	'label' => Yii::t('pages', 'id'),
	        		'options' => [
	        			'style' => 'width:70px',
	        		],
				],
				[
	            	'attribute' => 'title',
	            	'label' => Yii::t('pages', 'title'),
	            	'value' => function ($page) {
	            		return Html::a($page->getTitle(), ['update', 'id' => $page->getId()]);
					},
					'format' => 'raw',
	            ],
	            'comment:ntext',
				'noindex',
				'nofollow',
	            'enabled',
	            [
					'class' => ActionColumn::class,
					'options' => [
	        			'style' => 'width:85px',
	        		],
				],
	        ],
	    ]) ?>

		<div class="table-actions-bar">
			<div class="btn-group dropup" style="margin: 5px 0;"></div>

			<?= LinkPager::widget([
			    'pagination' => $dataProvider->pagination,
		    	'lastPageLabel' => '>>',
		    	'firstPageLabel' => '<<',
		    	'maxButtonCount' => 7,
			    'options' => [
			    	'class' => 'pagination pagination-sm no-margin pull-right',
			    ],
			]) ?>
		</div>

	</div>

</div>
