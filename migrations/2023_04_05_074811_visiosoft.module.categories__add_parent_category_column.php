<?php

use Anomaly\Streams\Platform\Database\Migration\Migration;

class VisiosoftModuleCategoriesAddParentCategoryColumn extends Migration
{

    protected $stream = [
        'slug' => 'category',
    ];

    protected $fields = [
        'parent_category' => [
            'type' => 'anomaly.field_type.relationship',
            'config' => [
                'related' => \Visiosoft\CategoriesModule\Category\CategoryModel::class,
                'mode' => 'lookup',
            ],
        ],
    ];

    protected $assignments = [
        'parent_category'
    ];
}
