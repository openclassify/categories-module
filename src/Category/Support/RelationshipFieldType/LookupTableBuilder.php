<?php namespace Visiosoft\CategoriesModule\Category\Support\RelationshipFieldType;

use Illuminate\Database\Eloquent\Builder;

class LookupTableBuilder extends \Anomaly\RelationshipFieldType\Table\LookupTableBuilder
{
    protected $columns = [
        'name',
    ];

    public function onQuerying(Builder $query)
    {
        if (request('parent')) {
            $query->where('parent_category_id', request('parent'));
        } else {
            $query->where('parent_category_id', NULL);
        }
    }
}
