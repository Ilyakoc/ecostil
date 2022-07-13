<?php
/**
 * Файл настроек модели
 */

use common\components\helpers\HYii as Y;

return [
    'class' => 'Article',
    'menu' => [
        'backend' => ['label' => 'Статьи']
    ],
    'buttons' => [
        'create' => ['label' => 'Добавить'],
    ],
    'controllerFilters'=>[
        ['DModuleFilter', 'name'=>'articles']
    ],
    'crud' => [
        'index' => [
            'url' => '/cp/crud/index',
            'title' => 'Статьи',
            'gridView' => [
                'dataProvider' => [
                    'criteria' => [
                        'select' => 'id, title, intro, preview_image, sort, published',
                    ],
                    'sort'=>['defaultOrder'=>'sort DESC']
                ],
                'emptyText'=>'Статей нет',
                'summaryText'=>'Статьи {start} &mdash; {end} из {count}',
                'columns' => [
                    [
                        'name'=>'id',
                        'header'=>'#',
                        'headerHtmlOptions'=>['style'=>'width:5%']
                    ],
                    [
                        'name'=>'preview_image',
                        'type'=>[
                            'common.ext.file.image'=>[
                                'behaviorName'=>'mainImageBehavior',
                                'width'=>120,
                                'height'=>120,
                                'proportional'=>true,
                                'htmlOptions'=>[],
                                'default'=>true
                            ]
                        ],
                        'headerHtmlOptions'=>['style'=>'width:15%']
                    ],
                    [
                        'type'=>'column.title',
                        'info'=>[
                            'Анонс'=>'strip_tags($data->intro)'
                        ]
                    ],
                    'common.ext.sort',
                    [
                        'name'=>'published',
                        'header'=>'Опубл.',
                        'headerHtmlOptions'=>['style'=>'width:5%;text-align:center;white-space:nowrap;'],
                        'type'=>'common.ext.published'
                    ],
                    'crud.buttons'
                ]
            ]
        ],
        'create' => [
            'url' => '/cp/crud/create',
            'title' => 'Добавление',
        ],
        'update' => [
            'url' => ['/cp/crud/update'],
            'title' => 'Редактирование',
        ],
        'delete' => [
            'url' => ['/cp/crud/delete'],
        ],
        'form' => [
            'htmlOptions'=>['enctype'=>'multipart/form-data'],
        ],
        'tabs'=>[
            'main'=>[
                'title'=>'Основные',
                'attributes'=>[
                    'published' => 'checkbox',
                    'sort'=>[
                        'type'=>'number',
                        'params'=>['htmlOptions'=>['class'=>'form-control w10']]
                    ],
                    'create_time'=>'date',
                    'title',
                    'alias' => 'alias',
                    'image'=>[
                        'type'=>'common.ext.file.image',
                        'behaviorName'=>'mainImageBehavior',
                        'params'=>[
                            // 'actionDelete'=>\Yii::app()->getController()->createAction('removeImage'), // необязательно, по умолчанию /crud/admin/default/removeImage
                            'tmbWidth'=>-1,
                            'tmbHeight'=>-1,
                        ]
                    ],
                    'intro'=>'tinyMce.lite',
                    'text'=>'tinyMce',
                ]
            ],
            'seo'=>[
                'title'=>'SEO',
                'attributes'=>[
                    'meta_h1',
                    'meta_title',
                    'meta_key',
                    'meta_desc'
                ]
            ]
        ]
    ],
];