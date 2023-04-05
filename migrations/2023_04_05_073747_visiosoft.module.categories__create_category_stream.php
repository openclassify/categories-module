<?php

use Anomaly\Streams\Platform\Database\Migration\Migration;

class VisiosoftModuleCategoriesCreateCategoryStream extends Migration
{
    protected $delete = false;

    protected $stream = [
        'slug' => 'category',
        'title_column' => 'name',
        'translatable' => true,
        'versionable' => false,
        'trashable' => true,
        'searchable' => true,
        'sortable' => true,
    ];

    protected $fields = [
        'name' => 'anomaly.field_type.text',
        'slug' => [
            'type' => 'anomaly.field_type.slug',
            'config' => [
                'slugify' => 'name',
                'type' => '-'
            ],
        ],
        'meta_title'       => 'anomaly.field_type.text',
        'meta_description' => 'anomaly.field_type.textarea',
        'meta_keywords'    => 'anomaly.field_type.tags',
    ];

    /**
     * The stream assignments.
     *
     * @var array
     */
    protected $assignments = [
        'name' => [
            'translatable' => true,
            'required' => true,
            'searchable' => true,
        ],
        'slug' => [
            'unique' => true,
            'required' => true,
            'searchable' => true,
        ],
        'meta_title' => [
            'searchable' => true,
            'translatable' => true,
        ],
        'meta_description' => [
            'searchable' => true,
            'translatable' => true,
        ],
        'meta_keywords' => [
            'searchable' => true,
            'translatable' => true,
        ],
    ];
}
