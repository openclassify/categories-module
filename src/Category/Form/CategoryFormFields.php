<?php namespace Visiosoft\CategoriesModule\Category\Form;

use Anomaly\Streams\Platform\Ui\Form\FormBuilder;

class CategoryFormFields
{
    public function handle(CategoryFormBuilder $builder)
    {
        $fields = [
            'name',
            'slug'
        ];

        if ($builder->getFormMode() == 'edit') {
            if ($builder->getFormEntryId()) {
                $entry = $builder->getFormEntry();
                if ($entry->parent_category_id) {
                    $fields = array_merge($fields,[
                        'parent_category' => [
                            'value' => $entry->parent_category_id,
                            'readonly' => true,
                            'disabled' => true,
                        ],
                    ]);
                }
            }
        } else {
            if (request('parent') && $parent_category = app($builder->getModel())->find(request('parent'))) {
                $fields = array_merge($fields,[
                    'parent_category' => [
                        'value' => $parent_category->id,
                        'readonly' => true,
                        'disabled' => true,
                    ],
                ]);
            }
        }


        $builder->setFields($fields);
    }
}
