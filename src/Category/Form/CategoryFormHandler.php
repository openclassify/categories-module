<?php namespace Visiosoft\CategoriesModule\Category\Form;

use Anomaly\Streams\Platform\Ui\Form\FormBuilder;

class CategoryFormHandler
{
    public function handle(CategoryFormBuilder $builder)
    {
        if (!$builder->canSave()) {
            return;
        }

        $builder->saveForm();

        if ($builder->getFormMode() == 'create') {
            $entry = $builder->getFormEntry();

            $entry->setAttribute('parent_category_id', request('parent', null));
            $entry->save();
        }
    }
}
