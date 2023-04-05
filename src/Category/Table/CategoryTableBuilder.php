<?php namespace Visiosoft\CategoriesModule\Category\Table;

use Anomaly\Streams\Platform\Ui\Table\TableBuilder;
use Illuminate\Database\Eloquent\Builder;

class CategoryTableBuilder extends TableBuilder
{

    public function onQuerying(Builder $query)
    {
        if (request('parent')) {
            $query->where('parent_category_id', request('parent'));
        } else {
            $query->where('parent_category_id', NULL);
        }
    }


    /**
     * The table views.
     *
     * @var array|string
     */
    protected $views = [];

    /**
     * The table filters.
     *
     * @var array|string
     */
    protected $filters = [];

    /**
     * The table columns.
     *
     * @var array|string
     */
    protected $columns = [];

    /**
     * The table buttons.
     *
     * @var array|string
     */
    protected $buttons = [
        'edit',
        'add_sub_category' => [
            'type' => 'success',
            'icon' => 'fa fa-plus',
            'href' => '/admin/categories/category/create?parent={entry.id}'
        ],
        'show_sub_categories' => [
            'type' => 'info',
            'icon' => 'fa fa-th-list',
            'href' => '/admin/categories/category?parent={entry.id}'
        ],
    ];

    /**
     * The table actions.
     *
     * @var array|string
     */
    protected $actions = [
        'delete'
    ];

    /**
     * The table options.
     *
     * @var array
     */
//    protected $options = [
//        'heading' => 'visiosoft.module.categories::partials/category/heading'
//    ];

    /**
     * The table assets.
     *
     * @var array
     */
    protected $assets = [];

}
