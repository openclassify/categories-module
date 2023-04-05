<?php

return [
    'related'    => [
        'required' => true,
        'type'     => 'anomaly.field_type.select',
        'config'   => [
            'handler' => \Anomaly\RelationshipFieldType\Support\Config\RelatedHandler::class,
        ],
    ],
    'level' => [
        'required' => true,
        'type' => 'anomaly.field_type.integer',
    ],
];
