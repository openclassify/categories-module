<?php

use Anomaly\Streams\Platform\Database\Migration\Migration;

class VisiosoftModuleCategoriesAddXategoryLevels extends Migration
{

    protected $stream = [
        'slug' => 'category',
    ];

    protected $fields = [
        'level_at' => 'anomaly.field_type.integer',
        'level' => [
            'type' => 'anomaly.field_type.integer',
            'config' => [
                'default_value' => 0
            ],
        ],
    ];

    protected $assignments = [
        'level_at',
        'level',
    ];
}
