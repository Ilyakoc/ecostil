<?php
/**
 * Конфигуарция поиска
 */
return [
    'queryname' => 'q',
    'minlength' => 3,
    'autocomplete' => [
    	'mark'=>true,
        'limit' => 20,
        'models' => [
            '\Product' => [
                'attributes' => ['code', 'title', 'description'],
                'criteria' => ['select'=>'id, code, title', 'scopes'=>'visibled'],
                'titleAttribute' => function($model) {
	                $title=$model->code ? "({$model->code}) {$model->title}" : $model->title;
					return \CHtml::link($model->title, ['/shop/product', 'id'=>$model->id]);
                }
            ],
        ]
    ],
    'search' => [
        'models' => [
			'\Product' => [
                'title' => 'Товары',
                'attributes' => ['title', 'description', 'code'],
                'criteria' => ['scopes'=>['cardColumns', 'visibled']],
				// 'strong_relevance_multiplier'=>4,
                'limit'=>42,
                'item' => [
                    'url' => function ($model) {
                        return \Yii::app()->createUrl('/shop/product', ['id'=>$model->id]);
                    }
                ],
				'wrapperOpen'=>'<div id="product-list-module">',
				'wrapperClose'=>'</div>',
				'listView'=>[
					'emptyText'=>'<div class="category-empty">Нет товаров для отображения.</div>',
					'itemView'=>'/shop/_products',
					'itemsCssClass'=>'t3__adaptive-product__list product-list row',
					'sortableAttributes'=>['title', 'price'],
					'template'=>'{sorter}{items}{pager}'
				]
            ],
            '\Event' => [
                'title' => 'Новости',
                'attributes' => ['title', 'text'],
                'criteria' => ['select'=>'id, title, intro'],
                'limit'=>1,
                'item' => [
                    'url' => function ($model) {
                        return \Yii::app()->createUrl('/site/event', ['id'=>$model->id]);
                    }
                ]
            ],
            '\Page' => [
                'title' => 'Страницы',
                'attributes' => ['title', 'text'],
                'criteria' => ['select'=>'id, title, intro'],
                'limit'=>1,
                'item' => [
                    'url' => function ($model) {
                        return \Yii::app()->createUrl('/site/page', ['id'=>$model->id]);
                    }
                ]
            ],
        ]
    ]
];
