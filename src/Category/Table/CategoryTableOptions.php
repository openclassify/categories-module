<?php namespace Visiosoft\CategoriesModule\Category\Table;

class CategoryTableOptions
{
    public function handle(CategoryTableBuilder $builder)
    {
        $options = [];

        if (request('parent') && $parent = app($builder->getModel())->find(request('parent'))) {
            $options['heading'] = 'visiosoft.module.categories::admin/category/heading';
            $options['parent'] = $parent;
        }

        $builder->setOptions($options);
    }
}
