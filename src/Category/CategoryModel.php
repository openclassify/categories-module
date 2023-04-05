<?php namespace Visiosoft\CategoriesModule\Category;

use Visiosoft\CategoriesModule\Category\Contract\CategoryInterface;
use Anomaly\Streams\Platform\Model\Categories\CategoriesCategoryEntryModel;
use Visiosoft\CategoriesModule\Category\Command\GetParents;

class CategoryModel extends CategoriesCategoryEntryModel implements CategoryInterface
{
    public function getParents()
    {
        return dispatch_now(new GetParents($this));
    }

    public function getSubCategories()
    {
        return $this->newQuery()->where('parent_category_id', $this->id)
            ->get();
    }
}
